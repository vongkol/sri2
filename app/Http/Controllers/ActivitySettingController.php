<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class ActivitySettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $x = Auth::user()->ngo_id;
        $data['settings'] = DB::table('activity_settings')
                ->join('projects', 'activity_settings.project_id', 'projects.id')
                ->where('activity_settings.active',1)
                ->select('activity_settings.*', 'projects.name as project_name')
                ->paginate(12);
        if($x>0)
        {
            $data['settings'] = DB::table('activity_settings')
            ->join('projects', 'activity_settings.project_id', 'projects.id')
            ->where('activity_settings.active',1)
            ->where('activity_settings.ngo_id', $x)
            ->select('activity_settings.*', 'projects.name as project_name')
            ->paginate(12);
        }
        return view('activity-settings.index', $data);
    }
    public function create()
    {
        $x = Auth::user()->ngo_id;
        $data['projects'] = DB::table('projects')->where('active',1)->where('ngo_id',0)->orderBy('name')->get();
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        $data['activity_types'] = DB::table('activity_types')->where('active',1)->where('ngo_id',0)->orderBy('name')->get();
        $data['frameworks'] = DB::table('frameworks')->where('active',1)->where('ngo_id',0)->orderBy('name')->get();
        $data['provinces'] = DB::table('provinces')->orderBy('name')->get();
        $data['users'] = DB::table('users')->where('active',1)->where('ngo_id',0)->get();
        $data['components'] = DB::table('components')->where('active',1)->where('ngo_id',0)->get();
        if($x>0)
        {
            $data['projects'] = DB::table('projects')->where('active',1)->where('ngo_id',$x)->orderBy('name')->get();
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id',$x)->orderBy('name')->get();  
            $data['activity_types'] = DB::table('activity_types')->where('active',1)->where('ngo_id',$x)->orderBy('name')->get();
            $data['frameworks'] = DB::table('frameworks')->where('active',1)->where('ngo_id',$x)->orderBy('name')->get();        
            $data['users'] = DB::table('users')->where('active',1)->where('ngo_id',$x)->get();
            $data['components'] = DB::table('components')->where('active',1)->where('ngo_id',$x)->get();        
        
        }
        return view('activity-settings.create', $data);
    }
}
