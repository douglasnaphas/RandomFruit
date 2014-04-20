@extends('dashlayout')

@section('title')
Courses
@stop

@section('css')
	@parent
	{{HTML::style('includes/css/vtickets.css')}}
@stop

@section('page_header')
View Courses
@stop

@section('content')

<div class="ccontain">
    @foreach(Course::all() as $course)
    <h3>  {{  $course->code  }}  </h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Projects</th>
            </tr>
            </thead>
            <tbody>
                @foreach($course->projects as $project)
                <tr>
                    <td>
                        {{ $project->name }} 
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr> 
                    <td>
                        <strong> Team Members: </strong>
                    </td>
                    <td>Jeff</td>
                    <td>Doug</td>
                    <td>Alex</td>
                    <td>Greg</td>
                    <td>Wolfgang</td>
                </tr>
                @endforeach
            </tbody>
        </table>    
    </div>
    @endforeach
</div>

@stop