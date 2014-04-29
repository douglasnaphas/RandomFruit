<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title') - RandomFruit</title>
    @section('css')
    <!-- Bootstrap core CSS -->
    {{HTML::style('includes/css/bootstrap.css')}}

    <!-- Custom styles for this template -->
    {{HTML::style('includes/css/dashboard.css')}}
    {{HTML::style('includes/css/datepicker.css')}}

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @show
    @section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    {{HTML::script('includes/js/bootstrap.min.js')}}
    {{HTML::script('includes/js/ajax-form.js')}}
    {{HTML::script('includes/js/bootstrap-datepicker.js')}}
    {{HTML::script('includes/js/bootstrap-touchspin.js')}}
    {{HTML::script('includes/js/jeditable.js')}}
    {{HTML::script('includes/js/chart.js')}}
    {{HTML::script('includes/js/canvassaver.js')}}
    {{HTML::script('includes/js/tablesorter/jquery.tablesorter.min.js')}}
    
    <script src="../../assets/js/docs.min.js"></script>
    @show

</head>

<body>

<!-- Include navigation top bar and side bar -->
@include('dash/dashnav');

<!-- Begin main content -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h1 class="page-header">@yield('page_header')</h1>
    @yield('content')
</div>
<!-- End main content -->

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<!-- Activate any sortable tables if they exist -->
<script type="text/javascript">
	$(function(){
			$('.tablesorter').tablesorter();
			$('.ticket-remove').click(
				function(){
					$delete_button = $(this);
					if(confirm('This ticket will be deleted.')){
						$.ajax(
							{ 
								method: 'GET',
								type: 'json',
								url: $delete_button.attr('data-delete-url'),
								success: function(data, status){
									if(data.status == "success")
										window.location.reload();	
									}
										
							}
						);
					}
				}
			);
			$('.project-remove').click(
				function(){
					$delete_button = $(this);
					if(confirm('This project will be deleted.')){
						$.ajax(
							{ 
								method: 'GET',
								type: 'json',
								url: $delete_button.attr('data-delete-url'),
								success: function(data, status){
									if(data.status == "success")
										window.location.reload();	
									}
										
							}
						);
					}
				}
			);
	});
</script>

</body>
</html>
