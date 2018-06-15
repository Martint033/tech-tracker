  // Get the modal
  var modal = document.getElementById('myModal');

  // Get the button that opens the modal
  var btn = document.getElementById("region-A");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];

  // When the user clicks the button, open the modal 
  btn.onclick = function () {
      modal.style.display = "block";
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function () {
      modal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function (event) {
      if (event.target == modal) {
          modal.style.display = "none";
      }
  }

google.charts.load('current', {
    'packages': ['corechart']
});
google.charts.setOnLoadCallback(drawChart);

function drawChart() {

    var data = google.visualization.arrayToDataTable([
        ['Langage', 'Utilisateurs'],
        ['JavaScript', 9],
        ['Java', 2],
        ['Ruby', 2],
        ['PHP', 2],
        ['Python', 7],
        ['CSS', 7],
        ['C++', 7],
        ['C#', 7],
        ['C', 7],
        ['HTML', 7],
    ]);

    var options = {
        title: 'Représentation des technologies par projets et par région',
        is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));

    chart.draw(data, options);
}


google.charts.load('current', {
    'packages': ['bar']
});
google.charts.setOnLoadCallback(drawStuff);

function drawStuff() {
    var data = new google.visualization.arrayToDataTable([
        ['Langage', 'Utilisateurs'],
        ['JavaScript', 9],
        ['Java', 2],
        ['Ruby', 2],
        ['PHP', 2],
        ['Python', 57],
        ['CSS', 47],
        ['C++', 97],
        ['C#', 87],
        ['C', 77],
        ['HTML', 67],
    ]);

    var options = {
        width: 800,
        legend: {
            position: 'none'
        },
        chart: {
            title: 'Nb de codeurs',
            subtitle: '% dutilisation'
        },
        axes: {
            x: {
                0: {
                    side: 'top',
                    label: 'White to move'
                } // Top x-axis.
            }
        },
        bar: {
            groupWidth: "90%"
        }
    };

    var chart = new google.charts.Bar(document.getElementById('top_x_div'));
    // Convert the Classic options to Material options.
    chart.draw(data, google.charts.Bar.convertOptions(options));
};