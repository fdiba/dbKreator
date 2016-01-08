var objects = [];
var pointer;
var myVar;

d3.csv('data/1973.csv', function(data){

	for(key in data){

		var firstName = data[key].firstName;
		var name = data[key].name;

		objects.push({firstName : firstName, name : name});
	
	}

	editDatabase();

});
function doStuff(){

	var firstName = objects[pointer].firstName;
	var name = objects[pointer].name;

	if(name){

        $.post("updateEditionTable.php", {firstName : firstName, name : name})
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

	var delay=500;
	pointer = 0;

	myVar = setInterval(doStuff, delay);
	
}