<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Admin/resetUserPassword"> Home </a>
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
                    <form class="form-horizontal" id=resetPassword method="post" action="<?=BASE_URL?>index.php/admin/createUser" enctype="multipart/form-data">
                        <div class="panel-body">													<?php //echo ERROR_HTML; ?>							
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" readonly name="name" id="name" value="<?php if(isset($user)){ echo $user[0]['first_name']." ".$user[0]['last_name']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                                <label class="col-md-3 col-xs-12 control-label">Enter Password <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                    	<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="password" name="NewPassword" id="NewPassword" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Re-Enter Password <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
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
                        <input type="hidden" name="id_user" id="id_user" value="<?php if(isset($user)){ echo encode($user[0]['id_user']); } else { echo 0; } ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



