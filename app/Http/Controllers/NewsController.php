<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class NewsController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }

    //this function is for show list of product
    public function index(Request $request)
    {
    	$data['news_list'] = DB::table("news")
    					->where("news.active",1)
    					->orderBy("news.id","desc")
    					->paginate(12);
        return view("news.index",$data);
    }

    //this function is for create new product
     public function create(Request $r)
    {
        return view("news.create");
    }

    //This function is for insert data of one product
    public function save(Request $request){
    	$data = array(
            "title" => $request->title,
            "description" => $request->description,
            "short_description" => $request->short_description
        );
        $i = DB::table("news")->insert($data);
        if ($i)
        {
            $request->session()->flash("sms", "New products has been created successfully!");
            return redirect("/news/create");
        }
        else{
            $request->session()->flash("sms1", "Fail to create new product!");
            return redirect("/news/create");
        }
    }

    // load detail product info
    public function detail($id)
    {
        $data['news_list']= DB::table("news")
    					->where("news.active",1)
    					->where("news.id",$id)
    					->first();
        return view("news.detail", $data);
    }

    //This function is for editting page of product
    public function edit($id){

    	$data['news_list'] = DB::table("news")
    					->where("news.active",1)
    					->where("news.id",$id)
    					->first();

    	return view("news.edit",$data);
    }

    //This function is for doing update product
    public function update(Request $r)
    {
       $data = array(
            "title" => $r->title,
            "description" => $r->description,
            "short_description" => $r->short_description
        );

        $i = DB::table("news")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/news/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/news/edit/". $r->id);
        }
    }

    //this function is for deleting product
     public function delete($id)
    {
        DB::table('news')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/news?page='.$page);
        }
        return redirect('/news');
    }
}
