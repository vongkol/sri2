<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class BranchController extends Controller
{
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
        $query = DB::table("branches")
                ->where("active",1);
        $data['branches'] =  $query->paginate(12);
        return view("branches.index", $data);
    }
    public function create()
    {
        return view("branches.create");
    }
    public function edit($id)
    {
        $data['branch'] = DB::table("branches")->where("id", $id)->first();
        return view("branches.edit", $data);
    }
    public function save(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name,
            "email" => $r->email,
            "phone" => $r->phone,
            "description" => $r->description
        );
        $i = DB::table('branches')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New branch has been created successfully!");
            return redirect("/branch/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new branch!");
            return redirect("/branch/create")->withInput();
        }
    }
    public function update(Request $r)
    {
        $data = array(
            "code" => $r->code,
            "name" => $r->name,
            "email" => $r->email,
            "phone" => $r->phone,
            "description" => $r->description
        );
        $i = DB::table('branches')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/branch/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. It seems you don't change any thing!");
            return redirect("/branch/edit/".$r->id);
        }
    }
    public function delete($id)
    {
        DB::table('branches')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/branch?page='.$page);
        }
        return redirect('/branch');
    }
}
