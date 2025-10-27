<?php

namespace App\Http\Controllers;

use App\Events\Notif;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy("id", "desc")->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create($request->all());

        return redirect()->route('admin.categories.index')->with('success', 'Data Kategori Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Data Kategori Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Data Kategori Berhasil Dihapus');
    }


    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        Excel::import(new CategoriesImport, $request->file('file'));

        return redirect()->route('admin.categories.index')->with('success', 'Data Kategori Berhasil Diimport');
    }
}
