@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                        <strong>Activity Category List</strong>&nbsp;&nbsp;
                        <a href="{{url('/activity_category/create')}}"><i class="fa fa-plus"></i> New</a>
                        <div class="col-sm-6">
                            <div class="form-group row">
                                <div class="col-sm-8">
                                    <span><b>User NGO</b></span>
                                    <select  id="test">
                                        <option>Test 1</option>
                                        <option>Test</option>
                                    </select>  
                                    <input type="button" value="search" name="search" class="btn-search">
                                </div>
                            </div>
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

                        @foreach($activity_categories as $activity_category)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$activity_category->name}}</td>
                                <td>{{$activity_category->ngo_name==null?'CCC':$activity_category->ngo_name}}</td>
                                <td>
                                    
                                    <a href="{{url('/activity_category/edit/'.$activity_category->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/activity_category/delete/'.$activity_category->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$activity_categories->links()}}
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
            $("#activity_category").addClass("current");
        })
    </script>
@endsection