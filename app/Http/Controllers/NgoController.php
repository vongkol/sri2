<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
class NgoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            app()->setLocale(Session::get("lang"));
             return $next($request);
         });
    }
    public function index(Request $r)
    {
        $data['ngos'] = DB::table("ngos")->where("active",1)->paginate(12);
        return view("ngos.index", $data);
    }
    // load detail company info
    public function detail($id)
    {
        $data['ngo'] = DB::table("ngos")->where("id", $id)->first();
        return view("ngos.detail", $data);
    }
    public function create()
    {
        return view("ngos.create");
    }
    public function save(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name,
            "email" => $r->email,
            "phone" => $r->phone,
            "address" => $r->address,
            "tax_no" => $r->tax_code,
            "description" => $r->description
        );
        $i = DB::table("ngos")->insertGetId($data);
        if ($r->hasFile("logo"))
        {
            $file = $r->file('logo');
            $file_name = $i . "-" .$file->getClientOriginalName();
            $destinationPath = 'uploads/ngos/';
            $file->move($destinationPath, $file_name);
            DB::table('ngos')->where("id", $i)->update(["logo"=>$file_name]);
        }
        if ($i)
        {
            // create default user role for new NGO
            $data = array(
                'name' => "Admin",
                'create_by' => Auth::user()->id,
                'ngo_id' => $i
            );
            $x = DB::table('roles')->insert($data);
            $r->session()->flash("sms", "New ngo has been created successfully!");
            return redirect("/ngo/create");
        }
        else{
            $r->session()->flash("sms1", "Cannot create new ngo!");
            return redirect("/ngo/create")->withInput();
        }
    }
    // load edit company form
    public function edit($id)
    {
        $data['ngo'] = DB::table("ngos")->where("id", $id)->first();
        return view("ngos.edit", $data);
    }
    public function update(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name,
            "email" => $r->email,
            "phone" => $r->phone,
            "address" => $r->address,
            "tax_no" => $r->tax_code,
            "description" => $r->description
        );
        // if user choose to change logo, upload it first
        if ($r->hasFile("logo"))
        {
            $file = $r->file('logo');
            $file_name = $r->id . "-" .$file->getClientOriginalName();
            $destinationPath = 'uploads/ngos/';
            $file->move($destinationPath, $file_name);
            $data["logo"] = $file_name;
        }
        $i = DB::table("ngos")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/ngo/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. It seems you don't make any change!");
            return redirect("/ngo/edit/". $r->id);
        }
    }
    public function delete($id)
    {
        DB::table('ngos')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/ngo?page='.$page);
        }
        return redirect('/ngo');
    }
}
