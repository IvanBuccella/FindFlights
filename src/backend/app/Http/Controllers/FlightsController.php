<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;

class FlightsController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Retrieve the Flight with the lowest price
     *
     * @return Response
     */
    public function getLowestPriceFlight()
    {
        /*
        foreach (Airport::all() as $airport) {
        $flights = Flight::where('code_departure', $airport->id)->get();
        //::has('departure', '=', $airport->id)->get(); //For ogni arco (v,w) ∈ E
        $a = $airport->code;
        foreach ($flights as $flight) {
        $b = $flight->departure->code;
        $c = $flight->arrival->code;
        $d = $flight->price;
        }
        }
         */
        $a = $this->shortestPath(1, 3, 2);

        return response()->json($a);
    }

    private function shortestPath($s, $t, $maxDepth)
    {
        $infinite = 0x7FFFFFFF;

        $airports = Airport::all();

        $m = [[]];
        foreach ($airports as $airport) {
            $m[0][$airport->id] = $infinite;
        }
        $m[0][$t] = 0;

        for ($i = 1; $i < $maxDepth; $i++) {
            foreach ($airports as $airport) {
                $v         = $airport->id;
                $previous  = $i - 1;
                $m[$i][$v] = $m[$previous][$v];
                $flights   = Flight::where('code_departure', $v)->get(); //For ogni arco (v,w) ∈ E
                foreach ($flights as $flight) {
                    $w = $flight->arrival->id;
                    if ($m[$i][$v] > $m[$previous][$w] + $flight->price) {
                        $m[$i][$v] = $m[$previous][$w] + $flight->price;
                    }
                }
            }
        }

        return $m[$maxDepth - 1][$s];
    }

}
