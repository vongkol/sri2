<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }

    // index
    public function index()
    {
        $x = Auth::user()->ngo_id;
        $data['components'] = DB::table("components")
            ->leftJoin('ngos', 'components.ngo_id', 'ngos.id')
            ->where("components.active",1)
            ->orderBy("components.name")
            ->select('components.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['components'] = DB::table("components")
                ->leftJoin('ngos', 'components.ngo_id', 'ngos.id')
                ->where("components.active",1)
                ->where('components.ngo_id', Auth::user()->ngo_id)
                ->orderBy("components.name")
                ->select('components.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        return view("components.index", $data);
    }
}
