addTooltip();

d3.selectAll('.edition').each(function(){

	var div = d3.select(this);

	var mWidth = div.attr("data-width");
	var color = div.attr("data-color");
	var str = div.attr("data-str");

	div.text('').style({width: mWidth+'px', height: '24px', overflow: 'hidden'});

	div.style("background",function() {

		var foo = 255/(2009-1973);
		var id = str - 1973;
		id *= foo;
    	return d3.hsl(id, .5, .5);
    })

    //div.transition().delay(10*i).style("visibility", "visible");
    /*
    var tooltip = d3.select('#tooltip');

    $(this).click(function(event) {
		tooltip.text(str)
				.style({'display': 'block',
						'top': (event.pageY + 10) + 'px',
			   			'left': (event.pageX + 10) + 'px'});
	}).mousemove(function(event) {
		tooltip.style('display', 'none');
	});*/
});

d3.selectAll('.info').each(function(){

	var div = d3.select(this);

	var mWidth = div.attr("data-width");
	var color = div.attr("data-color");
	var str = div.attr("data-str");

	div.text('').style({width: mWidth+'px', height: '24px', overflow: 'hidden'});

	div.style("background",function() {
    	return color;
    })

    //div.transition().delay(10*i).style("visibility", "visible");

    var tooltip = d3.select('#tooltip');

    $(this).click(function(event) {
		tooltip.text(str)
				.style({'display': 'block',
						'top': (event.pageY + 10) + 'px',
			   			'left': (event.pageX + 10) + 'px'});
	}).mousemove(function(event) {
		tooltip.style('display', 'none');
	});
});

function addTooltip(){

	var tooltip = d3.select('#message')
		.append('div')
		.attr('id', 'tooltip');

}
