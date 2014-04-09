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
#{{{ $ticket->number }}} - {{{ $ticket->title }}}
@stop

@section('content')

<!-- table implementation -->
<h3>Details</h3>
<table class="table-nonfluid">
    <tr>
        <td><strong>Creator:</strong></td>
        <td class="data-cell">{{{ $ticket->creator->username }}}</td>
        <td><span class="glyphicon-none"></span></td>
        <td><strong>Planned Hours:</strong></td>
        <td class="data-cell edit-planned">{{{ $ticket->planned_hours }}}</td>
        <td><span class="icon-planned glyphicon-none"></span></td>
    </tr>
    <tr>
        <td><strong>Owner:</strong></td>
        <td class="data-cell edit-owner">{{{ $ticket->owner->username }}}</td>
        <td><span class="icon-owner glyphicon-none"></span></td>
        <td><strong>Actual Hours:</strong></td>
        <td class="data-cell edit-actual">{{{ $ticket->actual_hours }}}</td>
        <td><span class="icon-actual glyphicon-none"></span></td>
    </tr>
</table>

<div>
    <div class="description-container">
        <h3>Description</h3>
    </div>
    <div class="glyphicon-container">
        <span class="icon-description glyphicon-none"></span>
    </div>
</div> <br class="clearBoth">
<div class="edit-description">{{{ $ticket->description }}}</div>

<script>
    $('.edit-owner').editable("", {});
    $('.edit-planned').editable();
    $('.edit-actual').editable();
    $('.edit-description').editable("", {
        type: 'textarea'
    });

    $('.edit-owner').mouseover(function () {
        $('.icon-owner').removeClass('glyphicon-none');
        $('.icon-owner').addClass('glyphicon glyphicon-pencil');
    });
    $('.edit-owner').mouseout(function () {
        $('.icon-owner').removeClass('glyphicon glyphicon-pencil');
        $('.icon-owner').addClass('glyphicon-none');
    });
    $('.edit-planned').mouseover(function () {
        $('.icon-planned').removeClass('glyphicon-none');
        $('.icon-planned').addClass('glyphicon glyphicon-pencil');
    });
    $('.edit-planned').mouseout(function () {
        $('.icon-planned').removeClass('glyphicon glyphicon-pencil');
        $('.icon-planned').addClass('glyphicon-none');
    });
    $('.edit-actual').mouseover(function () {
        $('.icon-actual').removeClass('glyphicon-none');
        $('.icon-actual').addClass('glyphicon glyphicon-pencil');
    });
    $('.edit-actual').mouseout(function () {
        $('.icon-actual').removeClass('glyphicon glyphicon-pencil');
        $('.icon-actual').addClass('glyphicon-none');
    });
    $('.edit-description').mouseover(function () {
        $('.icon-description').removeClass('glyphicon-none');
        $('.icon-description').addClass('glyphicon glyphicon-pencil');
    });
    $('.edit-description').mouseout(function () {
        $('.icon-description').removeClass('glyphicon glyphicon-pencil');
        $('.icon-description').addClass('glyphicon-none');
    });
</script>

<!-- Div implementation
<h4>Details</h4>
<div class="row ticket-container">
    <div class="col-md-1">Creator:</div>
    <div class="col-md-1">{{{ $ticket->creator->username }}}</div>
    <div class="col-md-1">Planned Hours</div>
    <div class="col-md-4">{{{ $ticket->planned_hours }}}</div>
</div>
<div class="row">
    <div class="col-md-1">Pla</div>
</div>
-->

<!-- Jeff implementation
        <div class="row">
          <div class="col-6 col-sm-6 col-lg-4 col-lg-4">
            <h4>Details</h4>
            <div>Creator: &nbsp;&nbsp;&nbsp;&nbsp; {{{ $ticket->creator->username }}}</div>
            <div class="edit-owner">Owner: &nbsp;&nbsp;&nbsp;&nbsp; {{{ $ticket->owner->username }}}</div>
          </div>
            <script>
                $(function() {
                    /*$.(".edit-owner").hover(function() {
                        $(this).append("<i class="glyphicon glyphicon-pencil">");
                    });*/
                    $(".edit-owner").editable("", {});
                });
            </script>
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
-->
<!--                <th>Ticket #</th>
                    <th>Title</th>
                    <th>Creator</th>
                    <th>Owner</th>
                    <th>Description</th>
                    <th>Planned</th>
                    <th>Actual</th>-->


@stop
