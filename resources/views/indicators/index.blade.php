@extends("layouts.design")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>{{trans('labels.indicator_setting_list')}}</strong>&nbsp;&nbsp;
                            <a href="{{url('/indicator/create')}}"><i class="fa fa-plus"></i> {{trans('labels.new')}}</a>
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
                            <th>{{trans('labels.project_code')}}</th>
                            <th>{{trans('labels.project_name')}}</th>
                            <th>{{trans('labels.indicator_code')}}</th>
                            <th>{{trans('labels.indicator_name')}}</th>
                            <th>{{trans('labels.indicator_type')}}</th>
                            <th>{{trans('labels.baseline')}}</th>
                            <th>{{trans('labels.data_source')}}</th>
                            <th>{{trans('labels.actuons')}}</th>
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
                                <td>{{$i++}}</td>
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
                                    <a class="btn btn-sm btn-success btn-flat my-btn"​​ href="{{url('/indicator/edit/'.$indicator->id)}}" title="Edit">{{trans('labels.edit')}}</a>
                                    <a class="btn btn-sm btn-danger btn-flat my-btn" href="{{url('/indicator/delete/'.$indicator->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete">{{trans('labels.delete')}}</a>
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