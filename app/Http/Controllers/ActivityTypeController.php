<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class ActivityTypeController extends Controller
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
        $data['activity_types'] = DB::table("activity_types")
            ->Join('ngos', 'activity_types.ngo_id', 'ngos.id')
            ->where("activity_types.active",1)
            ->orderBy("activity_types.name")
            ->select('activity_types.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['activity_types'] = DB::table("activity_types")
                ->Join('ngos', 'activity_types.ngo_id', 'ngos.id')
                ->where("activity_types.active",1)
                ->where('activity_types.ngo_id', Auth::user()->ngo_id)
                ->orderBy("activity_types.name")
                ->select('activity_types.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("activity_types.index", $data);
    }


    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("activity_types.create", $data);
    }

    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('activity_types')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New activity type has been created successfully!");
            return redirect("/activity_type/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new activity type!");
            return redirect("/activity_type/create")->withInput();
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

        $data['activity_types'] = DB::table("activity_types")->where("id", $id)->first();
        return view("activity_types.edit", $data);
    }

    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,

        );
        $i = DB::table('activity_types')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/activity_type/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/activity_type/edit/".$r->id);
        }
    }

    // delete
    public function delete($id)
    {
        DB::table('activity_types')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/activity_type?page='.$page);
        }
        return redirect('/activity_type');
    }

    public function get($id)
    {
        return DB::table('activity_types')->where('active',1)->where('ngo_id', $id)->get();
    }
}
