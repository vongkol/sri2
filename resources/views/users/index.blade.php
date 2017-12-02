@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <strong>User List</strong>&nbsp;&nbsp;
                    <a href="{{url('/user/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>&numero;</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Gender</th>
                            <th>Position</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>User Role</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $pagex = @$_GET['page'];
                            if(!$pagex)
                                $pagex = 1;
                            $i = 12 * ($pagex - 1) + 1;
                        ?>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->username}}</td>
                                <td>{{$user->gender}}</td>
                                <td>{{$user->position}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role_name}}</td>
                                <td>
                                    <a href="{{url('/user/update-password/'.$user->id)}}" title="Reset Password"><i class="fa fa-shield"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/user/edit/'.$user->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/user/delete/'.$user->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                   <nav>
                       {{$users->links()}}
                   </nav>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#user").addClass("current");
        })
    </script>
@endsection