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
    <table class ="table-nonfluid">
        <td>
            <h3>  {{  $course->code  }} - {{ $course->description }} </h3>
        </td>
        <td>
            <div class="icon-course glyphicon glyphicon-remove"></div>
        </td>
    </table>
        <table class="table-nonfluid">
            <tr>
                <td><strong>Project Name</strong></td>
				<td width="100"><input type="checkbox" class="course-toggle" id="active-{{$course->id}}"
					value="courseactive" {{$course->active ? 'checked' : ''}}
					data-target="{{URL::route('toggleActive', array('course_id' => $course->id))}}">
					Active
				</td>
				<td width="100"><input type="checkbox" class="course-toggle" id="planning->{{$course->id}}"
					value="courseplanning" {{$course->planning ? 'checked' : ''}}
					data-target="{{URL::route('togglePlanning', array('course_id' => $course->id))}}">
					Planning
				</td>
                                
            </tr>
                @foreach($course->projects as $project)
                <tr>
                    <td>
						<strong> <a href="{{URL::to("project/$project->name/tickets")}}"> {{ $project->name }} </a> </strong> &nbsp; <span class="icon-name glyphicon glyphicon-remove project-remove" 
							data-delete-url="{{$project->getDeleteUrl()}}"></span>
                    </td>                    
                </tr>
                <tr> 
                    <td>
                        <strong> Team Members: </strong>
					</td>
					@foreach($project->users as $user)
                                        <td width="100">{{$user->username}}&nbsp;&nbsp;<div class="icon-user glyphicon glyphicon-remove"></div></td>
					@endforeach
                </tr>
                @endforeach
        </table>
    <br />
    @endforeach
	<script>
		$(function(){
			$('.course-toggle').change(function(){
				$checkElement = $(this);
				ajax_data = {
					url:  $checkElement.attr('data-target'),
					method: 'GET',
					type: 'json',
					success: function (data, status){
						if (data.status != 'success'){
							alert(data.message);
						}
					},
					error: function(request, status, error){
						alert(request.responseText);
					}
					
				}
				$.ajax(ajax_data);
			});
		});

	</script>
    <br>
    <br>
    <div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addProject">Add Project</button> &nbsp;&nbsp;&nbsp;
        <button class="btn btn-primary" data-toggle="modal" data-target="#addUser">Add User</button>
    </div>

</div>

<!-- Include Add Project Modal -->
@include('dash/modals/addproject')

<!-- Include Add User Modal -->
@include('dash/modals/adduser')

@stop
