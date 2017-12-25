<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
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
        $this->middleware(function ($request, $next) {
            app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }

    // index
    public function index()
    {
        $x = Auth::user()->ngo_id;
        $data['projects'] = DB::table("projects")
            ->Join('ngos', 'projects.ngo_id', 'ngos.id')
            ->where("projects.active",1)
            ->orderBy("projects.name")
            ->select('projects.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['projects'] = DB::table("projects")
                ->Join('ngos', 'projects.ngo_id', 'ngos.id')
                ->where("projects.active",1)
                ->where('projects.ngo_id', Auth::user()->ngo_id)
                ->orderBy("projects.name")
                ->select('projects.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("projects.index", $data);
    }

    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("projects.create", $data);
    }

    // edit
    public function edit($id)
    {
    	$data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }

        $data['projects'] = DB::table("projects")->where("id", $id)->first();
        return view("projects.edit", $data);
    }

    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            "acronym" => $r->acronym,
            'ngo_id' => $r->ngo,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('projects')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New project has been created successfully!");
            return redirect("/project/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new project!");
            return redirect("/project/create")->withInput();
        }
    }

    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,
            "acronym" => $r->acronym

        );
        $i = DB::table('projects')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/project/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/project/edit/".$r->id);
        }
    }

    // delete
    public function delete($id)
    {
        DB::table('projects')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/project?page='.$page);
        }
        return redirect('/project');
    }
    // get project by ngo id
    public function get($id)
    {
        return DB::table('projects')->where('active',1)->where('ngo_id', $id)->get();
    }
}
