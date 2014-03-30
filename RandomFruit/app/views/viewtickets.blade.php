<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>View Tickets - Random Fruit</title>

    <!-- Bootstrap core CSS -->
    {{HTML::style('includes/css/bootstrap.css')}}

    <!-- Custom styles for this template -->
    {{HTML::style('includes/css/vtickets.css')}}
    {{HTML::style('includes/css/dashboard.css')}}

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Include navigation top bar and side bar -->
@include('dash/dashnav');

<!-- Begin main content -->
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
         <h1 class="page-header">View Tickets</h1>

         
            <div class="vcontain">
                <form class="form" role="form" method="post">
                    <div class="form-group">
                     <label for="ticket-search">Search</label>
                     <input type="search" class="form-control" placeholder="Enter Ticket Search Parameters" id="ticket-search">
                    </div>
                     <div class="form-inline">
                     <div class="btn-group" data-toggle="buttons">
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="blocker">Ticket #
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="critical">Title
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="major">Creator
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="major">Owner
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="minor">Description
                        </label>
                        <label class="btn btn-primary">
                            <input type="radio" name="options" id="trivial">Planned
                        </label>
                         <label class="btn btn-primary">
                             <input type="radio" name="options" id="trivial">Actual
                         </label>
                    </div>
                    <div class="pull-right">
                        <button type="button" class="btn btn-primary">Search</button>
                    </div>
                    </div>
                </form>
                <div class="table-responsive">
                <table class="table table-striped">
                <thead>
                <tr>
                    <th>Ticket #</th>
                    <th>Title</th>
                    <th>Creator</th>
                    <th>Owner</th>
                    <th>Description</th>
                    <th>Planned</th>
                    <th>Actual</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($project->tickets as $ticket)
                    <tr>
                        <td>
                            {{{ $ticket->number }}}
                        </td>
                        <td>
                            {{{ $ticket->title }}}
                        </td>
                        <td>
                            {{{ $ticket->creator->username }}}
                        </td>    
                        <td>
                            {{{ $ticket->owner->username }}}
                        </td>
                        <td>
                            {{{ $ticket->description }}}
                        </td>
                        <td>
                            {{{ $ticket->planned_hours }}}
                        </td>
                        <td>
                            {{{ $ticket->actual_hours }}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        </div>
     </div>
</div>
<!-- End main content -->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="includes/js/bootstrap.min.js"></script>
<script src="../../assets/js/docs.min.js"></script>
</body>
</html>
