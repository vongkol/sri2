@extends('layouts.setting')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{trans('labels.edit_user')}}</strong>&nbsp;&nbsp;
                    <a href="{{url('/user')}}" class="text-success"><i class="fa fa-arrow-left"></i> {{trans('labels.back')}}</a>
                </div>
                <div class="card-block">
                    <div class="row">
                        <div class="col-sm-12">
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
                    <form action="{{url('/user/update')}}" class="form-horizontal" onsubmit="return confirm('Do you want to save changes?')" enctype="multipart/form-data" method="post" id="frm">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="row">
                                    <div class="col">
                                       <div class="form-group row">
                                           <label for="name" class="control-label col-sm-4 lb">{{trans('labels.full_name')}}<span class="text-danger">*</span></label>
                                           <div class="col-sm-8">
                                               <input type="text" id="name" name="name" class="form-control" value="{{$user->name}}" required>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col">
                                       <div class="form-group row">
                                           <label for="gender" class="control-label col-sm-4 lb">{{trans('labels.gender')}} <span class="text-danger">*</span></label>
                                           <div class="col-sm-8">
                                               <select name="gender" id="gender" class="form-control sl">
                                                   <option value="Male" {{$user->gender=='Male'?'selected':''}}>{{trans('labels.male')}}</option>
                                                   <option value="Female" {{$user->gender=='Female'?'selected':''}}>{{trans('labels.female')}}</option>
                                               </select>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                    <div class="col">
                                       <div class="form-group row">
                                           <label for="email" class="control-label col-sm-4 lb">{{trans('labels.email')}}</label>
                                           <div class="col-sm-8">
                                               <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}">
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col">
                                       <div class="form-group row">
                                           <label for="phone" class="control-label col-sm-4 lb">{{trans('labels.phone')}}</label>
                                           <div class="col-sm-8">
                                               <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col">
                                       <div class="form-group row">
                                           <label for="username" class="control-label col-sm-4 lb">{{trans('labels.username')}} <span class="text-danger">*</span></label>
                                           <div class="col-sm-8">
                                               <input type="text" id="username" name="username" class="form-control" value="{{$user->username}}" required> 
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col">
                                   <div class="form-group row">
                                           <label for="ngo" class="control-label col-sm-4 lb">{{trans('labels.user_ngo')}} <span class="text-danger">*</span></label>
                                           <div class="col-sm-8">
                                              <select name="ngo" id="ngo" class="form-control chosen-select">
                                                @foreach($ngos as $ngo)
                                                    <option value="{{$ngo->id}}" {{$user->ngo_id==$ngo->id?'selected':''}}>{{$ngo->name}}</option>
                                                @endforeach
                                              </select>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col">
                                       <div class="form-group row">
                                           <label for="password" class="control-label col-sm-4 lb">{{trans('labels.password')}}</label>
                                           <div class="col-sm-8">
                                               <input type="password" name="password" id="password" class="form-control">
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col">
                                       <div class="form-group row">
                                           <label for="position" class="control-label col-sm-4 lb">{{trans('labels.position')}}</label>
                                           <div class="col-sm-8">
                                               <input type="text" name="position" id="position" class="form-control" value="{{$user->position}}">
                                              
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col">
                                       <div class="form-group row">
                                           <label for="cpassword" class="control-label col-sm-4 lb">{{trans('labels.confirm_password')}}</label>
                                           <div class="col-sm-8">
                                               <input type="password" name="cpassword" id="cpassword" class="form-control">
                                                <br>
                                               <button class="btn btn-primary btn-flat" type="submit">{{trans('labels.save_changes')}}</button>
                                               <button class="btn btn-danger btn-flat" type="button" id="btnCancel">{{trans('labels.cancel')}}</button>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="col">
                                        <div class="form-group row">
                                           <label for="role" class="control-label col-sm-4 lb">{{trans('labels.user_role')}} <span class="text-danger">*</span></label>
                                           <div class="col-sm-8">
                                               <select name="role" id="role" class="form-control sl">
                                                   @foreach($roles as $role)
                                                       <option value="{{$role->id}}" {{$user->role_id==$role->id?'selected':''}}>{{$role->name}}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col">
                                       <div class="form-group row">
                                           <label class="control-label col-sm-4 lb">&nbsp;</label>
                                           <div class="col-sm-8">

                                           </div>
                                       </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#btnCancel").click(function(){
                location.href = "{{url('/user/edit/'.$user->id)}}";
            });
            $("#siderbar li a").removeClass("current");
            $("#user").addClass("current");
            $("#ngo").change(function(){
                $.ajax({
                    type: "GET",
                    url: burl + "/user/getrole/" + this.value,
                    success: function(sms){
                        var opt = "";
                        for(var i=0; i<sms.length; i++)
                        {
                            opt += "<option value='" + sms[i].id + "'>" + sms[i].name + "</option>";
                        }
                        $("#role").html(opt);
                    }
                });
                /*
                $.ajax({
                    type: "GET",
                    url: burl + "/user/getcomponent/" + this.value,
                    success: function(sms){
                        var opt = "<option value='0'>Select a component</option>";
                        for(var i=0; i<sms.length; i++)
                        {
                            opt += "<option value='" + sms[i].id + "'>" + sms[i].name + "</option>";
                        }
                        $("#component").html(opt);
                    }
                });
                */
            });
        });
    </script>
@endsection
