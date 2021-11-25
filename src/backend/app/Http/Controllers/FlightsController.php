<?php

namespace App\Http\Controllers;

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
        $flights = Flight::all();
        return response()->json($flights);
    }

}
