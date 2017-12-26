@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>{{trans('labels.edit_framework')}}</strong>&nbsp;&nbsp;
                    <a href="{{url('/framework/create')}}"><i class="fa fa-plus"></i> {{trans('labels.new')}}</a>
                    <a href="{{url('/framework')}}" class="text-success"><i class="fa fa-arrow-left"></i> {{trans('labels.back')}}</a>
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
                    <form action="{{url('/framework/update')}}" class="form-horizontal" method="post" onsubmit="return confirm('You want to save?')">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="name" class="control-label col-sm-3 lb">{{trans('labels.name')}} <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" value="{{$frameworks->name}}" id="name" name="name" required>
                                        <input type="hidden" name="id" value="{{$frameworks->id}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="ngo" class="control-label col-sm-3 lb">{{trans('labels.user_ngo')}} <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="ngo" id="ngo" class="form-control">
                                            @foreach($ngos as $ngo)
                                                <option value="{{$ngo->id}}" {{$frameworks->ngo_id==$ngo->id?'selected':''}}>{{$ngo->name}}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <button class="btn btn-primary btn-flat" type="submit">{{trans('labels.save_changes')}}</button>
                                        <button class="btn btn-danger btn-flat" type="reset">{{trans('labels.cancel')}}</button>
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
    <script src="{{asset("chosen/chosen.jquery.js")}}"></script>
    <script src="{{asset("chosen/chosen.proto.js")}}"></script>
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#framework").addClass("current");
        });
    </script>
@endsection