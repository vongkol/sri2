@extends("layouts.activity")
@section('content')
<style>
    #sp .multi-select-button, #sp1 .multi-select-button{
        background: #eceeef;
    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Create Activity Achieved</strong>&nbsp;&nbsp;
                <a href="{{url('/activity-achieve')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
                                <strong>Information</strong>
                            </p>
                        </div>
                    </div>
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
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="activity_type" class="control-label col-sm-4 lb">Activity Type <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="activity_type" id="activity_type" class="form-control chosen-select">
                                        <option value="0">-- Activity Type --</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label for="activity_name" class="control-label col-sm-2 lb">Activity Name</label>
                                <div class="col-sm-10">
                                    <select name="activity_name" id="activity_name" class="form-control chosen-select">
                                    <option value="0">-- Activity Name --</option>
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
                                <label for="start_date" class="control-label col-sm-4 lb">Start Date</label>
                                <div class="col-sm-8">
                                   <input type="date" class="form-control" id="start_date" name="start_date" value="{{old('start_date')}}">
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="result_framework_structure" class="control-label col-sm-4 lb">Result Framework Structure</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="result_framework_structure" name="result_framework_structure" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_category" class="control-label col-sm-4 lb">Activity Category</label>
                                <div class="col-sm-8">
                                    <select name="activity_category" id="activity_category" class="form-control chosen-select" data-placeholder=" ">
                                        <option value="0">-- None Select --</option>
                                    </select>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="person_achieved" class="control-label col-sm-4 lb">Person(s) achieved activity</label>
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
                                <label for="end_date" class="control-label col-sm-4 lb">End Date</label>
                                <div class="col-sm-8">
                                   <input type="date" class="form-control" id="end_date" name="end_date" value="{{old('end_date')}}">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="component_responsible" class="control-label col-sm-4 lb">Component Responsible</label>
                                <div class="col-sm-8" id="sp">
                                    <select name="component_responsible[]" id="component_responsible" class="form-control" multiple disabled>
                                   
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="actual" class="control-label col-sm-4 lb">Actual</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('actual')}}" id="actual" name="actual" placeholder="Input actual">
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="person_responsible" class="control-label col-sm-4 lb">Person Responsible</label>
                                <div class="col-sm-8" id="sp1">
                                    <select name="person_responsible[]" id="person_responsible" class="form-control" multiple>
                                   
                                    </select>
                                </div>
                            </div>
                        </div>                  
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-primary" style="border-bottom:1px solid #ccc">
                                <strong>Description</strong>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="achievement" class="control-label col-sm-4 lb">Achievement</label>
                                <div class="col-sm-8">
                                    <textarea name="achievement" id="achievement" cols="30" rows="1" class="form-control">{{old('achievement')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="solution" class="control-label col-sm-4 lb">Solution</label>
                                <div class="col-sm-8">
                                    <textarea name="solution" id="solution" cols="30" rows="1" class="form-control">{{old('solution')}}</textarea>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="next_plan" class="control-label col-sm-4 lb">Next Plan</label>
                                <div class="col-sm-8">
                                    <textarea name="next_plan" id="next_plan" cols="30" rows="1" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                             <div class="form-group row">
                                <label for="challenge" class="control-label col-sm-4 lb">Challenge</label>
                                <div class="col-sm-8">
                                    <textarea name="challenge" id="challenge" cols="30" rows="1" class="form-control">{{old('challenge')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lesson_learn" class="control-label col-sm-4 lb">Lesson Learn</label>
                                <div class="col-sm-8">
                                    <textarea name="lesson_learn" id="lesson_learn" cols="30" rows="1" class="form-control">{{old('lesson_learn')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="other_comment" class="control-label col-sm-4 lb">Other Comment</label>
                                <div class="col-sm-8">
                                    <textarea name="other_comment" id="other_comment" cols="30" rows="1" class="form-control">{{old('other_comment')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-primary" style="border-bottom:1px solid #ccc">
                                <strong>Funding</strong>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="total_budget" class="control-label col-sm-4 lb">Total Budget($)</label>
                                <div class="col-sm-8">
                                    <input type="number" step="0.01" min="0" value="0" class="form-control" id="total_budget" name="total_budget">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="total_expense" class="control-label col-sm-4 lb">Total Expense($)</label>
                                <div class="col-sm-8">
                                    <input type="number" step="0.01" min="0" value="0" class="form-control" id="total_expense" name="total_expense">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-center">
                            <br>
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                <button class="btn btn-danger btn-flat" type="reset">Cancel</button>
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
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_activity_achieved").addClass("current");
            $('#person_responsible').multiSelect();
            $("#component_responsible").multiSelect();
            $("#person_achieved").multiSelect();
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