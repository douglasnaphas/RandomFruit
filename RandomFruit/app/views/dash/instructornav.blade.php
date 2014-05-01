@extends ('dash.dashnav')
@section('topbar')
@parent

<script>
    $(function () {
        $('#dashtype').html('Instructor');
    });
</script>
@stop

@section('sidebar')
@parent

<script>
    $(function () {
        $('#sidebar-links').append(
            '<strong>COURSE</strong>' +
                '<ul class="nav nav-sidebar">' +
                '<li><a href="#" data-toggle="modal" data-target="#createCourse">Create Course</a></li>' +
                '<li><a href="{{URL::to("courses")}}">View Courses</a></li>' +
                '</ul>' +
                '<strong>USER</strong>' +
                '<ul class="nav nav-sidebar">' +
                '<li><a href="#" data-toggle="modal" data-target="#createUser">Create User</a></li>' +
                '</ul>'
        );
    });
</script>
@stop


