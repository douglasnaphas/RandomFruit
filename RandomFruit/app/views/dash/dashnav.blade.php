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
                <li><a href="{{URL::to('dash')}}">Dashboard</a></li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Tickets<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{URL::to('project/RandomFruit/tickets')}}">View Tickets</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#createTicket">Create a Ticket</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
                <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->username}}<b
                            class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Edit Profile</a></li>
                        <li><a href="{{ URL::action('UserController@logout') }}">Logout</a></li>

                    </ul>
                </li>
                <li><a href="#">Help</a></li>
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

<!-- "Create a Ticket" Modal -->
@include('dash/modals/createaticket');

<!-- Begin sidebar -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="{{URL::to('dash')}}">Dashboard</a></li>
                <li><a href="#" data-toggle="modal" data-target="#createTicket">Create a Ticket</a></li>
                <li><a href="{{URL::to('project/RandomFruit/tickets')}}">View Tickets</a></li>
                <li><a href="#">Reports</a></li>
            </ul>
        </div>
        <!-- End sidebar -->
