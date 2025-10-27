<?php

namespace App\Http\Controllers;

use App\Models\ApotekRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeCustomerController extends Controller
{
    function index()
    {
        $ratings = ApotekRating::with('user')->orderBy('created_at', 'desc')->get();
        if (Auth::check()) {
            return view('customer.index', compact('ratings'));
        } else {
            return view('public.index', compact('ratings'));
        }
    }
}
