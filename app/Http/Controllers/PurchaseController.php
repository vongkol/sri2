<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    // index
    public function index()
    {
        if (Auth::user()==null)
        {
            return redirect('/login');
        }
        return view("purchases.index");
    }
}
