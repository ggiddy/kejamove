<div id="setup-request-carousel-form-view"  class="panel default-form carousel-form request-form">
	<div id="request-carousel-form" class="carousel slide">
		<div class="container">
			<div class="row">
			<form name="request-form" class="form" method="post" action="<?php echo base_url('setup/newrequest/'); ?>">
				<div class="col-md-offset-2 col-md-8">
					<div id="request-carousel-form" class="carousel slide">
						<div id="form-message" class="<?php if(!isset($message)): ?>hidden <?php endif; ?>form-message">
							<a class="close" href="#close">&times;</a>
							<span class="message">
								<?php if(isset($message)) echo $message; ?>
							</span>
						</div>
						<div class="carousel-inner">
							<div id="location-details" class="item active">
								<div class="form-group">
									<section id="move_path" style="min-height: 100%; z-index: 2000"></section>
									<div style="color: #000;" class="row select-options ">
										<div class="col-xs-12 col-sm-5">
											<strong>From:</strong><br>
											<div class="input-group">
										      <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
										      <input class="form-control moving-from" id="moving-from" type="text" name="request[moving_from]" value="<?php if(isset($moving_from)) echo $moving_from; ?>" placeholder="Moving from? e.g Kileleshwa" required/>
										    </div><br>
										    <strong>Apartment Floor</strong><br>
										    <input id="floor-from" type="number" min="0" max="500" name="request[floor_from]" class="form-control" placeholder="3rd Floor" required autocomplete="off">
										</div>
										<div class="hidden-xs col-sm-2 text-center">
											<br>
											<input type="hidden" name="request[distance]" id="hidden_distance" />
											<p style="color: #fd852d;"><strong id="move_distance"></strong></p>
										</div>
										<div class="col-xs-12 col-sm-5">
											<strong>To:</strong><br>
											<div class="input-group col-xs-12">
										      <div class="input-group-addon"><span class="glyphicon glyphicon-map-marker"></span></div>
										      <input class="form-control moving-to" id="moving-to" type="text" name="request[moving_to]" value="<?php if(isset($moving_to)) echo $moving_to; ?>" placeholder="Moving to? e.g Kilimani" required/>
										    </div><br>
										    <strong>Apartment Floor</strong>
										    <input id="floor-to" type="number" min="0" max="500" name="request[floor_to]" class="form-control" placeholder="Ground Floor" required autocomplete="off">
										</div>
									</div>
									<div class="row">
										<div style="background-color: #fff; padding-bottom: 5px;" class="col-xs-12">
										<br>
											<button type="button" class="btn submit-btn btn-primary btn-color btn-step col-sm-offset-2" id="moving-to-submit" data-target="#moving-to"><b>Proceed</b></button>
										</div>
									</div>
									</div>
								</div>		
						
							<div class="clearfix"></div>
							<div class="item">
							<div class="clearfix"></div>
								<div class="form-group">
									<div class="row">
										<h2 class="form-label">
											<img class="item-icon" src="<?php echo base_url('images/icons/phoneblue1plain.png'); ?>"/>&nbsp;Your phone number so we can get in touch?
										</h2>
									</div>
									<div class="row">
										<div class="col-md-6 col-md-offset-3">
											<input class="form-control phone-number text-center" id="phone-number" type="text[]\87*-" name="request[phone]" value="<?php if(isset($phone)) echo $phone; ?>" placeholder="Phone number e.g 0722222222" required/>
										</div>
									</div>
									<span class="clearfix"></span>
								</div>
								<br><br>
								<div class="form-group action-group">
									<div>
										<input type="hidden" name="normal_signup" value="true"/>
										<input type="hidden" name="usr_submit" value="true"/>
										<button class="btn btn-lg btn-primary btn-color btn-step col-md-6 col-md-offset-3" type="submit"  id="phone-number-submit" name="usr_submit" value="true" data-target="#phone-number">
											<strong>Submit Request</strong>
										</button>	
									</div>
									<span class="clearfix"></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
