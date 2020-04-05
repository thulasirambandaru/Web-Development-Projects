<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="<?=BASE_URL?>index.php/Driver/">Home</a>
        </li>
        <li class="active">
            Add Driver
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
        <a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>
            <ul id="tabs">
                <li><a href="#" name="tab1"> Driver Info </a></li>
            </ul>

            <div id="content">
                <div id="tab1">
                <?php 
                	if(isset($dview) && $dview=='dview')
                	{ ?>
                	
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">First Name</label>
                           
                                <?php if(isset($driver)) { echo  $driver[0]['firstName']." ".$driver[0]['lastName']; }?>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Phone Number</label>
                                       <?php if(isset($driver)) { echo  $driver[0]['phoneNumber']; }?>
                            
                        
                            <label class="col-md-3 col-xs-12 control-label">Date Of Birth</label>
                            
                                <?php if(isset($driver)) { echo   date('d-M-Y',strtotime($driver[0]['dob'])); }?>
                            
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Licence</label>
                            <div class="col-md-3 col-xs-12">
                                <?php if(isset($driver)) { echo  $driver[0]['licenceNumber']; }?>
                            </div>
                        
                            <label class="col-md-3 col-xs-12 control-label">Expiry Date</label>
                            <div class="col-md-3 col-xs-12">
                                <?php if(isset($driver)) { echo  date('d-M-Y',strtotime($driver[0]['expiryDate'])); }?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Address</label>
                            <div class="col-md-3 col-xs-12">
                                <?php if(isset($driver)) { echo  $driver[0]['address']; }?>
                                <span class="help-block"></span>
                            </div>
                        </div>
                   
                	
                <?php 		
	               	}
	               	else {
                ?>
                   <form action="<?=BASE_URL?>index.php/driver/driver_add" id="addDriver" method="post"  class="form-horizontal">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">First Name</label>
                            <div class="col-md-3 col-xs-12">
                                <input name="firstName" id="firstName" placeholder="First Name" class="form-control" type="text" value="<?php if(isset($driver)) { echo  $driver[0]['firstName']; }?>">
                                <span class="help-block"></span>
                            </div>
                        
                            <label class="col-md-3 col-xs-12 control-label">Last Name</label>
                            <div class="col-md-3 col-xs-12">
                                <input name="lastName" id="lastName" placeholder="Last Name" class="form-control" type="text" value="<?php if(isset($driver)) { echo  $driver[0]['lastName']; }?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Phone Number</label>
                            <div class="col-md-3 col-xs-12">
                                <input name="phoneNumber" id="phoneNumber" placeholder="Phone Number" class="form-control" type="text" value="<?php if(isset($driver)) { echo  $driver[0]['phoneNumber']; }?>">
                                <span class="help-block"></span>
                            </div>
                        
                            <label class="col-md-3 col-xs-12 control-label">Date Of Birth</label>
                            <div class="col-md-3 col-xs-12">
                                <input name="dob" id="dob" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text" value="<?php if(isset($driver)) { echo   date('d-M-Y',strtotime($driver[0]['dob'])); }?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Licence</label>
                            <div class="col-md-3 col-xs-12">
                                <input name="licenceNumber" id="licenceNumber" placeholder="Licence" class="form-control" type="text" value="<?php if(isset($driver)) { echo  $driver[0]['licenceNumber']; }?>">
                                <span class="help-block"></span>
                            </div>
                        
                            <label class="col-md-3 col-xs-12 control-label">Expiry Date</label>
                            <div class="col-md-3 col-xs-12">
                                <input name="expiryDate" id="expiryDate" placeholder="yyyy-mm-dd" class="form-control datepicker" type="text" value="<?php if(isset($driver)) { echo  date('d-M-Y',strtotime($driver[0]['expiryDate'])); }?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-xs-12 control-label">Address</label>
                            <div class="col-md-3 col-xs-12">
                                <textarea name="txaAddress" id="txaAddress" placeholder="Address" class="form-control"><?php if(isset($driver)) { echo  $driver[0]['address']; }?></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="text-center">
                            	<input type="hidden" name="driver_id" id="driver_id" value="<?php if(isset($driver)) { echo $driver[0]['driver_id']; } ?>">
                				<button class="btn btn-primary">Save</button>
                		</div>
                    </div>
                </form>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>

</section>
