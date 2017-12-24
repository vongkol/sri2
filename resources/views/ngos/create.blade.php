@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{trans('labels.create_ngo')}}</strong>&nbsp;&nbsp;
                    <a href="{{url('/ngo')}}" class="text-success"><i class="fa fa-arrow-left"></i> {{trans('labels.back')}}</a>

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
                    <form action="{{url('/ngo/save')}}" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return confirm('You want to save?')">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label  class="control-label col-sm-4 lb">{{trans('labels.focal_person_name')}} <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="person_name" required >
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="control-label col-sm-4 lb">{{trans('labels.focal_person_gender')}}</label>
                                    <div class="col-sm-8">
                                        <select name="gender" id="gender" class="form-control">
                                                <option value="Male">{{trans('labels.male')}} </option>
                                                <option value="Female">{{trans('labels.female')}} </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">{{trans('labels.focal_person_phone')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="person_phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">{{trans('labels.focal_person_position')}}​</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="person_position">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">{{trans('labels.focal_person_email')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="person_email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">{{trans('labels.organization_name')}} <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">{{trans('labels.organization_acronym')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="acronym">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">{{trans('labels.organization_type')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="type"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">{{trans('labels.office_phone')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">{{trans('labels.office_email')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="email">
                                    </div>
                                </div>
                                <p class="text-success">
                                    <br>
                                    All fields with <span class="text-danger">*</span> are required!
                                </p>
                            </div>
                            <div class="col-sm-6">
                            
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 lb">{{trans('labels.sector')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sector">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 lb">{{trans('labels.office_based')}}</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="base">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="logo" class="control-label col-sm-3 lb">{{trans('labels.logo')}}</label>
                                    <div class="col-sm-8">
                                        <input type="file" class="form-control" id="logo" name="logo" onchange="loadFile(event)">
                                        <br>
                                        <img src="{{asset("uploads/ngos/default.png")}}" alt="Logo" width="120" id="preview">
                                        <p>
                                            <br>
                                            <button class="btn btn-primary btn-flat" type="submit">{{trans('labels.save')}}</button>
                                            <button class="btn btn-danger btn-flat" type="reset">{{trans('labels.cancel')}}</button>
                                        </p>
                                    </div>
                                </div>
                                    
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
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_ngo").addClass("current");
        })
    </script>

@endsection