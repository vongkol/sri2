@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>{{trans('labels.activity_area_list')}}</strong>&nbsp;&nbsp;
                            <a href="{{url('/activity_area/create')}}"><i class="fa fa-plus"></i> {{trans('labels.new')}}</a>
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
                            <th>{{trans('labels.name')}}</th>
                            <th>{{trans('labels.ngo_name')}}</th>
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
                            @foreach($activity_areas as $act_are)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$act_are->name}}</td>
                                    <td>{{$act_are->ngo_name==null?'CCC':$act_are->ngo_name}}</td>
                                    <td>
                                        <a class="btn btn-success btn-sm" href="{{url('/activity_area/edit/'.$act_are->id)}}" title="Edit"><i class="fa fa-pencil"></i> {{trans('labels.edit')}}</a>
                                        <a class="btn btn-danger btn-sm" href="{{url('/activity_area/delete/'.$act_are->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                        title="Delete"><i class="fa fa-trash-o"></i> {{trans('labels.delete')}}</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$activity_areas->links()}}
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
            $("#activity_area").addClass("current");
        })
    </script>
@endsection