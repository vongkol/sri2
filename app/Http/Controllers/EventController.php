<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class EventController extends Controller
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
        $data['events'] = DB::table("events")
            ->Join('ngos', 'events.ngo_id', 'ngos.id')
            ->where("events.active",1)
            ->orderBy("events.name")
            ->select('events.*', 'ngos.name as ngo_name')
            ->paginate(12); 
        if($x>0)
        {
            $data['events'] = DB::table("events")
                ->Join('ngos', 'events.ngo_id', 'ngos.id')
                ->where("events.active",1)
                ->where('events.ngo_id', Auth::user()->ngo_id)
                ->orderBy("events.name")
                ->select('events.*', 'ngos.name as ngo_name')
                ->paginate(12); 
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("events.index", $data);
    }

    // create
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view("events.create", $data);
    }

    // insert
    public function save(Request $r)
    {
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,
            "create_by" => Auth::user()->id
        );
        $i = DB::table('events')->insert($data);
        if($i)
        {
            $r->session()->flash("sms", "New event has been created successfully!");
            return redirect("/event/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new event!");
            return redirect("/event/create")->withInput();
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

        $data['events'] = DB::table("events")->where("id", $id)->first();
        return view("events.edit", $data);
    }

    // update
    public function update(Request $r)
    {
       
        $data = array(
            "name" => $r->name,
            'ngo_id' => $r->ngo,

        );
        $i = DB::table('events')->where("id", $r->id)->update($data);
        if($i)
        {
            $r->session()->flash("sms", "All changes have been saved successfully!");
            return redirect("/event/edit/".$r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You might not change any thing!");
            return redirect("/event/edit/".$r->id);
        }
    }

    // delete
    public function delete($id)
    {
        DB::table('events')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/event?page='.$page);
        }
        return redirect('/event');
    }



///// Old code

    /*
     public function __construct()
    {
        $this->middleware('auth');
    }

    //this function is for show list of product
    public function index(Request $request)
    {
    	$data['event_list'] = DB::table("events")
    					->where("events.active",1)
    					->orderBy("events.id","desc")
    					->paginate(12);
        return view("events.index",$data);
    }

    //this function is for create new product
     public function create(Request $r)
    {
        return view("events.create");
    }

    //This function is for insert data of one product
    public function save(Request $request){
        if($request->event_date==""){
            $date = NULL;
        }else{
            $date = date("Y-m-d",strtotime($request->event_date));
        }

    	$data = array(
            "name" => $request->name,
            "location" => $request->location,
            "description" => $request->description,
            "event_date" => $date
        );
        $i = DB::table("events")->insert($data);
        if ($i)
        {
            $request->session()->flash("sms", "New products has been created successfully!");
            return redirect("/event/create");
        }
        else{
            $request->session()->flash("sms1", "Fail to create new product!");
            return redirect("/event/create");
        }
    }

    // load detail product info
    public function detail($id)
    {
        $data['event_list']= DB::table("events")
    					->where("events.active",1)
    					->where("events.id",$id)
    					->first();
        return view("events.detail", $data);
    }

    //This function is for editting page of product
    public function edit($id){

    	$data['events_list'] = DB::table("events")
    					->where("events.active",1)
    					->where("events.id",$id)
    					->first();

    	return view("events.edit",$data);
    }

    //This function is for doing update product
    public function update(Request $request)
    {
       if($request->event_date==""){
            $date = NULL;
        }else{
            $date = date("Y-m-d",strtotime($request->event_date));
        }

        $data = array(
            "name" => $request->name,
            "location" => $request->location,
            "description" => $request->description,
            "event_date" => $date
        );

        $i = DB::table("events")->where("id", $request->id)->update($data);
        if ($i)
        {
            $request->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/event/edit/". $request->id);
        }
        else{
            $request->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/event/edit/". $request->id);
        }
    }

    //this function is for deleting product
     public function delete($id)
    {
        DB::table('events')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/event?page='.$page);
        }
        return redirect('/event');
    }
    */
}
