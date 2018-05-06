@extends('layouts.report')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h3 class="text-primary">Dashboard Report</h3>
            <hr>
        </div>
    </div>
    @if(Auth::user()->ngo_id==0)
    <div class="row">
        <div class="col-sm-6">
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
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="start_month" class="control-label col-sm-3 lb">Start Period</label>
                <div class="col-sm-4">
                    <select class="form-control" id="start_month" name="start_month">
                        <option value="1">Jan</option>
                        <option value="2">Feb</option>
                        <option value="3">Mar</option>
                        <option value="4">Apr</option>
                        <option value="5">May</option>
                        <option value="6">Jun</option>
                        <option value="7">Jul</option>
                        <option value="8">Aug</option>
                        <option value="9">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>                    
                    </select>
                </div>
                <div class="col-sm-4">
                    <select name="start_year" id="start_year" class="form-control">
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2026">2025</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group row">
                <label for="end_month" class="control-label col-sm-3 lb">End Period</label>
                <div class="col-sm-4">
                    <select class="form-control" id="end_month" name="end_month">
                        <option value="1">Jan</option>
                        <option value="2">Feb</option>
                        <option value="3">Mar</option>
                        <option value="4">Apr</option>
                        <option value="5">May</option>
                        <option value="6">Jun</option>
                        <option value="7">Jul</option>
                        <option value="8">Aug</option>
                        <option value="9">Sep</option>
                        <option value="10">Oct</option>
                        <option value="11">Nov</option>
                        <option value="12">Dec</option>                    
                    </select>
                </div>
                <div class="col-sm-4">
                    <select name="start_year" id="start_year" class="form-control">
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2026">2025</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
@endsection