<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileEditController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        if ($user->role == "admin") {
            return view("admin.profiles.edit", compact("user"));
        } else if ($user->role == "apoteker") {
            return view("apoteker.profiles.edit", compact("user"));
        } else if ($user->role == "customer") {
            return view("customer.profiles.edit", compact("user"));
        }
    }


    public function update(Request $request)
    {

        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable',
            'phone' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = $user->image;
        }

        try {
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
                'phone' => $request->phone,
                'image' => $imagePath
            ]);

            if ($user->role == "admin") {
                return back()->with('success', 'Berhasil menyimpan data');
            } else if ($user->role == "apoteker") {
                return back()->with('success', 'Berhasil menyimpan data');
            } else if ($user->role == "customer") {
                return back()->with('success', 'Berhasil menyimpan data');
            }
        } catch (\Exception $e) {

            return back()->with('error', 'Gagal menyimpan data' . $e->getMessage());
        }
    }
}
