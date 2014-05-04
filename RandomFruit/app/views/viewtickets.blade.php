@extends('dashlayout')
{{-- app/views/viewtickets.blade.php shows tickets for a given project --}}

@section('title')
View Tickets - {{ $project->name }}
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
    @include('tickettable', array('tickets' => $project->tickets, 'id' => 1, 'omit' => array('project')))
</div>
@stop
