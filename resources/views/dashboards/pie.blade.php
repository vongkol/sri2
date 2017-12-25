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
                   <label class='control-label'>Start Date</label> &nbsp;
                   <input type="text" class="form-control datepicker-icon" id="start_date" name="start_date">&nbsp;&nbsp;
                   <label class='control-label'>End Date</label> &nbsp;    
                    <input type="text" class="form-control datepicker-icon" id="end_date" name="end_date">&nbsp;&nbsp;
                   <label class='control-label'>View As</label> &nbsp;
                   <select name="view_type" id="view_type" class="form-control">
                       <option value="0">Tree View</option>
                       <option value="1">Bar Chart</option>
                       <option value="2">Line Chart</option>
                       <option value="3">Pie Chart</option>
                   </select>&nbsp;&nbsp;
                   <label class='control-label'>User Ngo</label> &nbsp;
                   <select name="ngo" id="ngo" class="form-control chosen-select">
                    @foreach($ngos as $ngo)
                        <option value="{{$ngo->id}}">{{$ngo->name}}</option>
                    @endforeach
                   </select>&nbsp;&nbsp;
                   <button class="btn btn-primary btn-flat" type="submit">View</button>
                </form>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        Left
                    </div>
                    <div class="col-sm-6">
                        Right
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
            $("#start_date").val("{{$start_date}}");
            $("#end_date").val("{{$end_date}}");
            $("#ngo").val("{{$ngo_id}}");
            $("#view_type").val("{{$view_type}}");
        })
    </script>
@endsection