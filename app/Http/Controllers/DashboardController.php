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
        $ngo_id = Auth::user()->ngo_id;
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)
                ->where('id', Auth::user()->ngo_id)
                ->orderBy('name')
                ->get();
        }
        return view('reports.dashboard', $data);
    }
    public function search(Request $r)
    {
        
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        $data['ngo_id'] = $r->ngo;
        $ngo_id = $r->ngo;
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
            $data['ngo_id'] = Auth::user()->ngo_id;
            $ngo_id = Auth::user()->ngo_id;
        }
        $data['start_date'] = $r->start_date;
        $data['end_date'] = $r->end_date;
        // activity by type
        $data['activities'] = DB::select(
            "select activity_types.name, COUNT(activity_achieves.id) as total from activity_types
                LEFT JOIN activity_achieves on activity_types.id = activity_achieves.activity_type_id 
                where activity_types.ngo_id = {$ngo_id} 
                and activity_types.active = 1
                group BY activity_types.name"
        );

        // activity by category
        $data['acts'] = DB::select(
            "select activity_categories.name, COUNT(activity_achieves.id) as total from activity_categories
                left JOIN activity_achieves on activity_categories.id = activity_achieves.activity_category_id 
                where  activity_categories.ngo_id = {$ngo_id} 
                and activity_categories.active = 1
                group BY activity_categories.name"
        );
        // participant by type
        $data['participants'] = DB::select(
            "select sum(total_participant) as total, sum(total_female) as total_female, sum(total_youth) as total_youth
            from activity_achieved_events where ngo_id={$ngo_id}"
        );
        // activity funding by type
        // $data['funds'] = DB::select(
        //     "select activity_types.name, sum(activity_achieves.total_budget) as total_budget, sum(activity_achieves.total_budget) as total_expense from activity_types
        //         LEFT JOIN activity_achieves on activity_types.id = activity_achieves.activity_type_id 
        //         where  activity_types.ngo_id = {$ngo_id} 
        //         and activity_types.active = 1
        //         group BY activity_types.name"
        // );
        // activity by category
        // $data['funds1'] = DB::select(
        //     "select activity_categories.name, sum(activity_achieves.total_budget) as total_budget, sum(activity_achieves.total_budget) as total_expense from activity_categories
        //         LEFT JOIN activity_achieves on activity_categories.id = activity_achieves.activity_category_id 
        //         where  activity_categories.ngo_id = {$ngo_id} 
        //         and activity_categories.active = 1
        //         group BY activity_categories.name"
        // );

          $data['events'] = DB::select(
            "select provinces.name, count(activity_achieved_events.id) as total from activity_achieved_events
            left join provinces on activity_achieved_events.province_id = provinces.id
            where activity_achieved_events.ngo_id= {$ngo_id}
            group by provinces.name"
        );
        $data['events1'] = DB::select(
            "select venue_types.name, count(activity_achieved_events.id) as total from activity_achieved_events
            left join venue_types on activity_achieved_events.venue_id = venue_types.id
            where activity_achieved_events.ngo_id= {$ngo_id}
            group by venue_types.name"
        );
        $data['type'] = $r->type;
        return view('reports.dashboard-search', $data);
    }
    
}
