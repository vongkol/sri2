@extends("layouts.activity")
@section('content')
<link href="{{asset('css/datepicker.css')}}" rel="stylesheet">

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{trans('labels.create_narative_achieved')}}</strong>&nbsp;&nbsp;
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
                    <form action="{{url('/narative-achieve/save')}}" class="form-horizontal" enctype="multipart/form-data" method="post" onsubmit="return confirm('You want to save?')">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="start_date" class="control-label col-sm-3 lb">{{trans('labels.start_date')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control datepicker-icon" placeholder="dd/mm/yyyy" value="{{old('start_date')}}" id="start_date" name="start_date">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="end_date" class="control-label col-sm-3 lb">{{trans('labels.end_date')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control datepicker-icon" placeholder="dd/mm/yyyy" value="{{old('end_date')}}" id="end_date" name="end_date">
                                    </div>
                                </div>
                            </div>
                         
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="ngo" class="control-label col-sm-3 lb">{{trans('labels.user_ngo')}} <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="ngo" id="ngo" class="form-control chosen-select">
                                            @foreach($ngos as $ngo)
                                                <option value="{{$ngo->id}}">{{$ngo->name}}</option>
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
                                        <textarea name="cover_page" id="cover_page" class="form-control ckeditor">{{old('cover_page')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="content" class="control-label col-sm-12 lb">{{trans('labels.table_of_content')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="content" id="content" class="form-control ckeditor">{{old('content')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="acronyms" class="control-label col-sm-12 lb">{{trans('labels.list_of_acronyms')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="acronyms" id="acronyms" class="form-control ckeditor">{{old('acronyms')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="table_list" class="control-label col-sm-12 lb">{{trans('labels.list_of_table')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="table_list" id="table_list" class="form-control ckeditor">{{old('table_list')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="figure" class="control-label col-sm-12 lb">{{trans('labels.list_of_figures')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="figure" id="figure" class="form-control ckeditor">{{old('figure')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="photos" class="control-label col-sm-12 lb">{{trans('labels.list_of_photos')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="photos" id="photos" class="form-control ckeditor">{{old('photos')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="summary" class="control-label col-sm-12 lb">{{trans('labels.executive_summary')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="summary" id="summary" class="form-control ckeditor">{{old('summary')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="introduction" class="control-label col-sm-12 lb">{{trans('labels.introduction')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="introduction" id="introduction" class="form-control ckeditor">{{old('introduction')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="result_framework" class="control-label col-sm-12 lb">{{trans('labels.achievements_by_results_framework')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="result_framework" id="result_framework" class="form-control ckeditor">{{old('result_framework')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="indicator" class="control-label col-sm-12 lb">{{trans('labels.achievements_by_indicators')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="indicator" id="indicator" class="form-control ckeditor">{{old('indicator')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="outcome" class="control-label col-sm-12 lb">{{trans('labels.outcomes_and_impacts')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="outcome" id="outcome" class="form-control ckeditor">{{old('outcome')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="challenge" class="control-label col-sm-12 lb">{{trans('labels.challenges_and_solutions')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="challenge" id="challenge" class="form-control ckeditor">{{old('challenge')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="lesson_learn" class="control-label col-sm-12 lb">{{trans('labels.lesson_learned')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="lesson_learn" id="lesson_learn" class="form-control ckeditor">{{old('lesson_learn')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="next_plan" class="control-label col-sm-12 lb">{{trans('labels.next_plan')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="next_plan" id="next_plan" class="form-control ckeditor">{{old('next_plan')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="financial" class="control-label col-sm-12 lb">{{trans('labels.financial_management')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="financial" id="financial" class="form-control ckeditor">{{old('financial')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group row">
                                    <label for="annex" class="control-label col-sm-12 lb">{{trans('labels.annexes')}}</label>
                                    <div class="col-sm-12">
                                        <textarea name="annex" id="annex" class="form-control ckeditor">{{old('annex')}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="form-group row">
                                    <div class="col-sm-12 text-center">
                                    <button class="btn btn-primary btn-flat" type="submit">{{trans('labels.save')}}</button>
                                    <button class="btn btn-danger btn-flat" type="reset">{{trans('labels.cancel')}}</button>
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
    <script src="{{asset('chosen/chosen.jquery.js')}}"></script>
    <script src="{{asset('chosen/chosen.proto.js')}}"></script>
    <script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>

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
   
@endsection