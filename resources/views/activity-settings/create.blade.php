@extends("layouts.design")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>{{trans('labels.create_activity_setting')}}</strong>&nbsp;&nbsp;
                <a href="{{url('/activity-setting')}}" class="text-success"><i class="fa fa-arrow-left"></i> {{trans('labels.back')}}</a>
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
                <form action="{{url('/activity-setting/save')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')" name='frm'>
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group row {{Auth::user()->ngo_id>0?'hide':''}}">
                                <label for="ngo" class="control-label col-sm-4 lb">{{trans('labels.user_ngo')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="ngo" id="ngo" class="form-control chosen-select" onchange="binding()">
                                    @foreach($ngos as $ngo)
                                        <option value="{{$ngo->id}}">{{$ngo->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_code" class="control-label col-sm-4 lb">{{trans('labels.activity_code')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('activity_code')}}" id="activity_code" name="activity_code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_name" class="control-label col-sm-4 lb">{{trans('labels.activity_name')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <textarea name="activity_name" id="activity_name" cols="30" rows="2" class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="project_code" class="control-label col-sm-4 lb">{{trans('labels.project_code')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('project_code')}}" name="project_code" id="project_code">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="project_name" class="control-label col-sm-4 lb">{{trans('labels.project_name')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="project_name" id="project_name" class="form-control chosen-select" data-placeholder=" ">

                                        @foreach($projects as $pro)
                                            <option value="{{$pro->id}}">{{$pro->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="person_responsible" class="control-label col-sm-4 lb">{{trans('labels.person_responsible')}}</label>
                                <div class="col-sm-8" id="sp1">
                                    <select name="person_responsible[]" id="person_responsible" class="form-control" multiple>
                                        @foreach($users as $per)
                                            <option value="{{$per->id}}">{{$per->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            {{--<div class="form-group row">--}}
                                {{--<label for="activity_type" class="control-label col-sm-4 lb">{{trans('labels.activity_type')}}</label>--}}
                                {{--<div class="col-sm-8">--}}
                                    {{--<select name="activity_type" id="activity_type" class="form-control chosen-select" data-placeholder=" ">--}}
                                                                                                                {{----}}
                                    {{--@foreach($activity_types as $ac)--}}
                                        {{--<option value="{{$ac->id}}">{{$ac->name}}</option>--}}
                                    {{--@endforeach--}}
                                    {{--</select>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="form-group row">--}}
                                {{--<label for="activity_definition" class="control-label col-sm-4 lb">{{trans('labels.activity_definition')}}</label>--}}
                                {{--<div class="col-sm-8">--}}
                                    {{--<input type="text" class="form-control" value="{{old('activity_definition')}}" id="activity_definition" name="activity_definition">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            <br>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="result_framework_structure" class="control-label col-sm-4 lb">{{trans('labels.result_framework_structure')}}</label>
                                <div class="col-sm-8">
                                    <select name="result_framework_structure" id="result_framework_structure" class="form-control chosen-select" data-placeholder=" ">
                                    @foreach($frameworks as $fr)
                                        <option value="{{$fr->id}}">{{$fr->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="component_responsible" class="control-label col-sm-4 lb">{{trans('labels.component_responsible')}}</label>
                                <div class="col-sm-8" id="sp">
                                    <select name="component_responsible[]" id="component_responsible" class="form-control" multiple>
                                    @foreach($components as $com)
                                        <option value="{{$com->id}}">{{$com->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_source" class="control-label col-sm-4 lb">{{trans('labels.data_source')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('data_source')}}" id="data_source" name="data_source">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deliverable" class="control-label col-sm-4 lb">Unit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('deliverable')}}" id="deliverable" name="deliverable">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location" class="control-label col-sm-4 lb">{{trans('labels.location')}}</label>
                                <div class="col-sm-8">
                                    <select name="location" id="location" class="form-control " style="height: 37px">
                                        <option value=""> </option>
                                    @foreach($provinces as $pro)
                                        <option value="{{$pro->name}}">{{$pro->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>                  
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center ">
                            <input type="hidden" name="save_status" value="0" id="save_status">
                            <button class="btn btn-primary btn-flat" type="button" id="btnSave">{{trans('labels.save')}}</button>
                            <button class="btn btn-success btn-flat" type="button" id="btnSave1">{{trans('labels.save_and_continue')}}</button>
                            <button class="btn btn-danger btn-flat" type="reset">{{trans('labels.cancel')}}</button>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-12">
                            <p class="text-success">
                            All fields with <span class="text-danger">*</span> are required!
                            </p>
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
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_activity_setting").addClass("current");
            $('#person_responsible').multiSelect();
            // $('#location').multiSelect();
            $("#component_responsible").multiSelect();
            // save
            $("#btnSave").click(function(){
                $("#save_status").val("0");
                frm.submit();
            });
            $("#btnSave1").click(function(){
                $("#save_status").val("1");
                frm.submit();
            });
        });
        // function binding data on ngo changed
        function binding()
        {
            var id = $("#ngo").val();
            
            bindProject(id);
        }
        // bind project
        function bindProject(ngo_id)
        {
            $.ajax({
                type: "GET",
                url: burl + "/project/get/" + ngo_id,
                success: function(sms){
                    var opts = "";
                    for(var i=0;i<sms.length;i++)
                    {
                        opts += "<option value='" + sms[i].id + "'>" + sms[i].name + "</option>";
                    }

                    $("#project_name").html(opts);
                       
                   $('#project_name').val('').trigger('chosen:updated');
                    bindActivityType(ngo_id);
                }
            });
        }
        // bind activity type
        function bindActivityType(ngo_id)
        {
            $.ajax({
                type: "GET",
                url: burl + "/activity_type/get/" + ngo_id,
                success: function(sms){
                    var opts = "";
                    for(var i=0;i<sms.length;i++)
                    {
                        opts += "<option value='" + sms[i].id + "'>" + sms[i].name + "</option>";
                    }
                    $("#activity_type").html(opts);
                    $('#activity_type').val('').trigger('chosen:updated');                    
                    bindFramework(ngo_id);
                }
            });
        }
        // bind framework
        function bindFramework(ngo_id)
        {
            $.ajax({
                type: "GET",
                url: burl + "/framework/get/" + ngo_id,
                success: function(sms){
                    var opts = "";
                    for(var i=0;i<sms.length;i++)
                    {
                        opts += "<option value='" + sms[i].id + "'>" + sms[i].name + "</option>";
                    }
                    $("#result_framework_structure").html(opts);
                    $('#result_framework_structure').val('').trigger('chosen:updated');                    
                    
                    bindComponent(ngo_id);
                }
            });
        }
        // bind component
        function bindComponent(ngo_id)
        {
            $.ajax({
                type: "GET",
                url: burl + "/component/get/" + ngo_id,
                success: function(sms){
                    var lbs = "";
                    for(var i=0;i<sms.length;i++)
                    {
                        lbs += "<label class='multi-select-menuitem' for='component_responsible_" + i + "' role='menuitem'>";
                        lbs += "<input id='component_responsible_" + i + "' value='" + sms[i].id + "' type='checkbox'>";
                        lbs += sms[i].name;
                        lbs += "</label>";
                    }
                    $("#sp .multi-select-menuitems").html(lbs);

                   bindUser(ngo_id);
                }
            });
        }
        // bind component
        function bindUser(ngo_id)
        {
            $.ajax({
                type: "GET",
                url: burl + "/user/get/" + ngo_id,
                success: function(sms){
                    var lbs = "";
                    for(var i=0;i<sms.length;i++)
                    {
                        lbs += "<label class='multi-select-menuitem' for='person_responsible_" + i + "' role='menuitem'>";
                        lbs += "<input id='person_responsible_" + i + "' value='" + sms[i].id + "' type='checkbox'>";
                        lbs += sms[i].name;
                        lbs += "</label>";
                    }
                    $("#sp1 .multi-select-menuitems").html(lbs);
                   
                }
            });
        }
    </script>
@endsection