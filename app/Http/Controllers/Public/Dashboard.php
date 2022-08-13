<?php

namespace App\Http\Controllers\Public;

use Inertia\Inertia;
use Illuminate\Http\Request;
use RakibDevs\Weather\Weather;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Dashboard extends Controller
{
    public function index($dashboardId) {

        $user_id = Hashids::connection('dashboard')->decode($dashboardId);

        $images = DB::table('images')
            ->where('user_id', $user_id)
            ->get();        

        $dashboard_data = DB::table('dashboard')
            ->select('weather_city', 'weather_radar_id')
            ->where('user_id', $user_id)
            ->first();

        // dd($images);

        $weather_info = null;

        if ($dashboard_data?->weather_city != null) {

            $wt = new Weather();
            $weather_info = $wt->getCurrentByCity($dashboard_data->weather_city);
        } 

        $files = Storage::disk('ftp')->files("/anon/gen/radar/");
        $files = collect($files);   

        $loopId = $dashboard_data->weather_radar_id;        

        $radarImages = $files->filter(function ($value, $key) use ($loopId) {
            return preg_match('/(?:' . $loopId . ').*(?:.png)$/',$value);
        })->take(-6)->map(function ($value, $key) {
            return str_replace("anon/gen/radar/", "http://www.bom.gov.au/radar/", $value);
        })->values();

        return Inertia::render('Public/Dashboard', [
            'images' => $images,
            'weather' => $weather_info,
            'config' => $dashboard_data,
            'timeformat24h' => false,
            'radarImages' => $radarImages
        ]);

    }

}
