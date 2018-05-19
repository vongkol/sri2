<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TaskController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }

    //this function is for show list of product
    public function index(Request $request)
    {
    	$data['task_list'] = DB::table("tasks")
    					->where("tasks.active",1)
    					->orderBy("tasks.id","desc")
    					->paginate(12);
        return view("tasks.index",$data);
    }

    //this function is for create new product
     public function create(Request $r)
    {
        return view("tasks.create");
    }

    //This function is for insert data of one product
    public function save(Request $request){

        if($request->deadline==""){
            $date = NULL;
        }else{
            $date = date("Y-m-d",strtotime($request->deadline));
        }

    	$data = array(
            "title" => $request->title,
            "severity" => $request->severity,
            "deadline" => $date,
            "handler" => $request->handler,
            "description" => $request->description
        );

        $i = DB::table("tasks")->insert($data);
        if ($i)
        {
            $request->session()->flash("sms", "New products has been created successfully!");
            return redirect("/task/create");
        }
        else{
            $request->session()->flash("sms1", "Fail to create new product!");
            return redirect("/task/create");
        }
    }

    // load detail product info
    public function detail($id)
    {
        $data['task_list']= DB::table("tasks")
    					->where("tasks.active",1)
    					->where("tasks.id",$id)
    					->first();
        return view("tasks.detail", $data);
    }

    //This function is for editting page of product
    public function edit($id){

    	$data['task_list'] = DB::table("tasks")
    					->where("tasks.active",1)
    					->where("tasks.id",$id)
    					->first();

    	return view("tasks.edit",$data);
    }

    //This function is for doing update product
    public function update(Request $r)
    {
       if($r->deadline==""){
            $date = NULL;
        }else{
            $date = date("Y-m-d",strtotime($r->deadline));
        }

        $data = array(
            "title" => $r->title,
            "severity" => $r->severity,
            "deadline" => $date,
            "handler" => $r->handler,
            "description" => $r->description
        );

        $i = DB::table("tasks")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/task/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/task/edit/". $r->id);
        }
    }

    //this function is for deleting product
     public function delete($id)
    {
        DB::table('tasks')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/task?page='.$page);
        }
        return redirect('/task');
    }
}
