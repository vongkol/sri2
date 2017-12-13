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
                                <label for="project_code" class="control-label col-sm-4 lb">Project Code</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('project_code')}}" name="project_code" id="project_code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="project_name" class="control-label col-sm-4 lb">Project Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('project_name')}}" id="project_name" name="project_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_code" class="control-label col-sm-4 lb">Indicator Code</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('indicator_code')}}" id="indicator_code" name="indicator_code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="indicator_name" class="control-label col-sm-4 lb">Indicator Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('indicator_name')}}" id="indicator_name" name="indicator_name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="result_framework_structure" class="control-label col-sm-4 lb">Result Framework Structure</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('result_framework_structure')}}" id="result_framework_structure" name="result_framework_structure">
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
                                <label for="indicator_level" class="control-label col-sm-4 lb">Indicator Level</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('indicator_level')}}" id="indicator_level" name="indicator_level">
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
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('component_responsible')}}" id="component_responsible" name="component_responsible">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="responsible_person" class="control-label col-sm-4 lb">Responsible Person</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('responsible_person')}}" id="responsible_person" name="responsible_person">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="ngo" class="control-label col-sm-4 lb">User NGO</label>
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
<script>
    $(document).ready(function(){
        $("#siderbar li a").removeClass("current");
        $("#menu_indicator_setting").addClass("current");
        
         $("#btnSave").click(function(){
            $("#save_status").val("0");
            frm.submit();
        });
        $("#btnSave1").click(function(){
            $("#save_status").val("1");
            frm.submit();
        });

    });
</script>
@endsection