@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>NGO Detail</strong>&nbsp;&nbsp;
                    <a href="{{url('/ngo/create')}}"><i class="fa fa-plus"></i> New</a>
                    <a href="{{url('/ngo/edit/'.$ngo->id)}}" class="text-danger"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="{{url('/ngo')}}" class="text-success"><i class="fa fa-arrow-left"></i> Back</a>

                </div>
                <div class="card-block">
                   <div class="row">
                       <div class="col-sm-6">
                           <div class="form-group row">
                               <label class="control-label col-sm-5 lb">ID</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->id}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label  class="control-label col-sm-5 lb">Focal Person Name</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->person_name}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label  class="control-label col-sm-5 lb">Focal Person Gender</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->gender}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-5 lb">Focal Person Phone</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->person_phone}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-5 lb">Focal Person Position</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->person_position}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-5 lb">Focal Person Email</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->person_email}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-5 lb">Organization Name</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->name}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-5 lb">Organization Acronym</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->acronym}}" readonly>
                               </div>
                           </div>
                       </div>
                       <div class="col-sm-6">
                            <div class="form-group row">
                               <label class="control-label col-sm-4 lb">Organization Type</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$ngo->type}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-4 lb">Office Phone</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$ngo->phone}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-4 lb">Office Email</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$ngo->email}}" readonly>
                               </div>
                           </div>
                            <div class="form-group row">
                               <label class="control-label col-sm-4 lb">Sector</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$ngo->sector}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-4 lb">Office Based</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$ngo->base}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-4 lb">&nbsp;</label>
                               <div class="col-sm-8">
                                   <img src="{{asset("uploads/ngos/".$ngo->logo)}}" alt="Logo" width="127">
                               </div>
                           </div>
                          
                       </div>
                       </div>
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
            $("#company").addClass("current");
        })
    </script>

@endsection