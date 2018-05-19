<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ServiceController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    //this function is for show list of service
    public function index(Request $request)
    {
    	$data['service_list'] = DB::table("services")
    					->join("categories","categories.id","=","services.category_id")
    					->where("services.active",1)
    					->orderBy("services.id","desc")
    					->select("services.name as servicesname","categories.name as categoryname","services.id","services.price","services.description","services.category_id")
    					->paginate(12);
        return view("services.index",$data);
    }

    //this function is for create new service
     public function create(Request $r)
    {
    	$data['categories'] = DB::table("categories")->where("active",1)->get();
        return view("services.create",$data);
    }

    //This function is for insert data of one service
    public function save(Request $request){
    	$data = array(
            "name" => $request->name,
            "category_id" => $request->category,
            "price" => $request->price,
            "description" => $request->description,
        );
        $i = DB::table("services")->insert($data);
        if ($i)
        {
            $request->session()->flash("sms", "New products has been created successfully!");
            return redirect("/service/create");
        }
        else{
            $request->session()->flash("sms1", "Fail to create new product!");
            return redirect("/service/create");
        }
    }

    // load detail service info
    public function detail($id)
    {
        $data['service_list'] = DB::table("services")
                        ->join("categories","categories.id","=","services.category_id")
                        ->where("services.active",1)
                        ->where("services.id",$id)
                        ->select("services.name as servicesname","categories.name as categoryname","services.id","services.price","services.description","services.category_id")
                        ->first();
        return view("services.detail", $data);
    }

    //This function is for editting page of service
    public function edit($id){

    	$data['service_list'] = DB::table("services")
                        ->join("categories","categories.id","=","services.category_id")
                        ->where("services.active",1)
                        ->where("services.id",$id)
                        ->select("services.name as servicesname","categories.name as categoryname","services.id","services.price","services.description","services.category_id")
                        ->first();
    	$data['categories'] = DB::table("categories")->where("active",1)->get();

    	return view("services.edit",$data);
    }

    //This function is for doing update service
    public function update(Request $r)
    {
        $data = array(
            "name" => $r->name,
            "category_id" => $r->category,
            "price" => $r->price,
            "description" => $r->description,
        );

        $i = DB::table("services")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/service/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/service/edit/". $r->id);
        }
    }

    //this function is for deleting service
     public function delete($id)
    {
        DB::table('services')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/service?page='.$page);
        }
        return redirect('/service');
    }
}
