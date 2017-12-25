@extends("layouts.activity")
@section('content')
<link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
<style>
        #sp .multi-select-button{
            background: #eceeef;
        }
    </style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>{{trans('labels.edit_indicator_achieved')}}</strong>&nbsp;&nbsp;
                <a href="{{url('/indicator-achieve')}}" class="text-success"><i class="fa fa-arrow-left"></i> {{trans('labels.back')}}</a>
                <a href="#" class="text-danger" onclick="editIndicator(event)"><i class="fa fa-pencil"></i> {{trans('labels.edit')}}</a>
                <a href="{{url('/indicator-achieve/create')}}"><i class="fa fa-plus"></i> {{trans('labels.new')}}</a>
            </div>
            <div class="card-block">
                @if(Session::has('sms'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div>
                            {{session('sms')}}
                        </div>
                    </div>
                @endif
                @if(Session::has('sms1'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div>
                            {{session('sms1')}}
                        </div>
                    </div>
                @endif
                <form action="{{url('/indicator-achieve/update')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')">
                    {{csrf_field()}}
                    <input type="hidden" name="id" id="id" value="{{$indicator_achieve->id}}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="ngo" class="control-label col-sm-4 lb">{{trans('labels.user_ngo')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="ngo" id="ngo" class="form-control chosen-select" onchange="getProject()" disabled>
                                    @foreach($ngos as $ngo)
                                        <option value="{{$ngo->id}}">{{$ngo->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="project_code" class="control-label col-sm-4 lb">{{trans('labels.project_code')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="project_code" name="project_code" disabled> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label for="project_name" class="control-label col-sm-2 lb">{{trans('labels.project_name')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <select name="project_name" id="project_name" class="form-control chosen-select" onchange="getInfo()" disabled>
                                        {{--  <option value="0">-- Choose a project --</option>  --}}
                                    @foreach($settings as $s)
                                        <option value="{{$s->id}}" {{$indicator_achieve->indicator_setting_id==$s->id?'selected':''}}>{{$s->project_name}}</option>
                                    @endforeach
                                </select>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12"></div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="start_date" class="control-label col-sm-4 lb">{{trans('labels.start_date')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control datepicker-icon" id="start_date" 
                                    value="{{$indicator_achieve->start_date}}" name="start_date" required disabled> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_code" class="control-label col-sm-4 lb">{{trans('labels.indicator_code')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="indicator_code" name="indicator_code" disabled> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_type" class="control-label col-sm-4 lb">{{trans('labels.indicator_type')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="indicator_type" name="indicator_type" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="baseline" class="control-label col-sm-4 lb">{{trans('labels.baseline')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="baseline" name="baseline" disabled> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_mode" class="control-label col-sm-4 lb">{{trans('labels.indicator_mode')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="indicator_mode" value="{{$indicator_achieve->indicator_mode}}" name="indicator_mode" disabled> 
                                    <p class="hide" id="btnBox">
                                            <br>
                                            <button class="btn btn-primary btn-flat" type="submit">{{trans('labels.save_changes')}}</button>
                                            <button class="btn btn-danger btn-flat" type="button" id="btnCancel">{{trans('labels.cancel')}}</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="end_date" class="control-label col-sm-4 lb">{{trans('labels.end_date')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control datepicker-icon" 
                                    value="{{$indicator_achieve->end_date}}" id="end_date" name="end_date" required disabled> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_name" class="control-label col-sm-4 lb">{{trans('labels.indicator_name')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="indicator_name" name="indicator_name" disabled> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="framework" class="control-label col-sm-4 lb">{{trans('labels.result_framework_structure')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="framework" name="framework" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_unit" class="control-label col-sm-4 lb">{{trans('labels.indicator_unit')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="indicator_unit" name="indicator_unit" disabled> 
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="target" class="control-label col-sm-4 lb">{{trans('labels.target')}}</label>
                                <div class="col-sm-8" id="sp">
                                    <select name="target[]" id="target" class="form-control"  multiple disabled>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                </form>
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#description" role="tab">{{trans('labels.description')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#document" role="tab">{{trans('labels.supporting_document')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#other1" role="tab">Other 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#other2" role="tab">Other 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#other3" role="tab">Other 3</a>
                    </li>
                </ul>
                <div class="tab-content">
                        <div class="tab-pane active" id="description" role="tabpanel">
                            <form action="{{url('/indicator-achieve/description/update')}}" method="post" onsubmit="return confirm('You want to save changes?')">
                            {{csrf_field()}}
                            <input type="hidden" value="{{$indicator_achieve->id}}" name="id_for_description">
                            <div class="row">
                                <div class="col-sm-12">
                                    @if(Session::has('sms2'))
                                        <div class="alert alert-success" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div>
                                                {{session('sms2')}}
                                            </div>
                                        </div>
                                    @endif
                                    <p>
                                    <br>
                                    <button type="button" class="btn btn-primary btn-flat" onclick="editDescription()"><i class="fa fa-plus"></i> {{trans('labels.edit_description')}}</button>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="achievement" class="control-label col-sm-4 lb">{{trans('labels.achievement')}}</label>
                                        <div class="col-sm-8">
                                            <textarea name="achievement" id="achievement" cols="30" rows="2" class="form-control" disabled>{{$indicator_achieve->achievement}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="solution" class="control-label col-sm-4 lb">{{trans('labels.solution')}}</label>
                                        <div class="col-sm-8">
                                            <textarea name="solution" id="solution" cols="30" rows="2" class="form-control" disabled>{{$indicator_achieve->solution}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="next_plan" class="control-label col-sm-4 lb">{{trans('labels.next_plan')}}</label>
                                        <div class="col-sm-8">
                                            <textarea name="next_plan" id="next_plan" cols="30" rows="2" class="form-control" disabled>{{$indicator_achieve->next_plan}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="control-label col-sm-4 lb">&nbsp;</label>
                                        <div class="col-sm-8">
                                            <p class="hide" id="description_box">
                                                <button type="submit" class="btn btn-primary btn-flat">{{trans('labels.save_changes')}}</button>
                                                <button type="button" class="btn btn-danger btn-flat" onclick="cancelDescription()">{{trans('labels.cancel')}}</button>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label for="challenge" class="control-label col-sm-4 lb">{{trans('labels.challenge')}}</label>
                                        <div class="col-sm-8">
                                            <textarea name="challenge" id="challenge" cols="30" rows="2" class="form-control" disabled>{{$indicator_achieve->challenge}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="lesson_learn" class="control-label col-sm-4 lb">{{trans('labels.lesson_learned')}}</label>
                                        <div class="col-sm-8">
                                            <textarea name="lesson_learn" id="lesson_learn" cols="30" rows="2" class="form-control" disabled>{{$indicator_achieve->lesson_learn}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="other_comment" class="control-label col-sm-4 lb">{{trans('labels.other_comment')}}</label>
                                        <div class="col-sm-8">
                                            <textarea name="other_comment" id="other_comment" cols="30" rows="2" class="form-control" disabled>{{$indicator_achieve->other_comment}}</textarea>
                                        </div>
                                    </div>
    
                                </div>
                            </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="document" role="tabpanel">
                            <p>
                            <br>
                                <a class="btn btn-primary btn-flat" href="#" id="btnAddTarget" data-toggle="modal" 
                                data-target=".bd-target-modal-lg"><i class="fa fa-plus"></i> {{trans('labels.upload_document')}}</a>
                            </p>
                            <table class="tbl">
                                <thead>
                                    <tr>
                                        <th>{!!trans('labels.id')!!}</th>
                                        <th>{{trans('labels.description')}}</th>
                                        <th>{{trans('labels.file_url')}}</th>
                                        <th>{{trans('labels.file_name')}}</th>
                                        <th>{{trans('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody id="docData">
                                @php($i=1)
                                @foreach($documents as $doc)
                                    <tr id="{{$doc->id}}">
                                        <td>{{$i++}}</td>
                                        <td>{{$doc->description}}</td>
                                        <td><a href="{{$doc->url}}" target="_blank">{{$doc->url}}</a></td>                                        
                                        <td><a href="{{asset('uploads/documents/'.$doc->file_name)}}" target="_blank">{{$doc->file_name}}</a></td>
                                        <td>
                                            <button type='button' class="btn btn-sm btn-danger" onclick="deleteDoc(this,event)"><i class="fa fa-trash-o"></i> {{trans('labels.delete')}}</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="other1" role="tabpanel">
                            <p>
                                You don't have customer field to show in this tab yet.
                            </p>
                            
                        </div>
                        <div class="tab-pane" id="other2" role="tabpanel">
                            <p>
                                    You don't have customer field to show in this tab yet.

                            </p>
                            
                        </div>
                        <div class="tab-pane" id="other3" role="tabpanel">
                            <p>
                                    You don't have customer field to show in this tab yet.

                            </p>
                            
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade bd-target-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content btn-flat">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentTitle">{{trans('labels.upload_new_document')}}</h5>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" id="target1">
                       <input type="hidden" id="doc_id" name="doc_id" value="0">
                        <div class="form-group row">
                            <label for="doc_description" class="control-label col-sm-2 lb">{{trans('labels.description')}} <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="doc_description" name="doc_description">
                            </div>
                        </div>
                        <div class="row">
                            <label for="file_url" class="control-label col-sm-2 lb">{{trans('labels.file_url')}}</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="file_url" name="file_url">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="doc_file_name" class="control-label col-sm-2 lb">{{trans('labels.file_name')}}</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="doc_file_name" name="doc_file_name">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <br>
                                <p class="text-success text-center" id="docsms"></p>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="col-md-12 text-center">
                    <button type="button" class="btn btn-primary btn-flat" onclick="saveDoc()">{{trans('labels.save')}}</button>
                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" onclick="clearDoc()">{{trans('labels.close')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('js/multiselect/jquery.multi-select.min.js')}}"></script>
<script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('js/indicator-achieved.js')}}"></script>
@endsection