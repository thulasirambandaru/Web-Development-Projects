<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="<?=BASE_URL?>index.php/driver/drivervehicle/">Home</a>
        </li>
        <li class="active">
            Add Route
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
        	<a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>
            <ul id="tabs">
                <li><a href="#" name="tab1"> Add Route </a></li>
            </ul>

            <div id="content">
                <div id="tab1">
                     <form action="<?=BASE_URL?>index.php/route/route_add" id="addRoute" method="post" class="form-horizontal">
                    <input type="hidden" value="" name="id"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Route Name</label>
                            <div class="col-md-3 col-xs-12">
                                <input name="routeName" id="routeName" placeholder="Route Name" class="form-control" type="text" value="<?php if(isset($route)) { echo $route[0]['routeName']; }?>" >
                                <span class="help-block"></span>
                            </div>
                        
                            <label class="col-md-3 col-xs-12 control-label">Total Stops</label>
                            <div class="col-md-3 col-xs-12">
                                <input name="totalStops" id="totalStops" placeholder="Number of Stops" class="form-control" type="text" value="<?php if(isset($route)) { echo $route[0]['stops']; }?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Vehicle Number</label>
                            <div class="col-md-3 col-xs-12">
                                <select name="vehicleList" id="vehicleList" class="form-control">
                                <option value="">--Select Vehicle--</option>
									<?php foreach ($vehicle_list as $vehicle) {
											$vehicle_list_select=(isset($route) && $vehicle['vehicle_id']==$route[0]['fk_vehicle_id']) ? "selected='selected'" : "";
										?>
                                		 <option <?php echo $vehicle_list_select;?> value="<?php echo $vehicle['vehicle_id'] ?>"><?php echo $vehicle['vehicleNumber']; ?> </option>
                                 	<?php }?>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="hidden" name="route_id" id="route_id" value="<?php if(isset($route)) { echo $route[0]['route_id']; } ?>">
                			<button class="btn btn-primary">Save</button>
                		</div>
                    </div>
                </form>
               	</div>
                </div>
            </div>
        </div>
 </section>
