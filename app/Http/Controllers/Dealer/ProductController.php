<?php

namespace App\Http\Controllers\Dealer;

use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\AllModel;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Models\AdminSetting;
use App\Models\ProductImage;
use App\Models\CarBrandMake;
use App\Models\FeaturedProduct;
use Illuminate\Support\Facades\DB;
use App\Models\ProductCompatabilty;
use App\Models\ProductParcelDetail;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\ShippoPurchasedLabel;
use App\Models\PackagePaymentDetail;
use App\Http\Requests\ProductRequest;
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
           'token' => config('services.Car_api.CAR_API_TOKEN'),
            'secret' => config('services.Car_api.CAR_API_SECRET'),
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
        if($this->getUserParent() == auth()->id())
        {
            $products = Product::with('productImage', 'featuredProduct')->where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->Search()->Paginate(__('pagination.pagination_nuber'));
        }else
        {
            $products = Product::with('productImage', 'featuredProduct')->where('dealer_id', auth()->user()->id)->orderBy('id', 'DESC')->Search()->Paginate(__('pagination.pagination_nuber'));

        }
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
    public function downloadCSV()
    {
        $filePath = 'sample.csv';

        if (!Storage::exists($filePath)) {
            abort(404);
        }

        return Storage::download($filePath);
    }
    public function downloadModifiedCSV()
    {
        $filePath = 'sample.csv';

        if (!Storage::exists($filePath)) {
            abort(404);
        }
        $csvData = array_map('str_getcsv', file(Storage::path($filePath)));
        $allowedCategories = Category::with('parent')->has('parent')->pluck('name')->toArray();
        $csvData[0][] = 'allowed_categories';
        $columnCount = count($csvData[0]);
        foreach ($csvData as $index => &$row) {
            while (count($row) < $columnCount - 1) {
                $row[] = '';
            }

            if ($index > 0) {
                $row[] = $allowedCategories[$index - 1] ?? '';
            } else {
                $row[] = 'please delete this column as well as allowed_categories';
            }
        }
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="modified_sample.csv"',
        ];

        return response()->streamDownload(function () use ($csvData) {
            $output = fopen('php://output', 'w');
            foreach ($csvData as $row) {
                fputcsv($output, $row);
            }
            fclose($output);
        }, 'modified_sample.csv', $headers);
    }

    public function bulkUpload(Request $request)
    {
        try {
            $request->validate([
                'csv_file' => 'required|file|mimes:csv',
            ]);

            $path = $request->file('csv_file')->getRealPath();
            $data = array_map('str_getcsv', file($path));
            $header = array_shift($data);
            foreach ($data as $row) {
                $row = array_combine($header, $row);
                $subcategory = Category::with('parent')->has('parent')->where('name', $row['category'])->first();
                if (!$subcategory) {
                    $subcategory = Category::where('name', 'others')->first();
                }
                $product = [
                    'name' => $row['name'],
                    'user_id' =>$this->getUserParent(),
                    'dealer_id' =>  auth()->user()->id,
                    'subcategory_id' => $subcategory->id,
                    'description' => $row['description'],
                    'part_number' => $row['part_number'],
                    'additional_details' => $row['additional_details'],
                    'stocks_avaliable' => !empty($row['quantity']) && $row['quantity'] >= 0 ? $row['quantity'] : 0,
                    'price' => $row['price'],
                    'status' => '1',
                ];
                DB::beginTransaction();
                $product = Product::create($product);
                if ($row['year(Make)Model']) {
                    $compatables = explode(',', $row['year(Make)Model']);
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
                DB::commit();
            }
            return redirect()->back()->with('message', 'Product added successfully');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // dd($request->toArray());
        try {
            $product = [
                'name' => $request->name,
                'user_id' =>$this->getUserParent(),
                'dealer_id' =>  auth()->user()->id,
                'subcategory_id' => $request->subcategory,
                'description' => $request->description,
                'part_number' => $request->part_number,
                'additional_details' => $request->additional_details,
                'stocks_avaliable' => $request->stocks_avaliable,
                'price' => $request->price,
                'status' => '1',
            ];
            // 'shipping_price' => $request->shipping_price,
            // 'other_specification' => $request->other_specification,
            // 'Specifications_and_dimensions' => $request->Specifications_and_dimensions,
            // 'Shipping_info' => $request->Shipping_info,
            // 'field_3' => $request->field_3,
            // 'year' => $request->car_years,
            // 'brand' => $request->car_model,
            // 'model' => $request->car_make,
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

            if ($request->has('images') && count($request->file('images')) > 0) {
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
                ProductImage::insert($productimage);
            }


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
            // ProductParcelDetail::create([
            //     'product_id' => $product->id,
            //     'length' => $request->length,
            //     'width' => $request->width,
            //     'height' => $request->height,
            //     'weight' => $request->weight,
            //     'distance_unit' => $request->distance_unit,
            //     'mass_unit' => $request->mass_unit,
            // ]);
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
            $products = Product::with('productImage', 'user')->where('subcategory_id', $category->id)->Paginate(__('pagination.pagination_nuber'));
            $parent = $category->parent->id;
        } else {

            $subcategories = $category->children->pluck('id');
            $products = Product::with('productImage', 'user')->whereIn('subcategory_id', $subcategories->toArray())->Paginate(__('pagination.pagination_nuber'));
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
    public function update(ProductRequest $request, Product $product)
    {
        foreach ($request->image_id as $image) {
            $id = $image;
            $ids[] = explode(',', $id);
        }
        try {

            $products = [
                'name' => $request->name,
               'user_id' =>$this->getUserParent(),
                'dealer_id' =>  auth()->user()->id,
                'subcategory_id' => $request->subcategory,
                'description' => $request->description,
                'part_number' => $request->part_number,
                'additional_details' => $request->additional_details,
                'stocks_avaliable' => $request->stocks_avaliable,
                'price' => $request->price,
                'status' => '1',
            ];
            // 'shipping_price' => $request->shipping_price,
            // 'other_specification' => $request->other_specification,
            // 'Specifications_and_dimensions' => $request->Specifications_and_dimensions,
            // 'Shipping_info' => $request->Shipping_info,
            // 'field_3' => $request->field_3,
            // 'year' => $request->year,
            // 'brand' => $request->brand,
            // 'model' => $request->model,

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
            return redirect()->route('Dealer.products.index')->with('success', 'Data updated successfully');
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
        try {
            // Cart::where('product_id', $product->id)->first();
            // $featureproduct = FeaturedProduct::where('product_id', $product->id)->first();
            // $images = ProductImage::where('product_id', $product->id)->get();

            // if ($featureproduct) {
            //     $featureproduct->delete();
            // }
            // foreach ($images as $image) {
            //     Storage::disk('public')->delete('products/images', $image->file_url);
            //     $image->delete();
            // }

            $getOrderItemId = OrderItem::where('product_id', $product->id)->get();

            if ($getOrderItemId->isNotEmpty()) {
                foreach ($getOrderItemId as $value) {
                    $pendingFulfillment  = ShippoPurchasedLabel::where('order_id', $value->order_id)->first();
                    if (!is_null($pendingFulfillment)) {
                        return redirect()->back()->with(['error' => 'Due to pending fulfillment, the product cannot be deleted. Please complete fulfillment first.']);
                    }
                }
            }
            $product->delete();
            return redirect()->back()->with(['message' => "successfully deleted"]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function saveFeatureProducts(Request $request)
    {
        try {
            $this->validateProductIds($request);
            $featureLimit= $this->getFeatureLimit();
            $featuredProductIds =$this->getCurrentFeaturedProducts();
            if ($this->canAddMoreProducts($featureLimit, $featuredProductIds, $request->featured_product_Ids))
            {
                auth()->user()->featuredProducts()->attach($request->featured_product_Ids); //using pivot table relation
                return redirect()->route('Dealer.feature.products.view')->with(['success'=>'successfully added']);
            }
            return redirect()->route('Dealer.feature.products.view')->with(['error'=>'Limit Exceeded. Please upgrade the existing plan to add more']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
    public function validateProductIds($request)
    {
        if(is_null($request->featured_product_Ids) || empty($request->featured_product_Ids))
            {
                throw new Exception("Product IDs cannot be null or empty.");
            }
    }
   
    public function canAddMoreProducts(int $featureLimit, array $featuredProductIds, array $newProducts)
    {
        return $featureLimit >= (count($featuredProductIds) + count($newProducts));
    }

    public function getDealerProductsExcludingFeatured()
    {
        try {
            $alreadyFeaturedProductIds = $this->getCurrentFeaturedProducts();

        // $featuredProductIds = FeaturedProduct::where('user_id',auth()->id())->pluck('product_id')->toArray();
        $products = Product::where('user_id', auth()->id())->whereNotIn('id', $alreadyFeaturedProductIds)->get();
            return response()->json(['status'=>true,'data'=>view('components.product-listing-table', compact('products','alreadyFeaturedProductIds'))->render(),'message'=>'Products retrieved successfully']);
        } catch (\Exception $e) {
         return  response()->json(['status'=>false,'message'=>$e->getMessage()]);
        }
    }
    public function getCurrentFeaturedProducts()
    {
        return FeaturedProduct::where('user_id', auth()->id())
            ->pluck('product_id')
            ->toArray();
    }

    public function viewFeatureProducts(Request $request)
    {
        try {
            // $featureLimit= PackagePaymentDetail::where('user_id',auth()->id())->pluck('plan_product_count')->firstOrFail();
            // $featureLimit= PackagePaymentDetail::where('user_id',auth()->id())->orderBy('created_at', 'desc')->value('plan_product_count');
            $featureLimit= $this->getFeatureLimit();
            // $products=FeaturedProduct::where('user_id',auth()->id())->orderBy('created_at','desc')->Paginate(__('pagination.pagination_nuber'));
            $alreadyFeaturedProductIds = FeaturedProduct::where('user_id',auth()->id())->pluck('product_id')->toArray();
            $products=Product::where('user_id',auth()->id())
                                ->whereIn('id',$alreadyFeaturedProductIds)
                                ->Search($request)
                                ->orderBy('created_at','desc')
                                ->Paginate(__('pagination.pagination_nuber'));
            return view('dealer.featuredProducts.index',compact('products','featureLimit','alreadyFeaturedProductIds'));
        } catch (\Exception $e) {
         return redirect()->back()->with(['Error'=>$e->getMessage()]);
        }
    }
    public function getFeatureLimit()
    {
        // return PackagePaymentDetail::where('user_id', auth()->id())
        //     ->pluck('plan_product_count')
        //     ->firstOrFail();
       return  PackagePaymentDetail::where('user_id',auth()->id())
                            ->orderBy('created_at', 'desc')
                            ->value('plan_product_count');
    }
    public function featuredproductcreate(Product $product)
    {
        try {
            if (isset(plan_validity()->stripe_status) && plan_validity()->stripe_status != 'active')
            {
                session()->flash('success', 'Please purchase plan first');
                return response()->json([
                    'status' => false,
                    'message' => 'Please purchase plan first'
                ], 200);
            }
            if (!plan_validity()) 
            {
                // session()->flash('success', 'Please purchase plan');
                return response()->json([
                    'status' => false,
                    'message' => 'Please purchase plan'
                ], 200);
            }

            $category = Category::where('id', $product->subcategory_id)->first();
            $featured_product =
            [
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
        $allproducts = Product::with('productImage')->where('status', '1')->where('user_id', $userdetails->id)->inRandomOrder()->limit(6)->get();
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
    public function getUserParent()
    {
        $parentId=auth()->user()->working_for;
        if(is_null($parentId)){
            return auth()->id();
        }
       return $parentId;
    }

    public function search(Request $request)
    {
        if (is_null($request->globalquery)) {
            // return redirect()->route('products', ['search_parameter' => $request->globalquery]);
            return redirect()->back();
        }
    //    $request_test = $this->searchByVin($request);
    //    if($request_test){
    //     $request = $request->merge($request_test);
    //    }
    //    $brands = CarBrandMake::distinct('makes')->get();

    //    $sdk = \CarApiSdk\CarApi::build([
    //        'token' => config('services.Car_api.CAR_API_TOKEN'),
    //        'secret' => config('services.Car_api.CAR_API_SECRET'),
    //    ]);
    //    $filePath = storage_path('app/text.txt');
    //    $jwt = file_exists($filePath) ? file_get_contents($filePath) : null;

    //    if (empty($jwt) || $sdk->loadJwt($jwt)->isJwtExpired()) {
    //        try {
    //            $jwt = $sdk->authenticate();
    //            file_put_contents($filePath, $jwt);
    //        } catch (Exception $e) {
    //            Log::channel('daily')->error($e->getMessage());
    //            return;
    //        }
    //    }
    //    $years = $sdk->years();
    //    $models = AllModel::all();
    //    $products = Product::with('productImage', 'featuredProduct', 'productCompatible')->where('status','1')->global()->category()->compatiblity($request)->price()->paginate(12);
    //    $categories =  Category::with('children')->has('children')->orWhereNull('parent_id')->get();
    //    return view('public_shop', compact("categories", "products", "brands", "years", "models"));
            return redirect()->route('products',['globalquery'=>$request->globalquery]);
}

    

}
