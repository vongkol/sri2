@extends('layouts.dashboard')

@section('content')
    <h1 class="text-primary">Home</h1>
    <p class="text-success">


The Cooperation Committee for Cambodia (CCC) was established in 1990. The organization is deeply respected and is recognized as the largest Non-Governmental Organization (NGO) membership based organization in Cambodia. CCC formally released the Governance Hub Program (GHP) 2017-2021 that has two goals, three objectives, 46 indicators, and 12 expected results, through which 40 key interventions and 210 detailed activities will be implemented.

    </p>
<div class="row">
 <div class="col-sm-6">
        <img src="{{asset('img/tree.png')}}" alt="Map" class="img-fluid">
    </div>
    <div class="col-sm-6">
        <img src="{{asset('img/map.png')}}" alt="Map" class="img-fluid">
    </div>
</div>
@endsection
