d3.selectAll('.info').each(function(d, i){

	var div = d3.select(this);

	var mWidth = div.attr("data-color");

	// var color = Math.random()*255;
	var color = Math.random()*255;


	// console.log(div.attr("data-color"));

	div.text('').style({width: mWidth+'px', height: '10px', overflow: 'hidden'});

	div.style("background",function() {
    	return d3.rgb(color, color, color);
    })

    div.transition().delay(100*i).style("visibility", "visible");

});