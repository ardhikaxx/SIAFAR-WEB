<?php

namespace App\Http\Controllers;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Imports\SupplierImport;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderBy("id", "desc")->get();
        return view('admin.suppliers.index', compact('suppliers'));
    }


    private function generateSupplierCode()
    {
        $lastSupplier = Supplier::orderBy('id', 'desc')->first();
        $lastNumber = $lastSupplier ? intval(substr($lastSupplier->supplier_code, 3)) : 0;
        $newNumber = $lastNumber + 1;
        return 'SUP' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    public function create()
    {
        $supplier_code = $this->generateSupplierCode();
        return view('admin.suppliers.create', compact('supplier_code'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:255',
        ]);

        $supplier_code = $this->generateSupplierCode();

        Supplier::create([
            'supplier_code' => $supplier_code,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier created successfully');
    }

    public function edit($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:255',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
        ]);

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier updated successfully');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('admin.suppliers.index')->with('success', 'Supplier deleted successfully');
    }

    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        Excel::import(new SupplierImport, $request->file('file'));

        return redirect()->route('admin.suppliers.index')->with('success', 'Data Supplier Berhasil Diimport');
    }
}
