@extends("layouts.activity")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Create Indicator Setting</strong>&nbsp;&nbsp;
                <a href="{{url('/indicator')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
                <form action="{{url('/indicator/save')}}" class="form-horizontal" method="post" name="frm">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="ngo" class="control-label col-sm-4 lb">User NGO <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="ngo" id="ngo" class="form-control chosen-select" onchange="binding()">
                                    @foreach($ngos as $ngo)
                                        <option value="{{$ngo->id}}">{{$ngo->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="project_code" class="control-label col-sm-4 lb">Project Code <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('project_code')}}" name="project_code" id="project_code" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="project_name" class="control-label col-sm-4 lb">Project Name <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="project_name" id="project_name" class="form-control chosen-select" data-placeholder=" ">
                                    @foreach($projects as $pro)
                                        <option value="{{$pro->id}}">{{$pro->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_code" class="control-label col-sm-4 lb">Indicator Code <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('indicator_code')}}" id="indicator_code" name="indicator_code" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_name" class="control-label col-sm-4 lb">Indicator Name <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('indicator_name')}}" id="indicator_name" name="indicator_name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="result_framework_structure" class="control-label col-sm-4 lb">Result Framework Structure</label>
                                    <div class="col-sm-8">
                                        <select name="result_framework_structure" id="result_framework_structure" class="form-control chosen-select" data-placeholder=" ">
                                        @foreach($frameworks as $fr)
                                            <option value="{{$fr->id}}">{{$fr->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="calculation_method" class="control-label col-sm-4 lb">Calculation Method</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('calculation_method')}}" id="calculation_method" name="calculation_method">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_definition" class="control-label col-sm-4 lb">Indicator Definition</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('indicator_definition')}}" id="indicator_definition" name="indicator_definition">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="indicator_type" class="control-label col-sm-4 lb">Indicator Type <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="indicator_type" id="indicator_type" class="form-control chosen-select">
                                        <option value="0">-- Choose One --</option>
                                    @foreach($indicator_types as $t)
                                        <option value="{{$t->id}}">{{$t->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="baseline" class="control-label col-sm-4 lb">Baseline</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('baseline')}}" id="baseline" name="baseline">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_source" class="control-label col-sm-4 lb">Data Source</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('data_source')}}" id="data_source" name="data_source">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_unit" class="control-label col-sm-4 lb">Indicator Unit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('indicator_unit')}}" id="indicator_unit" name="indicator_unit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="component_responsible" class="control-label col-sm-4 lb">Component Responsible</label>
                                <div class="col-sm-8" id="sp">
                                    <select name="component_responsible[]" id="component_responsible" class="form-control" multiple>
                                    @foreach($components as $com)
                                        <option value="{{$com->id}}">{{$com->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="person_responsible" class="control-label col-sm-4 lb">Person Responsible</label>
                                <div class="col-sm-8" id="sp1">
                                    <select name="person_responsible[]" id="person_responsible" class="form-control" multiple>
                                    @foreach($users as $per)
                                        <option value="{{$per->id}}">{{$per->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center ">
                        <br>
                            <input type="hidden" name="save_status" value="0" id="save_status">
                            <button class="btn btn-primary btn-flat" type="button" id="btnSave">Save</button>
                            <button class="btn btn-success btn-flat" type="button" id="btnSave1">Save and Continue</button>
                            <button class="btn btn-danger btn-flat" type="reset">Cancel</button>

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
    $(document).ready(function(){
        $("#siderbar li a").removeClass("current");
        $("#menu_indicator_setting").addClass("current");
        $('#person_responsible').multiSelect();
        $("#component_responsible").multiSelect();
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