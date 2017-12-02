@extends('layouts.dashboard')

@section('content')
<div class="row">
    <div class="col-sm-3">
        Dashboard 1
    </div>
    <div class="col-sm-3">
        Dashboard 2
    </div>
    <div class="col-sm-3">
        Dashboard 3
    </div>
    <div class="col-sm-3">
        Dashboard 4
    </div>
</div>
<h1>Student List</h1>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Place of Birth</th>
            <th>Date of Birth</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        </thead>
    </table>
@endsection
