<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class IndicatorAchievedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            app()->setLocale(Session::get("lang"));
             return $next($request);
         });
    }
    public function index()
    {
        $x = Auth::user()->ngo_id;
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('id')->get();
        $data['indicator_achieves'] = DB::table('indicator_achieves')
            ->join('indicator_settings', 'indicator_achieves.indicator_setting_id', 'indicator_settings.id')
            ->join('projects', 'indicator_settings.project_id', 'projects.id')
            ->where('indicator_achieves.active', 1)
            ->where('indicator_achieves.ngo_id', 0)
            ->select('indicator_achieves.id as indicator_id', 'indicator_settings.*', 'projects.name as project_name')
            ->paginate(12);
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', $x)->get();
            $data['indicator_achieves'] = DB::table('indicator_achieves')
            ->join('indicator_settings', 'indicator_achieves.indicator_setting_id', 'indicator_settings.id')
            ->join('projects', 'indicator_settings.project_id', 'projects.id')
            ->where('indicator_achieves.active', 1)
            ->where('indicator_achieves.ngo_id', $x)
            ->select('indicator_achieves.id as indicator_id', 'indicator_settings.*', 'projects.name as project_name')
            ->paginate(12);
        }
        return view('indicator-achieves.index', $data);
    }
    public function create()
    {
        $x = Auth::user()->ngo_id;
        $data['ngos'] = DB::table('ngos')->where('active', 1)->orderBy('id')->get();
        $data['settings'] = DB::table('indicator_settings')
            ->join('projects', 'indicator_settings.project_id', 'projects.id')
            ->where('indicator_settings.active', 1)
            ->where('indicator_settings.ngo_id', 0)
            ->select('indicator_settings.*', 'projects.name as project_name')
            ->get();
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', $x)->get();
            $data['settings'] = DB::table('indicator_settings')
            ->join('projects', 'indicator_settings.project_id', 'projects.id')
            ->where('indicator_settings.active', 1)
            ->where('indicator_settings.ngo_id', $x)
            ->select('indicator_settings.*', 'projects.name as project_name')
            ->get();
        }

        return view('indicator-achieves.create', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'start_date' => $r->start_date,
            'end_date' => $r->end_date,
            'indicator_setting_id' => $r->project_name,
            'indicator_mode' => $r->indicator_mode,
            'ngo_id' => $r->ngo,
            'create_by' => Auth::user()->id
        );
        $id = DB::table("indicator_achieves")->insertGetId($data);
        return redirect('/indicator-achieve/edit/'. $id);
    }
    public function update(Request $r)
    {
        $data = array(
            'start_date' => $r->start_date,
            'end_date' => $r->end_date,
            'indicator_setting_id' => $r->project_name,
            'indicator_mode' => $r->indicator_mode,
            'ngo_id' => $r->ngo
        );
        $id = DB::table("indicator_achieves")->where('id', $r->id)->update($data);
        $r->session()->flash('sms','All changes have saved successfully!');
        return redirect('/indicator-achieve/edit/'. $r->id);
    }
    public function edit($id)
    {
        $x = Auth::user()->ngo_id;
        $data['ngos'] = DB::table('ngos')->where('active', 1)->orderBy('id')->get();
        $data['indicator_achieve'] = DB::table('indicator_achieves')
            ->where('id', $id)->first();
        $ngo_id = $data['indicator_achieve']->ngo_id;
        $data['settings'] = DB::table('indicator_settings')
            ->join('projects', 'indicator_settings.project_id', 'projects.id')
            ->where('indicator_settings.active', 1)
            ->where('indicator_settings.ngo_id', $ngo_id)
            ->select('indicator_settings.*', 'projects.name as project_name')
            ->get();
            $data['documents'] = DB::table('indicator_achieved_documents')->where('indicator_achieved_id', $id)->get();
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', $x)->get();
        }
        return view('indicator-achieves.edit', $data);
    }
    public function get_project($id)
    {
        return json_encode(
            DB::table('indicator_settings')
                ->join('projects', 'indicator_settings.project_id', 'projects.id')
                ->where('indicator_settings.active', 1)
                ->where('indicator_settings.ngo_id', $id)
                ->select('indicator_settings.*', 'projects.name as project_name')
                ->get()
        );
    }
    public function get_target($id)
    {
        return json_encode(
            DB::table('indicator_targets')->where('indicator_setting_id', $id)->get()
        );
    }
    public function get_info($id)
    {
        return json_encode(
            DB::table('indicator_settings')
                ->join('indicator_types', 'indicator_settings.indicator_type_id', 'indicator_types.id')
                ->join('frameworks', 'indicator_settings.framework', 'frameworks.id')
                ->where('indicator_settings.id', $id)
                ->select('indicator_settings.*', 'indicator_types.name as type', 'frameworks.name as framework')
                ->first()
        );
    }
    public function save_description(Request $r)
    {
        $id = $r->id_for_description;
        $data = array(
            'achievement' => $r->achievement,
            'challenge' => $r->challenge,
            'solution' => $r->solution,
            'lesson_learn' => $r->lesson_learn,
            'next_plan' => $r->next_plan,
            'other_comment' => $r->other_comment
        );
        $i = DB::table('indicator_achieves')->where('id', $id)->update($data);
        $r->session()->flash('sms2', 'Your description changes have been saved successfully!');
        return redirect('/indicator-achieve/edit/'.$id);            
    }
}
