<?php $this->load->view('admin/common/header');?>
<?php $this->load->view('admin/common/navbar');?>
<section class="section login-section">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="login-form-wrapper shadow">
					<center>
						<img class="img-responsive" src="http://www.kejamove.com/images/logos/kejamove-logo-1.png">
					</center>
					<hr class="divider faint-divider">
					<?=form_open(base_url('admin/login'),array('class' => 'form-horizontal login-form','role' => 'form','id' => 'login-form'));?>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon input-group-addon-login"><i class="fa fa-envelope-o"></i></span>
								<input  autocomplete="off" type="email" name="email" placeholder="Enter email address" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon input-group-addon-login"><i class="fa fa-key"></i></span>
								<input type="password" name="password" placeholder="Enter password" class="form-control" required>
							</div>
						</div>
						<div class="form-group">
							<center>
								<button class="btn btn-primary btn-color btn-lg">Login</button>
							</center>
						</div>
					<?=form_close();?>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
	var height = $('body').height();
	$('.login-section').css('min-height', height + 'px');
</script>
<?php $this->load->view('admin/common/footer');?>