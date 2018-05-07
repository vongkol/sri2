@extends('layouts.report')
@section('content')
<link href="{{asset('css/datepicker.css')}}" rel="stylesheet">
    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-primary">Dashboard Report</h3>
            <hr>
        </div>
    </div>
    <form action="{{url('/dashobard/search')}}" method="GET">
    @if(Auth::user()->ngo_id==0)
    <div class="row">
        <div class="col-sm-5">
            <div class="form-group row">
                <label for="ngo" class="control-label col-sm-3 lb">User NGO</label>
                <div class="col-sm-8">
                    <select name="ngo" id="ngo" class="form-control">
                        @foreach($ngos as $ngo)
                            <option value="{{$ngo->id}}">{{$ngo->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    @endif
    <p></p>
    <div class="row">
        <div class="col-sm-5">
            <div class="form-group row">
                <label for="start_date" class="control-label col-sm-3 lb">Start Date</label>
                <div class="col-sm-8">
                   <input type="text" class="form-control datepicker-icon" name="start_date" id="start_date">
                </div>
               
            </div>
        </div>
        <div class="col-sm-5">
            <div class="form-group row">
                <label for="end_date" class="control-label col-sm-3 lb">End Date</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control datepicker-icon" id="end_date" name="end_date">
                </div>
               
            </div>
        </div>
    </div>

    <p></p>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label class="col-sm-3 lb">&nbsp;</label>
                <div class="col-sm-8">
                    <button type="submit" name="type" title="Bar chart" value="bar">
                        <img src="{{asset('img/bar_chart.png')}}" alt="View as Bar Chart">
                    </button>
                    <button type="submit" name="type" title="Line chart" value="line">
                        <img src="{{asset('img/line_chart.png')}}" alt="View as Line Chart">
                    </button>
                    <button type="submit" name="type" title="Bar chart" value="pie">
                        <img src="{{asset('img/pie_chart.png')}}" alt="View as Pie Chart">
                    </button>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
@section('js')
<script src="{{asset('datepicker/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('js/highcharts.js')}}"></script>
<script src="{{asset('js/exporting.js')}}"></script>
<script>
    $(document).ready(function(){
        $("#siderbar li a").removeClass("current");
        $("#menu_dashboard").addClass("current");
        $("#start_date, #end_date").datepicker({
            orientation: 'bottom',
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            toggleActive: true
        });
    });
</script>
@endsection