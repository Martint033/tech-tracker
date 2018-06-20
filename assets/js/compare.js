function drawChart() {
    var data = google.visualization.arrayToDataTable([
        [calledRegion[x].region, "php", "javascript", "python", "java", "ruby", "c", "cpp", "csharp", "assembly"],
        [" ", parseInt(calledRegion[x].php), parseInt(calledRegion[x].javascript), parseInt(calledRegion[x].python), parseInt(calledRegion[x].java), parseInt(calledRegion[x].ruby), parseInt(calledRegion[x].c), parseInt(calledRegion[x].cpp), parseInt(calledRegion[x].csharp), parseInt(calledRegion[x].assembly)]
    ]);

    var options = {
        chart: {
            title: calledRegion[x].region,                
        },
    };

    console.log("dans la fonction: region = "+calledRegion.length);

    switch (x){
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
var x = 0;   




document.getElementById("submitCompare").addEventListener("click", function (e) {   
    
    e.preventDefault(); 
    // var choiceRegion = document.getElementsByClassName("regions");

    var choiceRegion = document.querySelectorAll("input[name='regions']:checked");
  
    for (x = 0; x < choiceRegion.length; x++){

            fetch("models/sendJson.php?region=" + choiceRegion[x].value)
                .then( function (response){
                    return response.json();
                }).then(function(response){
                    calledRegion[x] = response;
                    for (var y = 0; y < calledRegion.length; y++)
                    {   console.log(calledRegion[y].region);    }                                 
                    });
         
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);
 
    }   // end for
});