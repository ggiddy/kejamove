<?php $this->load->view('email/header'); ?>
<td align="left" valign="top">
	<table style="position:relative; width: 100%; background-color:white;">
		<tr>
			<td>
				<p>
					<p class="resize-header" style="padding-left: 80px; font-family:Arial, sans-serif; font-size: 18px; color:#898989;">
						Move Quotation
					</p>
					<p style="padding-left: 100px; font-family:Helvetica, Arial, sans-serif; font-size: 16px; color:#898989;">
						<table>
		                    <tr>
								<td>Moving From</td>
								<td><?php echo $request['moving_from']; ?></td>
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
								<td>Request Date</td>
								<td><?php echo date('M-d-Y H:i:s', $request['created']); ?></td>
							</tr>
							<tr>
								<td>Base Charge</td>
								<td><?php echo number_format($request['base_charge']) . "/="; ?></td>
							</tr>

							<tr>
								<td>Distance Charge</td>
								<td><?php echo number_format($request['distance_charge']) . "/="; ?></td>
							</tr>
							<tr>
								<td>House Cleaning</td>
								<td>
								<?php
									if($request['house_cleaning'] === 1)
									{
										echo number_format(HOUSE_CLEANING) . "/="; 
									} else {
										echo "N/A";
									}
								?>	
								</td>
							</tr>
							<tr>
								<td>Interior Decorator</td>
								<td>
								<?php
								if($request['interior_decorator'] === 1)
								{
									echo number_format(INTERIOR_DECORATOR) . "/="; 
								} else {
									echo "N/A";
								} 
								?>
								</td>
							</tr>
							
							<tr>
								<td><b>Subtotal</b></td>
								<td><b><?php echo number_format($request['subtotal']) . "/="; ?></b></td>
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

