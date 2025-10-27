<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use App\Models\ShippingAddress;

class ShippingController extends Controller
{
    public function index()
    {
        $shippingAddresses = ShippingAddress::with('user')->orderBy("id", "desc")->get();
        $shippingMethods = ShippingMethod::orderBy("id", "desc")->get();
        return view('admin.shippings.index', compact('shippingAddresses', 'shippingMethods'));
    }
}

