<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use App\Models\Country;
use App\Traits\ShippoTrait;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use App\Http\Requests\ShippingAddressRequest;
use App\Models\ShippingAddress;
use App\Models\UserAddresses;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class ShippoController extends Controller
{
    use ShippoTrait;

    public function view()
    {
        $countries = Country::all();
        // $states = State::all();
        // $city = City::all();
        return view('dealer.picking_address.index', compact('countries'));
    }

    public function from_address(ShippingAddressRequest $request)
    {
        try {
            dd($request->toArray());
            $shippoResponse = $this->address($request);
            if ($shippoResponse->object_state == "VALID") {
                $shippo_address_id = $shippoResponse->object_id;
                $addresstype = 'Pickup';
                $this->storeAddress($request, $addresstype, $shippo_address_id);
                return redirect()->back()->with('message', 'Picking address added successfully');
            }
            $error_code = $shippoResponse->messages[0]->code;
            // $error_type = $shippoResponse->messages[0]->type;
            $error_text = $shippoResponse->messages[0]->text;
            return redirect()->back()->with(['shippo' => 'error', 'code' => $error_code, 'text' => $error_text]);
        } catch (\Exception $e) {
            return  redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
