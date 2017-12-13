@extends('layouts.activity')
@section('content')
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                       <div class="col-sm-4">
                            <strong>Activity Setting List</strong>&nbsp;&nbsp;
                            <a href="{{url('/activity-setting/create')}}"><i class="fa fa-plus"></i> New</a>
                       </div>
                       <div class="col-sm-6">
                            <form action="" method="get">
                                <select name="search" id="search" class="filter">
                                    <option value="0">All NGOs</option>
                                    <option value="1">Vdoo Solutions Co., Ltd</option>
                                </select>
                                <button class="filter" type="submit">Filter</button>
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
                            <th>Activity Code</th>
                            <th>Activity Name</th>
                            <th>Data Source</th>
                            <th>Activity Definition</th>
                            <th>Location</th>
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
                        @foreach($settings as $st)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$st->project_code}}</td>
                            <td>{{$st->project_name}}</td>
                            <td>{{$st->activity_code}}</td>
                            <td>{{$st->activity_name}}</td>
                            <td>{{$st->data_source}}</td>
                            <td>{{$st->activity_definition}}</td>
                            <td>{{$st->location}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>

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
            $("#menu_activity_setting").addClass("current");
        })
    </script>
    
@endsection