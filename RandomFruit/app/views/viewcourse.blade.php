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
                <td><strong>Project Name</strong></td>
                <td width="100"><input type="checkbox" id="activecheck" value="courseactive"> Active</td>
                <td width="100"><input type="checkbox" id="plancheck" value="courseplanning"> Planning</td>
            </tr>
            <tr>
                @foreach($course->projects as $project)
                <tr>
                    <td>
                        <strong> <a href="{{URL::to("project/$project->name/tickets")}}"> {{ $project->name }} </a> </strong>
                    </td>
                </tr>
                <tr> 
                    <td>
                        <strong> Team Members: </strong>
					</td>
					@foreach($project->users as $user)
					<td width="100">{{$user->username}}</td>
					@endforeach
                </tr>
                @endforeach
        </table>    
    @endforeach
    <br>
    <br>
    <div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#">Create Project</button> &nbsp;&nbsp;&nbsp;
        <button class="btn btn-primary" data-toggle="modal" data-target="#">Add User</button>
        
    </div>

</div>

@stop
