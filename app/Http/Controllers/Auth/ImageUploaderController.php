<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Request as InertiaRequest;

class ImageUploaderController extends Controller
{
    public function index() {
        $images = DB::table('images')
            ->select(
                'id',
                'url'
            )
            ->where('user_id', Auth::id())
            ->get();


        return Inertia::render('ImagePage', [
            'images' => $images
        ]);
    }

    private function generateCDNUrl($filePath) {
        return env('CDN_URL') . $filePath;
    }

    public function store(Request $request) {
        $data = InertiaRequest::validate([
            'image' => ['image']
        ]);

        $hasQuotaLeft = DB::table('images')
            ->where('user_id', Auth::id())
            ->count() <= env('USER_MAX_IMAGE_COUNT');

        // If used up all image slots, return
        if (!$hasQuotaLeft) {
            return redirect()->back()->withErrors(['file' => 'You have uploaded too many photos']);
        }


        $clientId = Hashids::connection('dashboard')->encode(Auth::id());

        $fileName = Str::uuid()->toString();

        $filePath = "dashboards/" . $clientId . "/" . $fileName . ".png";

        Storage::disk('s3')->put($filePath, file_get_contents($data['image']));

        DB::table('images')
            ->insert([
                'user_id' => Auth::id(),
                'url' => $this->generateCDNUrl($filePath),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        
        return redirect()->back();
    }
}
