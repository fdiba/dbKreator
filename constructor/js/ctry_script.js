var year ='1987';
var path = 'data/'+year+'.csv';
var objects = [];
var pointer;
var myVar;

d3.csv(path, function(data){

	for(key in data){
		var countryName = data[key].country;
		objects.push({name : countryName});
	}

	editDatabase();

});
function doStuff(){

	var name = objects[pointer].name;

	if(name){

        $.post("updateTableCountry.php", {name: name})
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

	var delay=25;
	pointer = 0;

	myVar = setInterval(doStuff, delay);
	
}

