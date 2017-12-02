<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Vdoo</title>
    <!-- Styles -->
    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
        <link rel="stylesheet" href="{{asset("chosen/chosen.css")}}">
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset("css/table.css")}}">
</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
    <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Vdoo</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/home')}}">Dashboard</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/management')}}">Management <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/asset')}}">Asset</span></a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="{{url('/payment')}}">Payment</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{url('/setting')}}">Settings</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Help</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="nav1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->email}}
                </a>
                <div class="dropdown-menu" aria-labelledby="nav1">
                    <a class="dropdown-item" href="{{url('/user/profile')}}"><i class="fa fa-user text-primary"></i> &nbsp;Profile</a>
                    <a href="{{url('/user/reset-password')}}" class="dropdown-item"><i class="fa fa-key text-warning"></i> &nbsp;Reset Password</a>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out text-success"></i> &nbsp;Logout</a>
                </div>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
            <ul class="nav nav-pills flex-column" id="siderbar">
                <li class="nav-item"><strong>Item / Service</strong></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/product')}}" id="product">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/service')}}" id="service">Service</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/category')}}" id="category">Category</a>
                </li>
                <li class="nav-item"><strong>People</strong></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/customer')}}" id="customer">Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/salesperson')}}" id="salesperson">Salesperson</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/technician')}}" id="technician">Technician</a>
                </li>
                <li class="nav-item"><strong>Promotion / Event</strong></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/promotion')}}" id="promotion">Promotion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/event')}}" id="event">Event</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/news')}}" id="news">News</a>
                </li>
                <li class="nav-item"><strong>Feedback</strong></li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="customer_feedback">Customer Feedback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="technician_feedback">Technician Feedback</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="salesperson_feedback">Salesperson Feedback</a>
                </li>
                <li class="nav-item"><strong>Task</strong></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/task')}}" id="task">Task</a>
                </li>
                <li class="nav-item"><strong>Schedule / Calenda</strong></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/schedule')}}" id="schedule">Schedule</a>
                </li>
                <li class="nav-item"><strong>Reports</strong></li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="customer_report">Customer Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="service_report">Service Report</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="item_report">Item Report</a>
                </li>
            </ul>
        </nav>
        <main class="col-sm-9 offset-sm-3 col-md-10 offset-md-2">
            @yield('content')
        </main>
    </div>
</div>
<!-- Scripts -->
<script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('js/tether.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
@yield('js')
</body>
</html>
