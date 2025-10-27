<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medicine;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransactionIn;
use App\Models\TransactionInDetail;
use Illuminate\Support\Facades\Auth;

class TransactionInController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has(['start_date', 'end_date'])) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $transactionIns = TransactionIn::with('user', 'supplier')->whereBetween('transaction_in_date', [$startDate, $endDate])->orderBy("id", "desc")->get();
        } else {
            $transactionIns = TransactionIn::with('user', 'supplier')->orderBy("id", "desc")->get();
        }

        if (Auth::user()->role == "admin") {
            return view('admin.transactionIns.index', compact('transactionIns'));
        } else {
            return view('apoteker.transactionIns.index', compact('transactionIns'));
        }
    }

    public function show($id)
    {
        $transactionIn = TransactionIn::findOrFail($id);
        $transactionInDetails = TransactionInDetail::with('medicine')->where('transaction_in_id', $id)->get();
        $medicines = Medicine::all();
        if (Auth::user()->role == 'admin') {
            return view('admin.transactionIns.show', compact('transactionIn', 'transactionInDetails', 'medicines'));
        } else {
            return view('apoteker.transactionIns.show', compact('transactionIn', 'transactionInDetails', 'medicines'));
        }
    }

    public function generateTransactionInCode()
    {
        return 'TRX-' . Str::upper(Str::random(10));
    }
    public function create()
    {
        $transaction_in_code = $this->generateTransactionInCode();
        $users = User::all();
        $suppliers = Supplier::all();
        return view('admin.transactionIns.create', compact('transaction_in_code', 'users', 'suppliers'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'transaction_in_date' => 'required',
            'supplier_id' => 'required',
        ]);

        $transactionIn = TransactionIn::create([
            'transaction_in_code' => $this->generateTransactionInCode(),
            'transaction_in_date' => $request->transaction_in_date,
            'user_id' => Auth::id(),
            'supplier_id' => $request->supplier_id,
            'grand_total_amount' => 0,
        ]);

        return redirect()->route('admin.transactionIns.show', $transactionIn->id);
    }


    public function update($id)
    {
        $transactionIn = TransactionIn::findOrFail($id);

        if ($transactionIn->is_saved == 0) {
            $transactionIn->update([
                'is_saved' => 1,
            ]);

            $transactionInDetails = TransactionInDetail::where('transaction_in_id', $id)->get();

            foreach ($transactionInDetails as $detail) {
                $medicine = Medicine::findOrFail($detail->medicine_id);

                $medicine->update([
                    'stock' => $medicine->stock + $detail->added_quantity,
                ]);
            }
        }

        return redirect()->route('admin.transactionIns.show', $transactionIn->id)->with('success', 'Transaksi berhasil dikonfirmasi');
    }


    public function print($id)
    {
        $transactionIn = TransactionIn::findOrFail($id);
        $transactionInDetails = TransactionInDetail::with('medicine')->where('transaction_in_id', $id)->get();
        $medicines = Medicine::all();
        if (Auth::user()->role == 'admin') {
            return view('admin.transactionIns.print', compact('transactionIn', 'transactionInDetails', 'medicines'));
        } else {
            return view('apoteker.transactionIns.print', compact('transactionIn', 'transactionInDetails', 'medicines'));
        }
    }
}
