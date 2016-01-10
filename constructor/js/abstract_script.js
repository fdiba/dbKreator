d3.selectAll('.info').each(function(d, i){

	var div = d3.select(this);

	var mWidth = div.attr("data-width");
	var color = div.attr("data-color");


	div.text('').style({width: mWidth+'px', height: '24px', overflow: 'hidden'});

	div.style("background",function() {
    	// return d3.rgb(color, color, color);
    	return color;
    })

    div.transition().delay(100*i).style("visibility", "visible");

});