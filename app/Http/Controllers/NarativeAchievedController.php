<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Session;
class NarativeAchievedController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        $data['narative_achieves'] = DB::table('narative_achieves')
            ->join('ngos', 'ngos.id', '=', 'narative_achieves.ngo_id')
            ->select('narative_achieves.*',  'narative_achieves.id as id', 'ngos.name as ngo_name')
            ->where('narative_achieves.active',1)->paginate(12);
        return view('narative-achieves.index', $data);
    }
    public function create()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->orderBy('name')->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        return view('narative-achieves.create', $data);
    }

    public function edit()
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        $data['narative_achieve'] = DB::table('narative_achieves')
            ->join('ngos', 'ngos.id', '=', 'narative_achieves.ngo_id')
            ->select('narative_achieves.*', 'narative_achieves.id as id', 'ngos.name as ngo_name')
            ->where('narative_achieves.active',1)->first();
        return view('narative-achieves.edit', $data);
    }
    
    // load detail
    public function detail($id)
    {
        $data['ngos'] = DB::table('ngos')->where('active',1)->get();
        if(Auth::user()->ngo_id>0)
        {
            $data['ngos'] = DB::table('ngos')->where('active',1)->where('id', Auth::user()->ngo_id)->get();
        }
        $data['narative_achieve'] = DB::table('narative_achieves')
            ->join('ngos', 'ngos.id', '=', 'narative_achieves.ngo_id')
            ->select('narative_achieves.*', 'narative_achieves.id as id', 'ngos.name as ngo_name')
            ->where('narative_achieves.active',1)->first();

        return view("narative-achieves.detail", $data);
    }

    //This function is for insert data of one narative achieve
    public function save(Request $r){
    	$data = array(
            "cover_page" => $r->cover_page,
            "start_date" => $r->start_date,
            "end_date" => $r->end_date,
            "content" => $r->content,
            "acronyms" => $r->acronyms,
            "table_list" => $r->table_list,
            "figure" => $r->figure,
            "photos" => $r->photos,
            "summary" => $r->summary,
            "introduction" => $r->introduction,
            "result_framework" => $r->result_framework,
            "indicator" => $r->indicator,
            "outcome" => $r->outcome,
            "challenge" => $r->challenge,
            "lesson_learn" => $r->lesson_learn,
            "next_plan" => $r->next_plan,
            "financial" => $r->financial,
            "annex" => $r->annex,
            "ngo_id" => $r->ngo,

        );
        $i = DB::table("narative_achieves")->insert($data);
        if ($i)
        {
            $r->session()->flash("sms", "New narative achieve has been created successfully!");
            return redirect("/narative-achieve/create");
        }
        else{
            $r->session()->flash("sms1", "Fail to create new narative achieve!");
            return redirect("/narative-achieve/create");
        }
    }
    // update
    public function update(Request $r)
    {
        $data = array(
            "cover_page" => $r->cover_page,
            "start_date" => $r->start_date,
            "end_date" => $r->end_date,
            "content" => $r->content,
            "acronyms" => $r->acronyms,
            "table_list" => $r->table_list,
            "figure" => $r->figure,
            "photos" => $r->photos,
            "summary" => $r->summary,
            "introduction" => $r->introduction,
            "result_framework" => $r->result_framework,
            "indicator" => $r->indicator,
            "outcome" => $r->outcome,
            "challenge" => $r->challenge,
            "lesson_learn" => $r->lesson_learn,
            "next_plan" => $r->next_plan,
            "financial" => $r->financial,
            "annex" => $r->annex,
            "ngo_id" => $r->ngo,
        );
        $i = DB::table("narative_achieves")->where("id", $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash("sms", "All changes have saved successfully!");
            return redirect("/narative-achieve/edit/". $r->id);
        }
        else{
            $r->session()->flash("sms1", "Fail to save change. You may not make any change!");
            return redirect("/narative-achieve/edit/". $r->id);
        }
    }

    //Delete
    public function delete($id)
    {
        DB::table('narative_achieves')->where('id', $id)->update(["active"=>0]);
        $page = @$_GET['page'];
        if ($page>0)
        {
            return redirect('/narative-achieve?page='.$page);
        }
        return redirect('/narative-achieve');
    }
}
