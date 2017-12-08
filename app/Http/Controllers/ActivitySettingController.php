<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class ActivitySettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $x = Auth::user()->ngo_id;
       // $data['settings'] = DB::table('activity_settings')->where('active',1)->get();
        return view('activity-settings.index');
    }
    public function create()
    {
        return view('activity-settings.create');
    }
}
