<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    public function index()
    {

        $token = Token::first();

        $tokens = Token::all();


        return view("admin.token.index", compact("token", "tokens"));
    }



    public function update(Request $request)
    {
        $token = Token::first();

        $token->update($request->all());

        return back()->with("success", "Berhasil menyimpan token whatsapp");
    }

    public function store(Request $request)
    {


        Token::create($request->all());

        return back()->with("success", "Berhasil menyimpan token whatsapp");
    }


}
