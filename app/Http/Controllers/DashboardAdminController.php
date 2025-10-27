<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Models\TransactionIn;
use App\Models\TransactionOut;

class DashboardAdminController extends Controller
{

    public function index()
    {
        $transactionIn = TransactionIn::count();
        $transactionOut = TransactionOut::count();
        $medicines = Medicine::count();
        $users = User::count();


        return view('admin.index', compact('transactionIn', 'transactionOut', 'medicines', 'users'));
        if (!(view('admin.index'))) {
            redirect()->route('admin.index');
        }
    }
}
