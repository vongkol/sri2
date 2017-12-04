@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <strong>Event Organizor List</strong>&nbsp;&nbsp;
                    <a href="{{url('/event_organizor/create')}}"><i class="fa fa-plus"></i> New</a>
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

                        @foreach($event_organizors as $event_organizor)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$event_organizor->name}}</td>
                                <td>{{$event_organizor->ngo_name==null?'CCC':$event_organizor->ngo_name}}</td>
                                <td>
                                    
                                    <a href="{{url('/event_organizor/edit/'.$event_organizor->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/event_organizor/delete/'.$event_organizor->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$event_organizors->links()}}
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
            $("#event_organizor").addClass("current");
        })
    </script>
@endsection