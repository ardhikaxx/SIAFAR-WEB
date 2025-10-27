<?php

namespace App\Http\Controllers;

use App\Imports\UnitsImport;
use App\Models\Unit;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::orderBy("id", "desc")->get();
        return view('admin.units.index', compact('units'));
    }

    public function create()
    {
        return view('admin.units.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Unit::create($request->all());
        return redirect()->route('admin.units.index')->with('success', 'Satuan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $unit = Unit::findOrFail($id);
        return view('admin.units.edit', compact('unit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $unit = Unit::findOrFail($id);
        $unit->update($request->all());
        return redirect()->route('admin.units.index')->with('success', 'Satuan berhasil diubah');
    }

    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->route('admin.units.index')->with('success', 'Satuan berhasil dihapus');
    }
    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        Excel::import(new UnitsImport, $request->file('file'));

        return redirect()->route('admin.units.index')->with('success', 'Data Satuan Berhasil Diimport');
    }
}
