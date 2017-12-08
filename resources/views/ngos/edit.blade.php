@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Edit NGO</strong>&nbsp;&nbsp;
                    <a href="{{url('/ngo/create')}}"><i class="fa fa-plus"></i> New</a>
                    <a href="{{url('/ngo')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>

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
                    <form action="{{url('/ngo/update')}}" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="return confirm('You want to save changes?')">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$ngo->id}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label  class="control-label col-sm-4 lb">Focal Person Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="person_name" required value="{{$ngo->person_name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label  class="control-label col-sm-4 lb">Focal Person Gender</label>
                                    <div class="col-sm-8">
                                        <select name="gender" id="gender" class="form-control">
                                                <option value="Male" {{$ngo->gender=='Male'?'selected':''}}>Male</option>
                                                <option value="Female" {{$ngo->gender=='Female'?'selected':''}}>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">Focal Person Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="person_phone" value="{{$ngo->person_phone}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">Focal Person Position</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="person_position" value="{{$ngo->person_position}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">Focal Person Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="person_email" value="{{$ngo->person_email}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">Organization Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="name" required value="{{$ngo->name}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">Organization Acronym</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="acronym" value="{{$ngo->acronym}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">Organization Type</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="type" value="{{$ngo->type}}"> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">Office Phone</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="phone" value="{{$ngo->phone}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-4 lb">Office Email</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="email" value="{{$ngo->email}}">
                                    </div>
                                </div>
                                <p class="text-success">
                                    <br>
                                    All fields with <span class="text-danger">*</span> are required!
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 lb">Sector</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="sector" value="{{$ngo->sector}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 lb">Office Based</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="base" value="{{$ngo->base}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <label for="logo" class="control-label col-sm-3 lb">Logo</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="logo" name="logo" onchange="loadFile(event)">
                                            <br>
                                            <img src="{{asset("uploads/ngos/".$ngo->logo)}}" alt="Logo" width="120" id="preview">
                                            <p>
                                                <br>
                                                <button class="btn btn-primary btn-flat" type="submit">Save Changes</button>
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