

fetch("https://api.github.com/search/users?q=location:besan%C3%A7on")
    .then( // on attend d'avoir complètement chargé le fichier, PUIS (then)on effectue la fonction 
        function (response){
        return response.json();
    }).then(function(response){
        console.log(response);
    })