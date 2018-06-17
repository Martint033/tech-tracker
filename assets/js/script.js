var map = document.querySelector('#map'); // div container
var paths = map.querySelectorAll('.map__image a');  // tableau liens sur les paths de la carte svg
var links = map.querySelectorAll('.map__list a'); // tableau liens de la liste régions
// Get the modal
var modal = document.getElementById('myModal');
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
// init googlecharts
google.charts.load("current", {packages:["corechart"]});

// tableau de correspondance région
const regions = {A : 44, B : 75, C : 84, D : 27, E : 53, F : 24, G : 94, H : 11, I : 76, J : 32, K : 28, L : 52, M : 93};
var calledRegion = {};
//Polyfill du foreach
if (NodeList.prototype.forEach === undefined) {
    NodeList.prototype.forEach = function (callback) {
        [].forEach.call(this, callback);
    }
} // fin polyfill
// fonction gérant la sélection/déselection au survol souris
function activeArea(id) {
    map.querySelectorAll('.is-active').forEach(function (item) {
        item.classList.remove('is-active');
    });
    if (id !== undefined) {
        document.querySelector('#list-' + id).classList.add('is-active');
        document.querySelector('#region-' + id).classList.add('is-active');
    }
}
// fonction d'affichage googlecharts
function drawChart() {
    var data = google.visualization.arrayToDataTable([
            ['Langage', 'Nombre de projets'],
            ['PHP', calledRegion['php'] * 1],
            ['JavaScript', calledRegion['javascript'] * 1],
            ['Java', calledRegion['java'] * 1],
            ['Ruby', calledRegion['ruby'] * 1],           
            ['Python', calledRegion['python'] * 1],
            ['C++', calledRegion['cpp'] * 1],
            ['C#', calledRegion['csharp'] * 1],
            ['C', calledRegion['c'] * 1],
            ['Assembleur', calledRegion['assembly'] * 1],
        ]);

    var options = {
      title: calledRegion['region'],
      is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
}
// écouteurs d'évènnement sur les paths de la carte svg(régions)
paths.forEach(function (path) {
    // selectionnne le id d'un path du svg et appel activeArea
    path.addEventListener('mouseenter', function () {
        var id = this.id.replace('region-','');
        activeArea(id);
    });
    // gestion event 'click' 
    path.addEventListener('click', function(event){
        event.preventDefault();
        var id = this.id.replace('region-','');
        var code_region = regions[id];
        console.log(code_region);
        console.log(id);
        fetch("models/sendJson.php?region=" + code_region)
        .then( // on attend d'avoir complètement chargé le fichier, PUIS (then)on effectue la fonction 
            function (response){
            return response.json();
        }).then(function(response){
            calledRegion = response;
            console.log(calledRegion);
            google.charts.setOnLoadCallback(drawChart);
            modal.style.display = "block";
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }
            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }                   
        });
    });
});
// écouteurs d'évènnement sur les liens de la liste
links.forEach(function (link) {
    // selectionnne le id d'un lien de la liste régions
    link.addEventListener('mouseenter', function () {
        var id = this.id.replace('list-','');
        activeArea(id);
    });
    // gestion event 'click' 
    link.addEventListener('click', function(event){
        event.preventDefault();
        var id = this.id.replace('list-','');
        console.log(id);
    });
});
// déselection du path et du lien de la liste à la sortie du survol souris
map.addEventListener('mouseover', function () {
    activeArea();
});


