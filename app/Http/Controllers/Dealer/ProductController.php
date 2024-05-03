<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\FeaturedProduct;
use App\Models\Product;
use App\Models\ProductImage;
use GrahamCampbell\ResultType\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('productImage', 'featuredProduct')->where('user_id', auth()->user()->id)->Search()->Paginate(5);

        // $subscription =  DB::table('subscriptions')->where('user_id', auth()->user()->id)->first();
        return view('dealer.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.   
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $product = [
                'name' => $request->name,
                'user_id' => auth()->user()->id,
                'subcategory_id' => $request->subcategory,
                'description' => $request->description,
                'additional_details' => $request->additional_details,
                'stocks_avaliable' => $request->stocks_avaliable,
                'price' => $request->price,
                'shipping_price' => $request->shipping_price,
                'other_specification' => $request->other_specification,
                'year' => $request->car_years,
                'brand' => $request->car_make,
                'model' => $request->car_model,
                'status' => '1',
            ];

            DB::beginTransaction();
            $product = Product::create($product);
            if (isset($request->subscription_status)) {
                $featured_product = [
                    'user_id' => auth()->user()->id,
                    'product_id' => $product->id,
                    'category_id' => $request->category
                ];
                FeaturedProduct::create($featured_product);
            }

            if (count($request->file('images')) > 0) {
                foreach ($request->file('images') as $file) {
                    $image = store_image($file, 'products/images');
                    if ($image != null) {
                        $productimage[] = [
                            'product_id' => $product->id,
                            'file_name' => $image['name'],
                            'file_url' => $image['url'],
                        ];
                    }
                }
            }

            ProductImage::insert($productimage);

            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $category = Category::where('id', $product->subcategory_id)->first();
        $images = ProductImage::where('product_id', $product->id)->get();
        return view('dealer.products.edit', compact('product', 'category', 'images'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        foreach ($request->image_id as $image) {
            $id = $image;
            $ids[] = explode(',', $id);
        }
        // dd($ids);
        // dd($request->toArray());

        try {

            $products = [
                'name' => $request->name,
                'user_id' => auth()->user()->id,
                'subcategory_id' => $request->subcategory,
                'description' => $request->description,
                'additional_details' => $request->additional_details,
                'stocks_avaliable' => $request->stocks_avaliable,
                'price' => $request->price,
                'shipping_price' => $request->shipping_price,
                'other_specification' => $request->other_specification,
                'year' => $request->year,
                'brand' => $request->brand,
                'model' => $request->model,
                'status' => '1',
            ];

            DB::beginTransaction();
            $product->update($products);
            // dd($request->images);
            if (isset($request->images) && count($request->file('images')) > 0) {
                foreach ($request->file('images') as $key => $file) {
                    $image = store_image($file, 'products/images');
                    if ($image != null) {
                        $productimage[] = [
                            'product_id' => $product->id,
                            'file_name' => $image['name'],
                            'file_url' => $image['url'],
                        ];
                    }
                }
                $productImage = ProductImage::insert($productimage);
                // dd($productImage);
            }

            // $images = ProductImage::where('product_id', $product->id)->get();

            foreach ($ids as $id) {
                foreach ($id as $id) {
                    if ($id != "imageid[]") {
                        $image = ProductImage::where('id', $id)->first();
                        Storage::disk('public')->delete('products/images', $image->file_url);
                        $image->delete();
                    }
                    break;
                }
            }
            // dd($images, $request->file('images'));


            DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $featureproduct = FeaturedProduct::where('product_id', $product->id)->first();
        $images = ProductImage::where('product_id', $product->id)->get();
        // dd($images->toArray());
        $featureproduct->delete();
        foreach ($images as $image) {
            Storage::disk('public')->delete('products/images', $image->file_url);
            $image->delete();
        }
        $product->delete();
        return redirect()->back()->with(['message' => "successfully deleted"]);
    }

    public function featuredproductcreate(Product $product)
    {
        if (isset(plan_validity()->stripe_status) && plan_validity()->stripe_status != 'active') {
            session()->flash('success', 'Please purchase plan');
            return response()->json([
                'status' => false,
                'message' => 'Please purchase plan'
            ], 200);
        }
        $category = Category::where('id', $product->subcategory_id)->first();
        $featured_product = [
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'category_id' => $category->id
        ];

        FeaturedProduct::create($featured_product);
        session()->flash('success', 'Featured plan created Successfully');
        return response()->json([
            'status' => true,
            'message' => 'Successfully created'
        ], 200);
    }
    public function featuredproductdelete(FeaturedProduct $id)
    {
        $id->delete();
        session()->flash('success', 'Featured plan deleted Successfully');
        return response()->json([
            'status' => true,
            'message' => "Successfully deleted"
        ], 200);
    }
    public function subcategory($id)
    {
        $subcategories = Category::where('parent_id', $id)->get();
        return response()->json([
            'status' => true,
            'subcategory' => view('dealer.include.subcategory', compact('subcategories'))->render(),
        ], 200);
    }
}
