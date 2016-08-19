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

    var tooltip = d3.select('#info_bar p');

    $(this).click(function(event) {
		tooltip.text(str);
		//TODO DO DATABASE REQUEST TO GET MISAM
	});
});
