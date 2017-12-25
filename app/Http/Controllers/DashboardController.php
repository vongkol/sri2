<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class DashboardController extends Controller
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
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        $data['view_type'] = 0;
        $data['ngo_id'] = "0";
        $ngo_id = Auth::user()->ngo_id;
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        // activity by type
        $data['activities'] = DB::select(
            "select activity_types.name, COUNT(activity_achieves.id) as total from activity_types
                LEFT JOIN activity_achieves on activity_types.id = activity_achieves.activity_type_id 
                where  activity_types.ngo_id = {$ngo_id} 
                and activity_types.active = 1
                group BY activity_types.name"
        );
        // activity by category
        $data['activities1'] = DB::select(
            "select activity_categories.name, COUNT(activity_achieves.id) as total from activity_categories
                LEFT JOIN activity_achieves on activity_categories.id = activity_achieves.activity_category_id 
                where  activity_categories.ngo_id = {$ngo_id} 
                and activity_categories.active = 1
                group BY activity_categories.name"
        );
        // activity funding by type
        $data['funds'] = DB::select(
            "select activity_types.name, sum(activity_achieves.total_budget) as total_budget, sum(activity_achieves.total_budget) as total_expense from activity_types
                LEFT JOIN activity_achieves on activity_types.id = activity_achieves.activity_type_id 
                where  activity_types.ngo_id = {$ngo_id} 
                and activity_types.active = 1
                group BY activity_types.name"
        );
        // activity by category
        $data['funds1'] = DB::select(
            "select activity_categories.name, sum(activity_achieves.total_budget) as total_budget, sum(activity_achieves.total_budget) as total_expense from activity_categories
                LEFT JOIN activity_achieves on activity_categories.id = activity_achieves.activity_category_id 
                where  activity_categories.ngo_id = {$ngo_id} 
                and activity_categories.active = 1
                group BY activity_categories.name"
        );
        // event by province
        // $data['events'] = DB::select(
        //     "select provinces.name, sum(activity_achieved_events.total_participant) as total, sum(activity_achieved_events.total_female) as total1, 
        //     sum(activity_achieved_events.total_youth) as total2 from activity_achieved_events
        //     left join provinces on activity_achieved_events.province_id = provinces.id
        //     where activity_achieved_events.ngo_id= {$ngo_id}
        //     group by provinces.name"
        // );
          $data['events'] = DB::select(
            "select provinces.name, sum(activity_achieved_events.id) as total from activity_achieved_events
            left join provinces on activity_achieved_events.province_id = provinces.id
            where activity_achieved_events.ngo_id= {$ngo_id}
            group by provinces.name"
        );
        return view('dashboards.index', $data);
    }
    public function search(Request $r)
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        $data['view_type'] = $r->view_type;
        $data['ngo_id'] = $r->ngo;
        $ngo_id = $r->ngo;
        $x = Auth::user()->ngo_id;
        if($x>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', $x)->get();
        }
        if($r->view_type==0)
        {
            // number of activity by activity
            $data['activities'] = DB::select(
                "select activity_types.name, COUNT(activity_achieves.id) as total from activity_types
                    LEFT JOIN activity_achieves on activity_types.id = activity_achieves.activity_type_id 
                    where  activity_types.ngo_id = {$ngo_id} 
                    and activity_types.active = 1
                    group BY activity_types.name"
            );
            return view('dashboards.tree', $data);
            
        }
        else if($r->view_type==1)
        {
            return view('dashboards.bar', $data);
        }
        else if($r->view_type==2)
        {
            return view('dashboards.line', $data);
        }
        else if($r->view_type==3)
        {
            return view('dashboards.pie', $data);
        }
        else{
            return view('dashboards.index', $data);
        }
    }

}
