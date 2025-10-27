<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionIn;
use App\Models\TransactionOut;
use App\Models\TransactionInDetail;
use App\Models\TransactionOutDetail;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        // $transactionInId = TransactionIn::first()->id;
        if (Auth::user()->role == "admin") {
            return view('admin.reports.index');
        } else if (Auth::user()->role == 'apoteker') {
            return view('apoteker.reports.index');
        }
    }


    public function reportIn(Request $request)
    {
        $transactionsQueryIn = TransactionIn::query();

        if ($request->has(['start_date_in', 'end_date_in'])) {
            $startDateIn = $request->input('start_date_in');
            $endDateIn = $request->input('end_date_in');
            $transactionsIn = TransactionIn::whereBetween('transaction_in_date', [$startDateIn, $endDateIn])->get();
        }

        $grandTotal = $transactionsIn->sum('grand_total_amount');

        if (Auth::user()->role == 'admin') {
            return view('admin.reports.reportIn', compact('transactionsIn', 'startDateIn', 'endDateIn', 'grandTotal'));
        } else if (Auth::user()->role == 'apoteker') {
            return view('apoteker.reports.reportIn', compact('transactionsIn', 'startDateIn', 'endDateIn', 'grandTotal'));
        }
    }

    public function reportOut(Request $request)
    {

        $transactionsQueryOut = TransactionOut::query();

        if ($request->has(['start_date_out', 'end_date_out'])) {
            $startDateOut = $request->input('start_date_out');
            $endDateOut = $request->input('end_date_out');
            $transactionsQueryOut->whereBetween('transaction_out_date', [$startDateOut, $endDateOut]);
        }

        if ($request->has('status')) {
            $statuses = $request->input('status', []);
            if (!empty($statuses)) {
                $transactionsQueryOut->whereIn('transaction_out_status', $statuses);
            }
        }

        $transactionsOut = $transactionsQueryOut->get();
        $grandTotal = $transactionsOut->sum('grand_total_amount');

        if (Auth::user()->role == 'admin') {
            return view('admin.reports.reportOut', compact('transactionsOut', 'startDateOut', 'endDateOut', 'grandTotal'));
        } else if (Auth::user()->role == 'apoteker') {
            return view('apoteker.reports.reportOut', compact('transactionsOut', 'startDateOut', 'endDateOut', 'grandTotal'));
        }
    }


}
