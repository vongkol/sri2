<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class IndicatorTypeController extends Controller
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
        $this->middleware(function ($request, $next) {
            app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }

    // index
    public function index()
    {
        $x = Auth::user()->ngo_id;
        $data['indicator_types'] = DB::table("indicator_types")
            ->Join('ngos', 'indicator_types.ngo_id', 'ngos.id')
            ->where("indicator_types.active",1)
            ->orderBy("indicator_types.name")
            ->select('indicator_types.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['indicator_types'] = DB::table("indicator_types")
                ->Join('ngos', 'indicator_types.ngo_id', 'ngos.id')
                ->where("indicator_types.active",1)
                ->where('indicator_types.ngo_id', Auth::user()->ngo_id)
                ->orderBy("indicator_types.name")
                ->select('indicator_types.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("indicator-types.index", $data);
    }

    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("indicator-types.create", $data);
    }

    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('indicator_types')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New indicator type has been created successfully!");
            return redirect("/indicator-type/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new indicator type!");
            return redirect("/indicator-type/create")->withInput();
        }
    }

    // edit
    public function edit($id)
    {
    	$data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }

        $data['indicator_type'] = DB::table("indicator_types")->where("id", $id)->first();
        return view("indicator-types.edit", $data);
    }

    // update
    public function update(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,

        );
        $i = DB::table('indicator_types')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/indicator-type/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/indicator-type/edit/".$r->id);
        }
    }

    // delete
    public function delete($id)
    {
        DB::table('indicator_types')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/indicator-type?page='.$page);
        }
        return redirect('/indicator-type');
    }
}
