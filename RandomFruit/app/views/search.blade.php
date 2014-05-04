@extends('dashlayout')
{{-- app/views/viewtickets.blade.php shows tickets for a given project --}}

@section('title')
Tickets Search results
@stop

@section('css')
	@parent
	{{HTML::style('includes/css/vtickets.css')}}
@stop

@section('page_header')
Tickets Search results
@stop

@section('content')
         
<div class="vcontain">
    @include('tickettable', array('tickets' => $tickets, 'id' => 1))
</div>
@stop
