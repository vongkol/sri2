<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class AssetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        return view("assets.index");
    }
}
