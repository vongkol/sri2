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
        return view('indicators.index', $data);
    }
    public function create()
    {
        return view('indicators.create');
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
            'ngo_id' => Auth::user()->ngo_id
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
            'person_responsible' => $r->responsible_person
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
}
