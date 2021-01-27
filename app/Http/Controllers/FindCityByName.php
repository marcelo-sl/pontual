<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\City;
use App\State;

class FindCityByName extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($uf, $cityName)
    {
        if (isset($uf) && isset($cityName)) {
            $stateId = State::where('uf', $uf)->first()->id;
            $cityId = City::where([
                ['city', $cityName],
                ['state_id', $stateId],
            ])->first()->id;
        }

        return $cityId;
    }
}
