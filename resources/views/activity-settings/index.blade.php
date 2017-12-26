@extends('layouts.design')
@section('content')
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                       <div class="col-sm-4">
                            <strong>{{trans('labels.activity_setting_list')}}</strong>&nbsp;&nbsp;
                            <a href="{{url('/activity-setting/create')}}"><i class="fa fa-plus"></i> {{trans('labels.new')}}</a>
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
                            <th>&numero;</th>
                            <th>{{trans('labels.project_code')}}</th>
                            <th>{{trans('labels.project_name')}}</th>
                            <th>{{trans('labels.activity_code')}}</th>
                            <th>{{trans('labels.activity_name')}}</th>
                            <th>{{trans('labels.data_source')}}</th>
                            <th>{{trans('labels.activity_definition')}}</th>
                            <th>{{trans('labels.location')}}</th>
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
                        @foreach($settings as $st)
                        <tr>
                            <td>{{$i++}}</td>
                            <td> <a href="{{url('/activity-setting/edit/'.$st->id)}}" title="Detail">{{$st->project_code}}</a></td>
                            <td> <a href="{{url('/activity-setting/edit/'.$st->id)}}" title="Detail">{{$st->project_name}}</a></td>
                            <td>{{$st->activity_code}}</td>
                            <td>{{$st->activity_name}}</td>
                            <td>{{$st->data_source}}</td>
                            <td>{{$st->activity_definition}}</td>
                            <td>{{$st->location}}</td>
                            <td>
                                <a class="btn btn-sm btn-success btn-flat my-btn" href="{{url('/activity-setting/edit/'.$st->id)}}" title="Edit">&nbsp;{{trans('labels.edit')}}&nbsp;</a>
                                <a class="btn btn-sm btn-danger btn-flat my-btn" href="{{url('/activity-setting/delete/'.$st->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete">{{trans('labels.delete')}}</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$settings->links()}}
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