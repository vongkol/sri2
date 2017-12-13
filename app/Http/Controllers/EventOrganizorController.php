<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class EventOrganizorController extends Controller
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
        $data['event_organizors'] = DB::table("event_organizors")
            ->Join('ngos', 'event_organizors.ngo_id', 'ngos.id')
            ->where("event_organizors.active",1)
            ->orderBy("event_organizors.name")
            ->select('event_organizors.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['event_organizors'] = DB::table("event_organizors")
                ->Join('ngos', 'event_organizors.ngo_id', 'ngos.id')
                ->where("event_organizors.active",1)
                ->where('event_organizors.ngo_id', Auth::user()->ngo_id)
                ->orderBy("event_organizors.name")
                ->select('event_organizors.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("event_organizors.index", $data);
    }

    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("event_organizors.create", $data);
    }

    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('event_organizors')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New event organizor has been created successfully!");
            return redirect("/event_organizor/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new event organizor!");
            return redirect("/event_organizor/create")->withInput();
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

        $data['event_organizors'] = DB::table("event_organizors")->where("id", $id)->first();
        return view("event_organizors.edit", $data);
    }

    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,

        );
        $i = DB::table('event_organizors')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/event_organizor/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/event_organizor/edit/".$r->id);
        }
    }

    // delete
    public function delete($id)
    {
        DB::table('event_organizors')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/event_organizor?page='.$page);
        }
        return redirect('/event_organizor');
    }
}
