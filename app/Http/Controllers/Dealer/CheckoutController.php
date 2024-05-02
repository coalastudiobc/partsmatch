<?php

namespace App\Http\Controllers\dealer;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function state($countryId)
    {

        $states = State::where('country_id', $countryId)->get();
        return response()->json(['title' => 'Success', 'data' => $states, 'message' => 'States retrieved successfully']);
    }
    public function cities($stateId)
    {
        $cities = City::where('state_id', $stateId)->get();
        // dd($cities);

        return response()->json(['title' => 'Success', 'data' => $cities, 'message' => 'Cities retrieved successfully']);
    }
    public function create()
    {
        $countries = Country::get();
        return view('dealer.checkout', compact('countries'));
    }
}
