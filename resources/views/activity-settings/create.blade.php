@extends("layouts.activity")
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <strong>Create Activity Setting</strong>&nbsp;&nbsp;
                <a href="{{url('/activity-setting')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>
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
                <form action="{{url('/activity-setting/save')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="col-sm-6">
                             <div class="form-group row">
                                <label for="ngo" class="control-label col-sm-4 lb">User NGO</label>
                                <div class="col-sm-8">
                                    <select name="ngo" id="ngo" class="form-control">
                                    
                                    </select>
                                </div>
                            </div>
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
                                <label for="activity_code" class="control-label col-sm-4 lb">Activity Code</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('activity_code')}}" id="activity_code" name="activity_code">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_type" class="control-label col-sm-4 lb">Activity Type</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('activity_type')}}" id="activity_type" name="activity_type">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="activity_definition" class="control-label col-sm-4 lb">Activity Definition</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('activity_definition')}}" id="activity_definition" name="activity_definition">
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <label for="Result_Framework_structure" class="control-label col-sm-4 lb">Result Framework Structure</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('Result_Framework_structure')}}" id="Result_Framework_structure" name="Result_Framework_structure">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="component_responsible" class="control-label col-sm-4 lb">Component Responsible</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('component_responsible')}}" id="component_responsible" name="component_responsible">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data_source" class="control-label col-sm-4 lb">Data Source</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('data_source')}}" id="data_source" name="description">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="deliverable" class="control-label col-sm-4 lb">Deliverable / Unit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('deliverable')}}" id="deliverable" name="deliverable">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="location" class="control-label col-sm-4 lb">Location</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" value="{{old('location')}}" id="location" name="location">
                                </div>
                            </div>
                        </div>                  
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 text-center ">
                            <button class="btn btn-primary btn-flat" type="submit">Save</button>
                            <button class="btn btn-warning btn-flat" type="submit">Save and Continue</button>
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
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_activity_setting").addClass("current");
        })
    </script>
@endsection