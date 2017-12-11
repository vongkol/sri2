<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ComponentController extends Controller
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

    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("components.create", $data);
    }

    // edit
    public function edit($id)
    {
    	$data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }

        $data['components'] = DB::table("components")->where("id", $id)->first();
        return view("components.edit", $data);
    }

    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('components')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New component has been created successfully!");
            return redirect("/component/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new component!");
            return redirect("/component/create")->withInput();
        }
    }

    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo

        );
        $i = DB::table('components')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/component/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/component/edit/".$r->id);
        }
    }

    // delete
    public function delete($id)
    {
        DB::table('components')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/component?page='.$page);
        }
        return redirect('/component');
    }
    public function get($id)
    {
        return DB::table('components')->where('active', 1)->where('ngo_id', $id)->get();
    }
}
