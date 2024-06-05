<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->Search()->paginate(5);
        return view('admin.products.index', compact('products'));
    }
}
