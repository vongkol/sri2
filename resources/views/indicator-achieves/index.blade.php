@extends('layouts.activity')
@section('content')
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                       <div class="col-sm-4">
                            <strong>Indicator Achieved List</strong>&nbsp;&nbsp;
                            <a href="{{url('/indicator-achieve/create')}}"><i class="fa fa-plus"></i> New</a>
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
                            <th>&numero;</th>
                            <th>Project Code</th>
                            <th>Project Name</th>
                            <th>Indicator Code</th>
                            <th>Indicator Name</th>
                            <th>Baseline</th>
                            <th>Indicator Unit</th>
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
                        @foreach($indicator_achieves as $a)
                        <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    <a href="{{url('/indicator-achieve/edit/'.$a->indicator_id)}}">{{$a->project_code}}</a>
                                </td>
                                <td>
                                    <a href="{{url('/indicator-achieve/edit/'.$a->indicator_id)}}">{{$a->project_name}}</a>
                                </td>
                                <td>{{$a->indicator_code}}</td>
                                <td>{{$a->indicator_name}}</td>
                              
                                <td>{{$a->baseline}}</td>
                                <td>{{$a->indicator_unit}}</td>
                                <td>
                                    <a class="btn btn-sm btn-success"​​ href="{{url('/indicator-achieve/edit/'.$a->indicator_id)}}" title="Edit"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp
                                    <a class="btn btn-sm btn-danger" href="{{url('/indicator-achieve/delete/'.$a->indicator_id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-trash-o"></i> Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$indicator_achieves->links()}}
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
            $("#menu_indicator").addClass("current");
        })
    </script>
@endsection