<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use App\Models\Flight;

class LowestFlightController extends Controller
{
    private $nextAirport = [];
    private $cost        = [];

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
        $codeDeparture = request()->codeDeparture;
        $codeArrival   = request()->codeArrival;

        $departure_airport = Airport::where('code', $codeDeparture)->first();
        if (!$departure_airport instanceof Airport) {
            return $this->response(["error" => "Cannot find the specified departure airport."]);
        }

        $arrival_airport = Airport::where('code', $codeArrival)->first();
        if (!$arrival_airport instanceof Airport) {
            return $this->response(["error" => "Cannot find the specified arrival airport."]);
        }

        $maxStopOvers = 2;
        $minCost      = $this->revisitedBellmanFord($departure_airport, $arrival_airport, $maxStopOvers);
        if ($this->nextAirport[$departure_airport->id] instanceof Flight) {
            $response = ["price" => $minCost, "flights" => $this->getFlights($departure_airport, $arrival_airport)];
        } else {
            $response = ["error" => "No Flights Found"];
        }

        return $this->response($response);
    }

    private function response($response)
    {
        return response()->json($response);
    }

    private function revisitedBellmanFord($departure_airport, $arrival_airport, $maxStopOvers)
    {
        $maxEdges = $maxStopOvers + 1;
        $airports = Airport::all();

        foreach ($airports as $airport) {
            $this->cost[$airport->id]        = PHP_FLOAT_MAX;
            $this->nextAirport[$airport->id] = null;
        }
        $this->cost[$arrival_airport->id] = 0;

        for ($i = 0; $i < $maxEdges; $i++) {
            foreach ($airports as $airport) {
                $current_departure_airport = $airport->id;
                $available_flights_from    = Flight::where('code_departure', $current_departure_airport)->get();
                foreach ($available_flights_from as $flight) {
                    $this->updateCost($flight, $current_departure_airport);
                }
            }
        }

        return $this->cost[$departure_airport->id];
    }

    private function updateCost($flight, $departure_airport)
    {
        $flight->departure;
        $arrival_airport = $flight->arrival->id;
        $newPrice        = (float) $this->cost[$arrival_airport] + (float) $flight->price;
        if ($this->cost[$departure_airport] > $newPrice) {
            $this->cost[$departure_airport]        = (float) $newPrice;
            $this->nextAirport[$departure_airport] = $flight;
        }
    }

    private function getFlights($departure_airport, $arrival_airport)
    {
        if ($this->nextAirport[$departure_airport->id]->arrival->id == $arrival_airport->id) {
            return [$this->nextAirport[$departure_airport->id]];
        }

        $subpaths = $this->getFlights($this->nextAirport[$departure_airport->id]->arrival, $arrival_airport);

        array_unshift($subpaths, $this->nextAirport[$departure_airport->id]);

        return $subpaths;
    }
}
