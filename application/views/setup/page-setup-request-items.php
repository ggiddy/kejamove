<?php $this->load->view('common/header', array('no_header'=>true, 'alt_logo'=>true)); ?>
<div class="panel page setup request-items">
	<header class="header">
		<a data-toggle="collapse" href="#selectItems"><h1 class="heading">Just one more thing, what items are you moving?</h1></a>
	</header>
	<section class="content" id="selectItems">
		<div id="setup-request-items-inventory-form-view" class="panel item-inventory-form">
			<section class="content">
				<div class="container text-center">
					<form class="form" method="post" action="<?php echo base_url("setup/items/$user->id/$request->id"); ?>">
						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="couches/sofas 3 seater" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[couchesandthreeseatersofas]" value="1 couches/sofas 3 seater"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/sofa_3_seater.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Couches/Sofa 3 Seater" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="sofa 2 seater" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[sofatwoseater]" value="1 sofa 2 seater"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/sofa_2_seater.png'); ?>"/> 
								  <input  class="item-detail item-title" type="text"value="Sofa 2 Seater" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="sofa single seater" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[sofaoneseater]" value="1 sofa single seater"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/sofa_1_seater.png'); ?>"/> 
								  <input class="item-detail item-title" type="text"value="Sofa Single Seater" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0"/>
								</label>
							</div>
							<span class="clearfix"></span>
						</div>
						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="wall unit/display cabinet" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[displaycabinet]" value="1 wall unit/display cabinet)"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/tv_cabinet.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Wall Unit/Display Cabinet" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="book shelf" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[bookshelf]" value="1 book shelf"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/bookshelf.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Book Shelf" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="fridge" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[fridge]" value="1 fridge">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/fridge.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Fridge" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>

						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="tv set" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[tvset]" value="1 tv set"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/television.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="TV Sets" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="tv cabinet" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[tvcabinet]" value="1 tv cabinet"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/tv_cabinet.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="TV Cabinet" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="DSTV" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[dstv]" value="1 dstv">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/dstv.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="DSTV" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>
						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="home theatre" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[hometheatre]" value="1 home theatre"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/home_theatre.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Home Theatre" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="carpets" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[carpets]" value="1 carpet"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/carpets.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Carpets" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="Aquarium" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[aquarium]" value="1 aquarium">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/aquarium.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Aquarium" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>

						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="paino" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[piano]" value="1 piano"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/piano.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Piano" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="chandelier" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[chandelier]" value="1 chandelier"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/chandelier.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Chandelier" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="Dining Table" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[diningtable]" value="1 dining table">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/dining_table.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Dining Table" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>

						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="dining chairs" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[diningchairs]" value="1 dining chairs"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/dining_chair.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Dining Chairs" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="stools" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[stools]" value="1 stool"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/stool.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Stool" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="Coffee Table" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[coffeetable]" value="1 coffee table">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/coffee_table.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Coffee Table" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>
						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="chest freezer" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[chestfreezer]" value="1 chest freezer"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/chest_freezer.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Chest Freezer" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="water dispenser" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[waterdispenser]" value="1 water dispenser"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/water_dispenser.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Water Dispenser" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="four burner cooker" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[fourburnercooker]" value="1 four burner cooker">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/4_burner_cooker.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="4 Burner Cooker" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>
						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="microwave oven" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[microwaveoven]" value="1 microwave oven"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/microwave_oven.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Microwave Oven" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="cupboard" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[cupboard]" value="1 cupboard"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/cupboard.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Cup Board" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="king-size bed(with mattress)" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[kingsizebed]" value="1 king-size bed(with mattress)">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/king_size_bed.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="King-size Bed(With Mattress)" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>
						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="queen-size bed(with mattress)" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[queensizebedwithmattress]" value="1 queen-size bed(with mattress)"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/queen_size_bed.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Queen-size Bed(with mattress)" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="single bed(with mattress)" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[singlebed]" value="1 single bed(with mattress)"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/single_bed.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Single Bed(with mattress)" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="baby cot" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[babycot]" value="1 baby cot">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/baby_cot.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Baby Cot" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>
						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="chest of drawers" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[chestofdrawers]" value="1 chest of drawers"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/chest_drawers.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Chest of Drawers" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="cartons of clothes" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[cartonsofclothes]" value="1 carton of clothes"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/carton.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Cartons of Clothes" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="shoe rack" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[shoerack]" value="1 shoe rack">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/shoe_rack.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Shoe Rack" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>
						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="dressing table" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[dressingtable]" value="1 dressing table"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/dressing_table.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Dressing Table" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="study desk" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[studydesk]" value="1 study desk"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/study_desk.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Study Desk" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="computer" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[computer]" value="1 computer">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/computer.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Computer" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>
						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="curtains" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[curtains]" value="1 curtains"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/curtains.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Curtains" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="washing machine" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[washingmachine]" value="1 washing machine"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/washing_machine.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Washing Machine" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="instant shower" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[instantshower]" value="1 instant shower">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/instant_shower.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Instant Shower" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>
						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="water tank" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[watertank]" value="1 water tank)"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/water_tank.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Water Tank" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="gym machine" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[gymmachine]" value="1 gym machine"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/gym_machine.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Gym Machine" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="potted plant" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[pottedplant]" value="1 potted plant">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/potted_plant.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Potted Plant" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>
						<div class="form-group">
							<div class="col-md-4 field">
								<label data-item-name="balcony seat" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[balconyseat]" value="1 balcony seat"/>
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/balcony_seat.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Balcony Seats" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<div class="col-md-4 field">
								<label data-item-name="bar(glass)" class="checkbox-inline inventory-item">
								  <input class="item-detail item-value iform-field-control" type="checkbox" name="items[barglass]" value="1 bar(glass)">
								  <img class="item-detail item-icon" src="<?php echo base_url('images/icons/items/bar_glass.png'); ?>"/> 
								  <input class="item-detail item-title" type="text" value="Bar(Glass)" disabled="disabled" />
								  <input class="item-detail iform-field-control item-count" type="number"  min="0" max="1000000" value="0">
								</label>
							</div>
							<span class="clearfix"></span>
						</div>
						<div class="form-group action-group">
							<h3 class="sub-heading text-left">If moving to apartment and/or from apartment</h3>
							<div class="col-md-4 col-xs-12">
								<label class="form-label text-left">Moving from apartment floor</label>
								<div class="row">
									<input class="form-control" type="number" min="0" max="1000000" name="apartment_from_floor" placeholder="e.g 4"/>
								</div>
							</div>
							<div class="col-md-4 col-md-offset-1 col-sm-offset-2 col-xs-12">
								<label class="form-label text-left">Moving to apartment floor</label>
								<div class="row">
									<input class="form-control" type="number" min="0" max="1000000" name="apartment_to_floor" placeholder="e.g 4"/>
								</div>
							</div>
							<span class="clearfix"></span>
						</div>
						<hr class="divider"/>
						<div class="form-group action-group">
							<div class="col-md-12 text-center">
								<input id="kj-ua" type="hidden" name="ua" value="unkmown"/>
								<input class="btn btn-info" type="submit" name="usr_submit" value="Complete"/>
							</div>
						</div>
					</form>
				</div>
			</section>
		</div>
	</section>
</div>
<script type="text/javascript">
	window.jQuery(function(){
		 window.jQuery('#kj-ua').val(navigator.userAgent);
	});
</script>
<?php global $app_scripts; if(!is_array($app_scripts)) $app_scripts=array(); ?>
<?php $app_scripts['form-component']='js/app/components/form.js'; ?>
<?php $app_scripts['item-inventory-form-component']='js/app/components/item-inventory-form.js'; ?>
<?php $app_scripts['setup-item-inventory-form-view']='js/app/views/setup-item-inventory-form.js'; ?>
<?php $this->load->view('common/footer', array('no_footer'=>true)); ?>