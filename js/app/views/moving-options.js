$(document).ready(function(){

		//initialize variables
		var PICKUP_BASE_FARE = 1500;
		var PICKUP_KM_FARE = 750/3;
		var CANTER_BASE_FARE = 2500;
		var CANTER_KM_FARE = 1050/3;
		var FH_BASE_FARE = 4500;
		var FH_KM_FARE = 1350/3;
		var HELPER_GROUND = 600;
		var HELPER_NOT_GROUND = 800;
		var LITTLE_PACK = 3000;
		var NORMAL_PACK = 3500;
		var BIG_PACK = 6500;
		var JUMBO_PACK = 8000;
		var HOUSE_CLEANING = 2000;
		var INTERIOR_DECORATOR = 2000;
		var PICKUP_HELPERS = 2;
		var CANTER_HELPERS = 4;
		var FH_HELPERS = 5;
		var HELPER_CHARGE = 800;

		/**
		 * Initial cost based on distance and base charges.
		 */
		
		//get distance 
		var distance = $('#distance').val();

		//initial pickup calculation
		var pickup_cost = PICKUP_BASE_FARE + distance*PICKUP_KM_FARE + PICKUP_HELPERS*HELPER_CHARGE + LITTLE_PACK;
		$('#pickup_cost').text(Math.ceil(pickup_cost).toLocaleString());

		//initial canter calculation
		var canter_cost = CANTER_BASE_FARE + distance*CANTER_KM_FARE + CANTER_HELPERS*HELPER_CHARGE + NORMAL_PACK;	
		$('#canter_cost').text(Math.ceil(canter_cost).toLocaleString());

		//initial fh calculation
		var fh_cost = FH_BASE_FARE + distance*FH_KM_FARE + FH_HELPERS*HELPER_CHARGE + BIG_PACK;	
		$('#fh_cost').text(Math.ceil(fh_cost).toLocaleString());

		$('#email_quote').change(function(event) {
			if ($('#email_quote').is(':checked')) {
				$('#email_txt').removeClass('hidden');
			} else {
				$('#email_txt').addClass('hidden');
			}
		});

		/**
		 * Variable cost based on helper charges and addons.
		 */
		
		$('#house_cleaning').change(function(){
			
			if($('#house_cleaning').is(':checked')) {
				pickup_cost += HOUSE_CLEANING;
    			canter_cost += HOUSE_CLEANING;
    			fh_cost += HOUSE_CLEANING;
    			
    			//Add to quotation
    			$('#cleaning_label').removeClass('hidden');
		   		$('#cleaning_cost').text(HOUSE_CLEANING.toLocaleString() + " /=");

    		} else {
    			pickup_cost = PICKUP_BASE_FARE + distance*PICKUP_KM_FARE + PICKUP_HELPERS*HELPER_CHARGE + LITTLE_PACK;
    		
    			canter_cost = CANTER_BASE_FARE + distance*CANTER_KM_FARE + CANTER_HELPERS*HELPER_CHARGE + NORMAL_PACK;	
  
    			fh_cost = FH_BASE_FARE + distance*FH_KM_FARE + FH_HELPERS*HELPER_CHARGE + BIG_PACK;		
    			

    			//Remove from quotation
    			$('#cleaning_label').addClass('hidden');
		   		$('#cleaning_cost').text('');
    		}

    		
    		$('#pickup_cost').text(Math.ceil(pickup_cost).toLocaleString());
    		$('#canter_cost').text(Math.ceil(canter_cost).toLocaleString());
    		$('#fh_cost').text(Math.ceil(fh_cost).toLocaleString());

    		write_quote();
    	});

    	$('#interior_decorator').change(function(event) {
    		if($('#interior_decorator').is(':checked')) {
    			pickup_cost += INTERIOR_DECORATOR;
    			canter_cost += INTERIOR_DECORATOR;
    			fh_cost += INTERIOR_DECORATOR;

    			//Add to quotation
    			$('#decorator_label').removeClass('hidden');
		   		$('#decorator_cost').text(HOUSE_CLEANING.toLocaleString() + " /=");
    		} else {
    			pickup_cost = PICKUP_BASE_FARE + distance*PICKUP_KM_FARE + PICKUP_HELPERS*HELPER_CHARGE + LITTLE_PACK;
    		
    			canter_cost = CANTER_BASE_FARE + distance*CANTER_KM_FARE + CANTER_HELPERS*HELPER_CHARGE + NORMAL_PACK;	
  
    			fh_cost = FH_BASE_FARE + distance*FH_KM_FARE + FH_HELPERS*HELPER_CHARGE + BIG_PACK;	
    			

    			//Remove from quotation
    			$('#decorator_label').addClass('hidden');
		   		$('#decorator_cost').text('');
    		}


    		$('#pickup_cost').text(Math.ceil(pickup_cost).toLocaleString());
    		$('#canter_cost').text(Math.ceil(canter_cost).toLocaleString());
    		$('#fh_cost').text(Math.ceil(fh_cost).toLocaleString());

    		write_quote();	

    	});
    	
		
		/**
		 * Calculates costs using pickup vehicle
		 * @return {void}
		 */
		var pickup_calc = function() {
			
			//calculate helper charges and packaging material charges		
			var floor = $('#floor').val();
			var helpers = $('#pickup_loaders').val();
			var house_cleaning = $('#house_cleaning').val();
			var interior_decorator = $('#interior_decorator').val();
			
			if(floor === "ground") {
				pickup_cost += HELPER_GROUND*helpers;
			} else {
				pickup_cost += HELPER_NOT_GROUND*helpers;
			}

			//calculate packaging costs
			var pickup_packaging = $('#pickup_packaging').val();

			if(pickup_packaging != undefined) {
	    		if(pickup_packaging === 'little') {
	    			pickup_cost += LITTLE_PACK;
	    		} else if(pickup_packaging === 'normal') {
	    			pickup_cost += NORMAL_PACK;
	    		} else if(pickup_packaging === 'big') {
	    			pickup_cost += BIG_PACK;
	    		} else if(pickup_packaging === 'jumbo') {
	    			pickup_cost += JUMBO_PACK;
	    		} else {}
	    	}
	    	write_quote();
		};

		var canter_calc = function() {

			//calculate helper charges and packaging material charges		
			var floor = $('#floor').val();
			var helpers = $('#canter_loaders').val();
			
			if(floor === "ground") {
				canter_cost += HELPER_GROUND*helpers;
			} else {
				canter_cost += HELPER_NOT_GROUND*helpers;
			}

			//calculate packaging costs
			var canter_packaging = $('#canter_packaging').val();

			if(canter_packaging != undefined) {
	    		if(canter_packaging === 'little') {
	    			canter_cost += LITTLE_PACK;
	    		} else if(canter_packaging === 'normal') {
	    			canter_cost += NORMAL_PACK;
	    		} else if(canter_packaging === 'big') {
	    			canter_cost += BIG_PACK;
	    		} else if(canter_packaging === 'jumbo') {
	    			canter_cost += JUMBO_PACK;
	    		} else {}
	    	}
		};

		var fh_calc = function() {

			//calculate helper charges and packaging material charges		
			var floor = $('#floor').val();
			var helpers = $('#fh_loaders').val();
			
			if(floor === "ground") {
				fh_cost += HELPER_GROUND*helpers;
			} else {
				fh_cost += HELPER_NOT_GROUND*helpers;
			}

			//calculate packaging costs
			var fh_packaging = $('#fh_packaging').val();

			if(canter_packaging != undefined) {
	    		if(fh_packaging === 'little') {
	    			fh_cost += LITTLE_PACK;
	    		} else if(fh_packaging === 'normal') {
	    			fh_cost += NORMAL_PACK;
	    		} else if(fh_packaging === 'big') {
	    			fh_cost += BIG_PACK;
	    		} else if(fh_packaging === 'jumbo') {
	    			fh_cost += JUMBO_PACK;
	    		} else {}
	    	}
		};
/**
		$('#pickup_variables').on('keyup change click', function() {
			pickup_cost = PICKUP_BASE_FARE + distance*PICKUP_KM_FARE;
			pickup_calc();
			if($('#house_cleaning').is(':checked')) {
				pickup_cost += HOUSE_CLEANING;
			}
			if($('#interior_decorator').is(':checked')) {
				pickup_cost += INTERIOR_DECORATOR;
			}
			$('#pickup_cost').text(Math.ceil(pickup_cost).toLocaleString());
			write_quote();
		});

		
		//canter calculation
		$('#canter_variables').on('keyup change click', function() {
			canter_cost = CANTER_BASE_FARE + distance*CANTER_KM_FARE;
			canter_calc();
			if($('#house_cleaning').is(':checked')) {
				canter_cost += HOUSE_CLEANING;
			}
			if($('#interior_decorator').is(':checked')) {
				canter_cost += INTERIOR_DECORATOR;
			}
			//set total canter cost 	
			$('#canter_cost').text(Math.ceil(canter_cost).toLocaleString());
			write_quote();
		});

		//fh calculation
		$('#fh_variables').on('keyup change click', function() {
			fh_cost = FH_BASE_FARE + distance*FH_KM_FARE;
			fh_calc();
			if($('#house_cleaning').is(':checked')) {
				fh_cost += HOUSE_CLEANING;
			}
			if($('#interior_decorator').is(':checked')) {
				fh_cost += INTERIOR_DECORATOR;
			}
			$('#fh_cost').text(Math.ceil(fh_cost).toLocaleString());
			write_quote();
		});
*/
		/**
		 * Write Quotation
		 */
		$('#addons_proceed').click(function(event) {
			write_quote();
		});
		var write_quote = function() {
			if($('#pickup_radio').is(':checked')) {
		   		
		   		//unhide base charge label
		   		$('#base_charge_label').removeClass('hidden');

		   		//populate base charge value
		   		$('#base_charge_cost').text((PICKUP_BASE_FARE + PICKUP_HELPERS*HELPER_CHARGE + LITTLE_PACK).toLocaleString() + " /=");

		   		//unhide distance charge label
		   		$('#distance_charge_label').removeClass('hidden');

		   		//populate distance charge value
		   		$('#distance_charge_cost').text(Math.ceil(PICKUP_KM_FARE*$('#distance').val()).toLocaleString() + " /=");	   		

		   		/**if($('#pickup_packaging').val() != "") {
		   			//show packaging
		   			$('#packaging_label').removeClass('hidden');
		   			if($('#pickup_packaging').val() === "little") {
		   				$('#packaging_cost').text(LITTLE_PACK.toLocaleString() + " /=");;
		   			} else if($('#pickup_packaging').val() === "normal") {
		   				$('#packaging_cost').text(NORMAL_PACK.toLocaleString() + " /=");;
		   			} else if($('#pickup_packaging').val() === "big") {
		   				$('#packaging_cost').text(BIG_PACK.toLocaleString() + " /=");;
		   			} else if($('#pickup_packaging').val() === "jumbo") {
		   				$('#packaging_cost').text(JUMBO_PACK.toLocaleString() + " /=");;
		   			} else {} 
		   		} */
		   		//show <hr>
		   		$('#label_hr').removeClass('hidden');
		   		$('#values_hr').removeClass('hidden');

		   		//show email option
		   		$('#mail_to_self').removeClass('hidden');

		   		//show total cost
		   		$('#subtotal_label').removeClass('hidden');

		   		
		   		$('#subtotal').text($('#pickup_cost').text() + " /=");
		   		
		   	}

		   	//canter
		   	if($('#canter_radio').is(':checked')) {
		   		
		   		//unhide base charge label
		   		$('#base_charge_label').removeClass('hidden');

		   		//populate base charge value
		   		$('#base_charge_cost').text((CANTER_BASE_FARE + CANTER_HELPERS*HELPER_CHARGE + NORMAL_PACK).toLocaleString() + " /=");

		   		//unhide distance charge label
		   		$('#distance_charge_label').removeClass('hidden');

		   		//populate distance charge value
		   		$('#distance_charge_cost').text(Math.ceil(CANTER_KM_FARE*$('#distance').val()).toLocaleString() + " /=");

		   		/**
		   		if($('#canter_loaders').val() > 0) {
		   			//unhide loaders label
		   			$('#loaders_label').removeClass('hidden');

		   			if($('#floor').val() === "ground") {
		   				var loaders_cost = HELPER_GROUND*$('#canter_loaders').val();
		   				$('#loaders_cost').text(loaders_cost.toLocaleString() + " /=");;
		   			} else {
		   				var loaders_cost = HELPER_NOT_GROUND*$('#canter_loaders').val();
		   				$('#loaders_cost').text(loaders_cost.toLocaleString() + " /=");
		   			}
		   			
		   		} **/
		   		/**
		   		if($('#canter_packaging').val() != "") {
		   			//show packaging
		   			$('#packaging_label').removeClass('hidden');
		   			if($('#canter_packaging').val() === "little") {
		   				$('#packaging_cost').text(LITTLE_PACK.toLocaleString() + " /=");;
		   			} else if($('#canter_packaging').val() === "normal") {
		   				$('#packaging_cost').text(NORMAL_PACK.toLocaleString() + " /=");;
		   			} else if($('#canter_packaging').val() === "big") {
		   				$('#packaging_cost').text(BIG_PACK.toLocaleString() + " /=");;
		   			} else if($('#canter_packaging').val() === "jumbo") {
		   				$('#packaging_cost').text(JUMBO_PACK.toLocaleString() + " /=");;
		   			} else {} 
		   		} **/

		   		//show <hr>
		   		$('#label_hr').removeClass('hidden');
		   		$('#values_hr').removeClass('hidden');

		   		//show total cost
		   		$('#subtotal_label').removeClass('hidden');

		   		//show email option
		   		$('#mail_to_self').removeClass('hidden');

		   		
		   		$('#subtotal').text($('#canter_cost').text() + " /=");		
		   	}

		   	//fh 

	   		if($('#fh_radio').is(':checked')) {
	   		
	   		//unhide base charge label
	   		$('#base_charge_label').removeClass('hidden');

	   		//populate base charge value
	   		$('#base_charge_cost').text((FH_BASE_FARE + FH_HELPERS*HELPER_CHARGE + BIG_PACK).toLocaleString() + " /=");

	   		//unhide distance charge label
	   		$('#distance_charge_label').removeClass('hidden');

	   		//populate distance charge value
	   		$('#distance_charge_cost').text(Math.ceil(FH_KM_FARE*$('#distance').val()).toLocaleString() + " /=");

	   		if($('#fh_loaders').val() > 0) {
	   			//unhide loaders label
	   			$('#loaders_label').removeClass('hidden');

	   			if($('#floor').val() === "ground") {
	   				var loaders_cost = HELPER_GROUND*$('#fh_loaders').val();
	   				$('#loaders_cost').text(loaders_cost.toLocaleString() + " /=");;
	   			} else {
	   				var loaders_cost = HELPER_NOT_GROUND*$('#fh_loaders').val();
	   				$('#loaders_cost').text(loaders_cost.toLocaleString() + " /=");
	   			}
	   			
	   		}
	   		/**
	   		if($('#fh_packaging').val() != "") {
	   			//show packaging
	   			$('#packaging_label').removeClass('hidden');
	   			if($('#fh_packaging').val() === "little") {
	   				$('#packaging_cost').text(LITTLE_PACK.toLocaleString() + " /=");;
	   			} else if($('#fh_packaging').val() === "normal") {
	   				$('#packaging_cost').text(NORMAL_PACK.toLocaleString() + " /=");;
	   			} else if($('#fh_packaging').val() === "big") {
	   				$('#packaging_cost').text(BIG_PACK.toLocaleString() + " /=");;
	   			} else if($('#fh_packaging').val() === "jumbo") {
	   				$('#packaging_cost').text(JUMBO_PACK.toLocaleString() + " /=");;
	   			} else {} 
	   		}
			**/
	   		//show <hr>
	   		$('#label_hr').removeClass('hidden');
	   		$('#values_hr').removeClass('hidden');

	   		//show email option
		   	$('#mail_to_self').removeClass('hidden');

	   		//show total cost
	   		$('#subtotal_label').removeClass('hidden');

	   		
	   		$('#subtotal').text($('#fh_cost').text() + " /=");		
	   	}

		};
});
