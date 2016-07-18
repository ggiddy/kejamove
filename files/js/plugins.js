$(function(){
	var base_url = "http://www.kejamove.com/";
	// Load vegas slider
	$('#hero-slider').vegas({
		slides : [
			{src : base_url + 'images/bgs/bg23.jpg'},
			{src : base_url + 'images/bgs/bg_18.jpg', transition: 'fade'}
		],

		overlay : true,
		delay: 5000,
        timer: false,
        shuffle: false,
        transition: 'fade',
        color: '#fff',
        cover: true 

	});

	// Nicescroll Init
	$('html').niceScroll({
		cursorcolor : '#777',
		cursorwidth : '7px',
		cursorborder: "1px solid #777",
		smoothscroll : true,
		hwacceleration: true,
		background : '',
		scrollspeed : 100,
		autohidemode : false,
		horizrailenabled : false,
		sensitiverail: true,
		zindex : 9999
	});
	$('#owl-events').owlCarousel({
		 slideSpeed : 200,
		 paginationSpeed : 800,
		 rewindSpeed : 1000,
		 autoPlay : true,
		 items	: 3
	});


});