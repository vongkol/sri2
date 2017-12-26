@extends("layouts.achieve")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                        <div class="col-sm-4">
                            <strong>Narative Achieved List</strong>&nbsp;&nbsp;
                            <a href="{{url('/narative-achieve/create')}}"><i class="fa fa-plus"></i> New</a>
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
                            <th>{{trans('labels.introduction')}}</th>
                            <th>{{trans('labels.start_date')}}</th>
                            <th>{{trans('labels.end_date')}}</th>
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
                        @foreach($narative_achieves as $nar)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{!!$nar->introduction!!}</td>
                                <td>{{$nar->start_date}}</td>
                                <td>{{$nar->end_date}}</td>
                              
                                <td>
                                    <a class="btn btn-sm btn-info" href="{{url('/narative-achieve/detail/'.$nar->id)}}" title="Edit"><i class="fa fa-info-circle"></i> {{trans('labels.detail')}}</a>
                                    <a class="btn btn-sm btn-success" href="{{url('/narative-achieve/edit/'.$nar->id)}}" title="Edit"><i class="fa fa-pencil"></i> {{trans('labels.edit')}}</a>
                                    <a class="btn btn-sm btn-danger" href="{{url('/narative-achieve/delete/'.$nar->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-trash-o"></i> {{trans('labels.delete')}}</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                       {{$narative_achieves->links()}}
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
            $("#menu_narative_achieve").addClass("current");
        })
    </script>
    <script type="text/javascript">
    var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

    CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                                filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                                removeDialogTabs: 'link:upload;image:upload'});

    </script> 
@endsection