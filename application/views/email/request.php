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
								<td>Email</td>
								<td>
								<?php 
								if(isset($request['email_address']) && !empty($request['email_address']))
								{
									echo $request['email_address']; 
								} else {
									echo "N/A";
								}
								?>	
								</td>
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
								<td>House Type</td>
								<td>
								<?php
								if($request['vehicle'] == 'pickup')
								{
									echo "1 BDR";
								} else if ($request['vehicle'] == 'canter') {
									echo "2 BDR";
								} else {
									echo "3 BDR";
								}
								?>
								</td>
							</tr>
							
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