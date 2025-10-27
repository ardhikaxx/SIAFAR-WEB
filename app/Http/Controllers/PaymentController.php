<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy("id", "desc")->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function create()
    {
        return view('admin.payments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'payment_name' => 'required',
            'payment_address' => 'required',
        ]);
        Payment::create([
            'payment_name' => $request->payment_name,
            'payment_address' => $request->payment_address,
        ]);
        return redirect()->route('admin.payments.index')->with('success', 'Metode Pembayaran Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $payment = Payment::find($id);
        return view('admin.payments.edit', compact('payment'));
    }

    public function update(Request $request, Payment $payment)
    {
        // dd($request->all());
        $request->validate([
            'payment_name' => 'required',
            'payment_address' => 'required',
        ]);

        $payment->update([
            'payment_name' => $request->payment_name,
            'payment_address' => $request->payment_address,
        ]);

        return redirect()->route('admin.payments.index')->with('success', 'Berhasil mengedit data');
    }

    public function destroy($id)
    {
        Payment::find($id)->delete();
        return redirect()->route('admin.payments.index')->with('success', 'Berhasil menghapus data');
    }
}
