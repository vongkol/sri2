<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class LevelController extends Controller
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
        $data['levels'] = DB::table("levels")
            ->Join('ngos', 'levels.ngo_id', 'ngos.id')
            ->where("levels.active",1)
            ->orderBy("levels.name")
            ->select('levels.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['levels'] = DB::table("levels")
                ->Join('ngos', 'levels.ngo_id', 'ngos.id')
                ->where("levels.active",1)
                ->where('levels.ngo_id', Auth::user()->ngo_id)
                ->orderBy("levels.name")
                ->select('levels.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("levels.index", $data);
    }

    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("levels.create", $data);
    }

    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('levels')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New level has been created successfully!");
            return redirect("/level/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new level!");
            return redirect("/level/create")->withInput();
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

        $data['levels'] = DB::table("levels")->where("id", $id)->first();
        return view("levels.edit", $data);
    }

    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,

        );
        $i = DB::table('levels')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/level/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/level/edit/".$r->id);
        }
    }

    // delete
    public function delete($id)
    {
        DB::table('levels')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/level?page='.$page);
        }
        return redirect('/level');
    }
}
