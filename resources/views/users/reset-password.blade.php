@extends('layouts.setting')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Reset Your Password [{{Auth::user()->email}}]</strong>&nbsp;&nbsp;
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
                                <form action="{{url('/user/change-password')}}" class="form-horizontal" method="post">
                                {{csrf_field()}}
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label for="new_password" class="control-label col-sm-4">New Password</label>
                                                <div class="col-sm-8">
                                                    <input type="password" required  name="new_password" value="{{old('new_password')}}" id="new_password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                    </div>
                                    <div class="row">
                                       <div class="col">
                                           <div class="form-group row">
                                               <label for="confirm_password" class="control-label col-sm-4">Confirm Password</label>
                                               <div class="col-sm-8">
                                                   <input type="password" required  name="confirm_password" value="{{old('confirm_password')}}"
                                                          id="confirm_password" class="form-control">
                                               </div>
                                           </div>
                                       </div>
                                        <div class="col">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group row">
                                                <label class="control-label col-sm-4">&nbsp;</label>
                                                <div class="col-sm-8">
                                                    <br>
                                                    <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                                    <a href="{{url('/user')}}" class="btn btn-danger btn-flat">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col"></div>
                                    </div>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection