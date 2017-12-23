<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
class IndicatorController extends Controller
{
    public function __construct()
    {
       $this->middleware("auth");
    }
    public function index()
    {
        $x = Auth::user()->ngo_id;
        $data['indicator_settings'] = DB::table('indicator_settings')
            ->join('projects', 'indicator_settings.project_id', 'projects.id')
            ->join('indicator_types', 'indicator_settings.indicator_type_id', 'indicator_types.id')
            ->where('indicator_settings.active', 1)
            ->select('indicator_settings.*', 'projects.name as project_name', 'indicator_types.name as type')
            ->paginate(12);
        if($x>0)
        {
            $data['indicator_settings'] = DB::table('indicator_settings')
            ->join('projects', 'indicator_settings.project_id', 'projects.id')
            ->join('indicator_types', 'indicator_settings.indicator_type_id', 'indicator_types.id')
            ->where('indicator_settings.active', 1)
            ->where('indicator_settings.ngo_id', $x)
            ->select('indicator_settings.*', 'projects.name as project_name', 'indicator_types.name as type')
            ->paginate(12);
                    
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('id')->get();
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id',$x)->orderBy('id')->get();
        }
        return view('indicators.index', $data);
    }
    public function create()
    {
        $x = Auth::user()->ngo_id;
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('id')->get();
        $data['projects'] = DB::table('projects')->where('active',1)->where('ngo_id',0)->orderBy('name')->get();
        $data['indicator_types'] = DB::table('indicator_types')->where('active', 1)->where('ngo_id', 0)->get();
        $data['frameworks'] = DB::table('frameworks')->where('active',1)->where('ngo_id',0)->orderBy('name')->get();
        $data['users'] = DB::table('users')->where('active',1)->where('ngo_id',0)->get();
        $data['components'] = DB::table('components')->where('active',1)->where('ngo_id',0)->get();
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id',$x)->orderBy('id')->get();
            $data['projects'] = DB::table('projects')->where('active',1)->where('ngo_id',$x)->orderBy('id')->get();
            $data['indicator_types'] = DB::table('indicator_types')->where('active', 1)->where('ngo_id', $x)->get();   
            $data['frameworks'] = DB::table('frameworks')->where('active',1)->where('ngo_id',$x)->orderBy('name')->get();     
            $data['users'] = DB::table('users')->where('active',1)->where('ngo_id',$x)->get();
            $data['components'] = DB::table('components')->where('active',1)->where('ngo_id',$x)->get();    
        }
        return view('indicators.create', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'project_code' => $r->project_code,
            'project_id' => $r->project_name,
            'indicator_code' => $r->indicator_code,
            'indicator_name' => $r->indicator_name,
            'indicator_type_id' => $r->indicator_type,
            'framework' => $r->result_framework_structure,
            'baseline' => $r->baseline,
            'data_source' => $r->data_source,
            'calculation_method' => $r->calculation_method,
            'indicator_definition' => $r->indicator_definition,
            'indicator_unit' => $r->indicator_unit,
            'create_by' => Auth::user()->id,
            'ngo_id' => $r->ngo
        );
        $id = DB::table('indicator_settings')->insertGetId($data);
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
                    'indicator_setting_id' => $id,
                    'user_id' => $p
                );
                array_push($pp, $p);
            }
            $a = DB::table('indicator_persons')->insert($pp);
        
        }
       if($coms !=null)
       {
            foreach($coms as $com)
            {
                $c = array(
                    'indicator_setting_id' => $id,
                    'component_id' => $com
                );
                array_push($cc, $c);
            }
            $b = DB::table('indicator_components')->insert($cc);
        
       }
        if($r->save_status>0)
        {
            // go to detail page
            return redirect('/indicator/edit/'.$id);
        }
        else{
            // go to create page
            $r->session()->flash('sms', "New indicator setting has been created successfully!");
            return redirect('/indicator/create');
        }
    }
    // edit
    public function edit($id)
    {
        $data['indicator_setting'] = DB::table('indicator_settings')->where('id', $id)->first();
        $data['years'] = DB::table('years')->where('active',1)->orderBy('id')->get();
        $x = Auth::user()->ngo_id;
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('id')->get();
        $ngo_id = $data['indicator_setting']->ngo_id;
        
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id',$x)->get();
        }
        $data['targets'] = DB::table('indicator_targets')->where('indicator_setting_id', $id)->get();
        $data['projects'] = DB::table('projects')->where('active',1)->where('ngo_id',$ngo_id)->orderBy('name')->get();     
        $data['frameworks'] = DB::table('frameworks')->where('active',1)->where('ngo_id',$ngo_id)->orderBy('name')->get();
        $data['indicator_types'] = DB::table('indicator_types')->where('active', 1)->where('ngo_id', $ngo_id)->get();
        $data['users'] = DB::table('users')->where('active',1)->where('ngo_id', $ngo_id)->get();
        $data['components'] = DB::table('components')->where('active',1)->where('ngo_id', $ngo_id)->get();
        $data['iusers'] = DB::table('indicator_persons')->where('indicator_setting_id', $id)->get();
        $data['icomponents'] = DB::table('indicator_components')->where('indicator_setting_id', $id)->get();
        $ng_id = $data['indicator_setting']->ngo_id;

        return view('indicators.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'project_code' => $r->project_code,
            'project_id' => $r->project_name,
            'indicator_code' => $r->indicator_code,
            'indicator_name' => $r->indicator_name,
            'indicator_type_id' => $r->indicator_type,
            'framework' => $r->result_framework_structure,
            'baseline' => $r->baseline,
            'data_source' => $r->data_source,
            'calculation_method' => $r->calculation_method,
            'indicator_definition' => $r->indicator_definition,
            'indicator_unit' => $r->indicator_unit,
            'ngo_id' => $r->ngo
        );
        $i = DB::table('indicator_settings')->where('id', $r->id)->update($data);
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
                    'indicator_setting_id' => $r->id,
                    'user_id' => $p
                );
                array_push($pp, $p);
            }
            DB::table('indicator_persons')->where('indicator_setting_id', $r->id)->delete();
            $a = DB::table('indicator_persons')->insert($pp);
        
        }
       if($coms !=null)
       {
            foreach($coms as $com)
            {
                $c = array(
                    'indicator_setting_id' => $r->id,
                    'component_id' => $com
                );
                array_push($cc, $c);
            }
            DB::table('indicator_components')->where('indicator_setting_id', $r->id)->delete();            
            $b = DB::table('indicator_components')->insert($cc);
        
       }
       $r->session()->flash('sms', "All changes have been saved!");
       return redirect('/indicator/edit/'. $r->id);
    }
    public function delete($id)
    {
        DB::table('indicator_settings')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/indicator?page='.$page);
        }
        return redirect('/indicator');
    }
    // save target
    public function add_target(Request $r)
    {
        $id = $r->target_id;
        $data = array(
            'year' => $r->year,
            'm1' => $r->jan,
            'm2' => $r->feb,
            'm3' => $r->mar,
            'm4' => $r->apr,
            'm5' => $r->may,
            'm6' => $r->jun,
            'm7' => $r->jul,
            'm8' => $r->aug,
            'm9' => $r->sep,
            'm10' => $r->oct,
            'm11' => $r->nov,
            'm12' => $r->dec,
            'indicator_setting_id' => $r->id
        );
        if($id>0)
        {
            $i = DB::table("indicator_targets")->where('id', $id)->update($data);
            return $id;
        }
        else{
            $i = DB::table("indicator_targets")->insertGetId($data);
            return $i;
        }
        
    }
    // delete target
    public function delete_target($id)
    {
        $i = DB::table('indicator_targets')->where('id', $id)->delete();
        return $i;
    }
}
