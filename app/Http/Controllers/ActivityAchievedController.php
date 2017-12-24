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
        $this->middleware(function ($request, $next) {
            app()->setLocale(Session::get("lang"));
             return $next($request);
         });
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
        $i = DB::table('activity_achieves')->where('id', $id)->update($data);
        $r->session()->flash('sms2', 'Your description changes have been saved successfully!');
        return redirect('/activity-achieve/edit/'.$id);            
    }
    public function save_funding(Request $r)
    {
        $id = $r->id_for_funding;
        $data = array(
            
            'total_budget' => $r->total_budget,
            'total_expense' => $r->total_expense
        );
        $i = DB::table('activity_achieves')->where('id', $id)->update($data);
        $r->session()->flash('sms3', 'Your funding changes have been saved successfully!');
        $r->session()->flash('funding', 'active');
        return redirect('/activity-achieve/edit/'.$id . "#funding");            
    }
    public function edit($id)
    {
       
        $data['activity_achieve'] = DB::table('activity_achieves')
                ->where('id', $id)
                ->first();

        $x = Auth::user()->ngo_id;

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
        $data['provinces'] = DB::table('provinces')->orderBy('name')->get();
        $data['activity_areas'] = DB::table('activity_areas')->where('active',1)->where('ngo_id', $ngo_id)->get();
        $data['event_organizers'] = DB::table('event_organizors')->where('active',1)->where('ngo_id', $ngo_id)->get();
        $data['events'] = DB::table('activity_achieved_events')
            ->join('event_organizors', 'activity_achieved_events.organizer_id', 'event_organizors.id')
            ->where('activity_achieved_events.activity_achieved_id', $id)
            ->select('activity_achieved_events.*', 'event_organizors.name')
            ->get();
            $data['beneficiaries'] = DB::table("activity_achieved_beneficiaries")->where("activity_achieved_id", $id)->get();
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
            //'achievement' => $r->achievement,
            //'challenge' => $r->challenge,
            //'solution' => $r->solution,
            //'lesson_learn' => $r->lesson_learn,
            //'next_plan' => $r->next_plan,
            //'other_comment' => $r->other_comment,
            //'total_budget' => $r->total_budget,
            //'total_expense' => $r->total_expense,
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
    public function get_district($id)
    {
        return DB::table('districts')->where('province_id', $id)->get();
    }
    public function get_commune($id)
    {
        return DB::table('communes')->where('district_id', $id)->get();
    }
    public function get_village($id)
    {
        return DB::table('villages')->where('commune_id', $id)->get();
    }
    public function save_event(Request $r)
    {
        $data = array(
            'activity_area_id' => $r->activity_area_id,
            'subject' => $r->subject,
            'activity_achieved_id' => $r->activity_achieved_id,
            'organizer_id' => $r->organizer_id,
            'total_participant' => $r->total_participant,
            'total_female' => $r->total_female,
            'total_youth' => $r->total_youth,
            'village_id' => $r->village_id,
            'commune_id' => $r->commune_id,
            'district_id' => $r->district_id,
            'province_id' => $r->province_id
        );
        $x = $r->id;
        $id = 0;
        if($x>0)
        {
            $id = $x;
            $a = DB::table('activity_achieved_events')->where('id', $id)->update($data);
        }
        else{
            $id = DB::table('activity_achieved_events')->insertGetId($data);
        }
        $dd = DB::table('activity_achieved_events')
            ->join('event_organizors', 'activity_achieved_events.organizer_id', 'event_organizors.id')
            ->where('activity_achieved_events.id', $id)
            ->select('activity_achieved_events.*', 'event_organizors.name')
            ->first();
        return json_encode($dd);
    }
    public function delete_event($id)
    {
        return DB::table('activity_achieved_events')->where('id', $id)->delete();
    }
    public function get_event($id)
    {
        return json_encode(DB::table('activity_achieved_events')->where('id', $id)->first());
    }

    public function save_beneficiary(Request $r)
    {
        $data = array(
            'beneficiary_id' => $r->bid,
            'full_name' => $r->full_name,
            'gender' => $r->gender,
            'activity_achieved_id' => $r->activity_achieved_id,
            'email' => $r->email,
            'phone' => $r->phone,
            'position' => $r->position,
            'come_from' => $r->come_from,
            'type' => $r->type,
            'village_id' => $r->village,
            'commune_id' => $r->commune,
            'district_id' => $r->district,
            'province_id' => $r->province
        );
        // $id = DB::table('activity_achieved_beneficiaries')->insert($data);
        if($r->id>0)
        {
            $id = DB::table("activity_achieved_beneficiaries")->where('id', $r->id)->update($data);
            $id = $r->id;

        }
        else{
           $id = DB::table('activity_achieved_beneficiaries')->insertGetId($data);
        }
        return json_encode(DB::table('activity_achieved_beneficiaries')->where('id', $id)->first());
        // return $data;
    }
    public function delete_beneficiary($id)
    {
        $i = DB::table('activity_achieved_beneficiaries')->where('id', $id)->delete();
        return $i;
    }
    public function get_beneficiary($id)
    {
        return json_encode(DB::table('activity_achieved_beneficiaries')->where('id', $id)->first());
    }
}
