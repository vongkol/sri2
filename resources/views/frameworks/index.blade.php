@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Framework List</strong>&nbsp;&nbsp;
                            <a href="{{url('/framework/create')}}"><i class="fa fa-plus"></i> New</a>
                        </div>
                        <div class="col-sm-8">
                            <form action="" method="get" name="search">
                                <select name="user_ngo" id="user_ngo" class="chosen-select">
                                    <option value="0">All NGOs</option>
                                    <option value="1">Vdoo Solutions Co., Ltd</option>
                                    <option value="0">Passerelles numeriques Cambodia</option>
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

                        @foreach($frameworks as $framework)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$framework->name}}</td>
                                <td>{{$framework->ngo_name==null?'CCC':$framework->ngo_name}}</td>
                                <td>
                                    
                                    <a href="{{url('/framework/edit/'.$framework->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/framework/delete/'.$framework->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$frameworks->links()}}
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
            $("#framework").addClass("current");
        })
    </script>
@endsection