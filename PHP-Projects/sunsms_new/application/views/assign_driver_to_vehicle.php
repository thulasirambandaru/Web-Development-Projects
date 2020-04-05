<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="<?=BASE_URL?>index.php/driver/drivervehicle/">Home</a>
        </li>
        <li class="active">
            Assign Driver To Vehicle
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
        	<a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>
            <ul id="tabs">
                <li><a href="#" name="tab1"> Assign Driver to Vehicle Info </a></li>
            </ul>

            <div id="content">
                <div id="tab1">
                     <form action="<?=BASE_URL?>index.php/driver/drivervehicle_add" id="addDriverToVehicle" method="post" class="form-horizontal">
                    <div class="panel-body">
                        <input type="hidden" value="" name="id"/>
                        <div class="form-body">
                       
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Driver Name</label>
                            <div class="col-md-3 col-xs-12">
                                <select name="driverList" id="driverList" class="form-control">
                                <option value="">--Select Driver--</option>
                                <?php foreach ($driver_list as $driver) { 
                                		$driver_list_select=(isset($drivervehicle) && $driver['driver_id']==$drivervehicle[0]['fk_driver_id']) ? "selected='selected'" : "";
                                	?>
                                 <option <?php echo $driver_list_select; ?> value="<?php echo $driver['driver_id'] ?>"><?php echo $driver['firstName']." ".$driver['lastName']; ?> </option>
                                 <?php }?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                       
                            <label class="col-md-3 col-xs-12 control-label">Vehicle Number</label>
                            <div class="col-md-3 col-xs-12">
                                <select name="vehicleList" id="vehicleList" class="form-control">
                                <option value="">--Select Vehicle--</option>
									<?php foreach ($vehicle_list as $vehicle) {
											$vehicle_list_select=(isset($drivervehicle) && $vehicle['vehicle_id']==$drivervehicle[0]['fk_vehicle_id']) ? "selected='selected'" : "";
										?>
                                		 <option <?php echo $vehicle_list_select;?> value="<?php echo $vehicle['vehicle_id'] ?>"><?php echo $vehicle['vehicleNumber']; ?> </option>
                                 	<?php }?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
						</div>
                            
                            <div class="text-center">
                            	<input type="hidden" name="driver_vehicle_id" id="driver_vehicle_id" value="<?php if(isset($drivervehicle)) { echo $drivervehicle[0]['driver_vehicle_id']; } ?>">
                				<button class="btn btn-primary">Save</button>
                			</div>
                        </div>
                    
                </form>
					</div>
                </div>

               
            </div>
        </div>
 </section>
