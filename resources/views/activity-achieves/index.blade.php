@extends('layouts.achieve')
@section('content')
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                       <div class="col-sm-4">
                            <strong>{{trans('labels.activity_achieved_list')}}</strong>&nbsp;&nbsp;
                            <a href="{{url('/activity-achieve/create')}}"><i class="fa fa-plus"></i> {{trans('labels.new')}}</a>
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
                            <th>{!!trans('labels.id')!!}</th>
                            <th>{{trans('labels.activity_name')}}</th>
                            <th>{{trans('labels.activity_type')}}</th>
                            <th>{{trans('labels.start_date')}}</th>
                            <th>{{trans('labels.end_date')}}</th>
                            <th>{{trans('labels.total_budget')}}</th>
                            <th>{{trans('labels.total_expense')}}</th>
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
                        @foreach($activities as $a)
                            <tr>
                                <td>{{$i++}}</td>
                                <td><a href="{{url('/activity-achieve/edit/'.$a->id)}}">{{$a->activity_name}}</a></td>
                                <td>{{$a->activity_type_name}}</td>
                                <td>{{$a->start_date}}</td>
                                <td>{{$a->end_date}}</td>       
                                <td>$ {{$a->total_budget}}</td>   
                                <td>$ {{$a->total_expense}}</td>                      
                                <td>
                                    <a class="btn btn-sm btn-success btn-flat my-btn" href="{{url('/activity-achieve/edit/'.$a->id)}}" title="Edit">{{trans('labels.edit')}}</a>
                                    <a class="btn btn-sm btn-danger btn-flat my-btn" href="{{url('/activity-achieve/delete/'.$a->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete">{{trans('labels.delete')}}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$activities->links()}}
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
            $("#menu_activity_achieved").addClass("current");
        })
    </script>
@endsection