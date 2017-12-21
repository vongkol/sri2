@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>NGO List</strong>&nbsp;&nbsp;
                    <a href="{{url('/ngo/create')}}"><i class="fa fa-plus"></i> New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Organization Name</th>
                            <th>Focal Person Name</th>
                            <th>Focal Person Gender</th>
                            <th>Focal Person Phone</th>
                            <th>Organization Type</th>
                            <th>Office Phone</th>
                            <th>Office Email</th>
                            <th>Office Based</th>
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
                        @foreach($ngos as $ngo)
                            <tr>
                                <td>{{$i++}}</td>
                                
                                <td>
                                    <a href="{{url('/ngo/detail/'.$ngo->id)}}">{{$ngo->name}}</a>
                                </td>
                                <td>{{$ngo->person_name}}</td>
                                <td>{{$ngo->gender}}</td>
                                <td>{{$ngo->person_phone}}</td>
                                <td>{{$ngo->type}}</td>
                                <td>{{$ngo->phone}}</td>
                                <td>{{$ngo->email}}</td>
                                <td>{{$ngo->base}}</td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="{{url('/ngo/edit/'.$ngo->id)}}" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
                                    <a class="btn btn-danger btn-sm" href="{{url('/ngo/delete/'.$ngo->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-trash-o"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$ngos->links()}}
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
            $("#menu_ngo").addClass("current");
        })
    </script>
@endsection