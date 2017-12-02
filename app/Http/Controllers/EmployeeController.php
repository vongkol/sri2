<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    } 
    //index
    public function index()
    {
        $data['employees'] = DB::table("employees")->where("activ")
    }
}
