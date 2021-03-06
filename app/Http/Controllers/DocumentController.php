<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function save(Request $r)
    {
        $data = array(
            'description' => $r->description,
            'url' => $r->url,
            'activity_achieved_id' => $r->act_id
        );
        $i = DB::table('activity_achieved_documents')->insertGetId($data);
        if($i>0)
        {
            // upload doc to documents folder
            if($r->hasFile('doc_file_name'))
            {
                $file = $r->file('doc_file_name');
                $file_name = $i . "-" .$file->getClientOriginalName();
                $destinationPath = 'uploads/documents/';
                $file->move($destinationPath, $file_name);
                DB::table('activity_achieved_documents')->where('id', $i)->update(['file_name' => $file_name]);
            }
           
       }
        $doc = DB::table('activity_achieved_documents')
            ->where('id', $i)->first();
        return json_encode($doc);
    
    }
    public function delete($id)
    {
        $i = DB::table('activity_achieved_documents')->where('id', $id)->delete();
        return $i;
    }
    public function save1(Request $r)
    {
        $data = array(
            'description' => $r->description,
            'indicator_achieved_id' => $r->act_id,
            'url' => $r->url
        );
        $i = DB::table('indicator_achieved_documents')->insertGetId($data);
        if($i>0)
        {
            // upload doc to documents folder
            if($r->hasFile('doc_file_name'))
            {
                $file = $r->file('doc_file_name');
                $file_name = $i . "-" .$file->getClientOriginalName();
                $destinationPath = 'uploads/documents/';
                $file->move($destinationPath, $file_name);
                DB::table('indicator_achieved_documents')->where('id', $i)->update(['file_name' => $file_name]);
            }
           
       }
        $doc = DB::table('indicator_achieved_documents')
            ->where('id', $i)->first();
        return json_encode($doc);
    
    }
    public function delete1($id)
    {
        $i = DB::table('indicator_achieved_documents')->where('id', $id)->delete();
        return $i;
    }
}
