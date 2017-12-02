@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>User Branch [{{Auth::user()->email}}]</strong>&nbsp;&nbsp;
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
                       </div>
                       <div class="col-sm-6">
                           <div class="form-group row">
                               <img src="{{asset('profile/'.$user->photo)}}" alt="Photo" width="160">
                           </div>
                       </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="#" class="form-inline">
                                {{csrf_field()}}
                                <input type="hidden" id="user_id" value="{{$user->id}}">
                                <label>Branch Name:&nbsp;</label>
                                <select name="branch" id="branch_id" class="form-control" style="width: 200px">
                                    @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                </select>
                                &nbsp;&nbsp;
                                <button type="button" class="btn btn-primary btn-flat" id="btnAdd" onclick="addBranch('Do you want to add?')">Add</button>
                            
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        &nbsp;
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="tbl">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Branch Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                 <tbody id="data">
                                @php($i=1)
                                @foreach($user_branches as $b)
                                    <tr id="{{$b->id}}">
                                        <td>{{$i++}}</td>
                                        <td>{{$b->name}}</td>
                                        <td>
                                            <a href="#"
                                            onclick="rmBranch(this,'{{$b->id}}', event,'Do you want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
    var burl = "{{url('/')}}";
        function loadFile(e){
            var output = document.getElementById('preview');
            output.src = URL.createObjectURL(e.target.files[0]);
        }
        function addBranch(sms) {
            var user_id = $("#user_id").val();
            var branch_id = $("#branch_id").val();
            
            var o = confirm(sms);
            if(o)
            {
                var user_branch = {user_id: user_id, branch_id: branch_id};
                $.ajax({
                    type: "POST",
                    url: burl + "/user/branch/save",
                    data: user_branch,
                    beforeSend: function (request) {
                        return request.setRequestHeader('X-CSRF-Token', $("input[name='_token']").val());
                    },
                    success: function (id) {
                        if(id)
                        {
                           var i = $("#data tr").length + 1;
                           var tr = "<tr id='" + id + "'>";
                           tr += "<td>" + i + "</td>";
                           tr += "<td>" + $("#branch_id :selected").text() + "</td>";
                           tr += "<td>" + "<a href='#' onclick='rmBranch(this," + id + ",event,\"Do you want to delete?\")' title='Delete'><i class='fa fa-remove text-danger'></i></a>" + "</td>";
                           tr += "</tr>";
                           if(i>1)
                           {
                               $("#data tr:last-child").after(tr);
                           }
                            else{
                               $("#data").html(tr);
                           }
                        }
                    }
                });
            }
        }
        function rmBranch(obj, id, evt, sms) {
            evt.preventDefault();
            var o = confirm(sms);
            if(o)
            {
                $.ajax({
                    type: "GET",
                    url: burl + "/user/branch/delete/" + id,
                    success: function (x) {
                        if(x)
                        {
                            $(obj).parent().parent().remove();
                        }
                    }
                });
            }
        }
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#user").addClass("current");
        });
    </script>

@endsection
