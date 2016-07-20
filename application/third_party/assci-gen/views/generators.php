<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta name="generator" value="ASS-CodeIgniter-COMG"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'application/third_party/assci-gen/assets/css/bootstrap.css'; ?>"/>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'application/third_party/assci-gen/assets/css/styles.css'; ?>"/>
		<script type="text/javascript" src="<?php echo base_url().'application/third_party/assci-gen/assets/js/vendor/jquery.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'application/third_party/assci-gen/assets/js/vendor/bootstrap.js'; ?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'application/third_party/assci-gen/assets/js/vendor/editor.js'; ?>"></script>
		<title>ASS-CodeIgniter Components Generator</title>
	</head>
	<body>
		<div class="row">
			<div class="gpg-header well">
				<div class="col-lg-2">
					<span>
						<img  class="thumbnail" src="<?php echo base_url().'application/third_party/assci-gen/assets/img/logos/assci-gen.jpg';?>"/>
					</span>
				</div>
				<div class="col-lg-8">
				   <div class="gpg-page-header">
						<h3>Generate ASS-CodeIgniter Components</h3>
						<h4>Select a Component to generate</h4>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="gpg-page">
				<div class="gpg-generator-container">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#package" data-toggle="tab">Package</a></li>
						<li><a href="#controller" data-toggle="tab">Controller</a></li>
						<li><a href="#model" data-toggle="tab">Model</a></li>
						<li><a href="#driver" data-toggle="tab">Driver</a></li>
						<li><a href="#library" data-toggle="tab">Library</a></li>
						<li><a href="#helper" data-toggle="tab">Helper</a></li>
					</ul>
					<div class="tab-content">
					    <?php if(isset($message)): ?>
					    	<div class="well">
					    		<span class="alert alert-<?php echo $type ?: 'info'; ?>">
					    			<?php echo $message; ?>
					    		</span>
					    	</div>
					    <?php endif; ?>
						<div id="package" class="tab-pane active">
							<form class="form-horizontal gpg-generator-form" method="POST" action="<?php echo base_url().'index.php/gen/model/'?>">
								<div class="form-header">
								</div>
								<div class="form-content">
									<div class="form-group">
										<label class="control-label col-lg-2">Model Class</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_class" placeholder="model class name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Table</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_table" placeholder="model table name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Base Model Prefix</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="bmodel_prefix" placeholder="base model class prefix"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Output Directory</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_dir" placeholder="model output directory"/>
										</div>
									</div>
									<div class="form-group">
										<div class="controls col-lg-8 col-lg-offset-2">
											<input type="submit" class="form-control btn btn-primary"  name="generate" value="Generate Package"/>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div id="controller" class="tab-pane">
							<form class="form-horizontal gpg-generator-form" method="POST" action="<?php echo base_url().'index.php/gen/model/'?>">
								<div class="form-header">
								</div>
								<div class="form-content">
									<div class="form-group">
										<label class="control-label col-lg-2">Model Class</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_class" placeholder="model class name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Table</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_table" placeholder="model table name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Base Model Prefix</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="bmodel_prefix" placeholder="base model class prefix"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Output Directory</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_dir" placeholder="model output directory"/>
										</div>
									</div>
									<div class="form-group">
										<div class="controls col-lg-8 col-lg-offset-2">
											<input type="submit" class="form-control btn btn-primary"  name="generate" value="Generate Controller"/>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div id="model" class="tab-pane">
							<form class="form-horizontal gpg-generator-form" method="POST" action="<?php echo base_url().'index.php/gen/model/'?>">
								<div class="form-header">
								</div>
								<div class="form-content">
									<div class="form-group">
										<label class="control-label col-lg-2">Model Class</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_class" placeholder="model class name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Table</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_table" placeholder="model table name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Base Model Prefix</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="bmodel_prefix" placeholder="base model class prefix"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Output Directory</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_dir" placeholder="model output directory"/>
										</div>
									</div>
									<div class="form-group">
										<div class="controls col-lg-8 col-lg-offset-2">
											<input type="submit" class="form-control btn btn-primary" name="generate" value="Generate Model"/>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div id="driver" class="tab-pane">
							<form class="form-horizontal gpg-generator-form" method="POST" action="<?php echo base_url().'index.php/gen/model/'?>">
								<div class="form-header">
								</div>
								<div class="form-content">
									<div class="form-group">
										<label class="control-label col-lg-2">Model Class</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_class" placeholder="model class name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Table</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_table" placeholder="model table name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Base Model Prefix</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="bmodel_prefix" placeholder="base model class prefix"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Output Directory</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_dir" placeholder="model output directory"/>
										</div>
									</div>
									<div class="form-group">
										<div class="controls col-lg-8 col-lg-offset-2">
											<input type="submit" class="form-control btn btn-primary"  name="generate" value="Generate Driver"/>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div id="library" class="tab-pane">
							<form class="form-horizontal gpg-generator-form" method="POST" action="<?php echo base_url().'index.php/gen/model/'?>">
								<div class="form-header">
								</div>
								<div class="form-content">
									<div class="form-group">
										<label class="control-label col-lg-2">Model Class</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_class" placeholder="model class name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Table</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_table" placeholder="model table name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Base Model Prefix</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="bmodel_prefix" placeholder="base model class prefix"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Output Directory</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_dir" placeholder="model output directory"/>
										</div>
									</div>
									<div class="form-group">
										<div class="controls col-lg-8 col-lg-offset-2">
											<input type="submit" class="form-control btn btn-primary"  name="generate" value="Generate Library"/>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div id="helper" class="tab-pane">
							<form class="form-horizontal gpg-generator-form" method="POST" action="<?php echo base_url().'index.php/gen/model/'?>">
								<div class="form-header">
								</div>
								<div class="form-content">
									<div class="form-group">
										<label class="control-label col-lg-2">Model Class</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_class" placeholder="model class name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Table</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_table" placeholder="model table name"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Base Model Prefix</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="bmodel_prefix" placeholder="base model class prefix"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-lg-2">Model Output Directory</label>
										<div class="controls col-lg-8">
											<input type="text" class="form-control" name="model_dir" placeholder="model output directory"/>
										</div>
									</div>
									<div class="form-group">
										<div class="controls col-lg-8 col-lg-offset-2">
											<input type="submit" class="form-control btn btn-primary"  name="generate" value="Generate Helper"/>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
