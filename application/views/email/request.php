<?php $this->load->view('email/header'); ?>
<td align="left" valign="top">
	<table style="position:relative; width: 100%; background-color:white;">
		<tr>
			<td>
				<p>
					<p class="resize-header" style="padding-left: 80px; font-family:Arial, sans-serif; font-size: 18px; color:#898989;">
						New Move Request
					</p>
					<p style="padding-left: 100px; font-family:Helvetica, Arial, sans-serif; font-size: 16px; color:#898989;">
						<table>
							<tr>
								<td>Fullname</td>
								<td>N/A</td>
							</tr>
							<tr>
								<td>Email</td>
								<td>N/A</td>
							</tr>
							<tr>
								<td>Phone</td>
								<td><?php echo $request['phone']; ?></td>
							</tr>
							<tr>
								<td>Request Date</td>
								<td><?php echo date('M-d-Y H:i:s', $request['created']); ?></td>
							</tr>
							<!--<tr>
								<td><strong>Moving Date</strong></td>
								<td><?php echo date('M-d-Y H:i:s', $request['pickuptime']); ?></td>
							</tr>-->
							<tr>
								<td>Moving From</td>
								<td><?php echo $request['moving_from'];; ?></td>
							</tr>
							<tr>
								<td>Moving To</td>
								<td><?php echo $request['moving_to']; ?></td>
							</tr>
							<tr>
								<td>Distance</td>
								<td><?php echo $request['distance'] ." Km"; ?></td>
							</tr>
							<tr>
								<td>Vehicle</td>
								<td>
								<?php echo ucfirst($request['vehicle']); ?>
								</td>
							</tr>
							<tr>
								<td>Source Floor</td>
								<td><?php 
									if($request['floor_from'] == 1) {
										echo ucfirst($request['floor_from']) ."<sup>st</sup> floor";
									} else if($request['floor_from'] == 2) {
										echo ucfirst($request['floor_from']) ."<sup>nd</sup> floor";
									} else if($request['floor_from'] == 3) {
										echo ucfirst($request['floor_from']) ."<sup>rd</sup> floor";
									} else if($request['floor_from'] == 0) {
										echo ucfirst("Ground floor");
									}
									else {
										echo ucfirst($request['floor_from']) ."<sup>th</sup> floor";
									}
									 

									?></td>
							</tr>
							<tr>
								<td>Destination Floor</td>
								<td><?php 
									if($request['floor_to'] == 0) {
										echo ucfirst("Ground floor");
									} else if($request['floor_to'] == 1) {
										echo ucfirst($request['floor_to']) ."<sup>st</sup> floor";
									} else if($request['floor_to'] == 2) {
										echo ucfirst($request['floor_to']) ."<sup>nd</sup> floor";
									} else if($request['floor_to'] == 3) {
										echo ucfirst($request['floor_to']) ."<sup>rd</sup> floor";
									} else {
										echo ucfirst($request['floor_to']) ."<sup>th</sup> floor";
									}
								?></td>
							</tr>
							<tr>
								<td>Helpers</td>
								<td><?php if(!empty($request['helpers'])){ echo $request['helpers'];} else { echo "N/A";} ?></td>
							</tr>
							<tr>
								<td>Packaging Material</td>
								<td><?php if(!empty($request['packaging'])){ echo ucfirst($request['packaging']) ." pack";} else { echo "N/A";} ?></td>
							</tr>
							<br/>
							<tr></tr>
							<tr>
								<td><strong>Total Cost</strong></td>
								<td><strong><?php echo "KES. ".number_format($request['totalcost']); ?></strong></td>
							</tr>
						</table>
					</p>
				</p>
			</td>
		</tr>
	</table>
	<!--
	<table style="margin-left: 50px;">
		<thead>
			<tr>
				<th>Items to Ship</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($request->get_items() as $item=>$quantity): ?>
				<tr>
					<td>
						<?php echo strtolower($quantity); ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<table class="margin-left: 60px;">
		<tr>
			<th>
				Location Details
			</th>
		</tr>
	</table>
	<table>
		<tr>
			<th>Origin Street/Town/Place</th>
			<td><?php echo $request->moving_from; ?></td>
		<?php if($floor=$request->get_info('moving_from_apartment_floor')): ?>
			<th>Moving from apartment floor</th>
			<td><?php echo $floor; ?></td>
		<?php endif; ?>
		</tr>
	</table>
	<table>
		<tr>
			<th>Destination Street/Town/Place</th>
			<td><?php echo $request->moving_to; ?></td>
			<?php if($floor=$request->get_info('moving_to_apartment_floor')): ?>
				<th>Moving to apartment floor</th>
				<td><?php echo $floor; ?></td>
			<?php endif; ?>
		</tr>
	</table>

	-->

	<?php if(isset($ua)): ?>
		<table>
			<tr>
				<th>Browser Env</th>
				<td><?php echo $ua; ?></td>
			</tr>
		</table>
	<?php endif; ?>
</td>
<?php $this->load->view('email/footer'); ?>