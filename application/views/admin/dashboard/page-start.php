<?php $this->load->view('common/header', array('alt_logo'=>trye)); ?>
<div id="page-dashboard" class="panel page page-dashboard">
	<header class="header">
		<h2 class="heading">Dashboard</h2>
	</header>
	<section class="content">
		
	</section>
</div>
<?php global $app_scripts; if(!is_array($app_scripts)) $app_scripts=array(); ?>
<?php $app_scripts['panel-page-component']='js/app/components/panel-page.js'; ?>
<?php $app_scripts['admin-panel-page-view']='js/app/views/admin-panel-page.js'; ?>
<?php $this->load->view('common/footer', array('no_footer'=>true)); ?>