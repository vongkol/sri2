@extends("layouts.achieve")
@section('content')
<link href="{{asset('css/datepicker.css')}}" rel="stylesheet">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{trans('labels.edit_narative_achieved')}}</strong>&nbsp;&nbsp;
                    <a href="{{url('/narative-achieve')}}" class="text-success"><i class="fa fa-arrow-left"></i> {{trans('labels.back')}}</a>
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
                    <form action="{{url('/narative-achieve/update')}}" class="form-horizontal" enctype="multipart/form-data" method="post" onsubmit="return confirm('You want to save?')">
                        {{csrf_field()}}
                        <input type="hidden" value="{{$narative_achieve->id}}" name="id" id="id">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="start_date" class="control-label col-sm-3 lb">{{trans('labels.start_date')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control datepicker-icon" placeholder="dd/mm/yyyy" value="{{$narative_achieve->start_date}}" id="start_date" name="start_date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_date" class="control-label col-sm-3 lb">{{trans('labels.end_date')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control datepicker-icon" placeholder="dd/mm/yyyy" value="{{$narative_achieve->end_date}}" id="end_date" name="end_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="ngo" class="control-label col-sm-3 lb">{{trans('labels.user_ngo')}} <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="ngo" id="ngo" class="form-control chosen-select">
                                            @foreach($ngos as $ngo)
                                                <option value="{{$ngo->id}}" {{$narative_achieve->ngo_id==$ngo->id?'selected':''}}>{{$ngo->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="cover_page" class="control-label col-sm-12 lb">{{trans('labels.cover_page')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="cover_page" id="cover_page" class="form-control ckeditor">{!!$narative_achieve->cover_page!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="content" class="control-label col-sm-12 lb">{{trans('labels.table_of_content')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="content" id="content" class="form-control ckeditor">{!!$narative_achieve->content!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="acronyms" class="control-label col-sm-12 lb">{{trans('labels.list_of_acronyms')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="acronyms" id="acronyms" class="form-control ckeditor">{!!$narative_achieve->acronyms!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="table_list" class="control-label col-sm-12 lb">{{trans('labels.list_of_table')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="table_list" id="table_list" class="form-control ckeditor">{!!$narative_achieve->table_list!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="figure" class="control-label col-sm-12 lb">{{trans('labels.list_of_figures')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="figure" id="figure" class="form-control ckeditor">{!!$narative_achieve->figure!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="photos" class="control-label col-sm-12 lb">{{trans('labels.list_of_photos')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="photos" id="photos" class="form-control ckeditor">{!!$narative_achieve->photos!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="summary" class="control-label col-sm-12 lb">{{trans('labels.executive_summary')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="summary" id="summary" class="form-control ckeditor">{!!$narative_achieve->summary!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="introduction" class="control-label col-sm-12 lb">{{trans('labels.introduction')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="introduction" id="introduction" class="form-control ckeditor">{!!$narative_achieve->introduction!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="result_framework" class="control-label col-sm-12 lb">{{trans('labels.achievement_by_results_framework')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="result_framework" id="result_framework" class="form-control ckeditor">{!!$narative_achieve->result_framework!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="indicator" class="control-label col-sm-12 lb">{{trans('labels.achievements_by_indicators')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="indicator" id="indicator" class="form-control ckeditor">{!!$narative_achieve->indicator!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="outcome" class="control-label col-sm-12 lb">{{trans('labels.outcomes_and_impacts')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="outcome" id="outcome" class="form-control ckeditor">{!!$narative_achieve->outcome!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="challenge" class="control-label col-sm-12 lb">{{trans('labels.challenges_and_solutions')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="challenge" id="challenge" class="form-control ckeditor">{!!$narative_achieve->challenge!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="lesson_learn" class="control-label col-sm-12 lb">{{trans('labels.lesson_learned')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="lesson_learn" id="lesson_learn" class="form-control ckeditor">{!!$narative_achieve->lesson_learn!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="next_plan" class="control-label col-sm-12 lb">{{trans('labels.next_plan')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="next_plan" id="next_plan" class="form-control ckeditor">{!!$narative_achieve->next_plan!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="financial" class="control-label col-sm-12 lb">{{trans('labels.financial_management')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="financial" id="financial" class="form-control ckeditor">{!!$narative_achieve->financial!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="annex" class="control-label col-sm-12 lb">{{trans('labels.annexes')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="annex" id="annex" class="form-control ckeditor">{!!$narative_achieve->annex!!}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                    <button class="btn btn-primary btn-flat" type="submit">{{trans('labels.save_changes')}}</button>
                                    <button class="btn btn-danger btn-flat" type="reset" >{{trans('labels.cancel')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{asset("chosen/chosen.jquery.js")}}"></script>
    <script src="{{asset("chosen/chosen.proto.js")}}"></script>
    <script src="{{asset('datepicker/date.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_narative_achieve").addClass("current");

            $("#start_date, #end_date").datepicker({
                orientation: 'bottom',
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                toggleActive: true
            });
        });
    </script>
    <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 
        CKEDITOR.replace( 'annex',{filebrowserBrowseUrl:roxyFileman, 
                filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                removeDialogTabs: 'link:upload;image:upload'});
                
    </script> 

@endsection