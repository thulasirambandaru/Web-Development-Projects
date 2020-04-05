<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="<?=BASE_URL?>index.php/Vehicle/">Home</a>
        </li>
        <li class="active">
            Add Vehicle
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
        	<a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>
            <ul id="tabs">
                <li><a href="#" name="tab1"> Vehicle Info </a></li>
            </ul>
			
            <div id="content">
                <div id="tab1">
                     <form action="<?=BASE_URL?>index.php/Vehicle/vehicle_add" id="addVehicle" method="post"  class="form-horizontal">
                    <div class="panel-body">
                        <input type="hidden" value="" name="id"/>
                        <div class="form-body">
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Vehicle Number <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                        <input type="text" class="form-control" placeholder="Vehicle Number" name="vehicleNumber" id="vehicleNumber" value="<?php if(isset($vehicle)) { echo  $vehicle[0]['vehicleNumber']; }?>" title="Vehicle number"/>
                                        <span class="help-block"></span>
                                </div>
                           
                                <label class="col-md-3 col-xs-12 control-label">Capacity <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <input name="capacity" placeholder="Capacity" id="capacity" class="form-control" value="<?php if(isset($vehicle) && $vehicle[0]['capacity']) { echo  $vehicle[0]['capacity']; }?>" type="text">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Vehicle Type</label>
                                <div class="col-md-3 col-xs-12">
                                <?php 
                                	$owner=(isset($vehicle[0]['vehicleType']) && $vehicle[0]['vehicleType']=='Owner') ? "selected='selected'" : '';
                                	$Contract=(isset($vehicle[0]['vehicleType']) && $vehicle[0]['vehicleType']=='Contract') ? "selected='selected'" : '';
                                	
                                ?>
                                    <select name="vehicleType" class="form-control" id="vehicleType">
                                        <option value="">--Select Type--</option>
                                        <option value="Owner" <?php echo $owner; ?>>Owner</option>
                                        <option value="Contract" <?php echo $Contract; ?>>Contract</option>
                                    </select>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="text-center">
                            	<input type="hidden" name="vehicle_id" id="vehicle_id" value="<?php if(isset($vehicle)) { echo $vehicle[0]['vehicle_id']; } ?>">
                				<button class="btn btn-primary">Save</button>
                			</div>
                        </div>
                    </div>
                </form>
             
                </div>

               
            </div>
        </div>
    </div>

</section>
