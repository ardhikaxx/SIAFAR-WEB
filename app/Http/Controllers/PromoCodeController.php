<?php

namespace App\Http\Controllers;

use App\Models\PromoCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PromoCodeController extends Controller
{
    public function index()
    {
        $promoCodes = PromoCode::all();

        // Jika tanggal sekarang kurang dari tanggal selesainya promo code maka update is_active jadi 0
        foreach ($promoCodes as $promoCode) {
            if (date('Y-m-d') > $promoCode->end_date) {
                $promoCode->update(['is_active' => 0]);
            }
        }
        if (Auth::user()->role == 'admin') {
            return view('admin.promoCodes.index', compact('promoCodes'));
        } else {
            return view('apoteker.promoCodes.index', compact('promoCodes'));
        }
    }


    public function create()
    {
        if (Auth::user()->role == 'admin') {
            return view('admin.promoCodes.create');
        } else {
            return view('apoteker.promoCodes.create');
        }
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'promo_code' => 'required',
            'discount_amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);


        PromoCode::create([
            'promo_code' => $request->promo_code,
            'discount_amount' => $request->discount_amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.promoCodes.index')->with('success', 'Promo code created successfully.');
        } else {
            return redirect()->route('apoteker.promoCodes.index')->with('success', 'Promo code created successfully.');
        }
    }


    public function edit(PromoCode $promoCode)
    {
        if (Auth::user()->role == 'admin') {
            return view('admin.promoCodes.edit', compact('promoCode'));
        } else {
            return view('apoteker.promoCodes.edit', compact('promoCode'));
        }
    }


    public function update(Request $request, PromoCode $promoCode)
    {
        $request->validate([
            'promo_code' => 'required',
            'discount_amount' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);


        $promoCode->update([
            'promo_code' => $request->promo_code,
            'discount_amount' => $request->discount_amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);



        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.promoCodes.index')->with('success', 'Promo code created successfully.');
        } else {
            return redirect()->route('apoteker.promoCodes.index')->with('success', 'Promo code created successfully.');
        }
    }

    public function destroy(PromoCode $promoCode)
    {
        $promoCode->delete();
        if (Auth::user()->role == 'admin') {
            return redirect()->route('admin.promoCodes.index')->with('success', 'Promo code created successfully.');
        } else {
            return redirect()->route('apoteker.promoCodes.index')->with('success', 'Promo code created successfully.');
        }
    }
}
