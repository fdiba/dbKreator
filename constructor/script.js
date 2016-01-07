//d3.select('#message').html('<p>' +  foobar + '</p>');

var objects = [];
var pointer;
var myVar;

d3.csv('data/1973.csv', function(data){

	for(key in data){

		var countryName = data[key].country;
		//if (!countryName) countryName = "Inconnu";

		objects.push({name : countryName});

		//console.log(countryName);
	
	}

	editDatabase();

});
function doStuff(){

	var name = objects[pointer].name;

	if(name){
		//console.log(name);
        $.post("update.php", {name: name})
        .done(function( data ) {
    		console.log( "Data Loaded: " + data );
  			})
        ;


	} else {
		console.log('---------------- empty ----------------');

	}

	pointer++;
	if(pointer>=objects.length) clearInterval(myVar);

}
function editDatabase(){

	var delay=1000;
	pointer = 0;

	myVar = setInterval(doStuff, delay);

	/*for (var i = 0; i < objects.length; i++) {
		var name = objects[i].name;
		console.log(name);
	};*/
}

