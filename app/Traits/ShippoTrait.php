<?php

namespace App\Traits;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Models\UserAddresses;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request as GuzzleRequest;


trait ShippoTrait
{

    public function address($request)
    {
        $is_residential = 0;
        $fullName = $request->first_name . ' ' . $request->last_name;
        if ($request->addressType) {
            if ($request->addressType == 'home') {
                $is_residential = 1;
            }
        }
        $body = [
            "name" => $fullName,
            "company" => "",
            "street1" => $request->street1,
            "street2" => $request->street2,
            "city" => $request->city,
            "state" => $request->state,
            "zip" => $request->pin_code,
            "country" => $request->country,
            "phone" => $request->phone_number,
            "metadata" => $request->description,
            'is_residential' => $is_residential,
            "validate" => true,
            "object_purpose" => "PURCHASE"
        ];
        $guzzleRequest = new GuzzleRequest(
            'POST',
            'addresses/', // endpoint path relative to base_uri
            $this->headerApi(),
            json_encode($body)
        );
        try {
            $promise = $this->Client()->sendAsync($guzzleRequest)->then(function ($response) {
                return $response->getBody()->getContents();
            });
            $res = $promise->wait();
            $response_in_array = json_decode($res);
            return $response_in_array;
        } catch (\Exception $e) {
            throw new \Exception('address error: ' . $e->getMessage());
        }
    }
    public function createTransaction($body)
    {
        try {
            $endpoint = 'transactions/';
            $response = $this->createPostRequest($endpoint, $body);
            return $response;
        } catch (\Exception $e) {
            throw new \Exception('createTransaction error: ' . $e->getMessage());
        }
    }
    public function getRateDetails($rateId)
    {
        try {
            $endpoint = 'rates/' . $rateId;
            $response = $this->makeGetRequest($endpoint);
            return $response;
        } catch (\Exception $e) {
            throw new \Exception('getTranscation error: ' . $e->getMessage());
        }
    }
    public function getTranscation($transaction_rateId)
    {
        try {
            $endpoint = 'transactions?rate=' . $transaction_rateId;
            $response = $this->makeGetRequest($endpoint);
            return $response;
        } catch (\Exception $e) {
            throw new \Exception('getTranscation error: ' . $e->getMessage());
        }
    }
    public function makeGetRequest($endpoint,  $body = [])
    {
        $guzzleRequest = new GuzzleRequest(
            'GET',
            $endpoint, // endpoint path relative to base_uri
            $this->headerApi(),
            json_encode($body)
        );
        try {
            $promise = $this->Client()->sendAsync($guzzleRequest)->then(function ($response) {
                return $response->getBody()->getContents();
            });
            $res = $promise->wait();
            $response_in_array = json_decode($res);
            return $response_in_array;
        } catch (RequestException $e) {
            // Handle request exception
            if ($e->hasResponse()) {
                $errorMessage = $e->getResponse()->getBody()->getContents();
            } else {
                $errorMessage = 'Request failed: ' . $e->getMessage();
            }

            throw new \Exception('makeGetRequest error: ' . $errorMessage);
        }
    }
    public function createPostRequest($endpoint, $body)
    {
        $guzzleRequest = new GuzzleRequest(
            'POST',
            $endpoint, // endpoint path relative to base_uri
            $this->headerApi(),
            json_encode($body)
        );
        try {
            $promise = $this->Client()->sendAsync($guzzleRequest)->then(function ($response) {
                return $response->getBody()->getContents();
            });
            $response = $promise->wait();
            $res = json_decode($response);
            return $res;
        } catch (\Exception $e) {
            throw new \Exception('createPostRequest error: ' . $e->getMessage());
        }
    }
    public function headerApi()
    {
        $headers = [
            'Authorization' => 'ShippoToken shippo_test_96a55176aa0a6093d9b2fde00a924bd3160f4f68',
            'Content-Type' => 'application/json',
            'SHIPPO-API-VERSION' => '2014-02-11',
            'Cookie' => '__cf_bm=ZN9Wds4ygR_aqtdtvLW7OfP5Y4aR8veUZ.LL7L7rr4s-1719379749-1.0.1.1-z00R4n466DEP6g8ZAzFro6jty06Gy6D44j5hJcXnuDU65uloLZUPLYY.FMyy4jj8YnmmxPUotzTCP8uIIbLf4w; tracker_sessionid=b29ad3c54c8b4d73bb89d123f52d4615'
        ];
        return $headers;
    }
    public function Client()
    {
        $client = new Client([
            'base_uri' => 'https://api.goshippo.com/',
            'headers' => [
                'Authorization' => 'ShippoToken shippo_test_96a55176aa0a6093d9b2fde00a924bd3160f4f68',
                'Content-Type' => 'application/json',
                'SHIPPO-API-VERSION' => '2014-02-11',
            ],
        ]);
        return $client;
    }
    public function storeAddress($request, $addresstype, $shippo_address_id)
    {
        try {
            $checkExistenceOfuserData = UserAddresses::where('user_id', auth()->user()->id)->where('type', $addresstype)->get();
            if ($checkExistenceOfuserData->count()) {
                UserAddresses::where('user_id', auth()->user()->id)->where('type', $addresstype)->delete();
            }

            UserAddresses::create([
                'shippo_address_id' => $shippo_address_id,
                'user_id' => auth()->user()->id,
                'country' => $request->country,
                'phone_number' =>   $request->phone_number,
                'address_type' =>  $request->addressType,
                'first_name' =>  $request->first_name,
                'last_name' => $request->last_name,
                'type' => $addresstype,
                'address1' =>  $request->street1,
                'address2' =>  $request->street2,
                'state' =>  $request->state,
                'city' =>  $request->city,
                'pin_code' => $request->pin_code,
            ]);
            return true;
        } catch (\Exception $e) {
            throw new \Exception('storeAddress error: ' . $e->getMessage());
        }
    }
}