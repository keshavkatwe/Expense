<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>{{ env('PROJECT_NAME') }} -  @yield('title')</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style>
            .navbar-inverse {
                background-color: #FF3A3A;
                border-color: #FF4B4B;
            }
            .navbar-inverse .navbar-nav>.active>a, .navbar-inverse .navbar-nav>.active>a:hover, .navbar-inverse .navbar-nav>.active>a:focus {
                color: #FFFFFF;
                background-color: #DC1F1F;
            }
            .navbar-inverse .navbar-nav>li>a {
                color: #FFFFFF;
            }
            .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:hover, .navbar-inverse .navbar-nav>.open>a:focus {
                color: #FFFFFF;
                background-color: #DF2020;
            }
            .navbar-inverse .navbar-brand {
                color: #FFFFFF;
                font-size: 24px;
                font-style: italic;
            }
            .navbar-inverse .navbar-toggle:hover, .navbar-inverse .navbar-toggle:focus {
                background-color: #DC1F1F;
            }
            .navbar-inverse .navbar-toggle {
                border-color: #FFFFFF;
            }
            .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form {
                border-color: #FFFFFF;
            }
            @media (max-width: 767px){
                .navbar-inverse .navbar-nav .open .dropdown-menu>li>a {
                    color: #FFF;
                }
            }
            @media (max-width: 767px){
                .navbar-inverse .navbar-nav .open .dropdown-menu .divider {
                    background-color: #FFFFFF;
                }
            }

            .danger, .success, .warning, .info {
                color: #FFFFFF;
                border: none;
                border-radius: 0px;
            }

            .danger{
                background-color: #DC1F1F;
            }

            .info{
                background-color: #467F9B;
            }
            .success{
                background-color: #73D04C;
            }

            .warning{
                background-color: #EAA511;
            }

            .danger>h2>small , .info>h2>small, .success>h2>small, .warning>h2>small{
                color: #FFFFFF;
            }

            .btn-primary{
                background-color: #FF3A3A;
                border-color: #FF3A3A;
            }

            .btn {
                border-radius: 0px;
            }
            .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open>.dropdown-toggle.btn-primary {
                color: #fff;
                background-color: #DC1F1F;
                border-color: #DC1F1F;
            }
            
            *{
                border-radius: 0px !important;
            }
        </style>
    </head>

    <body>

        <!-- Static navbar -->
        <div class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">{{ env('PROJECT_NAME') }}</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="{{ $strCurrentPage=='dashboard'?'active':'' }}" ><a href="{{ URL('dashboard') }}">Dashboard</a></li>
                        <li class="{{ $strCurrentPage=='add_expense'?'active':'' }}"><a href="{{ URL('add_expense') }}">Add Expense</a></li>
                        <li class="{{ $strCurrentPage=='manage_expense'?'active':'' }}"><a href="{{ URL('manage_expense') }}">Manage Expense</a></li>
                        <li class="{{ $strCurrentPage=='reports'?'active':'' }}"><a href="{{ URL('reports') }}">Reports</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome : {{ ucfirst(Auth::user()->name) }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="auth/logout">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>


        <div class="container">
            <legend>@yield('title')</legend>
            @section('content')
            @show
        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    </body>
</html>
