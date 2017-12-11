@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                <div class="row">
                    <div class="col-sm-4">
                        <strong>Project List</strong>&nbsp;&nbsp;
                        <a href="{{url('/project/create')}}"><i class="fa fa-plus"></i> New</a>
                    </div>
                    <div class="col-sm-6">
                        <form action="" method="get" name="search">
                            <select name="user_ngo" id="user_ngo" class="filter">
                                <option value="0">All NGOs</option>
                                <option value="1">Vdoo Solutions Co., Ltd</option>
                            </select>
                            <button type="submit" class="filter">Filter</button>
                        </form>
                    </div>
                </div>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Acronym</th>
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

                        @foreach($projects as $project)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$project->name}}</td>
                                <td>{{$project->acronym}}</td>
                                <td>{{$project->ngo_name==null?'CCC':$project->ngo_name}}</td>
                                <td>
                                    
                                    <a href="{{url('/project/edit/'.$project->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/project/delete/'.$project->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$projects->links()}}
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
            $("#project").addClass("current");
        })
    </script>
@endsection