@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>Profile [{{Auth::user()->username}}]</strong>&nbsp;&nbsp;
                    <a href="{{url('/user/edit/'.$user->id)}}" class="text-danger"><i class="fa fa-pencil"></i> Edit</a>
                </div>
                <div class="card-block">
                   <div class="row">
                       <div class="col-sm-6">
                           <div class="form-group row">
                               <label for="name" class="control-label col-sm-3 lb">ID</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$user->id}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label for="username" class="control-label col-sm-3 lb">Username</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$user->name}}" readonly>
                               </div>
                           </div>
                           <div class="form-group row">
                               <label for="email" class="control-label col-sm-3 lb">Email</label>
                               <div class="col-sm-8">
                                   <input type="text" class="form-control" value="{{$user->email}}" readonly>
                               </div>
                           </div>
                          
                           <div class="form-group row">
                               <label for="role" class="control-label col-sm-3 lb">Use Role</label>
                               <div class="col-sm-8">
                                   <select name="role" id="role" class="form-control" readonly>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" {{$role->id==$user->role_id?'selected':''}}>{{$role->name}}</option>

                                    @endforeach
                                   </select>

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
            $("#user").addClass("current");
        });
    </script>

@endsection