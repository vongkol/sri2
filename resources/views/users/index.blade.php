@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>{{trans('labels.user_list')}}</strong>&nbsp;&nbsp;
                            <a href="{{url('/user/create')}}"><i class="fa fa-plus"></i> {{trans('labels.new')}}</a>
                        </div>
                        <div class="col-sm-8">
                            <form action="" method="get" name="search">
                                <select name="user_ngo" id="user_ngo" class="chosen-select">
                                    @foreach($ngos as $ngo)
                                        <option value="{{$ngo->id}}">{{$ngo->name}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="filter">{{trans('labels.filter')}}</button>   
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>{!!trans('labels.id')!!}</th>
                            <th>{{trans('labels.full_name')}}</th>
                            <th>{{trans('labels.username')}}</th>
                            <th>{{trans('labels.gender')}}</th>
                            <th>{{trans('labels.ngo_name')}}</th>
                            <th>{{trans('labels.phone')}}</th>
                            <th>{{trans('labels.email')}}</th>
                            <th>{{trans('labels.user_role')}}</th>
                            <th>{{trans('labels.actions')}}</th>
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
                                <td>{{$user->ngo_name}}</td>
                                <td>{{$user->phone}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->role_name}}</td>
                                <td>
                                    <a class="btn btn-success btn-sm btn-flat my-btn"  href="{{url('/user/edit/'.$user->id)}}" title="Edit">{{trans('labels.edit')}}</a>
                                    <a class="btn btn-danger btn-sm btn-flat my-btn"  href="{{url('/user/delete/'.$user->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')" title="Delete">{{trans('labels.delete')}}</a>
                                    <a class="btn btn-info btn-sm btn-flat my-btn-permission"  href="{{url('/user/update-password/'.$user->id)}}" title="Reset Password">{{trans('labels.reset_password')}}</a>
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