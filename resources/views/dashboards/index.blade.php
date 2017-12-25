@extends('layouts.report')
@section('content')
<link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header text-bold">
                <div class="row">
                    <div class="col-sm-4">
                        <strong>Dashboard Report</strong>
                    </div>
                </div>
            </div>
            <div class="card-block">
                <form action="{{url('/dashboard/view')}}" method="get" class="form-inline">
                  
                   <label class='control-label'>View As</label> &nbsp;
                   <select name="view_type" id="view_type" class="form-control">
                       <option value="0">Tree View</option>
                       <option value="1">Bar Chart</option>
                       <option value="2">Line Chart</option>
                       <option value="3">Pie Chart</option>
                   </select>&nbsp;&nbsp;
                   <label class='control-label'>User Ngo</label> &nbsp;
                   <select name="ngo" id="ngo" class="form-control">
                    @foreach($ngos as $ngo)
                        <option value="{{$ngo->id}}" {{$ngo_id==$ngo->id?'selected':''}}>{{$ngo->name}}</option>
                    @endforeach
                   </select>&nbsp;&nbsp;
                   <button class="btn btn-primary btn-flat" type="submit">View</button>
                </form>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="text-primary">Activity by Type</h3>

                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>Activity Type</th>
                                    <th>Number of Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                            @foreach($activities as $a)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$a->name}}</td>
                                    <td>{{$a->total}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <h3 class="text-primary">Activity by Category</h3>

                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>Activity Category</th>
                                    <th>Number of Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                            @foreach($activities1 as $a)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$a->name}}</td>
                                    <td>{{$a->total}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <br>
                        <h3 class="text-primary">Event by Province</h3>

                        <table class="tbl">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>Province</th>
                                    <th>Number of Event</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                            @foreach($events as $a)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$a->name}}</td>
                                    <td>{{$a->total}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                            <h3 class="text-primary">Activity Funding by Type</h3>

                            <table class="tbl">
                                <thead>
                                    <tr>
                                        <th>&numero;</th>
                                        <th>Activity Type</th>
                                        <th>Total Budget</th>
                                        <th>Total Expense</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                @foreach($funds as $a)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$a->name}}</td>
                                        <td>$ {{$a->total_budget==null?'0':$a->total_budget}}</td>
                                        <td>$ {{$a->total_expense==null?'0':$a->total_expense}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <br>
                            <h3 class="text-primary">Activity Funding by Category</h3>

                            <table class="tbl">
                                <thead>
                                    <tr>
                                        <th>&numero;</th>
                                        <th>Activity Type</th>
                                        <th>Total Budget</th>
                                        <th>Total Expense</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i=1)
                                @foreach($funds1 as $a)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$a->name}}</td>
                                        <td>$ {{$a->total_budget==null?'0':$a->total_budget}}</td>
                                        <td>$ {{$a->total_expense==null?'0':$a->total_expense}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <br>
                    </div>  

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $("#siderbar li a").removeClass("current");
            $("#menu_dashboard").addClass("current");
            $("#start_date, #end_date").datepicker({
                orientation: 'bottom',
                format: 'dd/mm/yyyy',
                autoclose: true,
                todayHighlight: true,
                toggleActive: true
            });
            $("#view_type").val("{{$view_type}}");
        })
    </script>
@endsection