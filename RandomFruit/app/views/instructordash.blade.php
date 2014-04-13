@extends('dashlayout')

{{-- app/views/instructordash.blade.php: Default view for instructors --}}
@section('title')
Instructor Dash
@stop

@section('page_header')
Dashboard
@stop

@section('content')
    <div>
        <canvas id="lineChart" height="450" width="1000"></canvas>
        <div class="pull-right"> <div id="lineLegend"></div></div>
    </div>

    <h2 class="sub-header">Owned Tickets</h2>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                    <th>Ticket #</th>
                    <th>Title</th>
                    <th>Creator</th>
                    <th>Owner</th>
                    <th>Description</th>
                    <th>Planned</th>
                    <th>Actual</th>
            </tr>
            </thead>
            <tbody>
    
    <?php
        $user = Auth::user();
        $con = mysqli_connect('localhost','root', 'root', 'RandomFruit') or die(mysqli_error());
        $sqlstmt = "SELECT * FROM tickets WHERE owner_id='".$user->id."'";
        $result = mysqli_query($con, $sqlstmt);
        
        
        while($row = mysqli_fetch_array($result)){
            $num = $row['number'];
            $title = $row['title'];
            $desc = $row['description'];
            $ph = $row['planned_hours'];
            $ah = $row['actual_hours'];
            
            echo "<tr>
                    <td>".$num."</td>
                    <td>".$title."</td>
                    <td>".$user->username."</td>
                    <td>".$user->username."</td>
                    <td>".substr($desc,0,50) . "..." ."</td>
                    <td>".$ph."</td>
                    <td>".$ah."</td>
                  </tr>";
        } 
        ?>            
            </tbody>
        </table>
    </div>
</div>
@stop

