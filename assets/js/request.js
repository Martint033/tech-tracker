
function findDev (town){
fetch("https://api.github.com/search/users?q=location:"+town).then( // on attend d'avoir complètement chargé le fichier, PUIS (then)on effectue la fonction 
        function (response){
        return response.json();
    }).then(function(response){
        console.log(response['items']['2']['login']);
    })
}


findDev('Paris');