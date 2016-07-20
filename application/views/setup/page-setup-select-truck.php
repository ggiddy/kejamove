<?php $this->load->view('common/header');?>
<div class="panel testimonials truck-selection">
<form name="request-form" class="form" method="post" action="<?php echo base_url('setup/process_request/'); ?>" id="details-form">
	<div class="container">
    	<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
        <!-- Wrapper for slides -->
        <ul class="nav nav-pills nav-justified hidden-xs">
            <li id="truckselect" style="border-right: 3px solid #fff;" data-target="#myCarousel" data-slide-to="0" class="active">
            	<a id="truck_anchor" href="#"><strong>1. House Size</strong></a>
            </li>
            <li id="addons" style="border-right: 3px solid #fff;" data-target="#myCarousel" data-slide-to="1">
           		<a id="addons_anchor" href="#"><strong>2. Select Addons</strong></a></li>
            <li id="dispatch" data-target="#myCarousel" data-slide-to="2">
            	<a id="dispatch_anchor" href="#"><strong>3. Dispatch</strong></a>
            </li>
        </ul>
         <ul class="nav nav-pills nav-justified visible-xs">
            <li id="truckselect" style="border-right: 3px solid #fff;" data-target="#myCarousel" data-slide-to="0" class="active">
            	<a id="truck_anchor" href="#"><strong>1. Pick Your Truck</strong></a>
            </li>
            <li id="addons" style="border-right: 3px solid #fff;" data-target="#myCarousel" data-slide-to="1">
           		<a id="addons_anchor" href="#"><strong>2. Select Addons</strong></a></li>
            <li id="dispatch" data-target="#myCarousel" data-slide-to="2">
            	<a id="dispatch_anchor" href="#"><strong>3. Dispatch</strong></a>
            </li>
        </ul>
        <br>
        <hr class="hidden-xs">

        <input type="hidden" name="request_id" value="<?php echo $request->id; ?>">
        <input type="hidden" name="user_id" value="<?php echo $user->id; ?>">
        <input type="hidden" name="floor_from" value="<?php echo $request->floor_from; ?>">
        <input type="hidden" name="floor_to" value="<?php echo $request->floor_to; ?>">
        <input type="hidden" name="distance" id="distance" value="<?php echo (int)$request->distance; ?>">
        <input type="hidden" name="floor" id="floor" value="<?php if($request->floor_from > 0 || $request->floor_to > 0){ echo "notground"; } else{ echo "ground"; } ?>">
        
        <div class="carousel-inner">
            <div class="item active">
            	<div id="pickup_variables" class="row">
					<div class="col-sm-4 limit">
						<div id="vehicleimg" class="vehicle text-center">
						<i>
						<img id="truckimage" src="<?php echo base_url('/images/trucks/one_bedroom.jpg'); ?>">
						</i>
					</div>
					</div>
					<div class="col-sm-4 limit">
						<p class="text-center" style="color: #fd852d;">Comes With: </p>
							<div class="text-center">
								<div class="col-xs-4 col-sm-5 col-md-4">
									<input id="pickup_loaders" class="form-control" type="number" name="pickup_loaders" min="0" max="99">
									<br>
									<small><p>2 Helpers</p></small>
								</div>
								<div class="col-xs-8 col-sm-7 col-md-offset-1 col-md-7">
									<i>
										<img src="<?php echo base_url('/images/trucks/packs.jpg'); ?>">
									</i>
									
									<br>
									<small class="hidden-sm"><p>Packaging Material</p></small>
									<small class="visible-sm"><p>Pkg Material</p></small>
								</div>
							</div>
					</div>
					<div class="col-sm-4 limit">
							<div class="text-center">
								<small>KES. </small><strong id="pickup_cost" style="color: #fd852d; font-size: 20px;"></strong>
								<br>
								<br>
								<input id="pickup_radio" class="hidden" type="radio" name="selected_truck" value="pickup" >
								<button id="select_pickup" style=" border-radius: 0 !important;" type="button" class="btn btn-primary"><strong>Select</strong></button>
							</div>
					</div>
				</div>
				<hr>
				<div class="row" id="canter_variables">
					<div class="col-sm-4 limit">
						<div id="vehicleimg" class="vehicle text-center">
						<img id="truckimage" src="<?php echo base_url('/images/trucks/canter.jpg'); ?>" >
					</div>
					</div>
					<div class="col-sm-4 limit">
						<p class="text-center" style="color: #fd852d;">Comes With: </p>
							<div class="text-center">
								<div class="col-xs-4 col-sm-5 col-md-4">
									<input id="canter_loaders" class="form-control" type="number" name="canter_loaders" min="0" max="99">
									<br>
									<small><p>Helpers</p></small>
								</div>
								<div class="col-xs-8 col-sm-7 col-md-offset-1 col-md-7">
									<i>
										<img src="<?php echo base_url('/images/trucks/packs.jpg'); ?>">
									</i>
									<br>
									<small class="hidden-sm"><p>Packaging Material</p></small>
									<small class="visible-sm"><p>Pkg Material</p></small>
								</div>
							</div>
					</div>
					<div class="col-sm-4 limit">
							<div class="text-center">
								<small>KES.</small><strong id="canter_cost" style="color: #fd852d; font-size: 20px;"></strong>
								<br>
								<br>
								<input id="canter_radio" class="hidden" type="radio" name="selected_truck" value="canter">
								<button id="select_canter" style=" border-radius: 0 !important;" type="button" class="btn btn-primary"><strong>Select</strong></button>
							</div>
					</div>
				</div>
				<hr>
				<div class="row" id="fh_variables">
					<div class="col-sm-4 limit">
						<div id="vehicleimg" class="vehicle text-center">
						<img id="truckimage" src="<?php echo base_url('/images/trucks/fh.jpg'); ?>" >
					</div>
					</div>
					<div class="col-sm-4 limit">
						<p class="text-center" style="color: #fd852d;">Comes With: </p>
							<div class="text-center">
								<div class="col-xs-4 col-sm-5 col-md-4">
									<input id="fh_loaders" class="form-control" type="number" name="fh_loaders" min="0" max="99">
									<br>
									<small><p>Helpers</p></small>
								</div>
								<div class="col-xs-8 col-sm-7 col-md-offset-1 col-md-7">
									<i>
										<img src="<?php echo base_url('/images/trucks/packs.jpg'); ?>">
									</i>
									<br>
									<small class="hidden-sm"><p>Packaging Material</p></small>
									<small class="visible-sm"><p>Pkg Material</p></small>
								</div>
							</div>
					</div>
					<div class="col-sm-4 limit">
							<div class="text-center">
								<small>KES.</small><strong id="fh_cost" style="color: #fd852d; font-size: 20px;"></strong>
								<br>
								<br>
								<input id="fh_radio" class="hidden" type="radio" name="selected_truck" value="fh" >
								<button id="select_fh" style=" border-radius: 0 !important;" type="button" class="btn btn-primary"><strong>Select</strong></button>
							</div>
					</div>
				</div>
            </div>
            <br>
            <!-- End Item -->
            <div class="item" id="addon_selection">
                <div class="row text-center">
					<div class="col-sm-4 limit">
						<div class="checkbox">
					        <label>
					            <input id="house_cleaning" name="house_cleaning" type="checkbox" class="form-control"><span style="padding-left: 2em"> House Cleaning</span>
					        </label>
				    	</div>
					</div>
					<div class="col-sm-4 limit">
							<div class="text-center">
								<p>We've partnered with hired help to get you full cleaning of your house at <span style="color: #fd852d;">50% off</span>.</p>
							</div>
					</div>
					<div class="col-sm-4 limit">
							<div class="text-center">
								<small>KES.</small><span style="color: #fd852d; font-size: 20px;"> 2,000</span>
								<br>
								<br>
							</div>
					</div>
				</div>
				<hr>
				<div class="row text-center">
					<div class="col-sm-4 limit">
						<div class="checkbox">
					        <label>
					            <input id="interior_decorator" name="interior_decorator" type="checkbox" class="form-control"><span style="padding-left: 1em"> Interior Decorator</span>
					        </label>
				    	</div>
					</div>
					<div class="col-sm-4 limit">
							<div class="text-center">
								<p><span>Want to make your home look stylish?</span></p>
								<p><span>Get an interior designer to advise on arrangement and decoration.</span></p>
							</div>
					</div>
					<div class="col-sm-4 limit">
							<div class="text-center">
								<small>KES.</small><span style="color: #fd852d; font-size: 20px;"> 2,000</span>
								<br>
								<br>
							</div>
					</div>
				</div>
				<br>
				<hr>
				<div class="row text-center">
					<div class="col-sm-offset-4 col-sm-4">
						<button id="addons_proceed" style=" border-radius: 0 !important;" type="button" class="btn btn-lg btn-warning"><strong>Proceed</strong></button>
					</div>
					
				</div>
            </div>
            <!-- End Item -->

            <div class="item">
                <div class="row vertical-divider">	
                	<div class="col-xs-12 col-sm-5">
                		<div class="col-xs-8">
                			<p><small id="base_charge_label" class="hidden">Base Charge</small></p>
                			<p><small id="distance_charge_label" class="hidden">Distance Charge</small></p>
                			<p><small id="loaders_label" class="hidden">Helpers</small></p>
                			<p><small id="packaging_label" class="hidden">Packaging Material</small></p>
                			<p><small id="cleaning_label" class="hidden">House Cleaning</small></p>
                			<p><small id="decorator_label" class="hidden">Interior Decorator</small></p>
                			<hr id="label_hr" style="max-width: 150px;" class="hidden">
                			<p><strong><small id="subtotal_label" class="hidden">Subtotal:</small></strong></p>
                		</div>
                		<div class="col-xs-4">
                			<p><small id="base_charge_cost"></small><p>
                			<p><small id="distance_charge_cost"></small><p>
                			<p><small id="loaders_cost"></small><p>
                			<p><small id="packaging_cost"></small><p>
                			<p><small id="cleaning_cost"></small><p>
                			<p><small id="decorator_cost"></small><p>
                			<hr id="values_hr" style="max-width: 70px;" class="hidden">
                			<p><strong><small id="subtotal"></small></strong></p>
                		</div>
                		<br>
                		<div id="mail_to_self" class="checkbox hidden">
					        <label>
					            <input id="email_quote" name="email_quote" type="checkbox" class="form-control"><strong style="padding-left: 2em"> Mail this to myself</strong><br><br>
					        </label>
					        <input id="email_txt" type="email" name="client_email" class="form-control text-center hidden" placeholder="email address">
				    	</div>
                	</div>
                	<div class="col-xs-12 col-sm-7">
                		<ol>
                			<li>Go to M-PESA on your phone</li>
                			<li>Select Buy Goods option</li>
                			<li>Enter Till No.<strong><span style="color: #fd852d;">871400</span></strong></li>
                			<li>Enter M-PESA PIN and send</li>
                			<li>You will receive a confirmation SMS from M-PESA</li>
                			<li>Enter the confirmation code below</li>
                		</ol>
                		<div class="col-xs-12 col-sm-8 col-md-7">
                			<input style="text-transform: uppercase;"  type="text" name="confirmation_code" class="form-control" placeholder="M-PESA Code" required minlength="10">
                		</div>
                		<div class="col-xs-12 col-sm-4 col-md-5">
                			<button style="border-radius: 0px !important;" type="submit" class="btn btn-lg btn-warning"><strong>Proceed</strong></button>
                		</div>
                		
                	</div>
                </div>
            </div>
            <!-- End Item -->
        </div>
        <!-- End Carousel Inner -->
        
    </div>
    <!-- End Carousel -->
</div>
</form>
</div>

<script>

</script>

<?php global $app_scripts; if(!is_array($app_scripts)) $app_scripts=array(); ?>
<?php $app_scripts['select-truck-carousel']='js/app/views/select-truck-carousel.js'; ?>
<?php $app_scripts['flip-panels-component']='js/app/components/flip-panels.js'; ?>
<?php $app_scripts['start-page-flip-panels-view']='js/app/views/start-page-flip-panels.js'; ?>
<?php $app_scripts['start-page-testimonials-view']='js/app/views/start-page-testimonials.js'; ?>
<?php $app_scripts['page-setup-select-truck']='js/app/views/moving-options.js'; ?>
<?php $this->load->view('common/footer');?>

