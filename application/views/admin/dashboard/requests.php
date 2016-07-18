<div class="col-md-10">
<div class="modal fade" id="modal-request">
	<div class="modal-dialog modal-lg">
		<div  id="request-modal-content" class="modal-content">
		<center>
			<img src="<?=base_url();?>images/gifs/loader.gif">
		</center>
		</div>
	</div>
</div>
	<div class="requests-wrapper">
		<div class="row requests-filter-form shadow">
			<?=form_open(base_url('admin/filterrequests'),array('class' => 'form-inline','role' => 'form','id'=> 'filter-form'));?>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><b><i class="fa fa-phone"></i> Phone</b></span>
					<input onkeyup="filterrequests();" type="tel" name="phone" class="form-control" placeholder="Filter by phone number">
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><b><i class="fa fa-calendar"></i> From</b></span>
					<input onchange="filterrequests();" type="date" name="startdate" class="form-control" placeholder="Filter by date">
				</div>
			</div>
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><b><i class="fa fa-calendar"></i> To</b></span>
					<input onchange="filterrequests();" type="date" name="enddate" class="form-control" placeholder="Filter by date">
				</div>
			</div>
			<div class="form-group">
				<div onclick="filterrequests();" type="submit" class="btn btn-primary btn-filter">Filter Requests</div>
			</div>
			<?=form_close();?>
		</div>
		<div  class="requests-tabs" role="tabpanel">
			<!-- Nav tabs -->
			<ul class="nav nav-tabs" role="tablist">
				<li role="presentation" class="active">
					<a href="#new" aria-controls="new" role="tab" data-toggle="tab"><b>New</b> <span class="badge badge-danger"><?=count($data['new']);?></span></a>
				</li>
				<li role="presentation">
					<a href="#scheduled" aria-controls="scheduled" role="tab" data-toggle="tab"><b>Scheduled</b> <span class="badge badge-warning"><?=count($data['scheduled']);?></span></a>
				</li>
				<li role="presentation">
					<a href="#completed" aria-controls="completed" role="tab" data-toggle="tab"><b>Completed</b> <span class="badge badge-success"><?=count($data['completed']);?></span></a>
				</li>
				<li role="presentation">
					<a href="#failed" aria-controls="tab" role="failed" data-toggle="tab"><b>Failed</b> <span class="badge"><?=count($data['failed']);?></span></a>
				</li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="new">
					<div class="new-requests row">
						<?php if(!empty($data['new'])): foreach($data['new'] as $new):?>
							<div class="col-md-6">
								<div onclick="openModal('<?=$new->id;?>');" id="request-<?=$new->id;?>" class="new-request shadow">
									<div class="col-md-3">	
										<center class="user-avatar">
											<!-- <img src="<?=base_url();?>images/people/avatar.png"> -->
											<!-- <hr class="divider"> -->
											<b><i class="fa fa-phone"></i> <?=$new->phone;?></b>
										</center>
									</div>
									<div class="col-md-9 user-items">
										<ul class="list-unstyled">
											<li class="pull-right"><a href="/admin/removerequest/<?=$new->id;?>" title="Delete permanently?"><i class="fa fa-times danger"></i></a></li>
											<li><i class="fa fa-rocket"></i> <?=$new->moving_from;?> <b>to</b></li>
											<br>
											<li><i class="fa fa-truck"></i> <?=$new->moving_to;?></li>
											<!-- <hr class="divider"> -->
											<!-- <li><i class="fa fa-info-circle"></i>
												<?=substr($new->items,0,30);?><a data-toggle="modal" href="#modal-request">...more</a>
											</li> -->
										</ul>
									</div>
									<span class="clearfix"></span>
								</div>
							</div>

						<?php endforeach; endif;?>
						<span class="clearfix"></span>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="scheduled">
					<div class="new-requests row">
						<?php if(!empty($data['scheduled'])): foreach($data['scheduled'] as $new):?>
							<div class="col-md-6">
								<div onclick="openModal('<?=$new->id;?>');" id="request-<?=$new->id;?>" class="new-request shadow">
									<div class="col-md-3">	
										<center class="user-avatar">
											<!-- <img src="<?=base_url();?>images/people/avatar.png"> -->
											<!-- <hr class="divider"> -->
											<b><i class="fa fa-phone"></i> <?=$new->phone;?></b>
										</center>
									</div>
									<div class="col-md-9 user-items">
										<ul class="list-unstyled">
											<li class="pull-right"><a href="#" title="Delete permanently?"><i class="fa fa-times danger"></i></a></li>
											<li><i class="fa fa-rocket"></i> <?=$new->moving_from;?> <b>to</b></li>
											<br>
											<li><i class="fa fa-truck"></i> <?=$new->moving_to;?></li>
											<!-- <hr class="divider"> -->
											<!-- <li><i class="fa fa-info-circle"></i>
												<?=substr($new->items,0,30);?><a data-toggle="modal" href="#modal-request">...more</a>
											</li> -->
										</ul>
									</div>
									<span class="clearfix"></span>
								</div>
							</div>

						<?php endforeach; endif;?>
						<span class="clearfix"></span>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="completed">
					<div class="new-requests row">
						<?php if(!empty($data['completed'])): foreach($data['completed'] as $new):?>
							<div class="col-md-6">
								<div onclick="openModal('<?=$new->id;?>');" id="request-<?=$new->id;?>" class="new-request shadow">
									<div class="col-md-3">	
										<center class="user-avatar">
											<!-- <img src="<?=base_url();?>images/people/avatar.png"> -->
											<!-- <hr class="divider"> -->
											<b><i class="fa fa-phone"></i> <?=$new->phone;?></b>
										</center>
									</div>
									<div class="col-md-9 user-items">
										<ul class="list-unstyled">
											<li class="pull-right"><a href="#" title="Delete permanently?"><i class="fa fa-times danger"></i></a></li>
											<li><i class="fa fa-rocket"></i> <?=$new->moving_from;?> <b>to</b></li>
											<br>
											<li><i class="fa fa-truck"></i> <?=$new->moving_to;?></li>
											<!-- <hr class="divider"> -->
											<!-- <li><i class="fa fa-info-circle"></i>
												<?=substr($new->items,0,30);?><a data-toggle="modal" href="#modal-request">...more</a>
											</li> -->
										</ul>
									</div>
									<span class="clearfix"></span>
								</div>
							</div>

						<?php endforeach; endif;?>
						<span class="clearfix"></span>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="failed">
					<div class="new-requests row">
						<?php if(!empty($data['failed'])): foreach($data['failed'] as $new):?>
							<div class="col-md-6">
								<div onclick="openModal('<?=$new->id;?>');" id="request-<?=$new->id;?>" class="new-request shadow">
									<div class="col-md-3">	
										<center class="user-avatar">
											<!-- <img src="<?=base_url();?>images/people/avatar.png"> -->
											<!-- <hr class="divider"> -->
											<b><i class="fa fa-phone"></i> <?=$new->phone;?></b>
										</center>
									</div>
									<div class="col-md-9 user-items">
										<ul class="list-unstyled">
											<li class="pull-right"><a href="#" title="Delete permanently?"><i class="fa fa-times danger"></i></a></li>
											<li><i class="fa fa-rocket"></i> <?=$new->moving_from;?> <b>to</b></li>
											<br>
											<li><i class="fa fa-truck"></i> <?=$new->moving_to;?></li>
											<!-- <hr class="divider"> -->
											<!-- <li><i class="fa fa-info-circle"></i>
												<?=substr($new->items,0,30);?><a data-toggle="modal" href="#modal-request">...more</a>
											</li> -->
										</ul>
									</div>
									<span class="clearfix"></span>
								</div>
							</div>

						<?php endforeach; endif;?>
						<span class="clearfix"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var height = $('.requests-wrapper').height();
	if(height > 600)
	{
		$('.aside-menu').css('min-height', height + 'px');
	}
	else
	{
		$('.aside-menu').css('min-height', 600 + 'px');
	}
</script>
