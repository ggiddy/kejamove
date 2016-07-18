<?php $this->load->view('common/header', array('alt_logo'=>true)); ?>
<div class="page-onboarding page-onboarding-start">
	<section id="move-map" class="page-section">
		<div data-fromplace="<?php echo $request->moving_from; ?>" data-toplace="<?php echo $request->moving_to; ?>" id="move-route-gmap" class="row move-gmap" style="min-height: 250px;"></div>
	</section>

	<section class="section how">
	<div class="container">
		<div class="row">
			 <h2 class="section-heading section-how"><span>How it works</span></h2>
			<div class="col-md-4 col-sm-6 col-xs-12 card-wrapper">
				<div class="card-holder">
					<center>
						<div class="card-step">
							<h1>1</h1>
						</div>
					</center>
					<div class="card-content">
						<h3>We clean the new place</h3>
						<p>(A day before the Move - optional)</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 card-wrapper">
				<div class="card-holder">
					<center>
						<div class="card-step">
							<h1>2</h1>
						</div>
					</center>
					<div class="card-content">
						<h3>Visit your old place</h3>
						<p>(On the day of the move)</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 card-wrapper">
				<div class="card-holder">
					<center>
						<div class="card-step">
							<h1>3</h1>
						</div>
					</center>
					<div class="card-content">
						<h3>Pack, wrap and load your stuff</h3>
						<p>(Mark items and create a checklist)</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 card-wrapper">
				<div class="card-holder">
					<center>
						<div class="card-step">
							<h1>4</h1>
						</div>
					</center>
					<div class="card-content">
						<h3>Travel to the new place</h3>
						<p>(In our truck)</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 card-wrapper">
				<div class="card-holder">
					<center>
						<div class="card-step">
							<h1>5</h1>
						</div>
					</center>
					<div class="card-content">
						<h3>Unload, unwrap and unpack</h3>
						<p>(Confirm the checklist)</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 col-sm-6 col-xs-12 card-wrapper">
				<div class="card-holder">
					<center>
						<div class="card-step">
							<h1>6</h1>
						</div>
					</center>
					<div class="card-content">
						<h3>Arrange the new place</h3>
						<p>(We toast to that :-)</p>
					</div>
				</div>
			</div>
			<span class="clearfix"></span>
		</div>
	</div>
</section>

	<section id="route-estimates" class="page-section route-estimates animated fadeInUp">
		<div class="container">
			<h2 class="section-heading small-heading"><span>Your estimate</span></h2>
			<div class="row">
				<div id="distance-metrics" class="col-md-12 col-sm-12 col-xs-12 distance-metrics text-center">
					<h2 class="small-heading">Moving from</h2>
					<div class="row">
						<div id="route-terminals" class="terminals">
							<ul class="list-unstyled list-inline">
							  <li>
							     <span class="from">
									<?php echo ucwords(strtolower($request->moving_from)); ?>
								 </span>
							  </li>
							  <li>
								&nbsp;&nbsp;&nbsp;
								<span class="connector">To</span>
								&nbsp;&nbsp;&nbsp;
							  </li>
							  <li>
							  	<span class="to">
									<?php echo ucwords(strtolower($request->moving_to)); ?>
								</span>
							  </li>
							</ul>
						</div>
						<div id="route-distance" class="distance">
							<span class="length">
								<span class="value">0</span><span class="unit">Km</span>	
							</span>
						</div>
					</div>
				</div>
				<span class="clearfix"></span>
			</div>
			<span class="clearfix"></span>
		</div>
		<span class="clearfix"></span>
	</section>
	<span class="clearfix"></span>
	<section id="social-share" class="page-section social-share animated fadeInUp">
		<div class="container">
			<h2 class="section-heading small-heading">&nbsp;&nbsp;</h2>
		  <div class="row">
			    <div class="col-md-7 col-md-offset-1 col-sm-6 col-sm-offset-2 col-xs-12">
					<div class="row message">
						<p>I am using KejaMove to move to my new house!</p>
					</div>
					<div class="row">
						<span class="footnote pull-right">Share this and Lunch will be on us when you move!</span>
						<span class="clearfix"></span>
					</div>
					<span class="clearfix"></span>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-12 social-links">
					<ul class="list-unstyled">
						<li>
							<div class="fb-share-button" data-href="http://www.kejamove.com" data-layout="button_count"></div>
						</li>
						<li>
							<?php $this->load->view('common/tweet');?>
						</li>
					</ul>
				</div>
				<span class="clearfix"></span>
		  </div>
		</div>
	</section>
	<span class="clearfix"></span>
</div>
<?php global $app_scripts; if(!is_array($app_scripts)) $app_scripts=array(); ?>
<?php $app_scripts['mover-request-view']='js/app/views/mover-request.js'; ?>
<?php $this->load->view('common/footer'); ?>