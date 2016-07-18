<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Admin Dashboard</title>
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?=base_url();?>files/css/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>files/plugins/owl/owl.carousel.css">		
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>files/plugins/owl/owl.theme.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>files/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>files/css/kejamove-admin.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>files/css/animate.min.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>files/css/kejamove-responsive.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url();?>files/css/morris.css">
		<script src="<?=base_url();?>files/js/jquery/jquery.js"></script>
		<script src="<?=base_url();?>files/js/raphael-min.js"></script>
		<script src="<?=base_url();?>files/js/morris.min.js"></script>		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

		<?php 
			if($this->dashboard->isspot())
			{
				$this->load->view('admin/dashboard/spotIM');
			}
		?>
		
	</head>
	<body>
	