@extends("layouts.achieve")
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
                <strong>{{trans('labels.create_indicator_achieved')}}</strong>&nbsp;&nbsp;
                <a href="{{url('/indicator-achieve')}}" class="text-success"><i class="fa fa-arrow-left"></i> {{trans('labels.back')}}</a>
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
                <form action="{{url('/indicator-achieve/save')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-6 {{Auth::user()->ngo_id>0?'hide':''}}">
                            <div class="form-group row">
                                <label for="ngo" class="control-label col-sm-4 lb">{{trans('labels.user_ngo')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="ngo" id="ngo" class="form-control chosen-select" onchange="getProject()">
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
                                        <select name="project_name" id="project_name" class="form-control chosen-select" onchange="getInfo()">
                                            {{--  <option value="0">-- Choose a project --</option>  --}}
                                        @foreach($settings as $s)
                                            <option value="{{$s->id}}">{{$s->project_name}}</option>
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
                                        <input type="text" class="form-control datepicker-icon" id="start_date" name="start_date" required> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="indicator_code" class="control-label col-sm-4 lb">{{trans('labels.indicator_code')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="indicator_code" name="indicator_code">
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
                                    <label for="indicator_mode" class="control-label col-sm-4 lb"></label>
                                    <div class="col-sm-8">
                                        {{--<input type="text" class="form-control" id="indicator_mode" name="indicator_mode"> --}}
                                        <br>
                                        <button class="btn btn-primary btn-flat" type="submit">{{trans('labels.save')}}</button>
                                        <button class="btn btn-danger btn-flat" type="reset">{{trans('labels.cancel')}}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="end_date" class="control-label col-sm-4 lb">{{trans('labels.end_date')}} <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control datepicker-icon" id="end_date" name="end_date" required> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="indicator_name" class="control-label col-sm-4 lb">{{trans('labels.indicator_name')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="indicator_name" name="indicator_name">
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('js/multiselect/jquery.multi-select.min.js')}}"></script>
<script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>

<script>
    $(document).ready(function(){
        $("#siderbar li a").removeClass("current");
        $("#menu_indicator").addClass("current");
        $("#start_date, #end_date").datepicker({
            orientation: 'bottom',
            format: 'dd/mm/yyyy',
            autoclose: true,
            todayHighlight: true,
            toggleActive: true
        });
        $("#target").multiSelect();
        getInfo();
    });
    // bind target to a setting
    function getTarget()
    {
        var sid = $("#project_name").val();
        $.ajax({
            type: "GET",
            url: burl + "/indicator/target/get/" + sid,
            success: function(sms){
                sms = JSON.parse(sms);
                var opts = "<select class='form-control' name='target[]' id='target' multiple disabled>";
                for(var i=0;i<sms.length;i++)
                {
                    opts += "<option value='" + sms[i].id + "' selected>" + sms[i].year + "</option>";
                }
                opts += "</select>";
                $("#sp").html(opts);
                $("#target").multiSelect();
              
            }
        });
    }
    // get project
    function getProject()
    {
        var ngo_id = $("#ngo").val();
        $.ajax({
            type: "GET",
            url: burl + "/indicator/project/get/" + ngo_id,
            success: function(sms){
                sms = JSON.parse(sms);
                var opts = "";
                for(var i=0;i<sms.length;i++)
                {
                    opts += "<option value='" + sms[i].id + "'>" + sms[i].project_name + "</option>";
                }
                $("#project_name").chosen('destroy');
                $("#project_name").html(opts);
                $("#project_name").chosen();
                getInfo();
            }
        });
    }
    // bind info when project is change
    function getInfo()
    {
        clearForm();
        var sid = $("#project_name").val();
        $.ajax({
            type: "GET",
            url: burl + "/indicator/info/get/" + sid,
            success: function(sms){
                sms = JSON.parse(sms);
                $("#project_code").val(sms.project_code);
                $("#indicator_code").val(sms.indicator_code);
                $("#indicator_name").val(sms.indicator_name);
                $("#indicator_type").val(sms.type);
                $("#framework").val(sms.framework);
                $("#baseline").val(sms.baseline);
                $("#indicator_unit").val(sms.indicator_unit);
            }
        });
        getTarget();                
        
    }
    function clearForm()
    {
        $("#project_code").val("");
        $("#indicator_code").val("");
        $("#indicator_name").val("");
        $("#indicator_type").val("");
        $("#framework").val("");
        $("#baseline").val("");
        $("#indicator_unit").val("");
    }
</script>
@endsection