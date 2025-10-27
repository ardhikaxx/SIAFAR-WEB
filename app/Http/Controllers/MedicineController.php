<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\MedicineRating;
use App\Imports\MedicinesImport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request, $id = null)
    {
        $search = $request->input('search', '');
        $category = $request->input('category', '');
        $unit = $request->input('unit', '');


        if (Auth::check()) {
            if (Auth::user()->role == 'customer') {
                $medicines = Medicine::where(function ($query) use ($search, $category, $unit) {
                    $query->where('name', 'like', '%' . $search . '%');

                    if (!empty($category)) {
                        $query->whereHas('category', function ($query) use ($category) {
                            $query->where('name', 'like', '%' . $category . '%');
                        });
                    }
                    if (!empty($unit)) {
                        $query->whereHas('unit', function ($query) use ($unit) {
                            $query->where('name', 'like', '%' . $unit . '%');
                        });
                    }
                })->with(['category', 'unit'])->paginate(8);



                $categories = Category::all();
                $units = Unit::all();

                $discounts = Discount::all();

                return view('customer.medicines.index', compact('medicines', 'categories', 'units', 'search', 'discounts'));
            } else if (Auth::user()->role == 'admin') {
                $medicines = Medicine::where(function ($query) use ($search, $category, $unit) {
                    $query->where('name', 'like', '%' . $search . '%');

                    if (!empty($category)) {
                        $query->whereHas('category', function ($query) use ($category) {
                            $query->where('name', 'like', '%' . $category . '%');
                        });
                    }
                    if (!empty($unit)) {
                        $query->whereHas('unit', function ($query) use ($unit) {
                            $query->where('name', 'like', '%' . $unit . '%');
                        });
                    }
                })->with(['category', 'unit'])->orderByDesc('id')->get();



                $categories = Category::all();
                $units = Unit::all();


                $zeroStocks = Medicine::where('stock', 0)->get();
                return view('admin.medicines.index', compact('medicines', 'categories', 'units', 'zeroStocks'));
            } else if (Auth::user()->role == 'apoteker') {
                $medicines = Medicine::where(function ($query) use ($search, $category, $unit) {
                    $query->where('name', 'like', '%' . $search . '%');

                    if (!empty($category)) {
                        $query->whereHas('category', function ($query) use ($category) {
                            $query->where('name', 'like', '%' . $category . '%');
                        });
                    }
                    if (!empty($unit)) {
                        $query->whereHas('unit', function ($query) use ($unit) {
                            $query->where('name', 'like', '%' . $unit . '%');
                        });
                    }
                })->with(['category', 'unit'])->orderByDesc('id')->get();



                $categories = Category::all();
                $units = Unit::all();
                $zeroStocks = Medicine::where('stock', 0)->get();
                return view('apoteker.medicines.index', compact('medicines', 'categories', 'units', 'zeroStocks'));
            }
        } else {
            $medicines = Medicine::where(function ($query) use ($search, $category, $unit) {
                $query->where('name', 'like', '%' . $search . '%');

                if (!empty($category)) {
                    $query->whereHas('category', function ($query) use ($category) {
                        $query->where('name', 'like', '%' . $category . '%');
                    });
                }
                if (!empty($unit)) {
                    $query->whereHas('unit', function ($query) use ($unit) {
                        $query->where('name', 'like', '%' . $unit . '%');
                    });
                }
            })->with(['category', 'unit'])->paginate(8);



            $categories = Category::all();
            $units = Unit::all();

            $discounts = Discount::all();
            return view('public.medicines.index', compact('medicines', 'categories', 'units', 'search', 'discounts'));
        }


    }

    /**
     * Show the form for creating a new resource.
     */

    private function generateMedicineCode()
    {
        $lastMedicine = Medicine::orderBy('id', 'desc')->first();
        $lastCode = $lastMedicine ? (int) substr($lastMedicine->medicine_code, 3) : 0;
        return 'OBT' . str_pad($lastCode + 1, 4, '0', STR_PAD_LEFT);
    }

    public function create()
    {
        $medicines = Medicine::with('unit', 'category')->get();
        $units = Unit::all();
        $categories = Category::all();
        $medicineCode = $this->generateMedicineCode();

        return view('admin.medicines.create', compact('medicines', 'units', 'categories', 'medicineCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medicine_code' => 'required',
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
        ]);

        $photo = $request->file('photo')->store('images', 'public');
        Medicine::create([
            'medicine_code' => $request->medicine_code,
            'name' => $request->name,
            'photo' => $photo,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'unit_id' => $request->unit_id,
        ]);

        return redirect()->route('admin.medicines.index')->with('success', 'Data Obat Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {

        if (Auth::check()) {
            $medicine = Medicine::with('unit', 'category')->findOrFail($medicine->id);
            $ratings = MedicineRating::with('user')
                ->where('medicine_id', $medicine->id)
                ->get();

            $discount = Discount::where('medicine_id', $medicine->id)->where('is_active', 1)->first();
            return view('customer.medicines.show', compact('medicine', 'ratings', 'discount'));
        } else {
            $medicine = Medicine::with('unit', 'category')->find($medicine->id);
            $ratings = MedicineRating::with('user')
                ->where('medicine_id', $medicine->id)
                ->get();
            $discount = Discount::where('medicine_id', $medicine->id)->where('is_active', 1)->first();
            return view('public.medicines.show', compact('medicine', 'ratings', 'discount'));
        }
    }


    public function storeRating(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'rating' => 'required',
        ]);

        $rating = new MedicineRating();
        $rating->rating = $request->rating;
        $rating->comment = $request->comment;
        $rating->user_id = Auth::user()->id;
        $rating->medicine_id = $request->medicine_id;
        $rating->save();

        return back()->with('success', 'Rating Berhasil Ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        $categories = Category::all();
        $units = Unit::all();


        return view('admin.medicines.edit', compact('medicine', 'categories', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'unit_id' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->except('photo');

        if ($request->hasFile('photo')) {
            // Hapus foto lama
            if ($medicine->photo) {
                Storage::disk('public')->delete($medicine->photo);
            }

            // Simpan foto baru
            $data['photo'] = $request->file('photo')->store('images', 'public');
        }

        $medicine->update($data);

        return redirect()->route('admin.medicines.index')->with('success', 'Data Obat Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        if ($medicine->photo) {
            Storage::disk('public')->delete($medicine->photo);
        }
        $medicine->delete();
        return redirect()->route('admin.medicines.index')->with('success', 'Data Obat Berhasil Dihapus');
    }

    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        Excel::import(new MedicinesImport, $request->file('file'));

        return redirect()->route('admin.medicines.index')->with('success', 'Data Obat Berhasil Diimport');
    }
}
