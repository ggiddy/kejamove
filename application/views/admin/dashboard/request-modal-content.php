			<?php $user = $this->dashboard->getuser($data->users);?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
				<h4 class="modal-title"><b>Move Request</b></h4>
			</div>
			<div class="modal-body">
				<div class="col-md-8">
					<div class="media modal-media">
						<a class="pull-left" href="#">
							<img class="media-object img-responsive modal-media-object" src="<?=base_url();?>images/people/avatar.png" alt="Image">
						</a>
						<div class="media-body">
							<h4 class="media-heading"><i class="fa fa-phone"></i> <?=$user->phone;?></h4>
							<hr class="divider">
							<ul class="list-unstyled">
								<li><i class="fa fa-rocket"></i> <?=$data->moving_from;?></li>
								<br>
								<li><i class="fa fa-truck"></i> <?=$data->moving_to;?></li>
								<hr class="divider">
								<li><i class="fa fa-info-circle"></i> <?=substr($data->items,0,600);?> <a href="#more-items" data-toggle="collapse">..see more</a>
								<div id="more-items" class="collapse">
									<?=substr('',601,1000);?>
								</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<hr class="hidden-lg divider">
 					<?=form_open(base_url('admin/updaterequest/'.$data->id.'/'.$user->id),array('class' => 'form-horizontal modal-form','role' => 'form','id' => 'update-form'));?>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-info-circle"></i></span>
								<select class="form-control" name="status">
									<option value="<?=$data->status;?>"><?=$data->status;?></option>
									<option value="Scheduled">Scheduled</option>
									<option value="Completed">Completed</option>
									<option value="Failed">Failed</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-phone"></i></span>
								<input class="form-control" type="tel" name="phone" required value="<?=$user->phone;?>" placeholder="Update users phone number">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-envelope-o"></i></span>
								<input class="form-control" type="email" name="email" required value="<?=$user->email;?>" placeholder="Update users email address">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-user"></i></span>
								<input class="form-control" type="text" name="name" required value="<?=$user->firstname;?>" placeholder="Update username">
							</div>
						</div>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-money"></i></span>
								<input class="form-control" type="number" name="cost" required value="<?=$data->cost;?>" placeholder="Enter Cost">
							</div>
						</div>
						<div class="form-group">
							<div onclick="updaterequest('<?=$data->id;?>','<?=$user->id;?>');" class="btn btn-primary col-md-12">Update</div>
							<span class="clearfix"></span>
						</div>
					<?=form_close();?>
				</div>
				<span class="clearfix"></span>
				<div class="cost-estimation text-center">
					<!-- <h4><b>Cost Estimate</b></h4> -->
					<hr class="divider">
					<center>
						<div class="cost">
							Ksh <?=number_format($data->cost,0);?>
						</div>
					</center>
				</div>
				<hr class="divider">
				<div class="spot-im-frame-inpage" data-post-id="post-<?=$data->id;?>"></div>
			</div>
			<div class="modal-footer-custom">
				<?=$data->status;?> <span class="pull-right"><a href="/admin/removerequest/<?=$data->id;?>" title="Delete Permanently">Delete <i class="fa fa-times"></i></a></span>
			</div>