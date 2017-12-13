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
        $data['indicator_settings'] = DB::table('indicator_settings')->where('active',1)->paginate(12);
        if($x>0)
        {
            $data['isettings'] = DB::table('indicator_settings')
                ->where('active',1)
                ->where('ngo_id', $x)
                ->paginate(12);        
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id',$x)->get();
        }
        return view('indicators.index', $data);
    }
    public function create()
    {
        $x = Auth::user()->ngo_id;
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id',$x)->get();
        }
        return view('indicators.create', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'project_code' => $r->project_code,
            'project_name' => $r->project_name,
            'indicator_code' => $r->indicator_code,
            'indicator_name' => $r->indicator_name,
            'indicator_level' => $r->indicator_level,
            'result_framework_structure' => $r->result_framework_structure,
            'baseline' => $r->baseline,
            'data_source' => $r->data_source,
            'calculation_method' => $r->calculation_method,
            'indicator_definition' => $r->indicator_definition,
            'indicator_unit' => $r->indicator_unit,
            'component_responsible' => $r->component_responsible,
            'person_responsible' => $r->responsible_person,
            'create_by' => Auth::user()->id,
            'ngo_id' => $r->ngo
        );
        $id = DB::table('indicator_settings')->insertGetId($data);
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
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id',$x)->get();
        }
        $data['targets'] = DB::table('indicator_targets')->where('indicator_setting_id', $id)->get();
        return view('indicators.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'project_code' => $r->project_code,
            'project_name' => $r->project_name,
            'indicator_code' => $r->indicator_code,
            'indicator_name' => $r->indicator_name,
            'indicator_level' => $r->indicator_level,
            'result_framework_structure' => $r->result_framework_structure,
            'baseline' => $r->baseline,
            'data_source' => $r->data_source,
            'calculation_method' => $r->calculation_method,
            'indicator_definition' => $r->indicator_definition,
            'indicator_unit' => $r->indicator_unit,
            'component_responsible' => $r->component_responsible,
            'person_responsible' => $r->person_responsible,
            'ngo_id' => $r->ngo_id
        );
        $i = DB::table('indicator_settings')->where('id', $r->id)->update($data);
        return $i;
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
