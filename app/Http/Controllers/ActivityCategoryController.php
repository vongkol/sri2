<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ActivityCategoryController extends Controller
{
    //
     public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }

    // index
    public function index()
    {
        $x = Auth::user()->ngo_id;
        $data['activity_categories'] = DB::table("activity_categories")
            ->Join('ngos', 'activity_categories.ngo_id', 'ngos.id')
            ->where("activity_categories.active",1)
            ->orderBy("activity_categories.name")
            ->select('activity_categories.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['activity_categories'] = DB::table("activity_categories")
                ->Join('ngos', 'activity_categories.ngo_id', 'ngos.id')
                ->where("activity_categories.active",1)
                ->where('activity_categories.ngo_id', Auth::user()->ngo_id)
                ->orderBy("activity_categories.name")
                ->select('activity_categories.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        return view("activity_categories.index", $data);
    }

    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("activity_categories.create", $data);
    }

    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('activity_categories')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New activity category has been created successfully!");
            return redirect("/activity_category/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new activity category!");
            return redirect("/activity_category/create")->withInput();
        }
    }

    // edit
    public function edit($id)
    {
    	$data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }

        $data['activity_categories'] = DB::table("activity_categories")->where("id", $id)->first();
        return view("activity_categories.edit", $data);
    }

    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,

        );
        $i = DB::table('activity_categories')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/activity_category/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/activity_category/edit/".$r->id);
        }
    }

    // delete
    public function delete($id)
    {
        DB::table('activity_categories')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/activity_category?page='.$page);
        }
        return redirect('/activity_category');
    }

}
