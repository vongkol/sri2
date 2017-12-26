@extends("layouts.achieve")
@section('content')   
<link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
<style>
    #sp .multi-select-button, #sp1 .multi-select-button{
        background: #eceeef;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>{{trans('labels.create_activity_achieved')}}</strong>&nbsp;&nbsp;
                <a href="{{url('/activity-achieve')}}" class="text-success"><i class="fa fa-arrow-left"></i> {{trans('labels.back')}}</a>
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
                <form action="{{url('/activity-achieve/save')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')" name='frm'>
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-primary" style="border-bottom:1px solid #ccc">
                                <strong>{{trans('labels.information')}}</strong>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group row">
                            
                                <label for="ngo" class="control-label col-sm-4 lb">{{trans('labels.user_ngo')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="ngo" id="ngo" class="form-control chosen-select" onchange="binding()">
                                    @foreach($ngos as $ngo)
                                        <option value="{{$ngo->id}}">{{$ngo->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="activity_type" class="control-label col-sm-4 lb">{{trans('labels.activity_type')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="activity_type" id="activity_type" class="form-control chosen-select">
                                        <option value="0">-- {{trans('labels.activity_type')}} --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label for="activity_name" class="control-label col-sm-2 lb">{{trans('labels.activity_name')}}</label>
                                <div class="col-sm-10">
                                    <select name="activity_name" id="activity_name" class="form-control chosen-select">
                                    <option value="0">-- {{trans('labels.activity_name')}} --</option>
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
                                <label for="start_date" class="control-label col-sm-4 lb">{{trans('labels.start_date')}}</label>
                                <div class="col-sm-8">
                                   <input type="text"  placeholder="yyyy-mm-dd"  class="form-control datepicker-icon" id="start_date" name="start_date" value="{{old('start_date')}}">
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="result_framework_structure" class="control-label col-sm-4 lb">{{trans('labels.result_framework_structure')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="result_framework_structure" name="result_framework_structure" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_category" class="control-label col-sm-4 lb">{{trans('labels.activity_category')}}</label>
                                <div class="col-sm-8">
                                    <select name="activity_category" id="activity_category" class="form-control chosen-select" data-placeholder=" ">
                                        <option value="0">-- {{trans('labels.none_select')}} --</option>
                                    </select>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="person_achieved" class="control-label col-sm-4 lb">{{trans('labels.person_achieved_activity')}}</label>
                                <div class="col-sm-8" id="sp2">
                                    <select name="person_achieved[]" id="person_achieved" class="form-control" multiple>
                                    @foreach($users as $per)
                                        <option value="{{$per->id}}">{{$per->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="end_date" class="control-label col-sm-4 lb">{{trans('labels.end_date')}}</label>
                                <div class="col-sm-8">
                                   <input type="text" class="form-control datepicker-icon" placeholder="yyyy-mm-dd" id="end_date" name="end_date" value="{{old('end_date')}}">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="component_responsible" class="control-label col-sm-4 lb">{{trans('labels.component_responsible')}}</label>
                                <div class="col-sm-8" id="sp">
                                    <select name="component_responsible[]" id="component_responsible" class="form-control" multiple disabled>
                                   
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="actual" class="control-label col-sm-4 lb">{{trans('labels.actual')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('actual')}}" id="actual" name="actual" placeholder="Input actual">
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="person_responsible" class="control-label col-sm-4 lb">{{trans('labels.person_responsible')}}</label>
                                <div class="col-sm-8" id="sp1">
                                    <select name="person_responsible[]" id="person_responsible" class="form-control" multiple>
                                   
                                    </select>
                                </div>
                            </div>
                        </div>                  
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-center">
                            <br>
                                <button class="btn btn-primary btn-flat" type="submit">{{trans('labels.save')}}</button>
                                <button class="btn btn-danger btn-flat" type="reset">{{trans('labels.cancel')}}</button>
                            </p>
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
    <script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_activity_achieved").addClass("current");
            $('#person_responsible').multiSelect();
            $("#component_responsible").multiSelect();
            $("#person_achieved").multiSelect();
            $("#start_date, #end_date").datepicker({
                orientation: 'bottom',
                format: 'yyyy-mm-dd',
                autoclose: true,
                todayHighlight: true,
                toggleActive: true
            });
            binding();
            $('#activity_type').change(function(){
                $("#result_framework_structure").val("");
                bindActivity($("#ngo").val());
            });
            $("#activity_name").change(function(){
                $("#result_framework_structure").val("");
                bindFramework();
                bindComponent();
                bindPerson();
            });
           
        });
        // function binding data on ngo changed
        function binding()
        {
            var id = $("#ngo").val();
            $("#result_framework_structure").val("");
            bindActivityType(id);
            bindCategory(id);
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
                     //$('#activity_type').val('').trigger('chosen:updated');  
                    $('#activity_type').chosen('destroy');
                    $("#activity_type").html(opts);
                    $("#activity_type option:first-child").attr("selected","selected");
                    $('#activity_type').chosen();                 
                    bindActivity(ngo_id);
                }
            });
        }
        // bind framework
        function bindActivity(ngo_id)
        {
           var aid = $("#activity_type").val();
           $.ajax({
                type: "GET",
                url: burl + "/setting/get/" + ngo_id+"*"+aid,
                success: function(sms){
                    var opts = "";
                    for(var i=0;i<sms.length;i++)
                    {
                        opts += "<option value='" + sms[i].id + "'>" + sms[i].activity_name + "</option>";
                    }
                     //$('#activity_type').val('').trigger('chosen:updated');  
                    $('#activity_name').chosen('destroy');
                    $("#activity_name").html(opts);
                    $("#activity_name option:first-child").attr("selected","selected");
                    $('#activity_name').chosen();                 
                    bindFramework();
                    bindComponent();
                    bindPerson();
                }
            });
        }
        function bindFramework()
        {
           var id = $("#activity_name").val();
           $.ajax({
                type: "GET",
                url: burl + "/setting/framework/get/" + id,
                success: function(sms){
                    
                    for(var i=0;i<sms.length;i++)
                    {
                        $("#result_framework_structure").val(sms[i].fname);
                    }
                }
            });
        }
        // bind component
        function bindComponent()
        {
            var id = $("#activity_name").val();
            $.ajax({
                type: "GET",
                url: burl + "/setting/component/get/" + id,
                success: function(sms){
                    var opts = "<select class='form-control' name='component_responsible[]' id='component_responsible' multiple disabled>";
                    for(var i=0;i<sms.length;i++)
                    {
                        opts += "<option value='" + sms[i].id + "' selected>" + sms[i].name + "</option>";
                    }
                    opts += "</select>";
                    $("#sp").html(opts);
                    $("#component_responsible").multiSelect();

                }
            });
        }
         function bindPerson()
        {
            var id = $("#activity_name").val();
            $.ajax({
                type: "GET",
                url: burl + "/setting/person/get/" + id,
                success: function(sms){
                    var opts = "<select class='form-control' name='person_responsible[]' id='person_responsible' multiple disabled>";
                    for(var i=0;i<sms.length;i++)
                    {
                        opts += "<option value='" + sms[i].id + "' selected>" + sms[i].name + "</option>";
                    }
                    opts += "</select>";
                    $("#sp1").html(opts);
                    $("#person_responsible").multiSelect();

                }
            });
        }
         function bindCategory(ngo_id)
        {
            $.ajax({
                type: "GET",
                url: burl + "/setting/category/get/" + ngo_id,
                success: function(sms){
                    var opts = "";
                    for(var i=0;i<sms.length;i++)
                    {
                        opts += "<option value='" + sms[i].id + "'>" + sms[i].name + "</option>";
                    }
                    $('#activity_category').chosen('destroy');
                    $("#activity_category").html(opts);
                    $("#activity_category option:first-child").attr("selected","selected");
                    $('#activity_category').chosen();                 

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