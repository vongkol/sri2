<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class CompanyController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }

    // index
    public function index(Request $r)
    {
        $data['companies'] = DB::table("companies")->where("active",1)->orderBy("name")->paginate(12);
        return view("companies.index", $data);
    }
    // load detail company info
    public function detail($id)
    {
        $data['company'] = DB::table("companies")->where("id", $id)->first();
        return view("companies.detail", $data);
    }
    public function create()
    {
        return view("companies.create");
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
        $i = DB::table("companies")->insertGetId($data);
        if ($r->hasFile("logo"))
        {
            $file = $r->file('logo');
            $file_name = $i . "-" .$file->getClientOriginalName();
            $destinationPath = 'uploads/companies/';
            $file->move($destinationPath, $file_name);
            DB::table('companies')->where("id", $i)->update(["logo"=>$file_name]);
        }
        if ($i)
        {
            $r->session()->flash("sms", "New company has been created successfully!");
            return redirect("/company/create");
        }
        else{
            $r->session()->flash("sms1", "Cannot create new company!");
            return redirect("/company/create")->withInput();
        }
    }
    // load edit company form
    public function edit($id)
    {
        $data['company'] = DB::table("companies")->where("id", $id)->first();
        return view("companies.edit", $data);
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
            $destinationPath = 'uploads/companies/';
            $file->move($destinationPath, $file_name);
            $data["logo"] = $file_name;
        }
        $i = DB::table("companies")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/company/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. It seems you don't make any change!");
            return redirect("/company/edit/". $r->id);
        }
    }
    public function delete($id)
    {
        DB::table('companies')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/company?page='.$page);
        }
        return redirect('/company');
    }
}
