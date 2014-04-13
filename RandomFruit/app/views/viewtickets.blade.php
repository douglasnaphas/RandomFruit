@extends('dashlayout')
{{-- app/views/viewtickets.blade.php shows tickets for a given project --}}

@section('title')
{{ $project->name }} -- View Tickets
@stop

@section('css')
	@parent
	{{HTML::style('includes/css/vtickets.css')}}
@stop

@section('page_header')
View Tickets for {{ $project->name }}
@stop

@section('content')
         
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
               @include('tickettable', array('tickets' => $project->tickets))
	 </div>
@stop
