<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
		.selection_checkbox:checked + .selection_label {
			text-decoration:line-through
		}
	</style>
</head>
<body>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Laravel</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target=".add-board-modal">Add Board</a>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	<div class="modal fade add-board-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-sm">
	    	<div class="modal-content">
	      		<div class="modal-header"><h3>Add new board</h3></div>
	      		<div class="modal-body">
	      			<input type="text" class="form-control" name="board_name" placeholder="Enter the board name..." />
	      		</div>
	      		<div class="modal-footer">
	  		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	  		        <button type="button" class="btn btn-primary" onclick="addBoard()">Add</button>
  		      	</div>
	    	</div>
	  	</div>
	</div>

	@yield('content')

	<!-- Scripts -->
	<!--script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script-->
	<script src="{{ asset('/js/jquery-2.1.4.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
</body>
</html>
