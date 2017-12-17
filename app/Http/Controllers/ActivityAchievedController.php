<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class ActivityAchievedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {

        $x = Auth::user()->ngo_id;
        $data['activities'] = DB::table('activity_achieves')
                ->join('activity_types', 'activity_achieves.activity_type_id', 'activity_types.id')
                ->join('activity_settings', 'activity_achieves.activity_setting_id', 'activity_settings.id')
                ->where('activity_achieves.active',1)
                ->select('activity_achieves.*', 'activity_types.name as activity_type_name', 'activity_settings.activity_name')
                ->paginate(12);
        if($x>0)
        {
            $data['activities'] = DB::table('activity_achieves')
            ->join('activity_types', 'activity_achieves.activity_type_id', 'activity_types.id')
            ->join('activity_settings', 'activity_achieves.activity_setting_id', 'activity_settings.id')
            ->where('activity_achieves.active',1)
            ->where('activity_achieves.ngo_id', $x)
            ->select('activity_achieves.*', 'activity_types.name as activity_type_name', 'activity_settings.activity_name')
            ->paginate(12);
        }
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();        
        return view('activity-achieves.index', $data);
    }
    public function create()
    {
        $x = Auth::user()->ngo_id;

        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        $data['users'] = DB::table('users')->where('active',1)->where('ngo_id',0)->get();
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id',$x)->orderBy('name')->get();  
            $data['users'] = DB::table('users')->where('active',1)->where('ngo_id',$x)->get();

        }
        return view('activity-achieves.create', $data);
    }
    public function save(Request $r)
    {
        $data = array(
            'activity_type_id' => $r->activity_type,
            'activity_setting_id' => $r->activity_name,
            'start_date' => $r->start_date,
            'end_date' => $r->end_date,
            'actual' => $r->actual,
            'achievement' => $r->achievement,
            'challenge' => $r->challenge,
            'solution' => $r->solution,
            'lesson_learn' => $r->lesson_learn,
            'next_plan' => $r->next_plan,
            'other_comment' => $r->other_comment,
            'total_budget' => $r->total_budget,
            'total_expense' => $r->total_expense,
            'activity_category_id' => $r->activity_category,
            'ngo_id' => $r->ngo,
            'create_by' => Auth::user()->id
        );
        $id = DB::table('activity_achieves')->insertGetId($data);
        if($id)
        {
            $persons = $r->person_achieved;
             $pp = array();
             if($persons!=null)
             {
                 foreach($persons as $p)
                 {
                     $p= array(
                         'activity_achieved_id' => $id,
                         'user_id' => $p
                     );
                     array_push($pp, $p);
                 }
                 $a = DB::table('person_achieved_activities')->insert($pp);
             
             }
            return redirect('/activity-achieve/edit/'.$id);            
        }
        else{
            $r->session()->flash('sms1', "Fail to save changes!");
            return redirect('/activity-achieve/create')->withInput();
        }
    }
    public function edit($id)
    {
        $x = Auth::user()->ngo_id;
        $data['activity_achieve'] = DB::table('activity_achieves')
                ->where('id', $id)
                ->first();

        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        // activity type by ngo
        $ngo_id = $data['activity_achieve']->ngo_id;
        $data['activity_types'] = DB::table('activity_types')->where('active',1)->where('ngo_id',$ngo_id)->orderBy('name')->get();
        $data['users'] = DB::table('users')->where('active',1)->where('ngo_id',$ngo_id)->get();
        $data['settings'] = DB::table("activity_settings")->where('active', 1)->where('ngo_id', $ngo_id)
                ->where('activity_type_id', $data['activity_achieve']->activity_type_id)
                ->where('active',1)
                ->get();
        $data['activity_categories'] = DB::table('activity_categories')->where('ngo_id', $ngo_id)->where('active', 1)->get();
        $data['person_achieves'] = DB::table('person_achieved_activities')->where('activity_achieved_id', $id)
                ->get();
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id',$x)->orderBy('name')->get();  
        }
        // get documents of the achieved activity
        $data['documents'] = DB::table('activity_achieved_documents')->where('activity_achieved_id', $id)->get();
        return view('activity-achieves.edit', $data);
    }
    public function update(Request $r)
    {
        $data = array(
            'activity_type_id' => $r->activity_type,
            'activity_setting_id' => $r->activity_name,
            'start_date' => $r->start_date,
            'end_date' => $r->end_date,
            'actual' => $r->actual,
            'achievement' => $r->achievement,
            'challenge' => $r->challenge,
            'solution' => $r->solution,
            'lesson_learn' => $r->lesson_learn,
            'next_plan' => $r->next_plan,
            'other_comment' => $r->other_comment,
            'total_budget' => $r->total_budget,
            'total_expense' => $r->total_expense,
            'activity_category_id' => $r->activity_category
        );
        $id = DB::table('activity_achieves')->where("id", $r->id)->update($data);

        $persons = $r->person_achieved;
        $pp = array();
        if($persons!=null)
        {
            foreach($persons as $p)
            {
                $p= array(
                    'activity_achieved_id' => $r->id,
                    'user_id' => $p
                );
                array_push($pp, $p);
            }
            DB::table('person_achieved_activities')->where('activity_achieved_id', $r->id)->delete();
            DB::table('person_achieved_activities')->insert($pp);
        
        }
        $r->session()->flash('sms', "All changes have been saved!");
        return redirect('/activity-achieve/edit/'.$r->id);            

    }
    public function get($id)
    {
        $x = explode("*", $id);
        return DB::table("activity_settings")->where('active', 1)->where('ngo_id', $x[0])->where('activity_type_id', $x[1])->get();
    }
    public function get_framework($id)
    {
        return DB::table('activity_settings')
                ->join('frameworks', 'activity_settings.framework_id', 'frameworks.id')
                ->where('activity_settings.id', $id)
                ->select('activity_settings.framework_id', 'frameworks.name as fname')
                ->get();
    }
    public function get_component($id)
    {
        return DB::table("component_responsible_details")
                ->join('components', "component_responsible_details.component_id", 'components.id')
                ->where('component_responsible_details.activity_setting_id', $id)
                ->select("component_responsible_details.component_id as id", 'components.name')
                ->get();
    }
    public function get_person($id)
    {
        return DB::table('person_responsible_details')
                ->join('users', 'person_responsible_details.user_id', 'users.id')
                ->where('person_responsible_details.activity_setting_id', $id)
                ->select('person_responsible_details.user_id as id', 'users.name')
                ->get();
    }
    public function get_category($id)
    {
        return DB::table('activity_categories')
            ->where('ngo_id', $id)
            ->get();
    }
    
}