<?php global $app_scripts; if(!is_array($app_scripts)) $app_scripts=array(); ?>
<?php $app_scripts['form-component']='js/app/components/form.js'; ?>
<?php $app_scripts['carousel-form-component']='js/app/components/carousel-form.js'; ?>
<?php $app_scripts['setup-carousel-form-view']='js/app/views/setup-carousel-form.js'; ?>

<script type="text/javascript">
	(function($){
	$(function(){

	  var moveMapEl = $('#move_path');

	  $('#location-details').on('change click', function(){
	  		moveFromPlace = $('#moving-from').val();
	  		moveToPlace = $('#moving-to').val();
			
			if(moveFromPlace.length > 0 && moveToPlace.length > 0) {
				showMoveRouteDirection();
			}
	  		
	  });
	  	

	  var moveMap = new google.maps.Map(moveMapEl.get(0), {
	    center: {lat: -1.290634, lng: 36.833698},
	    scrollwheel: false,
	    draggable: true,
	    zoom: 13
      });

	  var moveMapGeocoder = new google.maps.Geocoder();

	  var moveMapDirectionDisplay = new google.maps.DirectionsRenderer({
	    map: moveMap
	  });

	  var showMapError = function(message) {
	      	  var messageContainer = moveMapEl.first();

	      	  messageContainer.append('<span style="visibility:hidden!important;" class="alert alert-danger">'+message+'</span>');
	      	  messageEl = moveMapEl.parent().find('.alert');

	      	  messageEl.css({
	      	  	'position': 'fixed',
	      	  	'top':'150px',
	      	  	'left': '150px',
	      	  	'width': '300px',
	      	  	'height': '100px',
	      	  	'visibility': 'visible',
	      	  	'z-index': 2000,
	      	  }).fadeIn(1000, function(){
	      	  	  messageEl.fadeOut(10000);
	      	  });
	      };

	   var getMoveRouteDirectionRequest = function(callback) {
      		moveMapGeocoder.geocode({'address': moveFromPlace}, function(results, status){
      			
      			if(status === google.maps.GeocoderStatus.OK)
      			{
      				var destinationFound = false;

      				for(var i=0; i < results.length; i++)
      				{
      					if(destinationFound) break;

      					var result = results[i];

      					if(result.formatted_address.indexOf('Kenya') != -1)
      					{
      						var origin = result.geometry.location,
	      				    destination = null;

		        			moveMap.setCenter(origin);

		      				moveMapGeocoder.geocode({'address': moveToPlace}, function(dresults, status){

		      					if(status === google.maps.GeocoderStatus.OK)
		      					{
      								for(var j=0; j < dresults.length; j++)
				      				{
			      						var dresult = dresults[j];

				      					if(dresult.formatted_address.indexOf('Kenya') != -1)
				      					{			
				      						destination = dresult.geometry.location;

											callback.apply(this, [{
				  								'destination': destination,
				  								'origin': origin,
				  								'travelMode': google.maps.TravelMode.DRIVING
				  							}]);

				  							destinationFound = true;

				  							break;
				  						}
			  						}

		      					}
		      					else
		      					{
		      						showMapError('Error geocoding to address');
		      					}
		      				});
		      			}
	      			}
      			}
      			else
      			{
      				showMapError('Error geocoding from address');
      			}
      		});
	      };

	   var showMoveRouteDirection = function() {
	      	 getMoveRouteDirectionRequest(function(request) {
		      	 var moveMapDirectionsService = new google.maps.DirectionsService();
		      	 moveMapDirectionsService.route(request, function(response, status) {
				    if (status == google.maps.DirectionsStatus.OK) {
				      // Display the route on the map.
				      var routeDistance = (response.routes[0]['legs'][0]['distance']['value']/1000);
				      moveMapDirectionDisplay.setDirections(response);
				      $('#move_distance').text(Math.round(routeDistance) + " Km");
				      $('#hidden_distance').val(Math.round(routeDistance));
				    }
				    else
				    {
      					showMapError('Error showing move route '+status);
				    }
				  });
		     });
	      };
	      
	});

}(window.jQuery));
</script>