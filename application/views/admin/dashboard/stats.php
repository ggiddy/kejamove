<div class="col-md-10">
	<center>
	<div class="row stats-row table-responsive">
		<h3 class="left"><b>Welcome to KejaMove Dashboard <i class="fa fa-check-circle"></i></b></h3>
		<hr class="divider">
		<?=form_open(base_url('admin/filterreports'),array('class' => 'form-inline left', 'role' => 'form','id' => 'filter-reporting-form'));?>
		<div class="form-group">
			<label>From: </label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input type="date" name="startdate" class="form-control" placeholder="Enter start date">
			</div>
		</div>
		<div class="form-group">
			<label>To: </label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				<input type="date" name="enddate" class="form-control" placeholder="Enter end date">
			</div>
		</div>
		<div class="form-group">
			<button class="btn btn-primary btn-lg btn-color">Filter Reports</button>
		</div>
		<?=form_close();?>
		<hr class="divider">
		<p class=""><a href="#conversion-rate">See Conversion Rate <i class="fa fa-arrow-circle-down"></i></a></p>
		<hr class="divider">
		<div class="col-md-12">
			<div class="shadow" id="requests"></div>
		</div>
		<span class="clearfix"></span>
		<hr class="divider">
		<h3><b>Conversion Rate <i class="fa fa-check-circle"></i></b></h3>
		<hr class="divider">
		<div id="conversion-rate" class="conversion-rate">
			<?=$data['c_rate'];?>%
		</div>
		<hr class="divider">
	</div>
	</center>
</div>
<script type="text/javascript">
new Morris.Line({
// ID of the element in which to draw the chart.
element: 'requests',
// Chart data records -- each entry in this array corresponds to a point on
// the chart.
data: [
{ year: 'All Requests', value: <?=$data['all'];?> },
{ year: 'Scheduled', value: <?=$data['scheduled'];?> },
{ year: 'Completed', value: <?=$data['completed'];?> },
{ year: 'Failed', value: <?=$data['failed'];?> },
],
// The name of the data record attribute that contains x-values.
xkey: 'year',
// A list of names of data record attributes that contain y-values.
ykeys: ['value'],
// Labels for the ykeys -- will be displayed when you hover over the
// chart.
parseTime: false,
labels: ['Value']
});
</script>
<script type="text/javascript">
	var height = $('.stats-row').height();
	$('.aside-menu').css('min-height', height + 'px');
</script>