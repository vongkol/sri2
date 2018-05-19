<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class CategoryController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    // index
    public function index(Request $r)
    {
        $data['categories'] = DB::table("categories")
            ->where('active',1)
            ->orderBy('name')
            ->paginate(12);
        return view("categories.index", $data);
    }
    public function create(Request $r)
    {
        return view("categories.create");
    }
    public function save(Request $r)
    {

        $data = array(
            "name" => $r->name
        );
        $i = DB::table("categories")->insert($data);
        if ($i)
        {
            $r->session()->flash("sms", "New category has been created successfully!");
            return redirect("/category/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new category!");
            return redirect("/category/create");
        }
    }
    public function edit($id)
    {
        $data['category'] = DB::table("categories")->where("id", $id)->first();
        return view("categories.edit", $data);
    }
    public function update(Request $r)
    {
        $data = array(
            "name" => $r->name
        );
        $i = DB::table("categories")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/category/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/category/edit/". $r->id);
        }
    }
    public function delete($id)
    {
        DB::table('categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/category?page='.$page);
        }
        return redirect('/category');
    }
}
