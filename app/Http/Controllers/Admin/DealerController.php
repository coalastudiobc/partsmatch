<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminProductRequest;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DealerController extends Controller
{
    public function index()
    {
        $request = request();

        $users = User::with('product')->where('id', '!=', 1)->Search()->paginate(5);
        return view('admin.user.index', compact('users'));
    }
    public function products(User $user)
    {
        $products = Product::where('user_id', $user->id)->get();
        return view('admin.user.product_list', compact('products', 'user'));
    }
    public function toggleStatus(Request $request)
    {
        $id = $request->id;
        try {
            $class = "App\Models\\{$request->model}";

            if (empty($class)) {
                return response()->json(['status' => 'error', 'message' => ucwords($request->model) . ' not found'], 404);
            }
            $result = $class::where('id', $id)->firstOrFail();
            $status = ($result->status == "ACTIVE") ? 'INACTIVE' : 'ACTIVE';
            if ($result->update(['status' => $status])) {
                if ($status == 'ACTIVE') {
                    return response()->json(['status' => 'success', 'message' => "Dealer has been activated"], 200);
                } else {
                    return response()->json(['status' => 'danger', 'message' => "Dealer has been deactivated"], 200);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'status' . ' has not been updated.'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    public function dealerProfile(Request $request, User $user)
    {
        $paymentdetail = $user->paymentDetail;

        return view('admin.user.view', compact('user', 'paymentdetail'));
    }

    public function productedit(AdminProductRequest $request, Product $product)
    {
        if ($request->method() == 'GET') {
            return view('admin.user.product_edit', compact('product'));
        } else {
            try {
                DB::beginTransaction();
                $product->update([
                    'name' => $request->name,
                    'subcategory_id' => $request->subcategory,
                    'description' => $request->description,
                    'additional_details' => $request->additional_details,
                    'stocks_avaliable' => $request->stocks_avaliable,
                    'price' => $request->price,
                    'shipping_price' => $request->shipping_price,
                    'other_specification' => $request->other_specification,
                    'year' => $request->car_years,
                    'brand' => $request->car_makes,
                    'model' => $request->car_models,
                ]);
                if ($request->hasFile('images')) {
                    $images = $request->file('images');
                    foreach ($images as $image) {
                        // dd("got something?");
                        // if (!is_null($product->productImage)) {
                        //     dd("yeah!");
                        //     $existingFile = $product->productImage->file_name;
                        //     if (!is_null($existingFile) && Storage::exists($existingFile)){
                        //         Storage::disk('public')->delete('products', $existingFile);
                        //     }
                        // }
                        // dd('what are you doin...?', $images);
                        $fileName = $image->getClientOriginalName();
                        $path = Storage::disk('public')->put('products', $image);
                        ProductImage::create([
                            'product_id' => $product->id,
                            'file_name' => $fileName,
                            'file_url' => $path
                        ]);
                    }
                }
                DB::commit();
                return redirect()->back();
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }
}
