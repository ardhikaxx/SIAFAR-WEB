<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Discount;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    public function index(Request $request)
    {

        Discount::where('end_date', '<', Carbon::now())->update(['is_active' => 0]);
        Discount::where('end_date', '>', Carbon::now())->update(['is_active' => 1]);

        if ($request->has(['start_date', 'end_date'])) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $discounts = Discount::with('medicine')->whereBetween('created_at', [$startDate, $endDate])->orderBy("id", "desc")->get();
        } else {
            $discounts = Discount::with('medicine')->orderBy("id", "desc")->get();
        }

        if (Auth::user()->role == "apoteker") {
            return view('apoteker.discounts.index', compact('discounts'));
        } else {
            return view('admin.discounts.index', compact('discounts'));
        }
    }


    public function create()
    {
        $medicines = Medicine::all();
        return view('admin.discounts.create', compact('medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'medicine_id' => 'required|string|max:255',
            'discount_amount' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
        ]);

        Discount::create([
            'medicine_id' => $request->medicine_id,
            'discount_amount' => $request->discount_amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('admin.discounts.index')->with('success', 'Supplier created successfully');
    }

    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        $medicines = Medicine::all();
        return view('admin.discounts.edit', compact('discount', 'medicines'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'medicine_id' => 'required|string|max:255',
            'discount_amount' => 'required|string',
            'start_date' => 'required|string',
            'end_date' => 'required|string',
        ]);

        $discount = Discount::findOrFail($id);
        $discount->update([
            'medicine_id' => $request->medicine_id,
            'discount_amount' => $request->discount_amount,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('admin.discounts.index')->with('success', 'Discount updated successfully');
    }

    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->route('admin.discounts.index')->with('success', 'Discount deleted successfully');
    }
}
