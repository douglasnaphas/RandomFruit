@extends('dashlayout')

{{-- app/views/instructordash.blade.php: Default view for instructors --}}
@section('title')
{{Auth::user()->is_admin ? "Instructor Dashboard" : "Student Dashboard"}}
@stop

@section('page_header')
Earned Value Chart
@stop

@section('content')
<?php
$curDate = date("mdy_His");
    echo "<div> \n";
   foreach(Auth::user()->projects as $project){
   if($project->course->active){
        echo "<div align=\"center\"><h3><strong>".$project->name."</strong></h3>";
        echo " <canvas id='".$project->id."canvas' height='500' width='1000'></canvas> \n";
        echo "<script> \n";
        echo "var lineChartData = {
			labels:".json_encode($project->weeksLegendArray()).",
            datasets: [
                {
                    fillColor: 'rgba(0,0,0,0)',
                    strokeColor: 'rgba(5,162,5,1)',
                    pointColor: 'rgba(5,162,5,1)',
                    pointStrokeColor: '#fff',
                    data: ".json_encode($project->getPlannedValueData()).",
                    title: 'Planned'
                },
                {
                    fillColor: 'rgba(0,0,0,0)',
                    strokeColor: 'rgba(77,50,205,.55)',
                    pointColor: 'rgba(77,50,205,1)',
                    pointStrokeColor: '#000',
                    data: ".json_encode($project->getActualValueData()).",
                    title: 'Actual'
                },
                {
                    fillColor: 'rgba(220,5,5,.3)',
                    strokeColor: 'rgba(220,5,5,0)',
                    pointColor: 'rgba(220,5,5,.7)',
                    pointStrokeColor: '#fff',
                    data: ".json_encode($project->getEarnedValueData()).",
                    title: 'Earned'
                }
            ]
        };\n";
        echo "var myLine = new Chart(document.getElementById('".$project->id."canvas').getContext('2d')).Line(lineChartData, {showLegend: true});\n";
        echo "var graph = document.getElementById('".$project->id."canvas');\n";//augmented
        echo "var cs = new CanvasSaver('./saveme.php');\n";//augmented
        echo "var btn = cs.generateButton('Save ".$project->name." Graph', graph, '".$project->name."EarnedValueChart_$curDate');\n";//augmented
        echo "</script>\n";
        echo"<div id=\"".$project->id."saveChartBtn\" class=\"button-container\"></div>\n";  
        echo "</div>\n";
        echo"<script>
            var saveBtnDiv = document.getElementById('".$project->id."saveChartBtn');
            saveBtnDiv.appendChild(btn);
            </script>\n";
        echo "<br>\n";
   }
        
}
?>  

<h2 class="sub-header">Owned Tickets</h2>

@include('tickettable', array('tickets' => Auth::user()->tickets_owned, 'id' => 1, 'omit' => array('owner')))
</div>
@stop

