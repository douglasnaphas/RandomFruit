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
        <table class="table-nonfluid">
            <tr>
                <td><strong>Projects</strong></td>
                <td width="100"><input type="checkbox" id="activecheck" value="courseactive"> Active</td>
                <td width="100"><input type="checkbox" id="plancheck" value="courseplanning"> Planning</td>
            </tr>
            <tr>
                @foreach($course->projects as $project)
                <tr>
                    <td>
                        {{ $project->name }} 
                    </td>
                </tr>
                <tr> 
                    <td>
                        <strong> Team Members: </strong>
                    </td>
                    <td width="100">Jeff</td>
                    <td width="100">Doug</td>
                    <td width="100">Alex</td>
                    <td width="100">Greg</td>
                    <td width="100">Dave</td>
                </tr>
                @endforeach
        </table>    
    @endforeach
</div>

@stop