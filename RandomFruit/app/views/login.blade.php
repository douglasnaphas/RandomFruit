<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Random Fruit</title>

	<!-- Bootstrap -->
	{{HTML::style('includes/css/bootstrap.min.css')}}
	{{HTML::style('includes/css/login.css')}}
    <link href="includes/css/bootstrap.min.css" rel="stylesheet">
    <link href="includes/css/login.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="login-container">
	{{Form::Open(array('action' => 'UserController@loginAction', 'class' => 'form-signin'));}}
            <h1 class="form-signin-heading">Random Fruit<br/>
                <img src="{{URL::asset('includes/images/fruit/rotate.php')}}" alt="Header" width="125" height="125"/></h1>
            <h3 class="form-signin-heading">Please sign in</h3>
	    @if($error_message != "")
	    <div class="alert alert-danger" >
		    {{ $error_message }}
	    </div>
	    @endif
                <input type="text" class="form-control" placeholder="Username" required autofocus name="username">
                <input type="password" class="form-control" placeholder="Password" name="password" required>
                <label class="checkbox">
                    <input type="checkbox" value="remember-me" name="remember-me"> Remember me
                </label>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
	{{Form::Close()}}
        <!-- </form> -->
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
{{HTML::script('includes/js/bootstrap.min.js')}}
</body>
</html>
