@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{trans('labels.ngo_detail')}}</strong>&nbsp;&nbsp;
                    <a href="{{url('/ngo/create')}}"><i class="fa fa-plus"></i> {{trans('labels.new')}}</a>
                    <a href="{{url('/ngo/edit/'.$ngo->id)}}" class="text-danger"><i class="fa fa-pencil"></i> {{trans('labels.edit')}}</a>
                    <a href="{{url('/ngo')}}" class="text-success"><i class="fa fa-arrow-left"></i> {{trans('labels.back')}}</a>

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
                               <label  class="control-label col-sm-5 lb">{{trans('labels.focal_person_name')}}</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->person_name}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label  class="control-label col-sm-5 lb">{{trans('labels.focal_person_gender')}}</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->gender}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-5 lb">{{trans('labels.focal_person_phone')}}</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->person_phone}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-5 lb">{{trans('labels.focal_person_position')}}</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->person_position}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-5 lb">{{trans('labels.focal_person_email')}}</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->person_email}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-5 lb">{{trans('labels.organization_name')}}</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->name}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-5 lb">{{trans('labels.organization_acronym')}}</label>
                               <div class="col-sm-7">
                                   <input type="text" class="form-control" value="{{$ngo->acronym}}" readonly>
                               </div>
                           </div>
                       </div>
                       <div class="col-sm-6">
                            <div class="form-group row">
                               <label class="control-label col-sm-4 lb">{{trans('labels.organization_type')}}</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$ngo->type}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-4 lb">{{trans('labels.office_phone')}}</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$ngo->phone}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-4 lb">{{trans('labels.office_email')}}</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$ngo->email}}" readonly>
                               </div>
                           </div>
                            <div class="form-group row">
                               <label class="control-label col-sm-4 lb">{{trans('labels.sector')}}</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$ngo->sector}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label class="control-label col-sm-4 lb">{{trans('labels.office_based')}}</label>
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