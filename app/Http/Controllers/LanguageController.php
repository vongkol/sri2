<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;
class LanguageController extends Controller
{
    // index
    public function index($id)
    {
        Session::put("lang", $id);
        return 1;
    }
}
