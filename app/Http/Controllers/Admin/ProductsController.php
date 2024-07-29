<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'DESC')->Search()->paginate(__('pagination.admin_paginaion_number'));
        return view('admin.products.index', compact('products'));
    }
}
