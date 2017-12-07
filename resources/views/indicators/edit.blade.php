@extends("layouts.activity")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Edit Indicator Setting</strong>&nbsp;&nbsp;
                <a href="{{url('/indicator')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
                <a href="#" class="text-primary" id="btnEdit"><i class="fa fa-pencil"></i> Edit</a>
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
                            <a href="#" class="text-primary" id="btnAddTarget"><i class="fa fa-plus"></i> New Target</a>
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
                    <div class="tab-pane" id="other1" role="tabpanel">profile</div>
                    <div class="tab-pane" id="other2" role="tabpanel">profile</div>
                    <div class="tab-pane" id="other3" role="tabpanel">profile</div>
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
                    person_responsible: $("#responsible_person").val()
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
        });
    </script>
@endsection