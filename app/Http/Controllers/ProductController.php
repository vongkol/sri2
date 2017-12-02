<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{

     public function __construct()
    {
        $this->middleware('auth');
    }
    //this function is for show list of product
    public function index(Request $request)
    {
    	$data['product_list'] = DB::table("products")
    					->join("categories","categories.id","=","products.category_id")
    					->where("products.active",1)
    					->orderBy("products.id","desc")
    					->select("products.name as productname","categories.name as categoryname","products.id","products.price","products.cost","products.tax","products.description","products.quantity")
    					->paginate(12);
        return view("products.index",$data);
    }

    //this function is for create new product
     public function create(Request $r)
    {
    	$data['categories'] = DB::table("categories")->where("active",1)->get();
        return view("products.create",$data);
    }

    //This function is for insert data of one product
    public function save(Request $request){
    	$data = array(
            "name" => $request->name,
            "category_id" => $request->category,
            "price" => $request->price,
            "cost" => $request->cost,
            "quantity" => $request->quantity,
            "tax" => $request->tax,
            "description" => $request->description,
        );
        $i = DB::table("products")->insert($data);
        if ($i)
        {
            $request->session()->flash("sms", "New products has been created successfully!");
            return redirect("/product/create");
        }
        else{
            $request->session()->flash("sms1", "Fail to create new product!");
            return redirect("/product/create");
        }
    }

    // load detail product info
    public function detail($id)
    {
        $data['product_list']= DB::table("products")
    					->join("categories","categories.id","=","products.category_id")
    					->where("products.active",1)
    					->where("products.id",$id)
    					->select("products.name as productname","categories.name as categoryname","products.id","products.price","products.cost","products.tax","products.description","products.quantity")
    					->first();
        return view("products.detail", $data);
    }

    //This function is for editting page of product
    public function edit($id){

    	$data['product_list'] = DB::table("products")
    					->join("categories","categories.id","=","products.category_id")
    					->where("products.active",1)
    					->where("products.id",$id)
    					->select("products.name as productname","categories.name as categoryname","products.id","products.price","products.cost","products.tax","products.description","products.quantity","products.category_id")
    					->first();
    	$data['categories'] = DB::table("categories")->where("active",1)->get();

    	return view("products.edit",$data);
    }

    //This function is for doing update product
    public function update(Request $r)
    {
        $data = array(
            "name" => $r->name,
            "category_id" => $r->category,
            "price" => $r->price,
            "cost" => $r->cost,
            "quantity" => $r->quantity,
            "tax" => $r->tax,
            "description" => $r->description,
        );

        $i = DB::table("products")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/product/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/product/edit/". $r->id);
        }
    }

    //this function is for deleting product
     public function delete($id)
    {
        DB::table('products')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/product?page='.$page);
        }
        return redirect('/product');
    }
}
