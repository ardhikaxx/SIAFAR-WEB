<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'customer')->orWhere('role', 'apoteker')->orderBy("id", "desc")->get();
        return view("admin.users.index", compact("users"));
    }


    public function create()
    {
        return view("admin.users.create");
    }


    public function store(Request $request)
    {
        $validate = $request->validate([
            "name" => "required",
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'phone' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'role' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan.'); // Menangani jika gambar tidak ada
        }

        $user = User::create([
            'name' => $validate['name'],
            'email' => $validate['email'],
            'password' => bcrypt($validate['password']),
            'phone' => $validate['phone'],
            'image' => $imagePath,
            'role' => $validate['role'],
        ]);

        if ($user) {
            return redirect()->route('admin.users.index')->with('success', 'Berhasil menambahkan data');
        } else {
            return redirect()->back()->with(['general', 'Gagal menambahkan data']);
        }

    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'phone' => 'required',
            'role' => 'required',
        ]);

        $user = User::find($id);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $user->image;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'phone' => $request->phone,
            'image' => $imagePath,
            'role' => $request->role
        ]);

        return redirect()->route('admin.users.index')->with('success', 'Berhasil mengedit data');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('admin.users.index')->with('success', 'Berhasil menghapus data');
    }

}
