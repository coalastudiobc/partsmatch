<?php

namespace App\Http\Controllers\Dealer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DealerController extends Controller
{
    public function dashboard()
    {
        return view('dealer.dashboard');
    }
}
