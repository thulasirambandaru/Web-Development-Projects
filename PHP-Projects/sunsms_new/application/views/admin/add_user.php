<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Admin/user"> Home </a>
        </li>
        <li class="active">
            Add User
        </li>
    </ul>
    <a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($user)){ ?>Edit User<?php } else { ?>Add User<?php } ?></a></li>
            </ul>
            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="addUser" method="post" action="<?=BASE_URL?>index.php/admin/createUser" enctype="multipart/form-data">
                        <div class="panel-body">
                        	 <div class="form-group" <?php if(!isset($user) || $user[0]['special_user']!=1){ ?>style="display: none;"<?php } ?>>
                                <label class="col-md-3 col-xs-12 control-label">Username  </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        
                                       <?php if(isset($user[0]['username'])){ echo $user[0]['username']; }?>
                                    </div>
                                </div>
                            </div>
                        
                        													<?php //echo ERROR_HTML; ?>							
                            <div class="form-group" <?php if(!isset($user) || $user[0]['special_user']!=0){ ?>style="display: none;"<?php } ?>>
                                <label class="col-md-3 col-xs-12 control-label">Name </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" readonly name="name" id="name" value="<?php if(isset($user)){ echo $user[0]['first_name']." ".$user[0]['last_name']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group" <?php if(isset($user) && $user[0]['special_user']!=1){ ?>style="display: none;"<?php } ?>>
                                <label class="col-md-3 col-xs-12 control-label">First Name <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="first_name" id="first_name" value="<?php if(isset($user[0]['first_name'])){ echo $user[0]['first_name']; }?>"  class="form-control"/>
                                    </div>
                                </div>
                                
                                <label class="col-md-3 col-xs-12 control-label">Last Name<span class="clr-red">*</span> </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="last_name" id="last_name" value="<?php if(isset($user[0]['last_name'])){ echo $user[0]['last_name']; }?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                           
                             <div class="form-group" <?php if(isset($user)){ ?>style="display: none;"<?php } ?>>
                                <label class="col-md-3 col-xs-12 control-label">Username <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                        <input type="text" <?php if(isset($user) && $user[0]['special_user']==1){ ?> readonly <?php } ?> name="username" id="username" value="<?php if(isset($user[0]['username'])){ echo $user[0]['username']; }?>" class="form-control"/>
                                    </div>
                                </div>
                                <label class="col-md-3 col-xs-12 control-label">Password <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                        <input type="password" name="new_password" id="new_password"  class="form-control"/>
                                    </div>
                                </div>
                            </div>
                          
                            <div class="form-group" <?php if(isset($user)){ ?>style="display: none;"<?php } ?>>
                                <label class="col-md-3 col-xs-12 control-label">Confirm Password <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                        <input type="password" name="confirm_password" id="confirm_password"  class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" <?php if(isset($user) && $user[0]['special_user']!=1){ ?>style="display: none;"<?php } ?>>
                                <label class="col-md-3 col-xs-12 control-label">Phone Number<span class="clr-red">*</span> </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                                        <input type="text" name="phone_number" id="phone_number" value="<?php if(isset($user[0]['phone_number'])){ echo $user[0]['phone_number']; }?>"  class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group" <?php if(isset($user) && $user[0]['special_user']==0){ ?>style="display: block;"<?php }  else { ?> style="display: none;" <?php } ?> >
                                <label class="col-md-6 col-xs-12 control-label">User Type <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="user_type" id="user_type">
                                        <?php for($s=0;$s<count($user_type);$s++){ ?>
											<option <?php if(isset($user)){ if($user[0]['user_type_id']==$user_type[$s]['id_user_type']){ echo "selected='selected'"; } } ?> value="<?=$user_type[$s]['id_user_type']?>"><?=$user_type[$s]['user_type']?></option>
										<?php } ?>
                                    </select>
                                </div>
                            </div>
                           <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label">Status<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="status" id="status">
                                        <option <?php if(isset($user)){ if($user[0]['user_status']==1){ echo "selected='selected'"; } } ?> value="1">Active</option>
                                        <option <?php if(isset($user)){ if($user[0]['user_status']==0){ echo "selected='selected'"; } } ?> value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                            
                            <?php 
                            
                            	echo $dynamicFields;
                            
                            ?>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <input type="hidden" name="special_user" id="special_user" value="<?php if(isset($user)){ echo $user[0]['special_user']; } else { echo 0; } ?>">
                        <input type="hidden" name="id_user" id="id_user" value="<?php if(isset($user)){ echo encode($user[0]['id_user']); } else { echo 0; } ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



