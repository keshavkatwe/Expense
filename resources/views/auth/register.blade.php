<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <title>{{ env('PROJECT_NAME') }} - </title>

        <!-- Bootstrap core CSS -->
         <link href="{{ URL::asset('/assets/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body> 
        <div class="container">
            <h3 class="text-center">{{ env('PROJECT_NAME') }}</h3>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <form method="POST" action="<?php echo url('auth/register') ?>">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}" required="required" placeholder="User name">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"  required="required" placeholder="Email address">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password"  required="required" placeholder="Password">
                        </div>

                        <div  class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation"  required="required" placeholder="Confirm Password">
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Register</button>
                            <a href="/expense/public/" class="btn btn-success">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Bootstrap core JavaScript
       ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    </body>
</html>

