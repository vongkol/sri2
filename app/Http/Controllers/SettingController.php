<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class SettingController extends Controller
{
    // index
    public function index()
    {
        if (Auth::user()==null)
        {
            return redirect('/login');
        }
        return view("settings.index");
    }
}
