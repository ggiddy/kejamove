<?php $this->load->view('common/header'); ?>
<div class="panel">
	<section class="content">
		<div class="master">
			<ul class="menu">
				<?php $this->load->view('admin/dashboard/side-menu'); ?>
				<?php $this->load->view('admin/requests/side-menu'); ?>
				<?php $this->load->view('admin/users/side-menu'); ?>
				<?php //$this->load->view('admin/notifications/side-menu'); ?>
			</ul>
		</div>
		<div class="detail">