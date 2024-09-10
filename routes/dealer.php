<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShippoController;
use App\Http\Controllers\Dealer\ChatController;
use App\Http\Controllers\Dealer\OrderController;
use App\Http\Controllers\Dealer\DealerController;
use App\Http\Controllers\Dealer\ProductController;
use App\Http\Controllers\Dealer\EscrowController;
use App\Http\Controllers\Dealer\CheckoutController;
use App\Http\Controllers\Admin\CmsManagementController;
use App\Http\Controllers\Dealer\PartsManagerController;
use App\Http\Controllers\Dealer\SubscriptionController;
use App\Http\Controllers\Dealer\AccountSettingController;

Route::middleware(['auth', 'verified','user.status'])->group(function () {

    Route::get('/products/status', [App\Http\Controllers\HomeController::class, 'togglestatus'])->name('Dealer.products.status');

    // cms page
    Route::get('view/{slug}', [CmsManagementController::class, 'cms'])->name('view');
});
Route::name('Dealer.products.')->group(function () {
    Route::get('/products/interior/{subcategory}', [ProductController::class, 'interior'])->name('interior.page');
    Route::get('/products/interior', [ProductController::class, 'show'])->name('interior');
    Route::get('/products/details/{product}', [ProductController::class, 'details'])->name('details');
});
Route::middleware(['auth', 'verified','user.status'])->namespace('App\Http\Controllers\Dealer')->name('Dealer.')->group(function () {
    // Route::get('/download-csv', [ProductController::class, 'downloadCSV'])->name('download.sample');
    Route::get('/download-csv', [ProductController::class, 'downloadModifiedCSV'])->name('download.sample');
    Route::get('/dashboard', [DealerController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [AccountSettingController::class, 'profile'])->name('profile');
    Route::post('profile/post/update', [AccountSettingController::class, 'update'])->name('profile.post.update');
    Route::post('change-password', [AccountSettingController::class, 'updatePassword'])->name('changepassword');
    Route::match(['GET', "POST"], 'Dealers/status', [DealerController::class, 'toggleStatus'])->name('status');

    Route::get('state/{country}', [CheckoutController::class, 'state'])->name('state');
    Route::get('cities/{state}', [CheckoutController::class, 'cities'])->name('cities');
    Route::get('product/dealer/profile/view/{product}', [DealerController::class, 'dealerProfile'])->name('view.profile');
    Route::get('profile/view/{dealer}', [DealerController::class, 'dealerPublicProfile'])->name('view.public');
    // products
    Route::name('products.')->group(function () {
        Route::get('/products/create', [ProductController::class, 'create'])->name('create');
        Route::post('/products/bulk/upload', [ProductController::class, 'bulkUpload'])->name('bulk.upload');
        Route::get('/products', [ProductController::class, 'index'])->name('index');
        Route::post('/products/store', [ProductController::class, 'store'])->name('store');
        Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('edit');
        Route::post('/products/update/{product}', [ProductController::class, 'update'])->name('update');
        Route::get('/products/delete/{product}', [ProductController::class, 'destroy'])->name('delete');
        Route::get('/products/subcategory/{id}', [ProductController::class, 'subcategory'])->name('subcategory');

        Route::get('/model/{year}', [ProductController::class, 'model'])->name('model');
        Route::get('/make/{model}', [ProductController::class, 'make'])->name('make');
    });
    //order
    Route::name('myorder.')->group(function () {
        Route::get('order', [CheckoutController::class, 'order'])->name('orderlist');
        Route::get('order/view/{order}', [CheckoutController::class, 'orderProductView'])->name('view.products');
    });

    Route::name('order.')->group(function () {
        Route::get('order/management', [OrderController::class, 'order'])->name('orderlist');
        Route::match(['get', 'post'],'create/shippment/{orderid}', [OrderController::class, 'pickAddressOfShippment'])->name('create.shippment');
        Route::post('create/parcels/{order}', [OrderController::class, 'productParcels'])->name('product.parcels');
        Route::post('parcel/dimension', [OrderController::class, 'productDimension'])->name('product.parcels.dimensions');
        Route::get('parcel/shippment/create', [OrderController::class, 'createShippment'])->name('shippment.rates');
        Route::post('parcel/shippment/payment', [OrderController::class, 'shippmentPayment'])->name('shippment.payment');
        Route::post('parcel/groups', [OrderController::class, 'createGroups'])->name('parcels.group');
        Route::post('parcel/groups/delete', [OrderController::class, 'deleteGroups'])->name('parcels.group.delete');
        Route::get('order/fullfillment/shippment', [OrderController::class, 'fullfilledShippment'])->name('fulllfilled');
        Route::get('fullfilled/shippment/details/{order_id?}', [OrderController::class, 'detailsOfFullfilledShippment'])->name('fullfilled.shippment.details');
    });
    // cart
    Route::name('cart.')->group(function () {
        Route::get('cart/index', [CartController::class, 'index'])->name('cart.index');
        Route::post('add/to/cart/{product_id}', [CartController::class, 'addToCart'])->name('cart');
        Route::post('delete-add-to-cart/{product_id}', [CartController::class, 'deleteAndAddToCart'])->name('delete.add');
        Route::get('delete/to/cart/{product}', [CartController::class, 'removeFromCart'])->name('remove');
        Route::post('update/to/cart/{product}', [CartController::class, 'updateToCart'])->name('update');
    });
    Route::name('checkout.')->group(function () {
        Route::get('checkout/create', [CheckoutController::class, 'create'])->name('create');
        Route::post('checkout/store', [CheckoutController::class, 'store'])->name('store');
        Route::post('checkout/shiping/rates', [CheckoutController::class, 'getPaymentPage'])->name('rates');
    });

    // subscription
    Route::name('subscription.')->group(function () {
        Route::get('subscription/plans', [SubscriptionController::class, 'index'])->name('plan');
        Route::post('subscription/plans/purchase', [SubscriptionController::class, 'purchaseSubscription'])->name('plan.purchase');
        Route::get('subscription/plan/cancel', [SubscriptionController::class, 'unsubscribe'])->name('plan.cancel');
    });

    Route::name('partsmanager.')->group(function () {
        Route::get('parts/manager/index', [PartsManagerController::class, 'index'])->name('index');
        Route::post('parts/manager/store', [PartsManagerController::class, 'store'])->name('store');
        Route::get('parts/manager/edit/{user}', [PartsManagerController::class, 'edit'])->name('edit');
        Route::post('parts/manager/update/{user}', [PartsManagerController::class, 'update'])->name('update');
        Route::get('parts/manager/delete/{user}', [PartsManagerController::class, 'delete'])->name('delete');
        Route::get('partsmanager/userDetails/{user}', [PartsManagerController::class, 'getPartManagerDetail'])->name('userDetails');
    });
    Route::name('chat.')->group(function () {
        // Route::get('chat/view', [ChatController::class, 'view'])->name('view');
        Route::post('chat/messages', [ChatController::class, 'chatMessages'])->name('messages');
        Route::match(['get', 'post'], 'chat/setup/{user_id?}', [ChatController::class, 'inboxView'])->name('inbox.view');
        Route::post('getuser/names', [ChatController::class, 'userNames'])->name('getuser.names.sa');
        // Route::get('userimage', [ChatController::class, 'userImage'])->name('userimage');
        Route::post('lastchat/update', [ChatController::class, 'lastchat_update'])->name('lastchat.update');
        Route::post('chat/image', [ChatController::class, 'chatImage'])->name('chat.image');
    });
    Route::name('address.')->group(function () {
        Route::get('product/picking/address', [ShippoController::class, 'view'])->name('view');
        Route::get('shipping/methods/{country}', [CheckoutController::class, 'getShippingMethods'])->name('shipping.methods');
        Route::post('product/from/address', [ShippoController::class, 'from_address'])->name('from');
        Route::post('product/picking/address', [OrderController::class, 'picking_address'])->name('picking');
        Route::get('picking/address/delete/{address}', [OrderController::class, 'addressDelete'])->name('delete');
        Route::match(['get', 'post'],'product/shipping/toaddress', [CheckoutController::class, 'to_address'])->name('to');
    });

    Route::name('stripe.onboarding.')->group(function () {
        Route::get('check/onboard/account/', [EscrowController::class, 'checkAccountExist'])->name('check.onboard.account');
        Route::match(['get', 'post'],'complete/onboard/account/', [EscrowController::class, 'completeOnboarding'])->name('complete');
        Route::match(['get', 'post'],'refresh/onboard/account/', [EscrowController::class, 'refreshOnboarding'])->name('refresh');
        Route::match(['get', 'post'],'create/onboard/account/', [EscrowController::class, 'redirectToStripe'])->name('create');
      
    });

    Route::name('feature.products.')->group(function () {
        Route::match(['get', 'post'], '/featured/products', [ProductController::class, 'viewFeatureProducts'])->name('view');
        Route::match(['get', 'post'], '/featured/products/creating', [ProductController::class, 'saveFeatureProducts'])->name('save');
        Route::get('/products/excludeFeatured', [ProductController::class, 'getDealerProductsExcludingFeatured']);

        // Route::match(['get', 'post'], '/featured/products/create/{product}', [ProductController::class, 'featuredproductcreate'])->name('featured.create');
        // Route::get('/featured/products/delete/{id}', [ProductController::class, 'featuredproductdelete'])->name('featured.products.delete');
      
    });
});
