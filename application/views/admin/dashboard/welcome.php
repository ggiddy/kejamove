<?php $this->load->view('admin/common/header'); ?>
<?php $this->load->view('admin/common/navbar');?>
<section class="section">
	<div class="container-fluid">
		<div class="row">
			<?php $this->load->view('admin/dashboard/side-menu');?>
			<?php $this->load->view('admin/dashboard/'.$page,array('data' => $data,'feedback' => $feedback));?>
			<span class="clearfix"></span>
		</div>
	</div>
</section>
<?php $this->load->view('admin/common/footer'); ?>