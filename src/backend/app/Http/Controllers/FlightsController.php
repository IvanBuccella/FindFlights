<?php
namespace App\Http\Controllers;

use App\Models\Flight;

class FlightsController extends Controller
{
    public function __construct()
    {
        //
    }

    public function getFlights()
    {
        $ret = [];
        foreach (Flight::orderby('price')->get() as $flight) {
            array_push($ret, [
                "departure" => $flight->departure->code,
                "arrival"   => $flight->arrival->code,
                "price"     => $flight->price,
            ]);
        }
        return response()->json($ret);
    }

}
