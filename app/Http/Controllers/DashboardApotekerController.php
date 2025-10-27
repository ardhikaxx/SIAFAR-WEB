<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardApotekerController extends Controller
{
    public function index()
    {
        return view("apoteker.index");
        if (!(view('apoteker.index'))) {
            redirect()->route('apoteker.index');
        }
    }
}
