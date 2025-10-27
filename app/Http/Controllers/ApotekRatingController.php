<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ApotekRating;
use Illuminate\Http\Request;
use App\Models\TransactionOut;
use function Laravel\Prompts\error;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApotekRatingController extends Controller
{


    public function create(TransactionOut $transactionOut)
    {
        return view('customer.ratings.create', compact('transactionOut'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'rating' => 'required',
        ]);

        if (empty($request->rating)) {
            return redirect()->with('error', 'Rating harus diisi');
        }

        ApotekRating::create([
            'transaction_out_id' => $request->transaction_out_id,
            'user_id' => Auth::user()->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('customer.transactionOuts.show', $request->transaction_out_id)->with('success', 'Rating berhasil disimpan');
    }

}
