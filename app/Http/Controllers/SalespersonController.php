<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class SalespersonController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    // index
    public function index()
    {
        $data['salespersons'] = DB::table("employees")
            ->leftJoin("branches", "employees.branch_id","=", "branches.id")
            ->where("employees.position", "salesperson")
            ->where('employees.active',1)
            ->orderBy("employees.first_name")
            ->select("employees.*", "branches.name")
            ->paginate(12);
        return view("salespersons.index", $data);
    }
    // create
    public function create()
    {
        $data['branches'] = DB::table("branches")->where("active",1)->orderBy("name")->get();
        return view("salespersons.create",$data);
    }
    // save
    public function save(Request $r)
    {
        $data = array(
            "first_name" => $r->first_name,
            "last_name" => $r->last_name,
            "gender" => $r->gender,
            "dob" => $r->dob,
            "position" => "salesperson",
            "email" => $r->email,
            "phone" => $r->phone,
            "branch_id" => $r->branch_id
        );
        $i = DB::table("employees")->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New salesperson has been saved successfully!");
            return redirect("/salesperson/create");
        }
        else{
            $r->session()->flash("sms1", "New salesperson has not been saved successfully!");
            return redirect("/salesperson/create")->withInput();
        }
    }
    // edit
    public function edit($id)
    {
        $data['branches'] = DB::table("branches")->where("active",1)->orderBy("name")->get();
        $data['salesperson'] = DB::table("employees")->where("id", $id)->first();
        return view("salespersons.edit", $data);
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
            return redirect("/salesperson/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You maynot change anything!");
            return redirect("/salesperson/edit/".$r->id);
        }
    }
    // delete
    public function delete($id)
    {
        $i = DB::table("employees")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/salesperson?page='.$page);
        }
        return redirect('/salesperson');
    }
}
