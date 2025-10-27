<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\TransactionIn;
use App\Models\TransactionInDetail;

class TransactionInDetailController extends Controller
{

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'transaction_in_id' => 'required|exists:transaction_ins,id',
            'medicine_id' => 'required|exists:medicines,id',
            'added_quantity' => 'required|integer|min:1',
            'buy_price' => 'required|numeric|min:1',
        ]);

        // Hitung sub total
        $subTotal = $request->added_quantity * $request->buy_price;

        // Ambil data medicine dan transaction
        $medicine = Medicine::findOrFail($request->medicine_id);
        $transactionIn = TransactionIn::findOrFail($request->transaction_in_id);

        $detailExist = TransactionInDetail::where('transaction_in_id', $transactionIn->id)
            ->where('medicine_id', $request->medicine_id)->first();

        if ($detailExist) {
            $detailExist->update([
                'added_quantity' => $detailExist->added_quantity + $request->added_quantity,
                'current_stock' => $detailExist->current_stock + $request->added_quantity,
                // 'total_amount' => $detailExist->total_amount + $subTotal,
            ]);
        } else {
            TransactionInDetail::create([
                'transaction_in_id' => $transactionIn->id,
                'medicine_id' => $request->medicine_id,
                'added_quantity' => $request->added_quantity,
                'current_stock' => $medicine->stock + $request->added_quantity,
                'old_stock' => $medicine->stock,
                'buy_price' => $request->buy_price,
                'total_amount' => $subTotal,
            ]);
        }



        $transactionIn->update([
            'grand_total_amount' => $transactionIn->grand_total_amount + $subTotal,
        ]);

        return redirect()->route('admin.transactionIns.show', $transactionIn->id)
            ->with('success', 'Detail transaksi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $transactionInDetail = TransactionInDetail::findOrFail($id);
        $medicine = Medicine::findOrFail($transactionInDetail->medicine_id);

        $oldStock = $transactionInDetail->added_quantity;

        $transactionInDetail->update([
            'current_stock' => $transactionInDetail->current_stock - $oldStock,
        ]);

        $newStock = $medicine->stock + $request->added_quantity;

        $transactionInDetail->update([
            'added_quantity' => $request->added_quantity,
            'current_stock' => $newStock,
            'total_amount' => $request->added_quantity * $transactionInDetail->buy_price,
        ]);

        $transactionIn = TransactionIn::findorfail($transactionInDetail->transaction_in_id);

        $grand_total_amount = TransactionInDetail::where('transaction_in_id', $transactionIn->id)->sum('total_amount');
        $transactionIn->update([
            'grand_total_amount' => $grand_total_amount,
        ]);

        return redirect()->route('admin.transactionIns.show', $transactionInDetail->transaction_in_id)
            ->with('success', 'Detail transaksi berhasil diupdate');
    }


    public function destroy($id)
    {
        $transactionInDetail = TransactionInDetail::findOrFail($id);
        if ($transactionInDetail->delete()) {
            $transactionIn = TransactionIn::findOrFail($transactionInDetail->transaction_in_id);
            $total_amount = $transactionInDetail->total_amount;

            $grand_total_amount = $transactionIn->grand_total_amount - $total_amount;

            $transactionIn->update([
                'grand_total_amount' => $grand_total_amount,
            ]);
        }
        return redirect()->route('admin.transactionIns.show', $transactionInDetail->transaction_in_id)
            ->with('success', 'Detail transaksi berhasil dihapus');
    }

}
