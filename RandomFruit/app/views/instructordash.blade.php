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
    echo "<div> \n";
   foreach(Auth::user()->projects as $project){
        echo " <canvas id='".$project->id."canvas' height='500' width='1000'></canvas> \n";
        echo "<script> \n";
        echo "var lineChartData = {
			labels:".json_encode(Project::fromName("$project->name")->weeksLegendArray()).",
            datasets: [
                {
                    fillColor: 'rgba(0,0,0,0)',
                    strokeColor: 'rgba(5,162,5,1)',
                    pointColor: 'rgba(5,162,5,1)',
                    pointStrokeColor: '#fff',
                    data: ".json_encode(Project::fromName("$project->name")->getPlannedValueData()).",
                    title: 'Planned'
                },
                {
                    fillColor: 'rgba(0,0,0,0)',
                    strokeColor: 'rgba(77,50,205,1)',
                    pointColor: 'rgba(77,50,205,1)',
                    pointStrokeColor: '#fff',
                    data: ".json_encode(Project::fromName("$project->name")->getActualValueData()).",
                    title: 'Actual'
                },
                {
                    fillColor: 'rgba(0,0,0,0)',
                    strokeColor: 'rgba(220,5,5,1)',
                    pointColor: 'rgba(220,5,5,1)',
                    pointStrokeColor: '#fff',
                    data: ".json_encode(Project::fromName("$project->name")->getEarnedValueData()).",
                    title: 'Earned'
                }
            ]
        };\n";
        echo "var myLine = new Chart(document.getElementById('".$project->id."canvas').getContext('2d')).Line(lineChartData, {showLegend: true});\n";
        echo "var graph = document.getElementById('".$project->id."canvas');\n";
        echo "var cs = new CanvasSaver('./saveme.php');\n";
        echo "var btn = cs.generateButton('Save Graph', graph, 'BurndownChart_$curDate');\n";
        echo "</script>\n";
        echo"<div id=\"saveChartBtn\" class=\"button-container\"></div>\n";
        echo"<script>
            var saveBtnDiv = document.getElementById('saveChartBtn');
            saveBtnDiv.appendChild(btn);
            </script>\n";
        echo "<br>\n";
        
}
?>  

<h2 class="sub-header">Owned Tickets</h2>

@include('tickettable', array('tickets' => Auth::user()->tickets_owned))
</div>
@stop

