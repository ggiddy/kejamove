	<?php if(!empty($data)): foreach($data as $new):?>
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