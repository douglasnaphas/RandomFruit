@section('topbar')
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
        <span class="navbar-left" id="dashtype" style="color:#ffffff; padding-top: 17px">Student</span>

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
                    <a href="#" data-toggle="modal" data-target="#editSettings">
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
            <form class="navbar-form navbar-pull" action={{URL::route('search')}} method='GET'>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search Tickets" name="query">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("[data-toggle=tooltip]").tooltip();
</script>
@show

@section('sidebar')
<!-- Begin sidebar -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" id="sidebar-links">
            <strong>DASHBOARD</strong>
            <ul class="nav nav-sidebar">
                <li><a href="{{URL::to('dash')}}">Overview</a></li>
            </ul>
            <strong>TICKETS</strong>
            <ul class="nav nav-sidebar">
                <li>
                    <a href="#collapseTicket" data-toggle="collapse" data-parent="#sidebar-links">View Tickets</a>
                    <div id="collapseTicket" class="collapse">
                        <ul>
                            @foreach(Auth::user()->projects as $project)
                            @if($project->course->active)
                            <li><a href="{{URL::to("project/$project->name/tickets")}}">All {{$project->name}} Tickets</a></li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </li>
            </ul>

        </div>

        <!-- Create a User Modal -->
        @include('dash/modals/createuser');

        <!-- "Create a Ticket" Modal -->
        @include('dash/modals/createaticket');

        <!-- "Settings" Modal -->
        @include('dash/modals/editsettings');

	<!-- "Course" Modal -->
        @include('dash/modals/createcourse');

@show
