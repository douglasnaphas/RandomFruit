<!-- Begin top nav bar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="navbar-brand">Random Fruit</span>
        </div>
        <span class="navbar-left" style="color:#ffffff; padding-top: 17px">Instructor</span>

        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
		<li><a href="{{URL::to('dash')}}" data-toggle="tooltip" data-placement="bottom" title="Dashboard"><i class="glyphicon glyphicon-home"></i></a></li>
		<li><a href="#" data-toggle="modal" data-target="#createTicket"><i class="glyphicon glyphicon-edit" data-toggle="tooltip" data-placement="bottom" title="Create Ticket"></i></a></li>
		<li><a href="#"><i class="glyphicon glyphicon-cog"></i></a></li>
                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i></a></li>
		<li><a href="{{ URL::action('UserController@logout') }}"><i class="glyphicon glyphicon-off"></i></a></li>
            </ul>
            <form class="navbar-form navbar-right">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Tickets">
                    <!--<span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>-->
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End top nav bar -->

<script>
$("[data-toggle=tooltip]").tooltip();
</script>

<!-- "Create a Ticket" Modal -->
@include('dash/modals/createaticket');

<!-- Begin sidebar -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li class="active"><a href="#">Overview</a></li>
                <li><a href="#">Reports</a></li>
                <li><a href="#">Analytics</a></li>
                <li><a href="#">Export</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="">Nav item</a></li>
                <li><a href="">Nav item again</a></li>
                <li><a href="">One more nav</a></li>
                <li><a href="">Another nav item</a></li>
                <li><a href="">More navigation</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="">Nav item again</a></li>
                <li><a href="">One more nav</a></li>
                <li><a href="">Another nav item</a></li>
            </ul>
        </div>
        <!-- End sidebar -->
