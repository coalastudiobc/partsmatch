<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PackageRequest;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PackageController extends Controller
{
    private $stripe;
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    public function index()
    {
        $packages = Package::orderByDesc('id')->paginate(config('constants.pagination'));

        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        $package = new Package;
        return view('admin.packages.add', compact('package'));
    }

    public function store(PackageRequest $request, $id = null)
    {
        // dd($request->toArray());
        $id = jsdecode_userdata($id);
        DB::beginTransaction();
        try {
            $time_type = $request->time_type ? (jsdecode_userdata($request->time_type) == "Yearly" ? 'year' : 'month') : "month";

            if (jsdecode_userdata($request->time_type) == "Quarterly") {
                $interval = 3;
            } else if (jsdecode_userdata($request->time_type) == "Halfly") {
                $interval = 6;
            } else {
                $interval = 1;
            }
            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'billing_cycle' => jsdecode_userdata($request->time_type),
                'description' => $request->description,
                'status' => $request->status,
            ];

            if ($id == null) {
                $product = $this->stripe->products->create([
                    'name' => $request->name,
                ]);
                $product_price = $this->stripe->prices->create([
                    'unit_amount' => $request->price * 100,
                    'product' => $product->id,
                    "recurring" => [
                        "interval" =>  $time_type,
                        "interval_count" =>  $interval,
                        "usage_type" =>  "licensed"
                    ],
                    'currency' =>   'USD',
                ]);
                $data['stripe_id'] = $product->id;
                $data['stripe_price'] = $product_price->id;
                $data['trial_days'] = $product_price->recurring->trial_period_days;
                Package::create($data);
                $message = "Package created sucessfully";
            } else {
                $package = Package::where('id', $id)->firstOrFail();

                if ($package) {
                    $this->stripe->products->update($package->stripe_id, ['name' => $request->name]);
                    if ($package->price <> $request->price) {
                        $product_price = $this->stripe->prices->create([
                            'unit_amount' => $request->price * 100,
                            'product' => $package->stripe_id,
                            "recurring" => [
                                "interval" =>  $time_type,
                                "interval_count" =>  $interval,
                                "usage_type" =>  "licensed"
                            ],
                            'currency' =>   'USD',
                        ]);
                    }
                    $package->update($data);
                    $message = "Package updated sucessfully";
                    session()->flash('message', $message);
                } else {
                    return response()->json([
                        'success'    =>  false,
                        'msg'       =>   "Package not found"
                    ], 200);
                }
            }
            // dd($abc);
            DB::commit();
            // $url = route('admin.packages.all');
            session()->flash('status', 'success');
            session()->flash('message', $message);
            return redirect()->route('admin.packages.all');
            // return response()->json([
            //     'success'    =>  true,
            //     // 'url'       =>   $url
            // ], 200);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'success'    =>  false,
                'msg'      =>  $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $id = jsdecode_userdata($id);
        $package = Package::where('id', $id)->firstOrFail();

        return view('admin.packages.add', compact('package'));
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $id = jsdecode_userdata($id);
            $package = Package::where('id', $id)->first();
            $test = $this->stripe->products->update($package->stripe_id, ['active' => false]);
            Package::where('id', $id)->delete();
            DB::commit();
            $status = "success";
            $message = "Package deleted successfully";
        } catch (\Exception $e) {
            DB::rollback();
            $status = "error";
            $message = $e->getMessage();
        }

        return redirect()->route('admin.packages.all')->with(['status' => $status, 'message' => $message]);
    }
}
