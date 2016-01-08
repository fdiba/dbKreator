var objects = [];
var pointer;
var myVar;

d3.csv('data/1973.csv', function(data){

	for(key in data){

		var countryName = data[key].country;

		objects.push({name : countryName});
	
	}

	editDatabase();

});
function doStuff(){

	var name = objects[pointer].name;

	if(name){

        $.post("update.php", {name: name})
        .done(function( data ) {
    			console.log( "Data Loaded: " + data );
  			});


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
	
}

