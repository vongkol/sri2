<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ScheduleController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }

    //this function is for show list of product
    public function index(Request $request)
    {
    	$data['schedule_list'] = DB::table("schedules")
    					->where("schedules.active",1)
    					->orderBy("schedules.id","desc")
    					->paginate(12);
        return view("schedules.index",$data);
    }

    //this function is for create new product
     public function create(Request $r)
    {
        return view("schedules.create");
    }

    //This function is for insert data of one product
    public function save(Request $request){

        if($request->schedule_date==""){
            $date = NULL;
        }else{
            $date = date("Y-m-d",strtotime($request->schedule_date));
        }

    	$data = array(
            "title" => $request->title,
            "description" => $request->description,
            "schedule_date" => $date
        );

        $i = DB::table("schedules")->insert($data);
        if ($i)
        {
            $request->session()->flash("sms", "New products has been created successfully!");
            return redirect("/schedule/create");
        }
        else{
            $request->session()->flash("sms1", "Fail to create new product!");
            return redirect("/schedule/create");
        }
    }

    // load detail product info
    public function detail($id)
    {
        $data['schedule_list']= DB::table("schedules")
    					->where("schedules.active",1)
    					->where("schedules.id",$id)
    					->first();
        return view("schedules.detail", $data);
    }

    //This function is for editting page of product
    public function edit($id){

    	$data['schedule_list'] = DB::table("schedules")
    					->where("schedules.active",1)
    					->where("schedules.id",$id)
    					->first();

    	return view("schedules.edit",$data);
    }

    //This function is for doing update product
    public function update(Request $r)
    {
       if($r->schedule_date==""){
            $date = NULL;
        }else{
            $date = date("Y-m-d",strtotime($r->schedule_date));
        }

        $data = array(
            "title" => $r->title,
            "description" => $r->description,
            "schedule_date" => $date
        );

        $i = DB::table("schedules")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/schedule/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/schedule/edit/". $r->id);
        }
    }

    //this function is for deleting product
     public function delete($id)
    {
        DB::table('schedules')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/schedule?page='.$page);
        }
        return redirect('/schedule');
    }
}
