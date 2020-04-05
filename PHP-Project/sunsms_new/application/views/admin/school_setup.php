<section class="col-lg-10 right-section">

    <ul class="breadcrumb border-btm">
        <li class="active">
            <a href="<?=BASE_URL?>index.php/admin/addSchoolSetup"> Institution Configurations </a>
        </li>
    </ul>
    <a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1">School Information</a></li>
            </ul>
			
            <div id="content">
            	
                <div id="tab1">
                    <form class="form-horizontal" id="school_form" method="post" action="<?=BASE_URL?>index.php/admin/updateSchool" enctype="multipart/form-data">

                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">School / College Name <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="school_name" id="school_name" value="<?php if(isset($school)){ echo $school[0]['school_name']; } ?>" class="form-control"/>
									</div>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Registration ID <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="registration_id" id="registration_id" value="<?php if(isset($school)){ echo $school[0]['registration_id']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Founded On</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="founded_on" id="founded_on" value="<?php if(isset($school) && $school[0]['founded_on']!='0000-00-00'){ echo date('d-m-Y',strtotime($school[0]['founded_on'])); } ?>" class="form-control datepicker"/>
                                    </div>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">School Display Name</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="school_display_name" id="school_display_name" value="<?php if(isset($school)){ echo $school[0]['display_name']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-md-3 col-xs-12 control-label">Address <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <textarea class="form-control" id="address" name="address" rows="5"><?php if(isset($school)){ echo $school[0]['address']; } ?></textarea>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Select State <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" name="state_id" id="state_id" onchange="getCity(this.value)">
                                        <option value="0">Select State</option>
                                        <?php if(isset($school)){ for($s=0;$s<count($state);$s++){ ?>
                                            <option <?php if(isset($school)){ if($school[0]['state_id']==$state[$s]['id_state']){ echo "selected='selected'"; } } ?> value="<?=$state[$s]['id_state']?>"><?=$state[$s]['state']?></option>
                                        <?php } } ?>
                                    </select>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Select City <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12  m4">
                                    <select class="form-control select" name="city_id" id="city_id">
                                        <option value="0">Select City</option>
                                        <?php if(isset($school)){ for($s=0;$s<count($city);$s++){ ?>
                                            <option <?php if(isset($school)){ if($school[0]['city_id']==$city[$s]['id_city']){ echo "selected='selected'"; } } ?> value="<?=$city[$s]['id_city']?>"><?=$city[$s]['city']?></option>
                                        <?php } } ?>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Country <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" name="country_id" id="country_id" onchange="getState(this.value);">
                                        <option value="0">Select Country</option>
                                        <?php for($s=0;$s<count($county);$s++){ ?>
                                            <option <?php if(isset($school)){ if($school[0]['country_id']==$county[$s]['id_country']){ echo "selected='selected'"; } } ?> value="<?=$county[$s]['id_country']?>"><?=$county[$s]['country']?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Zipcode</label>
                                <div class="col-md-3 col-xs-12  m4">
                                    <input type="text" name="pincode" id="pincode" value="<?php if(isset($school)){ echo $school[0]['pincode']; } ?>" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Phone</label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <input type="text" name="phone" id="phone" value="<?php if(isset($school) && $school[0]['phone']!=0){ echo $school[0]['phone']; } ?>" class="form-control"/>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Alternative Phone</label>
                                <div class="col-md-3 col-xs-12  m4">
                                    <input type="text" name="alternative_phone" id="alternative_phone" value="<?php if(isset($school) && $school[0]['alternative_phone']!=0){ echo $school[0]['alternative_phone']; } ?>" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Email</label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <input type="text" name="email" id="email" value="<?php if(isset($school)){ echo $school[0]['email']; } ?>" class="form-control"/>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Fax</label>
                                <div class="col-md-3 col-xs-12  m4">
                                    <input type="text" name="fax" id="fax" value="<?php if(isset($school)){ echo $school[0]['fax']; } ?>" class="form-control"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">School Logo <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                    <input type="file" class="fileinput btn-primary " name="school_logo" id="school_logo" title="logo"/>
                                    </div>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Favicon</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <input type="file" class="fileinput btn-primary " name="fav_icon" id="fav_icon" title="logo"/>
                                    </div>
                                </div>
                            </div>
                            <?php if(isset($school)){ ?>
                                <div class="form-group">
                                    <?php if($school[0]['school_logo']!=''){ ?>
                                    <label class="col-md-3 col-xs-12 control-label"></label>
                                    <div class="col-md-3 col-xs-12">
                                        <img src="<?=BASE_URL?>images/school/logo/<?=$school[0]['school_logo']?>" width="150px" height="150px">
                                    </div>
                                    <?php } ?>

                                    <?php if($school[0]['fav_icon']!=''){ ?>
                                        <label class="col-md-3 col-xs-12 control-label"></label>
                                        <div class="col-md-3 col-xs-12">
                                            <img src="<?=BASE_URL?>images/school/favicon/<?=$school[0]['fav_icon']?>" width="50px" height="50px">
                                        </div>
                                    <?php } ?>
                                </div>
                                <input type="hidden" name="prev_school_logo" value="<?=$school[0]['school_logo']?>">
                                <input type="hidden" name="prev_fav_icon" value="<?=$school[0]['fav_icon']?>">
                            <?php } ?>




						<ul class="breadcrumb">
					        <li class="active">
					             Principal / Head of the Institution 
					        </li>
					    </ul>
                        
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name of the Principal</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="principle_name" id="principle_name" value="<?php if(isset($school)){ echo $school[0]['principle_name']; }?>" class="form-control"/>
                                    </div>

                                </div>
                           
                                <label class="col-md-3 col-xs-12 control-label">Email of the Principal</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="principle_email" id="principle_email"  value="<?php if(isset($school)){ echo $school[0]['principle_email']; }?>" class="form-control"/>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Phone</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="principle_phone" id="principle_phone" value="<?php if(isset($school) && $school[0]['principle_phone']!=0){ echo $school[0]['principle_phone']; }?>" class="form-control"/>
                                    </div>
                                </div>
                            
                                <label class="col-md-3 col-xs-12 control-label">Mobile</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="principle_mobile" id="principle_mobile" value="<?php if(isset($school) && $school[0]['principle_mobile']!=0){ echo $school[0]['principle_mobile']; }?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>

							<ul class="breadcrumb">
					        <li class="active">
					            Admission Number Setup  
					        </li>
					    	</ul>
                        
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Admission Number <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="admission_number" id="admission_number" value="<?php if(isset($school)){ echo $school[0]['admission_number']; }?>" class="form-control"/>
                                    </div>
                                </div>
                           
                                <label class="col-md-3 col-xs-12 control-label">Teacher Number <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="teacher_number" id="teacher_number"  value="<?php if(isset($school)){ echo $school[0]['teacher_number']; }?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">Update</button>
                            <input type='hidden' name='school_id' id='school_id' value="<?php if(isset($school)){ echo $school[0]['id_school']; } ?>">
                        </div>
                    </form></div>

                </div>
            </div>
        </div>
    </div>

</section>



