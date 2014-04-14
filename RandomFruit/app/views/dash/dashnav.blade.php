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
                <li data-toggle="tooltip" data-placement="bottom" title="Dashboard">
                    <a href="{{URL::to('dash')}}">
                        <i class="glyphicon glyphicon-home"></i>
                    </a>
                </li>
                <li data-toggle="tooltip" data-placement="bottom" title="Create Ticket">
                    <a href="#" data-toggle="modal" data-target="#createTicket">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                </li>
                <li data-toggle="tooltip" data-placement="bottom" title="Settings">
                    <a href="#">
                        <i class="glyphicon glyphicon-cog"></i>
                    </a>
                </li>
                <li data-toggle="tooltip" data-placement="bottom" title="Help">
                    <a href="#">
                        <i class="glyphicon glyphicon-question-sign"></i>
                    </a>
                </li>
                <li data-toggle="tooltip" data-placement="bottom" title="Logout">
                    <a href="{{ URL::action('UserController@logout') }}">
                        <i class="glyphicon glyphicon-off"></i>
                    </a>
                </li>
            </ul>
            <form class="navbar-form navbar-pull">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Tickets">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
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
        <div class="col-sm-3 col-md-2 sidebar" id="sidebar-links">
            <ul class="nav nav-sidebar">
                <li><a href="#">Overview</a></li>
            </ul>
            <strong>TICKETS</strong>
            <ul class="nav nav-sidebar">
                <li>
                    <a href="#collapseTicket" data-toggle="collapse" data-parent="#sidebar-links">View tickets</a>
                    <div id="collapseTicket" class="collapse">
                        <ul>
                            <li><a href="#">Active Tickets</a></li>
                            <li><a href="#">Assigned To Me</a></li>
                            <li><a href="#">My Tickets</a></li>
                            <li><a href="#">All Tickets</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <strong>REPORTS</strong>
            <ul class="nav nav-sidebar">
                <li><a href="">Generate Burndown Chart</a></li>
            </ul>
            <ul class="nav nav-sidebar">
                <li><a href="">Nav item again</a></li>
                <li><a href="">One more nav</a></li>
                <li><a href="">Another nav item</a></li>
            </ul>
        </div>
        <!-- End sidebar -->
