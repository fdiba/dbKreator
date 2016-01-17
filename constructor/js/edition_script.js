var year ='1978';
var path = 'data/'+year+'.csv';
var objects = [];
var pointer;
var myVar;

d3.csv(path, function(data){

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

        $.post("updateEditionTable.php", {firstName: firstName,
        								  name: name,
        								  year: year})
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

	var delay=250;
	pointer = 0;

	myVar = setInterval(doStuff, delay);
	
}