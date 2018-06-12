// "https://api.github.com/search/users?q=location:besan%C3%A7on"
// var testUrl = new URL('http://localhost/teck-tracker/sendJson.php?region=Provence-Alpes-Côte d\'Azur');
fetch("models/sendJson.php?region=84")
    .then( // on attend d'avoir complètement chargé le fichier, PUIS (then)on effectue la fonction 
        function (response){
        return response.json();
    }).then(function(response){
    	var languages = ["php", "javascript", "python", "java", "ruby"];
        var resultatRegion = { 'region' : "", "php" : 0, "javascript" : 0, "html" : 0, "css" : 0, "python" : 0, "java" : 0, "ruby" : 0};
        var longueur = response.length;
        resultatRegion.region = response[0].region;
        for (var j = 0; j < languages.length; j++){
        	for (var i = 0; i < longueur; i++){
        	var location = response[i].nom_commune;
        	fetch("https://api.github.com/search/users?q=location:" + location + "+language:" + languages[j])
        	.then(function (rep){
        		return rep.json();
    		}).then(function(rep){
    			console.log(rep.total_count);
        	})
        }
	}        
})