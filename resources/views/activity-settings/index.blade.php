@extends('layouts.activity')
@section('content')
<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <div class="row">
                        <strong>Activity Setting List</strong>&nbsp;&nbsp;
                        <a href="{{url('/activity-setting/create')}}"><i class="fa fa-plus"></i> New</a>
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
                            <th>Project Code</th>
                            <th>Project Name</th>
                            <th>Activity Code</th>
                            <th>Activity Name</th>
                            <th>Activity Type</th>
                            <th>Result Framework Structure</th>
                            <th>Component Responsible</th>
                            <th>Data Source</th>
                            <th>Deliverable / Unit</th>
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
                            <tr>
                                <td>001</td>
                                <td>P002</td>
                                <td>Test Project</td>
                                <td>IND01</td>
                                <td>Main Indicator</td>
                                <td>Starting</td>
                                <td>BLNM</td>
                                <td>Sample</td>
                                <td>Sample</td>
                                <td>Sample</td>
                                <td>Sample</td>
                                <td>Sample</td>
                                <td>
                                    <a href="#"></a>
                                </td>
                            </tr>
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