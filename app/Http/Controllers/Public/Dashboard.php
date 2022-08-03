<?php

namespace App\Http\Controllers\Public;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Controllers\Controller;

class Dashboard extends Controller
{
    public function index($dashboardId) {

        // dd(Hashids::connection('dashboard')->encode($dashboardId));

        $user_id = Hashids::connection('dashboard')->decode($dashboardId);

        $images = DB::table('images')
            ->where('user_id', $user_id)
            ->first()?->url;

        // dd($images);

        return Inertia::render('Public/Dashboard', [
            'image' => $images,
            'timeformat24h' => false
        ]);

    }
}
