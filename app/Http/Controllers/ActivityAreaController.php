<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ActivityAreaController extends Controller
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
        $data['activity_areas'] = DB::table("activity_areas")
            ->Join('ngos', 'activity_areas.ngo_id', 'ngos.id')
            ->where("activity_areas.active",1)
            ->orderBy("activity_areas.name")
            ->select('activity_areas.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['activity_areas'] = DB::table("activity_areas")
                ->Join('ngos', 'activity_areas.ngo_id', 'ngos.id')
                ->where("activity_areas.active",1)
                ->where('activity_areas.ngo_id', Auth::user()->ngo_id)
                ->orderBy("activity_areas.name")
                ->select('activity_areas.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("activity-areas.index", $data);
    }

    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("activity-areas.create", $data);
    }

    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo
        );
        $i = DB::table('activity_areas')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New activity area has been created successfully!");
            return redirect("/activity_area/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new activity area!");
            return redirect("/activity_area/create")->withInput();
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

        $data['activity_area'] = DB::table("activity_areas")->where("id", $id)->first();
        return view("activity-areas.edit", $data);
    }

    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo
        );
        $i = DB::table('activity_areas')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/activity_area/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/activity_area/edit/".$r->id);
        }
    }

    // delete
    public function delete($id)
    {
        DB::table('activity_areas')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/activity_area?page='.$page);
        }
        return redirect('/activity_area');
    }

}
