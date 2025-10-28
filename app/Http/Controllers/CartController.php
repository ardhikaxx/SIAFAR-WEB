<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Address;
use App\Models\Payment;
use App\Models\Discount;
use App\Models\Medicine;
use App\Models\PromoCode;
use Illuminate\Support\Str;
use App\Events\NotifyPusher;
use Illuminate\Http\Request;
use App\Models\ShippingMethod;
use App\Models\TransactionOut;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        $carts = Cart::with('medicine')
            ->where('user_id', Auth::id())
            ->get();
        $payments = Payment::all();

        return view('customer.carts.index', compact('carts', 'payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $medicines = Medicine::all();
        $carts = Cart::with('medicine')->where('user_id', Auth::user()->id)->get();
        return view('customer.carts.create', compact('medicines', 'carts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $medicineId = $request->medicine_id;
        $quantity = $request->quantity;

        // Cek apakah obat sudah ada di keranjang user
        $existingCart = Cart::where('user_id', $userId)
            ->where('medicine_id', $medicineId)
            ->first();

        if ($existingCart) {
            // Jika sudah ada, update quantity
            $existingCart->quantity += $quantity;
            $existingCart->save();
        } else {
            // Jika belum ada, buat baru
            Cart::create([
                'user_id' => $userId,
                'medicine_id' => $medicineId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('customer.medicines.index')->with('success', 'Obat berhasil ditambahkan ke keranjang.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart->update(['quantity' => $request->quantity]);
        return redirect()->route('customer.carts.index')->with('success', 'Jumlah obat berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('customer.carts.index')->with('success', 'Obat berhasil dihapus dari keranjang.');
    }

    public function indexCheckout(Request $request)
    {
        $carts = Cart::with('medicine')
            ->where('user_id', Auth::id())
            ->get();

        // Cek jika keranjang kosong
        if ($carts->isEmpty()) {
            return redirect()->route('customer.carts.index')->with('error', 'Keranjang belanja kosong.');
        }

        $medicines = Medicine::all();

        $totalAmount = $carts->sum(function ($cart) {
            return $cart->medicine->price * $cart->quantity;
        });

        $grandTotalAmount = $carts->sum(function ($cart) {
            $discount = Discount::where('medicine_id', $cart->medicine_id)
                ->where('is_active', 1)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if ($discount) {
                $discountAmount = $cart->medicine->price * ($discount->discount_amount / 100);
                return ($cart->medicine->price - $discountAmount) * $cart->quantity;
            }

            return $cart->medicine->price * $cart->quantity;
        });

        $payments = Payment::all();
        $shippingAddresses = ShippingAddress::with('user')
            ->where('user_id', Auth::id())
            ->orderBy("id", "desc")
            ->get();

        $shippingMethods = ShippingMethod::orderBy("id", "desc")->get();

        // Hapus baris ini karena tidak diperlukan di view
        // $shippingAddress = ShippingAddress::where('user_id', Auth::id())->first();

        return view("customer.checkout.index", compact(
            'carts',
            'medicines',
            'totalAmount',
            'grandTotalAmount',
            'payments',
            'shippingAddresses',
            'shippingMethods'
            // Hapus 'shippingAddress' dari compact
        ));
    }


    // public function CekPromo(Request $request)
    // {
    //     $carts = Cart::with('medicine')
    //         ->where('user_id', Auth::id())
    //         ->get();
    //     $medicines = Medicine::all();

    //     $totalAmount = $carts->sum(function ($cart) {
    //         return $cart->medicine->price * $cart->quantity;
    //     });

    //     $grandTotalAmount = $carts->sum(function ($cart) {
    //         return $cart->grand_total * $cart->quantity;
    //     });


    //     $payments = Payment::all();


    //     $promoCode = PromoCode::where('promo_code', $request->promo_code)
    //         ->where('is_active', 1)
    //         ->where('start_date', '<=', now())
    //         ->where('end_date', '>=', now())
    //         ->first();
    //     if (!$promoCode) {
    //         return view("customer.checkout.index", compact('promoCode', 'carts', 'medicines', 'totalAmount', 'grandTotalAmount', 'payments'))
    //             ->with('error', 'Kode promo ' . $request->promo_code . ' tidak valid atau sudah kadaluarsa');
    //     }

    //     $transactionOut = TransactionOut::where('promo_code_id', $promoCode->id)
    //         ->where('user_id', Auth::user()->id)->first();

    //     if ($transactionOut) {
    //         $promoCode = null;
    //         return view("customer.checkout.index", compact('promoCode', 'carts', 'medicines', 'totalAmount', 'grandTotalAmount', 'payments'))
    //             ->with('error', 'Kode Promo ' . $request->promo_code . ' sudah digunakan sebelumnya');
    //     }

    //     return view("customer.checkout.index", compact('promoCode', 'carts', 'medicines', 'totalAmount', 'grandTotalAmount', 'payments'));

    // }

}
