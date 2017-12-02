@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Role List</strong>&nbsp;&nbsp;
                    <a href="{{url('/role/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>NGO Name</th>
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
                        @foreach($roles as $role)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->ngo_name==null?'CCC':$role->ngo_name}}</td>
                                <td>
                                    <a href="{{url('/role/permission/'.$role->id)}}"><i class="fa fa-key text-primary" title="Permission"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/role/edit/'.$role->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/role/delete/'.$role->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$roles->links()}}
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
            $("#role").addClass("current");
        })
    </script>
@endsection