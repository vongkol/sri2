<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class VenueTypeController extends Controller
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
        $data['venue_types'] = DB::table("venue_types")
            ->Join('ngos', 'venue_types.ngo_id', 'ngos.id')
            ->where("venue_types.active",1)
            ->orderBy("venue_types.name")
            ->select('venue_types.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['venue_types'] = DB::table("venue_types")
                ->Join('ngos', 'venue_types.ngo_id', 'ngos.id')
                ->where("venue_types.active",1)
                ->where('venue_types.ngo_id', Auth::user()->ngo_id)
                ->orderBy("venue_types.name")
                ->select('venue_types.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        return view("venue_types.index", $data);
    }

    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("venue_types.create", $data);
    }

    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('venue_types')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New venue type has been created successfully!");
            return redirect("/venue_type/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new venue type!");
            return redirect("/venue_type/create")->withInput();
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

        $data['venue_types'] = DB::table("venue_types")->where("id", $id)->first();
        return view("venue_types.edit", $data);
    }

    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,

        );
        $i = DB::table('venue_types')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/venue_type/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/venue_type/edit/".$r->id);
        }
    }

    // delete
    public function delete($id)
    {
        DB::table('venue_types')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/venue_type?page='.$page);
        }
        return redirect('/venue_type');
    }
}
