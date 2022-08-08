<?php

namespace App\Http\Controllers\Public;

use Inertia\Inertia;
use Illuminate\Http\Request;
use RakibDevs\Weather\Weather;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class Dashboard extends Controller
{
    public function index($dashboardId) {

        $user_id = Hashids::connection('dashboard')->decode($dashboardId);

        $images = DB::table('images')
            ->where('user_id', $user_id)
            ->get();        

        $dashboard_data = DB::table('dashboard')
            ->select('weather_city')
            ->where('user_id', $user_id)
            ->first();

        // dd($images);

        $weather_info = null;

        if ($dashboard_data?->weather_city != null) {

            $wt = new Weather();
            $weather_info = $wt->getCurrentByCity($dashboard_data->weather_city);
        } 

        return Inertia::render('Public/Dashboard', [
            'images' => $images,
            'weather' => $weather_info,
            'config' => $dashboard_data,
            'timeformat24h' => false
        ]);

    }
}
