<?php

namespace App\Http\Controllers\Auth;

use stdClass;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomePageController extends Controller
{
    public function index() {

        $dashboard_id = Hashids::connection('dashboard')->encode(Auth::id());

        $dashboard_data = DB::table('dashboard')
            ->select('weather_city')
            ->where('user_id',  Auth::id())
            ->first();

        if ($dashboard_data == null) {
            DB::table('dashboard')
                ->insert([
                    'weather_city' => 'Brisbane',
                    'user_id' => Auth::id(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

            $dashboard_data = new stdClass();
            $dashboard_data->weather_city = "Brisbane";
        }
    

        return Inertia::render('Dashboard', [
            'dashboard_link' => URL::to("/dashboard/" . $dashboard_id),
            'currentCity' => $dashboard_data?->weather_city
        ]);
    }
}
