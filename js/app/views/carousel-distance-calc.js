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