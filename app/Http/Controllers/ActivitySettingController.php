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
    public function edit($id)
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
        $data['setting'] = DB::table('activity_settings')->where('id', $id)->first();
        $data['component_repsonsibles'] = DB::table('component_responsible_details')->where('activity_setting_id', $id)->get();
        $data['person_responsibles'] = DB::table('person_responsible_details')->where('activity_setting_id',$id)->get();
        return view('activity-settings.edit', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'project_code' => $r->project_code,
            'project_id' => $r->project_name,
            'activity_code' => $r->activity_code,
            'activity_name' => $r->activity_name,
            'activity_type_id' => $r->activity_type,
            'activity_definition' => $r->activity_definition,
            'framework_id' => $r->result_framework_structure,
            'deliverable' => $r->deliverable,
            'data_source' => $r->data_source,
            'location' => $r->location,
            'ngo_id' => $r->ngo,
            'create_by' => Auth::user()->id
        );
       $i = DB::table('activity_settings')->insertGetId($data);
       // person responsible
       $persons = $r->person_responsible;
       $coms = $r->component_responsible;
        $pp = array();
        $cc = array();
        if($persons!=null)
        {
            foreach($persons as $p)
            {
                $p= array(
                    'activity_setting_id' => $i,
                    'user_id' => $p
                );
                array_push($pp, $p);
            }
            $a = DB::table('person_responsible_details')->insert($pp);
        
        }
       if($coms !=null)
       {
            foreach($coms as $com)
            {
                $c = array(
                    'activity_setting_id' => $i,
                    'component_id' => $com
                );
                array_push($cc, $c);
            }
            $b = DB::table('component_responsible_details')->insert($cc);
        
       }
        if($r->save_status<=0)
        {
            $r->session()->flash('sms', "Save successfully!");
            return redirect('/activity-setting/create');
        }
        else{
            return redirect('/activity-setting/edit/'.$i);
        }
    }
}
