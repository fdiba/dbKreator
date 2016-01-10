addTooltip();

d3.selectAll('.info').each(function(d, i){

	var div = d3.select(this);

	var mWidth = div.attr("data-width");
	var color = div.attr("data-color");
	var str = div.attr("data-str");

	div.text('').style({width: mWidth+'px', height: '24px', overflow: 'hidden'});

	div.style("background",function() {
    	// return d3.rgb(color, color, color);
    	return color;
    })

    div.transition().delay(100*i).style("visibility", "visible");

    var tooltip = d3.select('#tooltip');

    $(this).mouseover(function() {
		tooltip.text(str);
		tooltip.style('display', 'block');
	}).mousemove(function(event) {
		tooltip.style('top', (event.pageY + 10) + 'px')
			   .style('left', (event.pageX + 10) + 'px');
	}).mouseout(function() {
    	tooltip.style('display', 'none');
  	});

});

function addTooltip(){

	var tooltip = d3.select('#message')
		.append('div')
		.attr('id', 'tooltip');

}
