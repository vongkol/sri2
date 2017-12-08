@extends("layouts.activity")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Edit Indicator Setting</strong>&nbsp;&nbsp;
                <a href="{{url('/indicator')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
                <a href="#" class="text-danger" id="btnEdit"><i class="fa fa-pencil"></i> Edit</a>
                <a href="{{url('/indicator/create')}}" class="text-primary"><i class="fa fa-plus"></i> New</a>
            </div>
            <div class="card-block">
                <form class="form-horizontal" method="post" name="frm">
                    {{csrf_field()}}
                    <input type="hidden" id="id" name="id" value="{{$indicator_setting->id}}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="project_code" class="control-label col-sm-4 lb">Project Code</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="project_code" id="project_code" value="{{$indicator_setting->project_code}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="project_name" class="control-label col-sm-4 lb">Project Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="project_name" name="project_name" value="{{$indicator_setting->project_name}}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_code" class="control-label col-sm-4 lb">Indicator Code</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$indicator_setting->indicator_code}}" id="indicator_code" name="indicator_code" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_name" class="control-label col-sm-4 lb">Indicator Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$indicator_setting->indicator_name}}" id="indicator_name" name="indicator_name" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="result_framework_structure" class="control-label col-sm-4 lb">Result Framework Structure</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$indicator_setting->result_framework_structure}}" id="result_framework_structure" name="result_framework_structure" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="calculation_method" class="control-label col-sm-4 lb">Calculation Method</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$indicator_setting->calculation_method}}" id="calculation_method" name="calculation_method" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_definition" class="control-label col-sm-4 lb">Indicator Definition</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$indicator_setting->indicator_definition}}" id="indicator_definition" name="indicator_definition" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="indicator_level" class="control-label col-sm-4 lb">Indicator Level</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$indicator_setting->indicator_level}}" id="indicator_level" name="indicator_level" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="baseline" class="control-label col-sm-4 lb">Baseline</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$indicator_setting->baseline}}" id="baseline" name="baseline" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_source" class="control-label col-sm-4 lb">Data Source</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$indicator_setting->data_source}}" id="data_source" name="data_source" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_unit" class="control-label col-sm-4 lb">Indicator Unit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$indicator_setting->indicator_unit}}" id="indicator_unit" name="indicator_unit" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="component_responsible" class="control-label col-sm-4 lb">Component Responsible</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$indicator_setting->component_responsible}}" id="component_responsible" name="component_responsible" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="responsible_person" class="control-label col-sm-4 lb">Person Responsible</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{$indicator_setting->person_responsible}}" id="responsible_person" name="responsible_person" readonly>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label for="ngo" class="control-label col-sm-4 lb">User NGO</label>
                                <div class="col-sm-8">
                                    <select name="ngo" id="ngo" class="form-control" readonly>
                                    @foreach($ngos as $ngo)
                                        <option value="{{$ngo->id}}" {{$indicator_setting->ngo_id==$ngo->id?'selected':''}}>{{$ngo->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center hide" id="box1">
                        <br>
                            <button class="btn btn-primary btn-flat" type="button" id="btnSave">Save Changes</button>
                            <button class="btn btn-danger btn-flat" type="button" id="btnCancel">Cancel</button>

                        </div>
                    </div>
                </form>
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#target" role="tab">Target</a>
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
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="target" role="tabpanel">
                        <p>
                        <br>
                            <a href="#" class="text-primary" id="btnAddTarget" data-toggle="modal" data-target=".bd-target-modal-lg"><i class="fa fa-plus"></i> New Target</a>
                        </p>
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>Year</th>
                                    <th>Jan</th>
                                    <th>Feb</th>
                                    <th>Mar</th>
                                    <th>Apr</th>
                                    <th>May</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Aug</th>
                                    <th>Sep</th>
                                    <th>Oct</th>
                                    <th>Nov</th>
                                    <th>Dec</th>
                                    <th>Actions</th>
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
                                        <a href="#" class="text-success" title="Edit" onclick="editTarget(this,event)"><i class="fa fa-pencil"></i></a>
                                        &nbsp;&nbsp;
                                        <a href="#" class="text-danger" title="Delete" onclick="deleteTarget(this,event)"><i class="fa fa-remove"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="other1" role="tabpanel">
                        <p>
                        <br>
                            <a href="#" class="text-primary" id="btnAddTarget1" data-toggle="modal" data-target=".bd-target-modal-lg-2"><i class="fa fa-plus"></i> New Target </a>
                        </p>
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>Year</th>
                                    <th>Jan</th>
                                    <th>Feb</th>
                                    <th>Mar</th>
                                    <th>Apr</th>
                                    <th>May</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Aug</th>
                                    <th>Sep</th>
                                    <th>Oct</th>
                                    <th>Nov</th>
                                    <th>Dec</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
            
                    <div class="tab-pane" id="other2" role="tabpanel"><p>
                        <br>
                            <a href="#" class="text-primary" id="btnAddTarget2" data-toggle="modal" data-target=".bd-target-modal-lg-3"><i class="fa fa-plus"></i> New Target </a>
                        </p>
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>Year</th>
                                    <th>Jan</th>
                                    <th>Feb</th>
                                    <th>Mar</th>
                                    <th>Apr</th>
                                    <th>May</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Aug</th>
                                    <th>Sep</th>
                                    <th>Oct</th>
                                    <th>Nov</th>
                                    <th>Dec</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="tab-pane" id="other3" role="tabpanel"><p>
                        <br>
                            <a href="#" class="text-primary" id="btnAddTarget3" data-toggle="modal" data-target=".bd-target-modal-lg-4"><i class="fa fa-plus"></i> New Target </a>
                        </p>
                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>Year</th>
                                    <th>Jan</th>
                                    <th>Feb</th>
                                    <th>Mar</th>
                                    <th>Apr</th>
                                    <th>May</th>
                                    <th>Jun</th>
                                    <th>Jul</th>
                                    <th>Aug</th>
                                    <th>Sep</th>
                                    <th>Oct</th>
                                    <th>Nov</th>
                                    <th>Dec</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
    $("#siderbar li a").removeClass("current");
    $("#menu_indicator_setting").addClass("current");
    // edit main form
    $("#btnEdit").click(function(event){
        event.preventDefault();
        $(this).hide();
        $("input").removeAttr('readonly');
        $("#ngo").removeAttr("readonly");
        $("#box1").removeClass("hide");
    });
    // btn cancel
    $("#btnCancel").click(function(){
        var o = confirm('You want to cancel?');
        if(o)
        {
            location.href= burl + "/indicator/edit/{{$indicator_setting->id}}";
        }
    });
    // save changes
    $("#btnSave").click(function(){
        var ind = {
            id: $("#id").val(),
            project_code: $("#project_code").val(),
            project_name: $("#project_name").val(),
            indicator_code: $("#indicator_code").val(),
            indicator_name: $("#indicator_name").val(),
            indicator_level: $("#indicator_level").val(),
            result_framework_structure: $("#result_framework_structure").val(),
            baseline: $("#baseline").val(),
            data_source: $("#data_source").val(),
            calculation_method: $("#calculation_method").val(),
            indicator_definition: $("#indicator_definition").val(),
            indicator_unit: $("#indicator_unit").val(),
            component_responsible: $("#component_responsible").val(),
            person_responsible: $("#responsible_person").val(),
            ngo_id: $("#ngo").val()
        };
        
        var o = confirm('You want to save changes?');
        if(o)
        {
            // send to server for update
            $.ajax({
                type: "POST",
                url: burl +"/indicator/update",
                data: ind,
                beforeSend: function (request) {
                    return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                },
                success: function (sms) {
                    
                   location.href = burl + "/indicator/edit/{{$indicator_setting->id}}";
                }
            });
        }
        
    });
    // clear from when click cancel
});
function clearForm()
{
    $("#target1 input[type='text']").val("");
    $("#target2 input[type='text']").val("");
    $("#target3 input[type='text']").val("");
    $("#target4 input[type='text']").val("");
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
            url: burl + "/indicator/target/save",
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
                        tr += "<td>" + "<a href='#' class='text-success' title='Edit' onclick='editTarget(this,event)'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;";
                        tr += "<a href='#' class='text-danger' title='Delete' onclick='deleteTarget(this,event)'><i class='fa fa-remove'></i></a>" + "</td>";
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
            url: burl + "/indicator/target/delete/" + id,
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
                <h5 class="modal-title" id="exampleModalLabel">Create New Target</h5>
                {{--  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>  --}}
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="target1">
                    <div class="form-group row col-md-12 text-center">
                        <div class="col-md-4"></div>
                        <div class="form-group row col-md-4 text-center">
                            <label for="jan" class="col-sm-6 col-md-6 lb text-right">Jan</label>
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
                            <label for="jan" class="col-sm-6 col-md-6 lb text-right">Jan</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jan" name="jan">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="feb" class=" col-sm-6 col-md-6 lb text-right">Feb</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="feb" name="feb">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="mar" class="col-sm-6 col-md-6 lb text-right">Mar</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="mar" name="mar">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="apr" class=" col-sm-6 col-md-6 lb text-right">Apr</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="apr" name="apr">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="may" class="col-sm-6 col-md-6 lb text-right">May</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="may" name="may">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="jun" class="col-sm-6 col-md-6 lb text-right">Jun</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jun" name="jun">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="jul" class="col-sm-6 col-md-6 lb text-right">Jul</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jul" name="jul">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="aug" class="col-sm-6 col-md-6 lb text-right">Aug</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="aug" name="aug">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="sep" class=" col-sm-6 col-md-6 lb text-right">Sep</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="sep" name="sep">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="oct" class="col-sm-6 col-md-6 lb text-right">Oct</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="oct" name="oct">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="nov" class="col-sm-6 col-md-6 lb text-right">Nov</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="nov" name="nov">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="dec" class="col-sm-6 col-md-6 lb text-right">Dec</label>
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
                <button type="button" class="btn btn-primary btn-flat" onclick="saveTarget(1)">Save</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" onclick="clearForm()">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-target-modal-lg-2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content btn-flat">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Other 1</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="target2">
                    <div class="form-group row col-md-12 text-center">
                        <div class="col-md-4"></div>
                        <div class="form-group row col-md-4 text-center">
                            <label for="year1" class="col-sm-6 col-md-6 lb text-right">Year</label>
                            <div class="col-sm-6 col-md-6">
                                <select id="year1" class="form-control text-center" name="year1">
                                @foreach($years as $year)
                                    <option value="{{$year->name}}">{{$year->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <br>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="jan1" class="col-sm-6 col-md-6 lb text-right">Jan</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jan1" name="jan1">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="feb1" class=" col-sm-6 col-md-6 lb text-right">Feb</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="feb1" name="feb1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="mar1" class="col-sm-6 col-md-6 lb text-right">Mar</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="mar1" name="mar1">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="apr1" class=" col-sm-6 col-md-6 lb text-right">Apr</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="apr1" name="apr1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="may1" class="col-sm-6 col-md-6 lb text-right">May</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="may1" name="may1">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="jun1" class="col-sm-6 col-md-6 lb text-right">Jun</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jun1" name="jun1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="jul1" class="col-sm-6 col-md-6 lb text-right">Jul</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jul1" name="jul1">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="aug1" class="col-sm-6 col-md-6 lb text-right">Aug</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="aug1" name="aug1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="sep1" class=" col-sm-6 col-md-6 lb text-right">Sep</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="sep1" name="sep1">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="oct1" class="col-sm-6 col-md-6 lb text-right">Oct</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="oct1" name="oct1">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="nov1" class="col-sm-6 col-md-6 lb text-right">Nov</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="nov1" name="nov1">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="dec1" class="col-sm-6 col-md-6 lb text-right">Dec</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="dec1" name="dec1">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary btn-flat">Submit</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" onclick="clearForm()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade bd-target-modal-lg-3" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content btn-flat">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Other 2</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="target3">
                    <div class="form-group row col-md-12 text-center">
                        <div class="col-md-4"></div>
                        <div class="form-group row col-md-4 text-center">
                            <label for="year2" class="col-sm-6 col-md-6 lb text-right">Year</label>
                            <div class="col-sm-6 col-md-6">
                                <select id="year2" class="form-control text-center" name="year2">
                                @foreach($years as $year)
                                    <option value="{{$year->name}}">{{$year->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <br>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="jan2" class="col-sm-6 col-md-6 lb text-right">Jan</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jan2" name="jan2">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="feb2" class=" col-sm-6 col-md-6 lb text-right">Feb</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="feb2" name="feb2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="mar2" class="col-sm-6 col-md-6 lb text-right">Mar</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="mar2" name="mar2">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="apr2" class=" col-sm-6 col-md-6 lb text-right">Apr</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="apr2" name="apr2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="may2" class="col-sm-6 col-md-6 lb text-right">May</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="may2" name="may2">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="jun2" class="col-sm-6 col-md-6 lb text-right">Jun</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jun2" name="jun2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="jul2" class="col-sm-6 col-md-6 lb text-right">Jul</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jul2" name="jul2">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="aug2" class="col-sm-6 col-md-6 lb text-right">Aug</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="aug2" name="aug2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="sep2" class=" col-sm-6 col-md-6 lb text-right">Sep</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="sep2" name="sep2">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="oct2" class="col-sm-6 col-md-6 lb text-right">Oct</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="oct2" name="oct2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="nov2" class="col-sm-6 col-md-6 lb text-right">Nov</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="nov2" name="nov2">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="dec2" class="col-sm-6 col-md-6 lb text-right">Dec</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="dec2" name="dec2">
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary btn-flat">Submit</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" onclick="clearForm()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-target-modal-lg-4" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content btn-flat">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Other 3</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" id="target4">
                    <div class="form-group row col-md-12 text-center">
                        <div class="col-md-4"></div>
                        <div class="form-group row col-md-4 text-center">
                            <label for="year3" class="col-sm-6 col-md-6 lb text-right">Year</label>
                            <div class="col-sm-6 col-md-6">
                                <select id="year3" class="form-control text-center" name="year3">
                                @foreach($years as $year)
                                    <option value="{{$year->name}}">{{$year->name}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <br>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="jan3" class="col-sm-6 col-md-6 lb text-right">Jan</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jan3" name="jan3">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="feb3" class=" col-sm-6 col-md-6 lb text-right">Feb</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="feb3" name="feb3">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="mar3" class="col-sm-6 col-md-6 lb text-right">Mar</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="mar3" name="mar3">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="apr3" class=" col-sm-6 col-md-6 lb text-right">Apr</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="apr3" name="apr3">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="may3" class="col-sm-6 col-md-6 lb text-right">May</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="may3" name="may3">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="jun3" class="col-sm-6 col-md-6 lb text-right">Jun</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jun3" name="jun3">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="jul3" class="col-sm-6 col-md-6 lb text-right">Jul</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="jul3" name="jul3">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="aug3" class="col-sm-6 col-md-6 lb text-right">Aug</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="aug3" name="aug3">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="sep3" class=" col-sm-6 col-md-6 lb text-right">Sep</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="sep3" name="sep3">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="oct3" class="col-sm-6 col-md-6 lb text-right">Oct</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="oct3" name="oct3">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row col-md-12 text-center">
                        <div class="form-group row col-md-6">
                            <label for="nov3" class="col-sm-6 col-md-6 lb text-right">Nov</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="nov3" name="nov3">
                            </div>
                        </div>
                        <div class="form-group row col-md-6">
                            <label for="dec3" class="col-sm-6 col-md-6 lb text-right">Dec</label>
                            <div class="col-sm-6 col-md-6">
                                <input type="text" class="form-control" value="" id="dec3" name="dec3">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="col-md-12 text-center">
                <button type="button" class="btn btn-primary btn-flat">Save</button>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal" onclick="clearForm()">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>


