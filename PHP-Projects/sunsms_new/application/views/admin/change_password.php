<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Admin"> Home </a>
        </li>
        <li class="active">
            Change Password
        </li>
    </ul>
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1">Change Password</a></li>
            </ul>
            <p class="err_msg">
				<?php if($this->session->userdata('message')){ echo $this->session->userdata('message'); $this->session->unset_userdata('message'); } ?>
			</p>
            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id=resetPassword method="post" action="<?=BASE_URL?>index.php/admin/createUser" enctype="multipart/form-data">
                        <div class="panel-body">													<?php //echo ERROR_HTML; ?>							
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Old Password </label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="password" name="oldPassword" id="oldPassword" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">New Password <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                    	<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="password" name="NewPassword" id="NewPassword" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Conform Password <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                	<div class="input-group">
                                		<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="password" name="ConformPassword" id="ConformPassword" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">Save</button>
                        </div>
                         <input type="hidden" name="id_user" id="id_user" value="<?php if(isset($user_data['id_user'])){ echo encode($user_data['id_user']); } else { echo 0; } ?>">
                         <input type="hidden" name="first_time_login" id="first_time_login" value="<?php if(isset($user_data['first_time_login']) && (decode($user_data['first_time_login'])!=0)){ echo decode($user_data['first_time_login']); } else { echo 0; } ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



