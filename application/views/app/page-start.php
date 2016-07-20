<?php $this->load->view('common/header', array('body_class'=>'start-page'));?>
<div class="panel page start-page">
	<section class="content">
		<div id="start-page-flip-panels-view" class="panel flip-panels">
		    <div class="bg-overlay"></div>
			<section class="content">
				<div id="start-hero-panel" class="flip-panel<?php if(!isset($message)): ?> active<?php endif; ?>">
					<div class="panel hero hero-welcome">
						<section class="content">
							<div class="container">
								<div class="row">
									<center>
										<div class="hero-title">
											<h1>Moving has never been easier</h1>
										</div>
										<div class="hero-actions">
											<button data-target="#setup-request-form-panel" class="btn btn-lg btn-primary col-md-2 col-md-offset-5 col-xs-8 col-xs-offset-2 btn-color btn-flip">
												Get a free quote
											</button>
										</div>
									</center>
								</div>
							</div>
						</section>
					</div>
				</div>
				<div id="setup-request-form-panel" class="flip-panel<?php if(isset($message)): ?> active<?php endif; ?>">
					<?php $this->load->view('setup/part-setup-request-form'); ?>
				</div>
			</section>
		</div> 
		<div class="panel testimonials testimonial">
			<section class="content">
				<div class="container">
					<div class="row">
						<div id="start-page-testimonials-view" class="carousel slide">
							<div class="carousel-inner">
								<div class="item active">
									<div class="col-md-3 text-center">
										<div class="testimonial-person">
											<img src="<?=base_url();?>images/people/testimonials/bett.jpg">
										</div>
									</div>
									<div class="col-md-9 testimonial-body">
										<p class="">
											"Very punctual, and very efficient. Great staff who are very polite and 
											professional. I was settled at the new house in record time and with AMAZING 
											convenience. The team is fully of energy and enthusiasm. I was impressed by 
											their expertise in moving furniture even around tricky spaces.
											That is excellent customer service"
										</p>
										<p class="pull-right">
											- Bett.
										</p>
									</div>
								</div>
								<div class="item">
									<div class="col-md-3 text-center">
										<div class="testimonial-person">
											<img src="<?=base_url();?>images/people/testimonials/beverly.jpg">
										</div>
									</div>
									<div class="col-md-9 testimonial-body">
										<p class="">
											"In 4 hours things were packed in my old house, 
											 moved to the new house, the house was spotless at the time everything was at its place. All I 
											 had to do is make my bed. And that is because I chose to move with KejaMove"
										</p>
										<p class="pull-right">
											- Beverly Mbeke.
										</p>
									</div>
								</div>
								<div class="item">
									<div class="col-md-3 text-center">
										<div class="testimonial-person">
											<img src="<?=base_url();?>images/people/testimonials/judy.jpg">
										</div>
									</div>
									<div class="col-md-9 testimonial-body">
										<p class="">
											"This team is amazing, they take their time to make sure that when you 
											move everything goes smoothly. Trust me even the most complicated furniture 
											they fixed perfectly without a manual. Thanks Brian and team I surely recommend 
											kejamove."
										</p>
										<p class="pull-right">
											- Judy Mwangi.
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</section>
</div>

<?php global $app_scripts; if(!is_array($app_scripts)) $app_scripts=array(); ?>
<?php $app_scripts['flip-panels-component']='js/app/components/flip-panels.js'; ?>
<?php $app_scripts['start-page-flip-panels-view']='js/app/views/start-page-flip-panels.js'; ?>
<?php $app_scripts['start-page-testimonials-view']='js/app/views/start-page-testimonials.js'; ?>
<?php $this->load->view('common/footer');?>