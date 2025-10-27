<?php

namespace App\Http\Controllers;

use App\Models\ShippingMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingMethodController extends Controller
{
    public function create()
    {
        return view('admin.shippings.shipping_method.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);



        ShippingMethod::create([
            'name' => $request->name,
            'price' => $request->price
        ]);


        return redirect()->route('admin.shippings.index')->with('success', 'Metode pengiriman berhasil ditambahkan');
    }


    public function edit(ShippingMethod $shippingMethod)
    {
        return view('admin.shippings.shipping_method.edit', compact('shippingMethod'));
    }


    public function update(Request $request, ShippingMethod $shippingMethod)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
        ]);

        $shippingMethod->update([
            'name' => $request->name,
            'price' => $request->price
        ]);

        return redirect()->route('admin.shippings.index')->with('success', 'Metode pengiriman berhasil diubah');
    }


    public function destroy(ShippingMethod $shippingMethod)
    {
        $shippingMethod->delete();
        return redirect()->route('admin.shippings.index')->with('success', 'Metode pengiriman berhasil dihapus');
    }
}
