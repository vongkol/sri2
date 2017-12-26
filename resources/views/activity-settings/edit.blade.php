@extends("layouts.design")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>{{trans('labels.edit_activity_setting')}}</strong>&nbsp;&nbsp;
                <a href="{{url('/activity-setting')}}" class="text-success"><i class="fa fa-arrow-left"></i> {{trans('labels.back')}}</a>
                <a href="#" class="text-danger" onclick="showEdit(event)"><i class="fa fa-pencil"></i> {{trans('labels.edit')}}</a>
                <a href="{{url('/activity-setting/create')}}" class="text-primary"><i class="fa fa-plus"></i> {{trans('labels.new')}}</a>
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
                <form action="{{url('/activity-setting/update')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')" name='frm'>
                    {{csrf_field()}}
                    <input type="hidden" value="{{$setting->id}}" id="id" name="id">
                    <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group row">
                                <label for="ngo" class="control-label col-sm-4 lb">{{trans('labels.user_ngo')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="ngo" id="ngo" class="form-control chosen-select" onchange="binding()" disabled>
                                    @foreach($ngos as $ngo)
                                        <option value="{{$ngo->id}}" {{$ngo->id==$setting->ngo_id?'selected':''}}>{{$ngo->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="project_code" class="control-label col-sm-4 lb">{{trans('labels.project_code')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$setting->project_code}}" name="project_code" id="project_code" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="project_name" class="control-label col-sm-4 lb">{{trans('labels.project_name')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <select name="project_name" id="project_name" class="form-control chosen-select" data-placeholder=" " disabled>
                                    @foreach($projects as $pro)
                                        <option value="{{$pro->id}}" {{$setting->project_id==$pro->id?'selected':''}}>{{$pro->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_code" class="control-label col-sm-4 lb">{{trans('labels.activity_code')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$setting->activity_code}}" id="activity_code" name="activity_code" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_name" class="control-label col-sm-4 lb">{{trans('labels.activity_name')}} <span class="text-danger">*</span></label>
                                <div class="col-sm-8">
                                    <textarea name="activity_name" id="activity_name" cols="30" rows="2" class="form-control" disabled>{{$setting->activity_name}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_type" class="control-label col-sm-4 lb">{{trans('labels.activity_type')}}</label>
                                <div class="col-sm-8">
                                    <select name="activity_type" id="activity_type" class="form-control chosen-select" data-placeholder=" " disabled>
                                                                                                                
                                    @foreach($activity_types as $ac)
                                        <option value="{{$ac->id}}" {{$setting->activity_type_id==$ac->id?'selected':''}}>{{$ac->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_definition" class="control-label col-sm-4 lb">{{trans('labels.activity_definition')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$setting->activity_definition}}" id="activity_definition" name="activity_definition" disabled>
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="result_framework_structure" class="control-label col-sm-4 lb">{{trans('labels.result_framework_structure')}}</label>
                                <div class="col-sm-8">
                                    <select name="result_framework_structure" id="result_framework_structure" class="form-control chosen-select" data-placeholder=" " disabled>
                                    @foreach($frameworks as $fr)
                                        <option value="{{$fr->id}}" {{$fr->id==$setting->framework_id?'selected':''}}>{{$fr->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="component_responsible" class="control-label col-sm-4 lb">{{trans('labels.component_responsible')}}</label>
                                <div class="col-sm-8" id="sp">
                                    <select name="component_responsible[]" id="component_responsible" class="form-control" multiple disabled>
                                            @php($a="")
                                            @foreach($components as $com)
                                                @foreach($icomponents as $c)
                                                    @if($com->id == $c->component_id)
                                                        {{$a='selected'}}
                                                    @endif
                                                @endforeach
                                                <option value="{{$com->id}}" {{$a}}>{{$com->name}}</option>
                                                {{$a=''}}
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_source" class="control-label col-sm-4 lb">{{trans('labels.data_source')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$setting->data_source}}" id="data_source" name="data_source" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deliverable" class="control-label col-sm-4 lb"> {{trans('labels.deliverable')}}/ {{trans('labels.unit')}}</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$setting->deliverable}}" id="deliverable" name="deliverable" disabled>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location" class="control-label col-sm-4 lb">{{trans('labels.location')}}</label>
                                <div class="col-sm-8">
                                    <select name="location" id="location" class="form-control chosen-select" style="height: 37px" disabled>
                                    @foreach($provinces as $pro)
                                        <option value="{{$pro->name}}" {{$setting->location==$pro->name?'selected':''}}>{{$pro->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="person_responsible" class="control-label col-sm-4 lb">{{trans('labels.person_responsible')}}</label>
                                <div class="col-sm-8" id="sp1">
                                    <select name="person_responsible[]" id="person_responsible" class="form-control" multiple disabled>
                                    @php($x="")
                                    @foreach($users as $per)
                                        @foreach($person_responsibles as $p)
                                            @if($per->id==$p->user_id)
                                                {{$x='selected'}}
                                            @endif
                                        @endforeach
                                        <option value="{{$per->id}}" {{$x}}>{{$per->name}}</option>
                                        {{$x=''}}
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>                  
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center hide" id="btnBox">
                           <button type="submit" class="btn btn-primary btn-flat">{{trans('labels.save_changes')}}</button>
                           <button type="button" onclick="doCancel()" class="btn btn-danger btn-flat">{{trans('labels.cancel')}}</button>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm-12">
                            <p class="text-success">
                            <br>
                                All fields with <span class="text-danger">*</span> are required!
                            </p>
                        </div>
                    </div>
                </form>
               <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#target" role="tab">{{trans('labels.target')}}</a>
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
                    <div class="tab-pane active" id="target" role="tabpanel">
                        <p>
                        <br>
                            <a href="#" class="btn btn-primary btn-flat" id="btnAddTarget" data-toggle="modal" data-target=".bd-target-modal-lg"><i class="fa fa-plus"></i> {{trans('labels.new_target')}}</a>
                        </p>
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>{{trans('labels.year')}}</th>
                                    <th>{{trans('labels.jan')}}</th>
                                    <th>{{trans('labels.feb')}}</th>
                                    <th>{{trans('labels.mar')}}</th>
                                    <th>{{trans('labels.apr')}}</th>
                                    <th>{{trans('labels.may')}}</th>
                                    <th>{{trans('labels.jun')}}</th>
                                    <th>{{trans('labels.jul')}}</th>
                                    <th>{{trans('labels.aug')}}</th>
                                    <th>{{trans('labels.sep')}}</th>
                                    <th>{{trans('labels.oct')}}</th>
                                    <th>{{trans('labels.nov')}}</th>
                                    <th>{{trans('labels.dec')}}</th>
                                    <th>{{trans('labels.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody id="data">
                            @php($i=1)
                            @foreach($targets as $target)
                                <tr id="{{$target->id}}">
                                    <td>{{$i++}}</td>
                                    <td>{{$target->year}}</td>
                                    <td>{{$target->m1}}</td>
                                    <td>{{$target->m2}}</td>
                                    <td>{{$target->m3}}</td>
                                    <td>{{$target->m4}}</td>
                                    <td>{{$target->m5}}</td>
                                    <td>{{$target->m6}}</td>
                                    <td>{{$target->m7}}</td>
                                    <td>{{$target->m8}}</td>
                                    <td>{{$target->m9}}</td>
                                    <td>{{$target->m10}}</td>
                                    <td>{{$target->m11}}</td>
                                    <td>{{$target->m12}}</td>
                                    <td>
                                        <a href="#" class="btn btn-success btn-sm" title="Edit" onclick="editTarget(this,event)"><i class="fa fa-pencil"></i> {{trans('labels.edit')}}</a>
                                        <a href="#" class="btn btn-danger btn-sm" title="Delete" onclick="deleteTarget(this,event)"><i class="fa fa-trash-o"></i> {{trans('labels.delete')}}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="other1" role="tabpanel">
                        <p>
                            Other 1
                        </p>
                       
                    </div>
            
                    <div class="tab-pane" id="other2" role="tabpanel">
                        <p>Other 2</p>
                    </div>
                    <div class="tab-pane" id="other3" role="tabpanel">
                       <p>Other 3</p>
                    </div>
                </div>
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
            $("#component_responsible").multiSelect();
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
        function showEdit(evt)
        {
            evt.preventDefault();
            $("input, textarea").removeAttr('disabled');
            $("select.chosen-select").chosen('destroy');
            $("select.chosen-select").removeAttr("disabled");
            $("select#person_responsible").removeAttr("disabled");
            $("select#component_responsible").removeAttr("disabled");
            $("select.chosen-select").chosen();
            $("#btnBox").removeClass('hide');
        }
        function doCancel()
        {
            var o = confirm('You want to cancel?');
            if(o)
            {
                location.href = burl + "/activity-setting/edit/" + $("#id").val();
            }
        }
        function clearForm()
        {
            $("#target1 input[type='text']").val("");
            $("#sms").html("");
            $("#target_id").val("0");
        }
// save target1
function saveTarget(id)
{
    var target = {
        id: $("#id").val(),
        target_id: $("#target_id").val(),
        year: $("#year").val(),
        jan: $("#jan").val(),
        feb: $("#feb").val(),
        mar: $("#mar").val(),
        apr: $("#apr").val(),
        may: $("#may").val(),
        jun: $("#jun").val(),
        jul: $("#jul").val(),
        aug: $("#aug").val(),
        sep: $("#sep").val(),
        oct: $("#oct").val(),
        nov: $("#nov").val(),
        dec: $("#dec").val()
    };

    var o = confirm("You want to save?");
    if(o)
    {
        $.ajax({
            type: "POST",
            url: burl + "/activity-setting/target/save",
            data: target,
            beforeSend: function (request) {
                return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
            },
            success: function (sms) {
                if(sms>0)
                {
                    var tid = $("#target_id").val();
                    if(tid<=0)
                    {
                        var counter = $("#data tr").length +1;
                        var tr = "";
                        tr += "<tr id='" + sms + "'>";
                        tr += "<td>" + counter + "</td>";
                        tr += "<td>" + target.year + "</td>";
                        tr += "<td>" + target.jan + "</td>";
                        tr += "<td>" + target.feb + "</td>";
                        tr += "<td>" + target.mar + "</td>";
                        tr += "<td>" + target.apr + "</td>";
                        tr += "<td>" + target.may + "</td>";
                        tr += "<td>" + target.jun + "</td>";
                        tr += "<td>" + target.jul + "</td>";
                        tr += "<td>" + target.aug + "</td>";
                        tr += "<td>" + target.sep + "</td>";
                        tr += "<td>" + target.oct + "</td>";
                        tr += "<td>" + target.nov + "</td>";
                        tr += "<td>" + target.dec + "</td>";
                        tr += "<td>" + "<a href='#' class='btn btn-success btn-sm' title='Edit' onclick='editTarget(this,event)'><i class='fa fa-pencil'></i> {{trans('labels.edit')}}</a>&nbsp;";
                        tr += "<a href='#' class='btn btn-danger btn-sm' title='Delete' onclick='deleteTarget(this,event)'><i class='fa fa-trash-o'></i> {{trans('labels.delete')}} </a>" + "</td>";
                        tr += "</tr>";
                        if($("#data tr:last-child").length>0)
                        {
                            $("#data").html($("#data").html() + tr);
                        }
                        else{
                            $("#data").html(tr);
                        }
                        clearForm();
                        $("#sms").html("New target has been saved success fully!");
                    }
                    else{
                        var str = "#data tr#" + tid;
                        var tr = $(str);
                        var tds = $(tr).children("td");
                        $(tds[1]).html(target.year);
                        $(tds[2]).html(target.jan);
                        $(tds[3]).html(target.feb);
                        $(tds[4]).html(target.mar);
                        $(tds[5]).html(target.apr);
                        $(tds[6]).html(target.may);
                        $(tds[7]).html(target.jun);
                        $(tds[8]).html(target.jul);
                        $(tds[9]).html(target.aug);
                        $(tds[10]).html(target.sep);
                        $(tds[11]).html(target.oct);
                        $(tds[12]).html(target.nov);
                        $(tds[13]).html(target.dec);
                        $("#sms").html("All changes have been saved successfully!");
                        
                    }
                }
            }
        });
    }
}
// delete target
function deleteTarget(obj, evt)
{
    var tr = $(obj).parent().parent();
    var id = $(tr).attr("id");
    evt.preventDefault();
    var o = confirm('You want to delete?');
    if(o)
    {
        $.ajax({
            type: "GET",
            url: burl + "/activity-setting/target/delete/" + id,
            success: function(sms){
                if(sms>0)
                {
                    tr.remove();
                }
            }
        });
    }
}
function editTarget(obj,evt)
{
    evt.preventDefault();
    var tr = $(obj).parent().parent();
    var id = $(tr).attr("id");
    var tds = $(tr).children("td");
    // set status to 1
    $("#target_id").val(id);
    // put data to edit modal
    $("#year").val($(tds[1]).html());
    $("#jan").val($(tds[2]).html());
    $("#feb").val($(tds[3]).html());
    $("#mar").val($(tds[4]).html());
    $("#apr").val($(tds[5]).html());
    $("#may").val($(tds[6]).html());
    $("#jun").val($(tds[7]).html());
    $("#jul").val($(tds[8]).html());
    $("#aug").val($(tds[9]).html());
    $("#sep").val($(tds[10]).html());
    $("#oct").val($(tds[11]).html());
    $("#nov").val($(tds[12]).html());
    $("#dec").val($(tds[13]).html());
    $("#btnAddTarget").trigger("click");
}
    </script>
@endsection
<div class="modal fade bd-target-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content btn-flat">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('labels.create_new_target')}}</h5>
                {{--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>  --}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="target1">
                    <div class="form-group row col-md-12 text-center">
                        <div class="col-md-4"></div>
                        <div class="form-group row col-md-4 text-center">
                            <label for="jan" class="col-sm-6 col-md-6 lb text-right">{{trans('labels.year')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <select id="year" class="form-control text-center">
                                @foreach($years as $year)
                                    <option value="{{$year->name}}">{{$year->name}}</option>
                                @endforeach
                                </select>
                                <input type='hidden' id='target_id' name='target_id' value="0">
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <br>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="jan" class="col-sm-6 col-md-6 lb text-right">{{trans('labels.jan')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jan" name="jan">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="feb" class=" col-sm-6 col-md-6 lb text-right">{{trans('labels.feb')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="feb" name="feb">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="mar" class="col-sm-6 col-md-6 lb text-right">{{trans('labels.mar')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="mar" name="mar">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="apr" class=" col-sm-6 col-md-6 lb text-right">{{trans('labels.apr')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="apr" name="apr">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="may" class="col-sm-6 col-md-6 lb text-right">{{trans('labels.mar')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="may" name="may">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="jun" class="col-sm-6 col-md-6 lb text-right">{{trans('labels.jun')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jun" name="jun">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="jul" class="col-sm-6 col-md-6 lb text-right">{{trans('labels.jul')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jul" name="jul">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="aug" class="col-sm-6 col-md-6 lb text-right">{{trans('labels.aug')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="aug" name="aug">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="sep" class=" col-sm-6 col-md-6 lb text-right">{{trans('labels.sep')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="sep" name="sep">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="oct" class="col-sm-6 col-md-6 lb text-right">{{trans('labels.oct')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="oct" name="oct">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="nov" class="col-sm-6 col-md-6 lb text-right">{{trans('labels.nov')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="nov" name="nov">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="dec" class="col-sm-6 col-md-6 lb text-right">{{trans('labels.dec')}}</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="dec" name="dec">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12">
                    <br>
                        <p class="text-success text-center" id="sms"></p>
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary btn-flat" onclick="saveTarget(1)">{{trans('labels.save_changes')}}</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" onclick="clearForm()">{{trans('labels.close')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
