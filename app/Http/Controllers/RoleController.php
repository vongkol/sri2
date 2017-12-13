<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            app()->setLocale(Session::get("lang"));
             return $next($request);
         });
    }
    // index
    public function index()
    {
        $x = Auth::user()->ngo_id;
        $data['roles'] = DB::table("roles")
            ->leftJoin('ngos', 'roles.ngo_id', 'ngos.id')
            ->where("roles.active",1)
            ->orderBy("roles.name")
            ->select('roles.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['roles'] = DB::table("roles")
                ->leftJoin('ngos', 'roles.ngo_id', 'ngos.id')
                ->where("roles.active",1)
                ->where('roles.ngo_id', Auth::user()->ngo_id)
                ->orderBy("roles.name")
                ->select('roles.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("roles.index", $data);
    }
    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("roles.create", $data);
    }
    // edit
    public function edit($id)
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        $data['role'] = DB::table("roles")->where("id", $id)->first();
        return view("roles.edit", $data);
    }
    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('roles')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New role has been created successfully!");
            return redirect("/role/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new role!");
            return redirect("/role/create")->withInput();
        }
    }
    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name
        );
        $i = DB::table('roles')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/role/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/role/edit/".$r->id);
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('roles')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/role?page='.$page);
        }
        return redirect('/role');
    }
}
