<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\State;
use App\City;

class FilterCitiesByUf extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($uf)
    {
        $stateId = State::where('uf', $uf)->first()->id;

        $filteredCities = City::where('state_id', $stateId)->orderBy('city')->get();
        
        return $filteredCities;
    }
}
