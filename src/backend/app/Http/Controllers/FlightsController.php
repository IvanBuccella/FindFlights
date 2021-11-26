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
        $result = ["error" => "No Flights Found"];

        $maxStopOvers = 2;
        $s            = Airport::where('code', 'LIN')->first();
        $t            = Airport::where('code', 'LIN')->first();

        $minCost = $this->revisitedBellmanFord($s, $t, $maxStopOvers);
        if ($this->nextHop[$s->id] instanceof Flight) {
            $result = ["price" => $minCost, "flights" => $this->getPath($s, $t)];
        }

        return response()->json($result);
    }

    private function revisitedBellmanFord($s, $t, $maxStopOvers)
    {
        $maxEdges = $maxStopOvers + 1;
        $infinite = 0x7FFFFFFF;

        $airports = Airport::all();

        $cost          = [];
        $this->nextHop = [];
        foreach ($airports as $airport) {
            $cost[$airport->id]          = $infinite;
            $this->nextHop[$airport->id] = 0;
        }
        $cost[$t->id] = 0;

        for ($i = 0; $i < $maxEdges; $i++) {
            foreach ($airports as $airport) {
                $v       = $airport->id;
                $flights = Flight::where('code_departure', $v)->get();
                foreach ($flights as $flight) {
                    $flight->departure;
                    $w        = $flight->arrival->id;
                    $newPrice = floatval($cost[$w]) + floatval($flight->price);
                    if ($cost[$v] > $newPrice) {
                        $cost[$v]          = $newPrice;
                        $this->nextHop[$v] = $flight;
                    }
                }
            }
        }

        return $cost[$s->id];
    }

    private function getPath($s, $t)
    {
        if (!($this->nextHop[$s->id] instanceof Flight)) {
            return [];
        }

        if ($this->nextHop[$s->id]->arrival->id == $t->id) {
            return [$this->nextHop[$s->id]];
        }

        $subpaths = $this->getPath($this->nextHop[$s->id]->arrival, $t);

        array_unshift($subpaths, $this->nextHop[$s->id]);

        return $subpaths;
    }

    private function checkCost()
    {

    }
}
