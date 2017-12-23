@extends("layouts.activity")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Indicator Setting List</strong>&nbsp;&nbsp;
                            <a href="{{url('/indicator/create')}}"><i class="fa fa-plus"></i> New</a>
                        </div>
                        <div class="col-sm-8">
                            <form action="" method="get" name="search">
                                <select name="user_ngo" id="user_ngo" class="chosen-select">
                                    @foreach($ngos as $ngo)
                                        <option value="{{$ngo->id}}">{{$ngo->name}}</option>
                                    @endforeach
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
                            <th>Project Code</th>
                            <th>Project Name</th>
                            <th>Indicator Code</th>
                            <th>Indicator Name</th>
                            <th>Indicator Type</th>
                            <th>Baseline</th>
                            <th>Data Source</th>
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
                            @foreach($indicator_settings as $indicator)
                            <tr>
                                <td>{{$indicator->id}}</td>
                                <td>
                                    <a href="{{url('/indicator/edit/'.$indicator->id)}}">{{$indicator->project_code}}</a>
                                </td>
                                <td>
                                    <a href="{{url('/indicator/edit/'.$indicator->id)}}">{{$indicator->project_name}}</a>
                                </td>
                                <td>{{$indicator->indicator_code}}</td>
                                <td>{{$indicator->indicator_name}}</td>
                                <td>{{$indicator->type}}</td>
                                <td>{{$indicator->baseline}}</td>
                                <td>{{$indicator->data_source}}</td>
                                <td>
                                    <a class="btn btn-sm btn-success"​​ href="{{url('/indicator/edit/'.$indicator->id)}}" title="Edit"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp
                                    <a class="btn btn-sm btn-danger" href="{{url('/indicator/delete/'.$indicator->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-trash-o"></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$indicator_settings->links()}}
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
            $("#menu_indicator_setting").addClass("current");
        })
    </script>
@endsection