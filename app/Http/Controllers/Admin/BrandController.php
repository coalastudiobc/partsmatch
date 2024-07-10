<?php

namespace App\Http\Controllers\Admin;

use CarApiSdk\CarApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Models\CarBrandMake;

class BrandController extends Controller
{
    public $sdk;
    public function __construct()
    {
        $this->sdk = \CarApiSdk\CarApi::build([
            'token' => "1e9f178a-f016-4aa9-b582-99934fc52ff9",
            'secret' => "37e149448eeae0e28026dcdbaea8d8c7",
        ]);
        $filePath = storage::path('text.txt');
        $jwt = file_get_contents($filePath);
        if (empty($jwt) || $this->sdk->loadJwt($jwt)->isJwtExpired() !== false) {
            try {
                $jwt = $this->sdk->authenticate();
                file_put_contents($filePath, $jwt);
            } catch (\CarApiSdk\CarApiException $e) {
                // handle errors here
                Log::channel('daily')->info("error:" . $e->getMessage());
            }
        }
    }


    public function index()
    {
        $makes = CarBrandMake::select('id', 'makes', 'image_url')->orderBy('created_at', 'DESC')->Search()->paginate(5);
        return view('admin.brands.index', compact('makes'));
    }
    public function add()
    {
        $makes = CarBrandMake::select('id', 'makes')->get();
        return view('admin.brands.add', compact('makes'));
    }
    public function store(Request $request, $id = null)
    {
        $makeId = json_decode($id);
        try {
            $data = [];
            if ($request->has('makeicon')) {
                $image = store_image($request->makeicon, 'make_icons');

                $data['image_url'] = $image['url'];
                $data['image_name'] = $image['name'];
            }
            CarBrandMake::where('id', $makeId)->update($data);
            return redirect()->back()->with(['status' => "success", "message" => 'image uploaded successfully.']);
        } catch (\Throwable $th) {
            return redirect()->back()->with(['error' =>  $th->getMessage()]);
        }
    }
    public function edit($id)
    {
        $makeId = json_decode($id);
        $makes = CarBrandMake::where('id', $makeId)->first();
        return view('admin.brands.add', compact('makes'));
    }
}
