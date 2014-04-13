if(!!(window.addEventListener)) window.addEventListener('DOMContentLoaded', main);
else window.attachEvent('onload', main);

function main() {
    lineChart();
}


function lineChart() {
    var data = {    
        labels : ["Week 1","Week 2","Week 3","Week 4","Week 5","Week 6","Week 7", "Week 8", "Week 9", "Week 10"],
        datasets : [
                {
                        fillColor : "rgba(0,0,0,0)",
                        strokeColor : "rgba(255,162,5,1)",
                        pointColor : "rgba(255,162,5,1)",
                        pointStrokeColor : "#fff",
                        data : [65,67,75,81,85,90,95],
                        title: 'Planned'
                },
                {
                        fillColor : "rgba(0,0,0,0)",
                        strokeColor : "rgba(252,5,5,1)",
                        pointColor : "rgba(252,5,5,1)",
                        pointStrokeColor : "#fff",
                        data : [60,69,74,81,90,95,110],
                        title: 'Actual'
                },
                {
                        fillColor : "rgba(0,0,0,0)",
                        strokeColor : "rgba(77,50,205,1)",
                        pointColor : "rgba(77,50,205,1)",
                        pointStrokeColor : "#fff",
                        data : [67,69,77,83,87,92,97],
                        title: 'Earned'
                }
        ]

}

    var ctx = document.getElementById("lineChart").getContext("2d");
    new Chart(ctx).Line(data);

    legend(document.getElementById("lineLegend"), data);

    // testing adding twice (should get same result)
    //legend(document.getElementById("lineLegend"), data);
}
