<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PromotionController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }

    //this function is for show list of product
    public function index(Request $request)
    {
    	$data['pro_list'] = DB::table("promotions")
    					->where("promotions.active",1)
    					->orderBy("promotions.id","desc")
    					->paginate(12);
        return view("promotions.index",$data);
    }

    //this function is for create new product
     public function create(Request $r)
    {
        return view("promotions.create");
    }

    //This function is for insert data of one product
    public function save(Request $request){
        if($request->expired_date==""){
            $date = NULL;
        }else{
            $date = date("Y-m-d",strtotime($request->expired_date));
        }

    	$data = array(
            "title" => $request->title,
            "expired_date" => $date,
            "description" => $request->description
        );
        $i = DB::table("promotions")->insert($data);
        if ($i)
        {
            $request->session()->flash("sms", "New products has been created successfully!");
            return redirect("/promotion/create");
        }
        else{
            $request->session()->flash("sms1", "Fail to create new product!");
            return redirect("/promotion/create");
        }
    }

    // load detail product info
    public function detail($id)
    {
        $data['pro_list']= DB::table("promotions")
    					->where("promotions.active",1)
    					->where("promotions.id",$id)
    					->first();
        return view("promotions.detail", $data);
    }

    //This function is for editting page of product
    public function edit($id){

    	$data['pro_list'] = DB::table("promotions")
    					->where("promotions.active",1)
    					->where("promotions.id",$id)
    					->first();

    	return view("promotions.edit",$data);
    }

    //This function is for doing update product
    public function update(Request $request)
    {
       if($request->expired_date==""){
            $date = NULL;
        }else{
            $date = date("Y-m-d",strtotime($request->expired_date));
        }

        $data = array(
            "title" => $request->title,
            "expired_date" => $date,
            "description" => $request->description
        );

        $i = DB::table("promotions")->where("id", $request->id)->update($data);
        if ($i)
        {
            $request->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/promotion/edit/". $request->id);
        }
        else{
            $request->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/promotion/edit/". $request->id);
        }
    }

    //this function is for deleting product
     public function delete($id)
    {
        DB::table('promotions')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/promotion?page='.$page);
        }
        return redirect('/promotion');
    }
}
