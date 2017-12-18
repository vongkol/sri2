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
                <strong>Edit Activity Achieved</strong>&nbsp;&nbsp;
                <a href="{{url('/activity-achieve')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
                <a href="#" class="text-danger" onclick="showEdit(event)"><i class="fa fa-pencil"></i> Edit</a>
                <a href="{{url('/activity-achieve/create')}}" class="text-primary"><i class="fa fa-plus"></i> New</a>
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
                <form action="{{url('/activity-achieve/update')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')" id='frm'>
                    {{csrf_field()}}
                    <input type="hidden" name="id" value="{{$activity_achieve->id}}" id="id">
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
                                    <select name="ngo" id="ngo" class="form-control chosen-select" onchange="binding()" disabled>
                                    @foreach($ngos as $ngo)
                                        <option value="{{$ngo->id}}" {{$activity_achieve->ngo_id==$ngo->id?'selected':''}}>{{$ngo->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="activity_type" class="control-label col-sm-4 lb">Activity Type <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="activity_type" id="activity_type" class="form-control chosen-select" disabled>
                                        @foreach($activity_types as $t)
                                        <option value="{{$t->id}}" {{$t->id==$activity_achieve->activity_type_id?'selected':''}}>{{$t->name}}</option>
                                        @endforeach
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
                                    <select name="activity_name" id="activity_name" class="form-control chosen-select" disabled>
                                    @foreach($settings as $s)
                                        <option value="{{$s->id}}" {{$s->id==$activity_achieve->activity_setting_id?'selected':''}}>{{$s->activity_name}}</option>
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
                                <label for="start_date" class="control-label col-sm-4 lb">Start Date</label>
                                <div class="col-sm-8">
                                   <input type="text"  placeholder="MM/DD/YYYY"  class="form-control" id="start_date" name="start_date" value="{{$activity_achieve->start_date}}" disabled>
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
                                    <select name="activity_category" id="activity_category" class="form-control chosen-select" data-placeholder=" " disabled>
                                    @foreach($activity_categories as $c)
                                        <option value="{{$c->id}}" {{$c->id==$activity_achieve->activity_category_id?'selected':''}}>{{$c->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="person_achieved" class="control-label col-sm-4 lb">Person(s) achieved activity</label>
                                <div class="col-sm-8" id="sp2">
                                    <select name="person_achieved[]" id="person_achieved" class="form-control" multiple disabled>
                                    @foreach($users as $per)
                                        @php($a = "")
                                        @foreach($person_achieves as $pa)
                                            @if($per->id==$pa->user_id)
                                                {{$a="selected"}}
                                            @endif
                                        @endforeach
                                        <option value="{{$per->id}}" {{$a}}>{{$per->name}}</option>
                                        @php($a="")
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="end_date" class="control-label col-sm-4 lb">End Date</label>
                                <div class="col-sm-8">
                                   <input type="text" class="form-control"  placeholder="MM/DD/YYYY"  id="end_date" name="end_date" value="{{$activity_achieve->end_date}}" disabled>
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
                                    <input type="text" class="form-control" value="{{$activity_achieve->actual}}" id="actual" name="actual" placeholder="Input actual" disabled>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="person_responsible" class="control-label col-sm-4 lb">Person Responsible</label>
                                <div class="col-sm-8" id="sp1">
                                    <select name="person_responsible[]" id="person_responsible" class="form-control" multiple disabled>
                                   
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
                                    <textarea name="achievement" id="achievement" cols="30" rows="1" class="form-control" disabled>{{$activity_achieve->achievement}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="solution" class="control-label col-sm-4 lb">Solution</label>
                                <div class="col-sm-8">
                                    <textarea name="solution" id="solution" cols="30" rows="1" class="form-control" disabled>{{$activity_achieve->solution}}</textarea>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="next_plan" class="control-label col-sm-4 lb">Next Plan</label>
                                <div class="col-sm-8">
                                    <textarea name="next_plan" id="next_plan" cols="30" rows="1" class="form-control" disabled>{{$activity_achieve->next_plan}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                             <div class="form-group row">
                                <label for="challenge" class="control-label col-sm-4 lb">Challenge</label>
                                <div class="col-sm-8">
                                    <textarea name="challenge" id="challenge" cols="30" rows="1" class="form-control" disabled>{{$activity_achieve->challenge}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lesson_learn" class="control-label col-sm-4 lb">Lesson Learn</label>
                                <div class="col-sm-8">
                                    <textarea name="lesson_learn" id="lesson_learn" cols="30" rows="1" class="form-control" disabled>{{$activity_achieve->lesson_learn}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="other_comment" class="control-label col-sm-4 lb">Other Comment</label>
                                <div class="col-sm-8">
                                    <textarea name="other_comment" id="other_comment" cols="30" rows="1" class="form-control" disabled>{{$activity_achieve->other_comment}}</textarea>
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
                                    <input type="number" step="0.01" min="0" value="{{$activity_achieve->total_budget}}" class="form-control" id="total_budget" name="total_budget" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="total_expense" class="control-label col-sm-4 lb">Total Expense($)</label>
                                <div class="col-sm-8">
                                    <input type="number" step="0.01" min="0" value="{{$activity_achieve->total_expense}}" class="form-control" id="total_expense" name="total_expense" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-center hide" id="box">
                                <br>
                                <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                <button class="btn btn-danger btn-flat" type="button" id="btnCancel">Cancel</button>
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
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#document" role="tab">Supporting Document</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#event" role="tab">Event</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#beneficiary" role="tab">Beneficiary</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="document" role="tabpanel">
                        <p>
                        <br>
                            <a href="#" class="text-primary" id="btnAddTarget" data-toggle="modal" 
                            data-target=".bd-target-modal-lg"><i class="fa fa-plus"></i> Upload Document</a>
                        </p>
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>File Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="docData">
                            @php($i=1)
                            @foreach($documents as $doc)
                                <tr id="{{$doc->id}}">
                                    <td>{{$i++}}</td>
                                    <td><a href="{{asset('uploads/documents/'.$doc->file_name)}}" target="_blank">{{$doc->file_name}}</a></td>
                                    <td>{{$doc->description}}</td>
                                    <td>
                                        <a href="#" class="text-danger" title="Delete" onclick="deleteDoc(this,event)"><i class="fa fa-remove"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="event" role="tabpanel">
                        <p>
                        <br>
                            <a href="#" class="text-primary" id="btnAddTarget" data-toggle="modal" data-target=".bd-target-modal-lg"><i class="fa fa-plus"></i> New Target</a>
                        </p>
                        
                    </div>
                    <div class="tab-pane" id="beneficiary" role="tabpanel">
                        <p>
                        <br>
                            <a href="#" class="text-primary" id="btnAddTarget" data-toggle="modal" data-target=".bd-target-modal-lg"><i class="fa fa-plus"></i> New Target</a>
                        </p>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="{{asset('js/multiselect/jquery.multi-select.min.js')}}"></script>
    <script src="{{asset('datepicker/date.js')}}" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_activity_achieved").addClass("current");
            $('#person_responsible').multiSelect();
            $("#component_responsible").multiSelect();
            $("#person_achieved").multiSelect();
            bindFramework();
            bindComponent();
            bindPerson();
            $("#btnCancel").click(function(){
                location.href = burl + "/activity-achieve/edit/" + $("#id").val();
            });
            $("#activity_type").change(function(){
                var ngo_id = $("#ngo").val();
                $("#result_framework_structure").val("");
                bindActivity(ngo_id);
            });
            $("#activity_name").change(function(){
                $("#result_framework_structure").val("");
                bindFramework();
                bindComponent();
                bindPerson();
            });
            $('#start_date').datepicker({
                uiLibrary: 'bootstrap4'
            });
            $('#end_date').datepicker({
                uiLibrary: 'bootstrap4'
            });
        });
        // function binding data on ngo changed
        function binding()
        {
            var id = $("#ngo").val();
            $("#result_framework_structure").val("");
            bindActivityType(id);

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
        function showEdit(evt)
        {
            evt.preventDefault();
            $("input").removeAttr("disabled");
            $("textarea").removeAttr("disabled");
            $("#result_framework_structure").attr("disabled","disabled");
            // enable ngo dropdown
            $("#ngo").chosen('destroy');
            $("#ngo").removeAttr("disabled");
            $("#ngo").chosen();
            // enable activity type dropdown
            $("#activity_type").chosen("destroy");
            $("#activity_type").removeAttr("disabled");
            $("#activity_type").chosen();
            // enable activity name
            $("#activity_name").chosen("destroy");
            $("#activity_name").removeAttr("disabled");
            $("#activity_name").chosen();
            // enable activity category
            $("#activity_category").chosen("destroy");
            $("#activity_category").removeAttr("disabled");
            $("#activity_category").chosen();
            // person achieved
       
            $("#person_achieved").removeAttr("disabled");
     
            $("#box").removeClass('hide');
        }
        function clearDoc() {
            $("#doc_description").val("");
            $("#doc_file_name").val("");
            $("#docsms").html("");
            $("#doc_id").val("0");
        }
        // delete a document by its id
        function deleteDoc (obj, evt) {
            var tr = $(obj).parent().parent();
            var id = $(tr).attr('id');
            var con = confirm('You want to delete?');
            if(con)
            {
                $.ajax({
                type: "GET",
                url: burl + "/document/delete/" + id,
                success: function (response) {
                    $(tr).remove();
                    }
                });
            }
        
        }
        // save document
function saveDoc () {
    var id = $("#id").val();
    
      var o = confirm('Do you want to save?');
        if(o)
        {
            var file_data = $('#doc_file_name').prop('files')[0];
            var form_data = new FormData();
            form_data.append('doc_file_name', file_data);
            form_data.append("description", $('#doc_description').val());
            form_data.append("act_id", id);
            $("#docsms").html("<img src='" + asset + "/ajax-loader.gif" + "'>");
            $.ajax({
                type: 'POST',
                url:burl + '/document/save',
                data: form_data,
                type: 'POST',
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData: false,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                },
                success:function(sms){
         

                   sms = JSON.parse(sms);
                   var counter = $("#docData tr").length;
                    var tr = "";
                    
                    tr +="<tr id='" + sms.id + "'>";
                    tr += "<td>" + (counter++) + "</td>";
                    tr += "<td>" + "<a href='" + doc_url + "/" + sms.file_name + "' target='_blank'>" + sms.file_name + "</a>" + "</td>";
                    tr +="<td>" + sms.description+ "</td>";
                    tr += "<td>" + "<a href='#' onclick='deleteDoc(this,event)'><i class='fa fa-remove text-danger'></i></a>" + "</td>";
                    tr +="</tr>";
                    
                    if(counter>0){
                        $("#docData tr:last-child").after(tr);
                    }
                    else{
                        $("#docData").html(tr);
                    }
                    $("#docsms").html("Your doc has been saved!");
                    $("#doc_description").val("");
                    $("#doc_file_name").val("");
                },
            });

        }
}
    </script>
@endsection
<div class="modal fade bd-target-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content btn-flat">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload New Document</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="target1">
                   <input type="hidden" id="doc_id" name="doc_id" value="0">
                    <div class="form-group row">
                        <label for="doc_description" class="control-label col-sm-2 lb">Description</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="doc_description" name="doc_description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="doc_file_name" class="control-label col-sm-2 lb">File Name</label>
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
                <button type="button" class="btn btn-primary btn-flat" onclick="saveDoc()">Save</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" onclick="clearDoc()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>