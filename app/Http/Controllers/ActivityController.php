<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            app()->setLocale(Session::get("lang"));
             return $next($request);
         });
    }
    public function index()
    {
        return view('activities.index');
    }
}
