<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    // index
    public function index()
    {
        $data['customers'] = DB::table("customers")->where("active",1)->orderBy("first_name")
            ->paginate(12);

        return view("customers.index", $data);
    }
    // create
    public function create()
    {
        return view("customers.create");
    }
    // insert
    public function save(Request $r)
    {
        $data = array(
            "first_name" => $r->first_name,
            "last_name" => $r->last_name,
            "gender" => $r->gender,
            "email" => $r->email,
            "phone" => $r->phone,
            "address" => $r->address,
            "company_name" => $r->company_name
        );
        $i = DB::table("customers")->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New customer has been saved successfully!");
            return redirect("/customer/create");
        }
        else{
            $r->session()->flash("sms1", "New customer has not been saved successfully!");
            return redirect("/customer/create")->withInput();
        }
    }
     // update
     public function update(Request $r)
     {
         $data = array(
             "first_name" => $r->first_name,
             "last_name" => $r->last_name,
             "gender" => $r->gender,
             "email" => $r->email,
             "phone" => $r->phone,
             "address" => $r->address,
             "company_name" => $r->company_name
         );
         $i = DB::table("customers")->where("id", $r->id)->update($data);
         if($i)
         {
             $r->session()->flash("sms", "Update successfully!");
             return redirect("/customer/edit/".$r->id);
         }
         else{
             $r->session()->flash("sms1", "Fail to save changes. You maynot change anything!");
             return redirect("/customer/edit/".$r->id);
         }
     }
    // edit
    public function edit($id)
    {
        $data['customer'] = DB::table("customers")->where("id", $id)->first();
        return view("customers.edit", $data);
    }
    // delete
    public function delete($id)
    {
        $i = DB::table("customers")->where("id", $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/customer?page='.$page);
        }
        return redirect('/customer');
    }
}
