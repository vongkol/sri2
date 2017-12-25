<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>System Admin - SRI V2</title>

    <!-- Styles -->
    <!-- Bootstrap core CSS -->
    <link href="{{asset('chosen/docsupport/prism.css')}}" rel="stylesheet">
    <link href="{{asset('chosen/chosen.css')}}" rel="stylesheet">
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/table.css')}}">

</head>
<body>
<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-blue">
    <button class="navbar-toggler navbar-toggler-right hidden-lg-up" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">SRI V2</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{url('/home')}}">{{trans('labels.home')}}</a>
            </li>
            <li class="nav-item"><a href="{{url('/activity')}}" class="nav-link">{{trans('labels.activity')}}</a></li>
            <li class="nav-item">

                    <a class="nav-link" href="{{url('/dashboard')}}">Report</a>

            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/setting')}}">{{trans('labels.administration')}} <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">{{trans('labels.help')}}</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="chLang(event,'km')">
                    <img src="{{asset('img/khmer.png')}}" alt="" width="35" style="border:1px solid #ababab"> ខ្មែរ
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="chLang(event,'en')">
                    <img src="{{asset('img/english.png')}}" alt="" width="35" style="border:1px solid #ababab"> English
                </a>
            </li>
            <li class="nav-item" style="margin-left:27px">
                &nbsp;
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="nav1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{Auth::user()->username}}
                </a>
                <div class="dropdown-menu" aria-labelledby="nav1">
                    {{--  <a class="dropdown-item" href="{{url('/user/edit/'.Auth::user()->id)}}"><i class="fa fa-user text-primary"></i> &nbsp;{{trans('labels.profile')}}</a>  --}}
                    <a href="{{url('/user/reset-password')}}" class="dropdown-item"><i class="fa fa-key text-warning"></i> &nbsp;{{trans('labels.reset_password')}}</a>
                    <a href="{{ route('logout') }}" class="dropdown-item"
                       onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();"><i class="fa fa-sign-out text-success"></i> &nbsp;{{trans('labels.logout')}}</a>
                </div>
            </li>
        </ul>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>~
    </div>
</nav>
<div class="container-fluid">
    <div class="row">
        <nav class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
            <ul class="nav nav-pills flex-column" id="siderbar">
                <li class="nav-item"><strong>Configuration</strong></li>
                <li class="nav-item"><a href="{{url('/project')}}" class="nav-link" id="project"><i class="fa fa-angle-double-right text-info"></i> Project</a></li>
                <li class="nav-item"><a href="{{url('/component')}}" class="nav-link" id="menu_component"><i class="fa fa-angle-double-right text-info"></i> Component</a></li>
                <li class="nav-item"><a href="{{url('/activity_type')}}" class="nav-link" id="activity_type"><i class="fa fa-angle-double-right text-info"></i> Activity Type</a></li>
                <li class="nav-item"><a href="{{url('/framework')}}" class="nav-link" id="framework"><i class="fa fa-angle-double-right text-info"></i>
Framework</a></li>
                <li class="nav-item"><a href="{{url('/level')}}" class="nav-link" id="level"><i class="fa fa-angle-double-right text-info"></i> Level</a></li>
                <li class="nav-item"><a href="{{url('/indicator-type')}}" class="nav-link" id="indicator_type"><i class="fa fa-angle-double-right text-info"></i> Indicator Type</a></li>
                <li class="nav-item"><a href="{{url('/activity_category')}}" class="nav-link" id="activity_category"><i class="fa fa-angle-double-right text-info"></i> Activity Category</a></li>
                <li class="nav-item"><a href="{{url('/activity_area')}}" class="nav-link" id="activity_area"><i class="fa fa-angle-double-right text-info"></i> Activity Area</a></li>
                <li class="nav-item"><a href="{{url('/event')}}" class="nav-link" id="event"><i class="fa fa-angle-double-right text-info"></i> Event</a></li>
                <li class="nav-item"><a href="{{url('/venue_type')}}" class="nav-link" id="venue_type"><i class="fa fa-angle-double-right text-info"></i> Venue Type</a></li>
                <li class="nav-item"><a href="{{url('/event_organizor')}}" class="nav-link" id="event_organizor"><i class="fa fa-angle-double-right text-info"></i> Event Organizer</a></li>

                <li class="nav-item"><strong>Custom Field</strong></li>
                <li class="nav-item"><a href="#" class="nav-link" id="activity_setting"><i class="fa fa-angle-double-right text-info"></i> Activity Setting</a></li>
                <li class="nav-item"><strong> User Management</strong></li>
                @if(Auth::user()->ngo_id<=0)
                 <li class="nav-item">
                    <a class="nav-link" href="{{url('/ngo')}}" id="menu_ngo"><i class="fa fa-angle-double-right text-info"></i> NGO</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/role')}}" id="menu_role"><i class="fa fa-angle-double-right text-info"></i> User Role</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/user')}}" id="user"><i class="fa fa-angle-double-right text-info"></i> User Account</a>
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
<script src="{{asset('chosen/chosen.jquery.js')}}"></script>
<script src="{{asset('chosen/docsupport/prism.js')}}"></script>
<script src="{{asset('chosen/docsupport/init.js')}}"></script>
<script>
        function chLang(evt, ln)
        {
            evt.preventDefault();
            $.ajax({
                type: "GET",
                url: "{{url('/')}}" + "/language/" + ln,
                success: function(sms){
                    if(sms>0)
                    {
                        location.reload();
                    }
                }
            });
        }
    </script>
<script>
    var burl = "{{url('/')}}";
</script>
@yield('js')
</body>
</html>
