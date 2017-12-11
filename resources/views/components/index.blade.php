@extends("layouts.setting")
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                        <strong>Component List</strong>&nbsp;&nbsp;
                        <a href="{{url('/component/create')}}"><i class="fa fa-plus"></i> New</a>
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

                        @foreach($components as $component)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$component->name}}</td>
                                <td>{{$component->ngo_name==null?'CCC':$component->ngo_name}}</td>
                                <td>
                                    
                                    <a href="{{url('/component/edit/'.$component->id)}}" title="Edit"><i class="fa fa-edit text-success"></i></a>&nbsp;&nbsp
                                    <a href="{{url('/component/delete/'.$component->id ."?page=".@$_GET["page"])}}" onclick="return confirm('You want to delete?')"
                                       title="Delete"><i class="fa fa-remove text-danger"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <nav>
                        {{$components->links()}}
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
            $("#menu_component").addClass("current");
        })
    </script>
@endsection