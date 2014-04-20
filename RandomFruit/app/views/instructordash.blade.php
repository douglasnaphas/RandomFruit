@extends('dashlayout')

{{-- app/views/instructordash.blade.php: Default view for instructors --}}
@section('title')
Instructor Dash
@stop

@section('page_header')
Burndown Chart
@stop

@section('content')
<?php
$curDate = date("mdy_His");
?>
<div>
    <canvas id="canvas" height="500" width="1000"></canvas>
    <script>
        var lineChartData = {
            labels: ["Week 1", "Week 2", "Week 3", "Week 4", "Week 5", "Week 6", "Week 7", "Week 8", "Week 9", "Week 10"],
            datasets: [
                {
                    fillColor: "rgba(0,0,0,0)",
                    strokeColor: "rgba(5,162,5,1)",
                    pointColor: "rgba(5,162,5,1)",
                    pointStrokeColor: "#fff",
                    data: {{json_encode(Project::fromName('RandomFruit')->getPlannedValueData())}},
                    title: "Planned"
                },
                {
                    fillColor: "rgba(0,0,0,0)",
                    strokeColor: "rgba(77,50,205,1)",
                    pointColor: "rgba(77,50,205,1)",
                    pointStrokeColor: "#fff",
                    data: {{json_encode(Project::fromName('RandomFruit')->getActualValueData())}},
                    title: "Actual"
                },
                {
                    fillColor: "rgba(0,0,0,0)",
                    strokeColor: "rgba(220,5,5,1)",
                    pointColor: "rgba(220,5,5,1)",
                    pointStrokeColor: "#fff",
                    data: {{json_encode(Project::fromName('RandomFruit')->getEarnedValueData())}},
                    title: "Earned"
                }
            ]
        };

        var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData, {showLegend: true});
        //This should produce a button that allows for the graph to be saved
        var graph = document.getElementById("canvas");
        var cs = new CanvasSaver('./saveme.php');
        var btn = cs.generateButton("Save Graph", graph, "BurndownChart_<?php echo $curDate; ?>");

    </script>
    <div id="saveChartBtn" class="button-container"></div>

    <script>
        var saveBtnDiv = document.getElementById('saveChartBtn');
        saveBtnDiv.appendChild(btn);
    </script>
</div>

<h2 class="sub-header">Owned Tickets</h2>

@include('tickettable', array('tickets' => Auth::user()->tickets_owned))
@stop

