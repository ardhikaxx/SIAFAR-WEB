<?php

namespace App\Http\Controllers;

use App\Models\ApotekRating;
use Illuminate\Http\Request;
use App\Models\MedicineRating;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FeedBackController extends Controller
{
    function index(Request $request)
    {

        if ($request->has(['start_date_apotek', 'end_date_apotek'])) {
            $startDateApotek = Carbon::parse($request->start_date_apotek)->startOfDay();
            $endDateApotek = Carbon::parse($request->end_date_apotek)->endOfDay();
            $ApotekRatings = ApotekRating::whereBetween('created_at', [$startDateApotek, $endDateApotek])->get();
        } else {
            $ApotekRatings = ApotekRating::all();
        }

        if ($request->has(['start_date_medicine', 'end_date_medicine'])) {
            $startDateMedicine = Carbon::parse($request->start_date_medicine)->startOfDay();
            $endDateMedicine = Carbon::parse($request->end_date_medicine)->endOfDay();
            $MedicineRatings = MedicineRating::whereBetween('created_at', [$startDateMedicine, $endDateMedicine])->get();
        } else {
            $MedicineRatings = MedicineRating::with('medicine')->get();
        }


        if (Auth::user()->role == 'admin') {
            return view('admin.feedbacks.index', compact('ApotekRatings', 'MedicineRatings'));
        } else if (Auth::user()->role == 'apoteker') {
            return view('apoteker.feedbacks.index', compact('ApotekRatings', 'MedicineRatings'));
        }
    }
}
