<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;

class FlightsController extends Controller
{
    private $nextHop;
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
        $maxStopOvers = 1;
        $s            = Airport::where('code', 'EZE')->first();
        $t            = Airport::where('code', 'NAP')->first();
        $a            = $this->shortestPath($s, $t, $maxStopOvers);

        return response()->json($a);
    }

    private function shortestPath($s, $t, $maxStopOvers)
    {
        $maxDepth = $maxStopOvers + 1;
        $infinite = 0x7FFFFFFF;

        $airports = Airport::all();

        $m             = [];
        $this->nextHop = [];
        foreach ($airports as $airport) {
            $m[$airport->id]             = $infinite;
            $this->nextHop[$airport->id] = 0;
        }
        $m[$t->id] = 0;

        for ($i = 1; $i <= $maxDepth - 1; $i++) {
            foreach ($airports as $airport) {
                $v       = $airport->id;
                $flights = Flight::where('code_departure', $v)->get();
                foreach ($flights as $flight) {
                    $flight->departure;
                    $w        = $flight->arrival->id;
                    $newPrice = floatval($m[$w]) + floatval($flight->price);
                    if ($m[$v] > $newPrice) {
                        $m[$v]             = $newPrice;
                        $this->nextHop[$v] = $flight;
                    }
                }
            }
        }

        return $this->getPath($s, $t);
    }

    private function getPath($s, $t)
    {
        if ($this->nextHop[$s->id] == 0) {
            return ["price" => 0, "flights" => []];
        }

        if ($this->nextHop[$s->id]->arrival->id == $t->id) {
            return ["price" => $this->nextHop[$s->id]->price, "flights" => [$this->nextHop[$s->id]]];
        }

        $subpaths = $this->getPath($this->nextHop[$s->id]->arrival, $t);

        $subpaths["price"] += $this->nextHop[$s->id]->price;
        array_unshift($subpaths["flights"], $this->nextHop[$s->id]);

        return $subpaths;
    }
}
