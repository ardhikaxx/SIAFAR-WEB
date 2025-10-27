<?php

namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingAddressController extends Controller
{
    public function create()
    {
        $users = User::all();
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('admin.shippings.shipping_address.create', compact('users'));
        }
    }

    public function store(Request $request)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $request->validate([
                'user_id' => 'required',
                'address' => 'required',
                'city' => 'required',
                'province' => 'required',
                'postal_code' => 'required',
            ]);

            ShippingAddress::create([
                'user_id' => $request->user_id,
                'address' => $request->address,
                'city' => $request->city,
                'province' => $request->province,
                'postal_code' => $request->postal_code
            ]);

            return redirect()->route('admin.shippings.index')
                ->with('success', 'Alamat Pengiriman Berhasil Ditambahkan');
        } elseif (Auth::check() && Auth::user()->role == 'customer') {

            $request->validate([
                'address' => 'required',
                'city' => 'required',
                'province' => 'required',
                'postal_code' => 'required',
            ]);


            ShippingAddress::create([
                'user_id' => Auth::user()->id,
                'address' => $request->address,
                'city' => $request->city,
                'province' => $request->province,
                'postal_code' => $request->postal_code
            ]);

            return redirect()->route('customer.checkout.index')
                ->with('success', 'Alamat Pengiriman Berhasil Ditambahkan');
        }

    }


    public function edit(ShippingAddress $shippingAddress)
    {
        $users = User::all();
        if (Auth::check() && Auth::user()->role == 'admin') {
            return view('admin.shippings.shipping_address.edit', compact('shippingAddress', 'users'));
        }
    }

    public function update(Request $request, ShippingAddress $shippingAddress)
    {


        if (Auth::check() && Auth::user()->role == 'admin') {
            $request->validate([
                'user_id' => 'required',
                'address' => 'required',
                'city' => 'required',
                'province' => 'required',
                'postal_code' => 'required',
            ]);

            $shippingAddress->update([
                'user_id' => $request->user_id,
                'address' => $request->address,
                'city' => $request->city,
                'province' => $request->province,
                'postal_code' => $request->postal_code
            ]);

            return redirect()->route('admin.shippings.index')
                ->with('success', 'Alamat Pengiriman Berhasil Diubah');
        } elseif (Auth::check() && Auth::user()->role == 'customer') {
            $request->validate([
                'address' => 'required',
                'city' => 'required',
                'province' => 'required',
                'postal_code' => 'required',
            ]);

            $shippingAddress->update([
                'address' => $request->address,
                'city' => $request->city,
                'province' => $request->province,
                'postal_code' => $request->postal_code
            ]);

            return redirect()->route('customer.checkout.index')
                ->with('success', 'Alamat Pengiriman Berhasil Diubah');
        }
    }


    public function destroy(ShippingAddress $shippingAddress)
    {
        if (Auth::check() && Auth::user()->role == 'admin') {
            $shippingAddress->delete();
            return redirect()->route('admin.shippings.index')
                ->with('success', 'Alamat Pengiriman Berhasil Dihapus');
        } elseif (Auth::check() && Auth::user()->role == 'customer') {
            $shippingAddress->delete();
            return redirect()->route('customer.checkout.index')
                ->with('success', 'Alamat Pengiriman Berhasil Dihapus');
        }
    }
}
