@extends('dashlayout')
{{-- app/views/ticket.blade.php shows the attributes of a ticket for a given project --}}

@section('title')
Ticket #{{{ $ticket->number }}}
@stop

@section('css')
	@parent
        {{HTML::style('includes/css/vtickets.css')}}
@stop

@section('page_header')
{{{ $ticket->title }}}
@stop

@section('content')
         
        <div class="row">
          <div class="col-6 col-sm-6 col-lg-4 col-lg-4">
            <h4>Details</h4>
            <p>Ticket #:  &nbsp;&nbsp;&nbsp;&nbsp;{{{ $ticket->number }}} </p>
            <p>Creator: &nbsp;&nbsp;&nbsp;&nbsp; {{{ $ticket->creator->username }}}</p>
            <p>Owner: &nbsp;&nbsp;&nbsp;&nbsp; {{{ $ticket->owner->username }}}</p>
          </div>
          <div class="col-6 col-sm-6 col-lg-4 col-lg-4">
            <h4>&nbsp;&nbsp;&nbsp;&nbsp;</h4>
            <p>Planned Hours: &nbsp;&nbsp;&nbsp;&nbsp; {{{ $ticket->planned_hours }}}</p>
            <p>Actual Hours: &nbsp;&nbsp;&nbsp;&nbsp; {{{ $ticket->actual_hours }}}</p>
          </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6">
                <h4>Description</h4>
            </div>
        </div>
                <p> {{{$ticket->description}}}</p>
            
<!--                <th>Ticket #</th>
                    <th>Title</th>
                    <th>Creator</th>
                    <th>Owner</th>
                    <th>Description</th>
                    <th>Planned</th>
                    <th>Actual</th>-->
                  
@stop
