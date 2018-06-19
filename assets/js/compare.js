function drawChart() {
    var data = google.visualization.arrayToDataTable([
        [calledRegion[y].region, "php", "javascript", "python", "java", "ruby", "c", "cpp", "csharp", "assembly"],
        [" ", parseInt(calledRegion[y].php), parseInt(calledRegion[y].javascript), parseInt(calledRegion[y].python), parseInt(calledRegion[y].java), parseInt(calledRegion[y].ruby), parseInt(calledRegion[y].c), parseInt(calledRegion[y].cpp), parseInt(calledRegion[y].csharp), parseInt(calledRegion[y].assembly)]
    ]);

    var options = {
        chart: {
            title: calledRegion[y].region,                
        },
    };
    console.log("dans le if: y = "+y+"region = "+calledRegion[y].region);

    switch (y){
        case 0:
            var chart = new google.charts.Bar(document.getElementById('columnchart_materialA'));
            break;

        case 1:
            var chart = new google.charts.Bar(document.getElementById('columnchart_materialB'));
            break;

        case 2:
            var chart = new google.charts.Bar(document.getElementById('columnchart_materialC'));
            break;

        case 3:
            var chart = new google.charts.Bar(document.getElementById('columnchart_materialD'));
            break;

        case 4:
            var chart = new google.charts.Bar(document.getElementById('columnchart_materialE'));
            break;

    }
    chart.draw(data, google.charts.Bar.convertOptions(options)); 
}





var calledRegion = new Array();
var y = 0;   




document.getElementById("submitCompare").addEventListener("click", function (e) {
    
    e.preventDefault(); 
    var choiceRegion = document.getElementsByClassName("regions");
    
    y = 0;

    for (var x = 0; x < choiceRegion.length; x++){

        console.log("y = "+y+", x = "+x+", length = "+calledRegion.length);

        if (choiceRegion[x].checked === true){
            fetch("models/sendJson.php?region=" + choiceRegion[x].value)
                .then( function (response){
                    return response.json();
                }).then(function(response){
                    calledRegion[y] = response;                                   
                    });
         
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);
 
             y++;
        }   // end if
    }   // end for
});