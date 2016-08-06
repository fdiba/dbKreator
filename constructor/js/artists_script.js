var year ='1990';
var path = 'data/'+year+'.csv';
var objects = [];
var pointer;
var myVar;

d3.csv(path, function(data){

	for(key in data){

		var firstName = data[key].firstName;
		var name = data[key].name;
		var country = data[key].country;

		objects.push({firstName : firstName, name : name, country : country});
	
	}

	editDatabase();

});
function doStuff(){

	var firstName = objects[pointer].firstName;
	var name = objects[pointer].name;
	var country = objects[pointer].country;

	if(name){

        $.post("updateArtistsTable.php", {firstName : firstName, name : name, country : country})
        .done(function( data ) {
    			// console.log( "Data Loaded: " + data );
    			d3.select('#message').append('div')
    				.classed('feedback', true)
    				.text(data);

  			});


	} else {
		console.log('---------------- empty ----------------');
		d3.select('#message').append('div')
					.classed('error', true)
    				.text('---------------- no name ----------------');

	}

	pointer++;
	if(pointer>=objects.length) clearInterval(myVar);

}
function editDatabase(){

	var delay=50;
	pointer = 0;

	myVar = setInterval(doStuff, delay);
	
}