@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Indicator Type List</strong>&nbsp;&nbsp;
                            <a href="{{url('/indicator-type/create')}}"><i class="fa fa-plus"></i> New</a>
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
                            @foreach($indicator_types as $ind)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$ind->name}}</td>
                                    <td>{{$ind->ngo_name==null?'CCC':$ind->ngo_name}}</td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{url('/indicator-type/edit/'.$ind->id)}}" title="Edit"><i class="fa fa-pencil"></i> Edit</a>
                                        <a class="btn btn-danger btn-sm" href="{{url('/indicator-type/delete/'.$ind->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                        title="Delete"><i class="fa fa-trash-o"></i> Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$indicator_types->links()}}
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
            $("#indicator_type").addClass("current");
        })
    </script>
@endsection