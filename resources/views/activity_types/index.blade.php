@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>{{trans('labels.activity_type_list')}}</strong>&nbsp;&nbsp;
                            <a href="{{url('/activity_type/create')}}"><i class="fa fa-plus"></i> {{trans('labels.new')}}</a>
                        </div>
                        <div class="col-sm-8 {{Auth::user()->ngo_id>0?'hide':''}}">
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
                        @foreach($activity_types as $activity_type)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$activity_type->name}}</td>
                              
                                <td>{{$activity_type->ngo_name==null?'CCC':$activity_type->ngo_name}}</td>
                                <td>
                                    <a class="btn btn-success btn-sm btn-flat my-btn"  href="{{url('/activity_type/edit/'.$activity_type->id)}}" title="Edit">{{trans('labels.edit')}}</a>
                                    <a class="btn btn-danger btn-sm btn-flat my-btn"  href="{{url('/activity_type/delete/'.$activity_type->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete">{{trans('labels.delete')}}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$activity_types->links()}}
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
            $("#activity_type").addClass("current");
        })
    </script>
@endsection