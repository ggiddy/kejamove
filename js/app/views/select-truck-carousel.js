$(document).ready( function() {
	var clickEvent = false;

	$('#select_pickup').on('click', function() {
		clickEvent = false;
		$('.nav li').removeClass('active');
		$('#addons').addClass('active');
		$("#pickup_radio").prop("checked", true);
		$('#addons_anchor')[0].click();
	});

	$('#select_canter').on('click', function(){
		clickEvent = false;
		$('.nav li').removeClass('active');
		$('#addons').addClass('active');
		$("#canter_radio").prop("checked", true);
		$('#addons_anchor')[0].click();
	});
	$('#select_fh').on('click', function(){
		clickEvent = false;
		$('.nav li').removeClass('active');
		$('#addons').addClass('active');
		$("#fh_radio").prop("checked", true);
		$('#addons_anchor')[0].click();
	});

	$('#addons_proceed').on('click', function(){
		clickEvent = false;
		$('.nav li').removeClass('active');
		$('#addons').addClass('active');
		$('#dispatch_anchor')[0].click();
	});

	$('#myCarousel').on('click', '.nav a', function() {
			clickEvent = false;
			$('.nav li').removeClass('active');
			$(this).parent().addClass('active');		
	});
});