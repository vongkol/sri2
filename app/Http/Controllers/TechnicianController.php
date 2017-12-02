<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class TechnicianController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    // index
    public function index()
    {
        $data['technicians'] = DB::table("employees")
        ->leftJoin("branches", "employees.branch_id","=", "branches.id")
        ->where("employees.position", "technician")
        ->where('employees.active',1)
        ->orderBy("employees.first_name")
        ->select("employees.*", "branches.name")
        ->paginate(12);
    return view("technicians.index", $data);
    }
    // create
    public function create()
    {
        $data['branches'] = DB::table("branches")->where("active",1)->orderBy("name")->get();
        return view("technicians.create",$data);
    }
    // save
    public function save(Request $r)
    {
        $data = array(
            "first_name" => $r->first_name,
            "last_name" => $r->last_name,
            "gender" => $r->gender,
            "dob" => $r->dob,
            "position" => "technician",
            "email" => $r->email,
            "phone" => $r->phone,
            "branch_id" => $r->branch_id
        );
        $i = DB::table("employees")->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New technician has been saved successfully!");
            return redirect("/technician/create");
        }
        else{
            $r->session()->flash("sms1", "New technician has not been saved successfully!");
            return redirect("/technician/create")->withInput();
        }
    }
    // edit
    public function edit($id)
    {
        $data['branches'] = DB::table("branches")->where("active",1)->orderBy("name")->get();
        $data['technician'] = DB::table("employees")->where("id", $id)->first();
        return view("technicians.edit", $data);
    }
    // update
    public function update(Request $r)
    {
        $data = array(
            "first_name" => $r->first_name,
            "last_name" => $r->last_name,
            "gender" => $r->gender,
            "dob" => $r->dob,
            "email" => $r->email,
            "phone" => $r->phone,
            "branch_id" => $r->branch_id
        );
        $i = DB::table("employees")->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved!");
            return redirect("/technician/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You maynot change anything!");
            return redirect("/technician/edit/".$r->id);
        }
    }
     // delete
     public function delete($id)
     {
         $i = DB::table("employees")->where("id", $id)->update(["active"=>0]);
         $page = @$_GET['page'];
         if ($page>0)
         {
             return redirect('/technician?page='.$page);
         }
         return redirect('/technician');
     }
}
