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
        <canvas id="canvas" height="500" width="1000"></canvas>
        <div id="btn"></div>
	<script>
            var lineChartData = {
                    labels : ["Week 1","Week 2","Week 3","Week 4","Week 5","Week 6","Week 7", "Week 8", "Week 9", "Week 10"],
                    datasets : [
                            {
                                    fillColor : "rgba(0,0,0,0)",
                                    strokeColor : "rgba(5,162,5,1)",
                                    pointColor : "rgba(5,162,5,1)",
                                    pointStrokeColor : "#fff",
                                    data : [65,67,75,81,85,90,95],
                                    title:"Planned"
                            },
                            {
                                    fillColor : "rgba(0,0,0,0)",
                                    strokeColor : "rgba(77,50,205,1)",
                                    pointColor : "rgba(77,50,205,1)",
                                    pointStrokeColor : "#fff",
                                    data : [60,69,74,81,90,95,110],
                                    title: "Actual"
                            },
                            {
                                    fillColor : "rgba(0,0,0,0)",
                                    strokeColor : "rgba(220,5,5,1)",
                                    pointColor : "rgba(220,5,5,1)",
                                    pointStrokeColor : "#fff",
                                    data : [67,69,77,83,87,92,97],
                                    title: "Earned"
                            }
                    ]
            };

	var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData, {showLegend: true});
        //This should produce a button that allows for the graph to be saved
        var graph = document.getElementById("canvas");
        var cs = new CanvasSaver('./saveme.php');
        var btn = cs.generateButton('Save Graph', myLine, 'PAEChart');
        
        </script>
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

