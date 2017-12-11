<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class FrameworkController extends Controller
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
        $data['frameworks'] = DB::table("frameworks")
            ->Join('ngos', 'frameworks.ngo_id', 'ngos.id')
            ->where("frameworks.active",1)
            ->orderBy("frameworks.name")
            ->select('frameworks.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['frameworks'] = DB::table("frameworks")
                ->Join('ngos', 'frameworks.ngo_id', 'ngos.id')
                ->where("frameworks.active",1)
                ->where('frameworks.ngo_id', Auth::user()->ngo_id)
                ->orderBy("frameworks.name")
                ->select('frameworks.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        return view("frameworks.index", $data);
    }

    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("frameworks.create", $data);
    }

    // edit
    public function edit($id)
    {
    	$data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }

        $data['frameworks'] = DB::table("frameworks")->where("id", $id)->first();
        return view("frameworks.edit", $data);
    }

    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('frameworks')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New framework has been created successfully!");
            return redirect("/framework/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new framework!");
            return redirect("/framework/create")->withInput();
        }
    }

    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,

        );
        $i = DB::table('frameworks')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/framework/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/framework/edit/".$r->id);
        }
    }

    // delete
    public function delete($id)
    {
        DB::table('frameworks')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/framework?page='.$page);
        }
        return redirect('/framework');
    }
    public function get($id)
    {
        return DB::table('frameworks')->where('active',1)->where('ngo_id',$id)->get();
    }
}
