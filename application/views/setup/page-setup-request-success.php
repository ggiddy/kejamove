<?php $this->load->view('common/header', array('no_header'=>true, 'alt_logo'=>true));?>
<div class="panel page setup request-recieved">
	<header class="header">
		<h2 class="heading">
			<img src="<?php echo base_url('images/icons/green-tick.png'); ?>"/>
			<p>You are done!</p>
			&nbsp;&nbsp;See, we told you it wasn't that much work :-)! 
			<p></p>
			<p>We'll be calling you shortly with a quotation.</p>
		</h2>
	</header>
	<section class="content">
		<div class="container">
			<div class="row text-center action-group">
				<a class="btn btn-primary btn-custom" href="<?php echo base_url("mover/home/$user->id/$request->id");?>">
					<i class="fa fa-check-circle"></i> 
					Proceed <i class="fa fa-angle-right"></i>
				</a>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('common/footer', array('no_footer'=>true));?>