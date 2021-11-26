<?php
namespace App\Http\Controllers;

use App\Models\Airport;

class AirportsController extends Controller
{
    public function __construct()
    {
        //
    }

    public function getAirports()
    {
        $ret = [];
        foreach (Airport::orderby('name')->get() as $airport) {
            array_push($ret, [
                "name" => $airport->name,
                "code" => $airport->code,
                "lat"  => $airport->lat,
                "lng"  => $airport->lng,
            ]);
        }
        return response()->json($ret);
    }

}
