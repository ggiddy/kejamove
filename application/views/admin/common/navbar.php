<nav class="navbar navbar-default navbar-fixed-top shadow" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Kejamove</a>
		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if($this->dashboard->isadmin()):?>
					<li><a href="/admin">Stats</a></li>
					<li><a href="/admin/index/requests">Requests</a></li>
				<?php endif;?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<?php if($this->dashboard->isadmin()):?>
							<li><a href="<?=base_url('admin/logout');?>">Logout</a></li>
						<?php else:?>
							<li><a href="<?=base_url('admin/login');?>">Login</a></li>
						<?php endif;?>		
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>