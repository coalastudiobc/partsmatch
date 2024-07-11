<?php

namespace App\Http\Controllers\Dealer;

use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\AdminSetting;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\FeaturedProduct;
use Illuminate\Support\Facades\DB;
use App\Models\ProductCompatabilty;
use App\Models\ProductParcelDetail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $years = $this->sdk->years();

        $products = Product::with('productImage', 'featuredProduct')->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->Search()->Paginate(5);

        // $subscription =  DB::table('subscriptions')->where('user_id', auth()->user()->id)->first();
        return view('dealer.products.index', compact('years', 'products'));
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
        // dd($request->toArray());
        try {
            $product = [
                'name' => $request->name,
                'user_id' => auth()->user()->id,
                'subcategory_id' => $request->subcategory,
                'description' => $request->description,
                'part_number' => $request->part_number,
                'additional_details' => $request->additional_details,
                'stocks_avaliable' => $request->stocks_avaliable,
                'price' => $request->price,
                // 'shipping_price' => $request->shipping_price,
                // 'other_specification' => $request->other_specification,
                // 'Specifications_and_dimensions' => $request->Specifications_and_dimensions,
                // 'Shipping_info' => $request->Shipping_info,
                // 'field_3' => $request->field_3,
                // 'year' => $request->car_years,
                // 'brand' => $request->car_model,
                // 'model' => $request->car_make,
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

            if ($request->has('compatable_with')) {
                $compatables = explode(',', $request->compatable_with);
                for ($i = 0; $i < count($compatables); $i++) {
                    $item = $compatables[$i];
                    if (preg_match('/(\d{4})\((.*?)\)(.*)/', $item, $matches)) {
                        $year = $matches[1];
                        $make = $matches[2];
                        $model = $matches[3];
                        ProductCompatabilty::create(['year' => $year, 'make' => $make, 'model' => $model, 'product_id' => $product->id]);
                    }
                }
            }
            ProductParcelDetail::create([
                'product_id' => $product->id,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->height,
                'weight' => $request->weight,
                'distance_unit' => $request->distance_unit,
                'mass_unit' => $request->mass_unit,
            ]);
            DB::commit();
            return redirect()->back()->with('message', 'Product added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        if ($request->globalquery) {
            $products = Product::when(!empty($request->globalquery), function ($q) use ($request) {
                $q->Where('name', 'like', '%' . $request->globalquery . '%')
                    ->orWhere('price', 'like', '%' . $request->globalquery . '%')
                    ->orWhere('year', 'like', '%' . $request->globalquery . '%')
                    ->orWhere('brand', 'like', '%' . $request->globalquery . '%')
                    ->orWhere('model', 'like', '%' . $request->globalquery . '%');
            })->when(!empty($request->globalquery) && $request->globalquery == 'active', function ($q) use ($request) {
                $q->where('status', '1');
            });
        }
        $category = Category::with('children', 'parent')->where('id', $request->category)->first();
        if ($category->parent) {
            $products = Product::with('productImage', 'user')->where('subcategory_id', $category->id)->Paginate(5);
            $parent = $category->parent->id;
        } else {

            $subcategories = $category->children->pluck('id');
            $products = Product::with('productImage', 'user')->whereIn('subcategory_id', $subcategories->toArray())->Paginate(5);
            $parent = $category->id;
        }
        $active_id = $category->id;
        return view('dealer.products.interior_accessories', compact('products', 'active_id',  'parent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product)
    {
        $product = Product::with('category', 'productCompatible', 'parcelDetail')->where('id', $product)->first();
        $years = $this->sdk->years();
        $category = Category::where('id', $product->subcategory_id)->first();
        $images = ProductImage::where('product_id', $product->id)->get();
        $oppositeResults = [];
        foreach ($product->productCompatible as $key => $value) {
            $oppositeFormat = $value->year . '(' . $value->make . ')' . $value->model;
            array_push($oppositeResults, $oppositeFormat);
            // $oppositeResults[] = $oppositeFormat;
        }
        $oppositeString = implode(',', $oppositeResults);
        $oppositeString = json_encode($oppositeResults);
        return view('dealer.products.edit', compact('years', 'product', 'category', 'images', 'oppositeString'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // dd($product);
        foreach ($request->image_id as $image) {
            $id = $image;
            $ids[] = explode(',', $id);
        }


        try {

            $products = [
                'name' => $request->name,
                'user_id' => auth()->user()->id,
                'subcategory_id' => $request->subcategory,
                'description' => $request->description,
                'additional_details' => $request->additional_details,
                'stocks_avaliable' => $request->stocks_avaliable,
                'price' => $request->price,
                // 'shipping_price' => $request->shipping_price,
                // 'other_specification' => $request->other_specification,
                // 'Specifications_and_dimensions' => $request->Specifications_and_dimensions,
                // 'Shipping_info' => $request->Shipping_info,
                // 'field_3' => $request->field_3,
                // 'year' => $request->year,
                // 'brand' => $request->brand,
                // 'model' => $request->model,
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
            if ($request->has('compatable_with')) {
                $compatables = explode(',', $request->compatable_with);
                ProductCompatabilty::where('product_id', $product->id)->delete();
                for ($i = 0; $i < count($compatables); $i++) {
                    $item = $compatables[$i];
                    if (preg_match('/(\d{4})\((.*?)\)(.*)/', $item, $matches)) {
                        $year = $matches[1];
                        $make = $matches[2];
                        $model = $matches[3];
                        ProductCompatabilty::create(['year' => $year, 'make' => $make, 'model' => $model, 'product_id' => $product->id]);
                    }
                }
            }
            ProductParcelDetail::create([
                'product_id' => $product->id,
                'length' => $request->length,
                'width' => $request->width,
                'height' => $request->heigth,
                'weight' => $request->weight,
                'distance_unit' => $request->distance_unit,
                'mass_unit' => $request->mass_unit,
            ]);
            DB::commit();
            return redirect()->back()->with('message', 'Data updated successfully');
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
        // Cart::where('product_id', $product->id)->first();
        $featureproduct = FeaturedProduct::where('product_id', $product->id)->first();
        $images = ProductImage::where('product_id', $product->id)->get();

        if ($featureproduct) {
            $featureproduct->delete();
        }
        foreach ($images as $image) {
            Storage::disk('public')->delete('products/images', $image->file_url);
            $image->delete();
        }
        $product->delete();
        return redirect()->back()->with(['message' => "successfully deleted"]);
    }

    public function featuredproductcreate(Product $product)
    {
        try {
            if (isset(plan_validity()->stripe_status) && plan_validity()->stripe_status != 'active') {

                session()->flash('success', 'Please purchase plan');
                return response()->json([
                    'status' => false,
                    'message' => 'Please purchase plan'
                ], 200);
            }
            if (!plan_validity()) {

                // session()->flash('success', 'Please purchase plan');
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
            // session()->flash('success', 'Featured plan created Successfully');
            return response()->json([
                'status' => true,
                'message' => 'Featured plan created Successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }
    public function featuredproductdelete(FeaturedProduct $id)
    {
        $id->delete();
        // session()->flash('success', 'Featured plan deleted Successfully');
        return response()->json([
            'status' => true,
            'message' => "Featured plan deleted Successfully"
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

    public function details(Product $product)
    {
        $userdetails = User::where('id', $product->user_id)->first();
        $productImages = $product->productImage;
        $shippingCharge = AdminSetting::where('name', 'shipping_charge')->first();
        $allproducts = Product::with('productImage')->where('user_id', $userdetails->id)->inRandomOrder()->limit(6)->get();
        if (auth()->user()) {
            $cart =  Cart::with('cartProducts', 'cartProducts.product', 'cartProducts.product.productImage')->where('user_id', auth()->id())->first();
            return view('dealer.products.product_details', compact('product', 'productImages', 'shippingCharge', 'userdetails', 'allproducts', 'cart'));
        }
        return view('dealer.products.product_details', compact('product', 'productImages', 'shippingCharge', 'userdetails', 'allproducts'));
    }

    // public function interior($subcategory_id)
    // {
    //     $products = Product::with('productImage')->where('subcategory_id', $subcategory_id)->get();
    //     return view('dealer.products.interior_accessories', compact('products'));
    // }

    public function model($year)
    {
        $models = $this->sdk->makes(['query' => ['year' => $year]]);
        // $make = $this->sdk->models(['query' => ['make' => 'Toyota']]);
        $modeldata = $models->data;
        // dd($modeldata, $make, $this->sdk->years());
        $model = view('components.model-component', compact('modeldata'))->render();

        return response()->json(['success' => true, 'models' => $model]);
    }

    public function make($model)
    {

        $make = $this->sdk->models(['query' => ['make' => $model]]);
        $makedata = $make->data;
        $make = view('components.make-component', compact('makedata'))->render();

        return response()->json(['success' => true, 'makes' => $make]);
    }
    public function search(Request $request)
    {
        if (is_null($request->globalquery)) {
            return redirect()->back();
        }
        // Define initial query
        $productsQuery = Product::query();

        // Apply global search for products
        $productsQuery->when(!empty($request->globalquery), function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->globalquery . '%')
                    ->orWhere('price', 'like', '%' . $request->globalquery . '%')
                    ->orWhere('year', 'like', '%' . $request->globalquery . '%')
                    ->orWhere('brand', 'like', '%' . $request->globalquery . '%')
                    ->orWhere('model', 'like', '%' . $request->globalquery . '%');
            });
        });

        // Apply status filter if 'active' keyword is provided
        $productsQuery->when(!empty($request->globalquery) && $request->globalquery == 'active', function ($query) {
            $query->where('status', '1');
        });
        // Retrieve products
        $products = $productsQuery->paginate(5)
            ->appends($request->globalquery);

        // // Retrieve categories for the products
        // $categories = Category::with('children', 'parent')->get();

        // // Extract parent category ID
        // $parentCategoryId = null;
        // if ($request->has('category')) {
        //     $category = $categories->firstWhere('id', $request->category);
        //     if ($category && $category->parent) {
        //         $parentCategoryId = $category->parent->id;
        //     }
        // }

        // Retrieve products

        return view('dealer.products.search_products', compact('products'));
    }
}
