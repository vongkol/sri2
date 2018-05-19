<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <style>
        body {
            background: url("{{asset('img/bg.png')}}") no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
        .box{
            position: absolute;
            top: 18%;
            left: 50%;
            width: 360px;
            min-width: 160px;
            margin-left: -180px;
            background: rgba(0, 0, 0, 0.5);
            color: #EEF;
            padding:0;
            border: 1px solid rgba(255,255,255, 0.1);
        }
        .box-title{
            padding: 8px 6px;
            text-transform: uppercase;
            font-size: 20px;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255, 0.1);
        }
        .box-body{
            padding: 22px 6px 9px 6px;
        }
        .box-body input{
            background: rgba(255, 255, 255, 0.3);
            border: none;
            outline: none;
            color: #eee;
            font-size: 13px;
            font-family:Arial;
            width: 100%;
            padding: 6px 5px;
        }
        .btn-login{
            width: 100px;
            background: rgba(255, 255, 255, 0.3);
            outline: none;
            border: none;
            color: #eee;
            font-size: 13px;
            font-family: Arial;
            padding: 6px;
            -webkit-box-shadow: 0 1px 2px #000 , 1px 0 2px #000;
            -moz-box-shadow: 0 1px 2px #000 , 1px 0 2px #000;
            box-shadow: 0 1px 2px #000, 1px 0 2px #000;
        }
        .text-red{
            color: #FFF;
            font-size: 13px;
            font-family:Arial;
        }
		::-webkit-input-placeholder { /* WebKit, Blink, Edge */
			color:    #ccc;
		}
		:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
		   color:    #ccc;
		   opacity:  1;
		}
		::-moz-placeholder { /* Mozilla Firefox 19+ */
		   color:    #ccc;
		   opacity:  1;
		}
		:-ms-input-placeholder { /* Internet Explorer 10-11 */
		   color:    #ccc;
		}
		::-ms-input-placeholder { /* Microsoft Edge */
		   color:    #ccc;
		}
    </style>
</head>
<body>
    <div class="box">
        <div class="box-title">
          User Login
        </div>
        <div class="box-body">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{csrf_field()}}
               
                <p>
                    <input type="text" id="username" name="username" value="{{old('username')}}" placeholder="Username" required autofocus>
                </p>
                <p>
                    <input type="password" placeholder="Your Password" id="password" name="password" required>
                </p>
                <p>
                    <button type="submit" class="btn-login">Login</button>
                </p>
                <p class="text-red text-center">
                    @if ($errors->has('email'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                </p>
            </form>
        </div>
    </div>
</body>
</html>

