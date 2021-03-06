<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
class NgoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            app()->setLocale(Session::get("lang"));
            return $next($request);
        });
    }
    public function index(Request $r)
    {
        $data['ngos'] = DB::table("ngos")->where("active",1)->paginate(12);
        return view("ngos.index", $data);
    }
    // load detail company info
    public function detail($id)
    {
        $data['ngo'] = DB::table("ngos")->where("id", $id)->first();
        return view("ngos.detail", $data);
    }
    public function create()
    {
        return view("ngos.create");
    }
    public function save(Request $r)
    {
        $data = array(
            "person_name" => $r->person_name,
            'gender' => $r->gender,
            'person_phone' => $r->person_phone,
            'person_email' => $r->person_email,
            'person_position' => $r->person_position,
            "name" => $r->name,
            'acronym' => $r->acronym,
            'type' => $r->type,
            'sector' => $r->sector,
            "email" => $r->email,
            "phone" => $r->phone,
            'base' => $r->base
        );
        $i = DB::table("ngos")->insertGetId($data);
        if ($r->hasFile("logo"))
        {
            $file = $r->file('logo');
            $file_name = $i . "-" .$file->getClientOriginalName();
            $destinationPath = 'uploads/ngos/';
            $file->move($destinationPath, $file_name);
            DB::table('ngos')->where("id", $i)->update(["logo"=>$file_name]);
        }
        if ($i)
        {
            // create default user role for new NGO
            $data = array(
                'name' => "Admin",
                'create_by' => Auth::user()->id,
                'ngo_id' => $i
            );
            $x = DB::table('roles')->insert($data);
            $message = "<h3 style='color:#039'>Your new NGO has been created successfully!</h3>";
            $message .= "<br>";
            $message .= "<p>This is your NGO Information: </p><hr>";
            $message .= "<p>NGO Name: <strong>{$r->name}</strong></p>";
            $message .= "<p>Email: <strong>{$r->email}</strong></p>";
            $message .= "<p>Phone: <strong>{$r->phone}</strong></p>";
            $message .= "<p>Focal Person: <strong>{$r->person_name}</strong></p>";
            $message .= "<p>Gender: <strong>{$r->gender}</strong></p>";
            $message .= "<p>Focal Email: <strong>{$r->person_email}</strong></p>";
            $message .= "<p>Focal Phone: <strong>{$r->person_phone}</strong></p>";
            $message .= "<p>Position: <strong>{$r->person_position}</strong></p>";
            $message .= "<hr>";
            $message .= "<p>If you have any problem with your account, please contact the system admin.<br>Thank you!</p>";
            Right::send_email($r->email, $message);
            $r->session()->flash("sms", "New ngo has been created successfully!");
            return redirect("/ngo/create");
        }
        else{
            $r->session()->flash("sms1", "Cannot create new ngo!");
            return redirect("/ngo/create")->withInput();
        }
    }
    // load edit company form
    public function edit($id)
    {
        $data['ngo'] = DB::table("ngos")->where("id", $id)->first();
        return view("ngos.edit", $data);
    }
    public function update(Request $r)
    {
        $data = array(
            "person_name" => $r->person_name,
            'gender' => $r->gender,
            'person_phone' => $r->person_phone,
            'person_email' => $r->person_email,
            'person_position' => $r->person_position,
            "name" => $r->name,
            'acronym' => $r->acronym,
            'type' => $r->type,
            'sector' => $r->sector,
            "email" => $r->email,
            "phone" => $r->phone,
            'base' => $r->base
        );
        // if user choose to change logo, upload it first
        if ($r->hasFile("logo"))
        {
            $file = $r->file('logo');
            $file_name = $r->id . "-" .$file->getClientOriginalName();
            $destinationPath = 'uploads/ngos/';
            $file->move($destinationPath, $file_name);
            $data["logo"] = $file_name;
        }
        $i = DB::table("ngos")->where("id", $r->id)->update($data);
  
        $r->session()->flash("sms", "All changes have been saved successfully!");
        return redirect("/ngo/edit/". $r->id);
       
    }
    public function delete($id)
    {
        DB::table('ngos')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/ngo?page='.$page);
        }
        return redirect('/ngo');
    }
}
