



<section class="col-lg-10 right-section">

    <ul class="breadcrumb border-btm">
        <li>
            <a href="<?=BASE_URL?>index.php/welcome/index">Home</a>

        </li>

        <li class="active">
            Dashboard
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($school)){ ?>Edit School<?php } else { ?>Add School<?php } ?></a></li>

            </ul>

            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="school_form" method="post" action="<?=BASE_URL?>index.php/welcome/createSchool" enctype="multipart/form-data">



                        <div class="panel-body">
                        <h4><u>School</u></h4>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">School name <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="school_name" id="school_name" value="<?php if(isset($school)){ echo $school[0]['school_name']; } ?>" class="form-control"/>

                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">School logo <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                    <input type="file" class="fileinput btn-primary " name="school_logo" id="school_logo" title="logo"/>
                                    </div>
                                </div>
                            </div>
                            <?php if(isset($school)){ ?>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label"></label>
                                    <div class="col-md-6 col-xs-12">
                                        <img src="<?=BASE_URL?>uploads/<?=$school[0]['school_logo']?>" width="150px" height="150px">
                                    </div>
                                </div>
                                <input type="hidden" name="prev_school_logo" value="<?=$school[0]['school_logo']?>">
                            <?php } ?>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Address <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <textarea class="form-control" id="address" name="address" rows="5"><?php if(isset($school)){ echo $school[0]['address']; } ?></textarea>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Country <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control select" name="country_id" id="country_id" onchange="getState(this.value);">
                                        <option value="0">Select Country</option>
                                        <?php for($s=0;$s<count($county);$s++){ ?>
                                            <option <?php if(isset($school)){ if($school[0]['country_id']==$county[$s]['id_country']){ echo "selected='selected'"; } } ?> value="<?=$county[$s]['id_country']?>"><?=$county[$s]['country']?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select State <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control select" name="state_id" id="state_id" onchange="getCity(this.value)">
                                        <option value="0">Select State</option>
                                        <?php if(isset($school)){ for($s=0;$s<count($state);$s++){ ?>
                                            <option <?php if(isset($school)){ if($school[0]['state_id']==$state[$s]['id_state']){ echo "selected='selected'"; } } ?> value="<?=$state[$s]['id_state']?>"><?=$state[$s]['state']?></option>
                                        <?php } } ?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select City <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control select" name="city_id" id="city_id">
                                        <option value="0">Select City</option>
                                        <?php if(isset($school)){ for($s=0;$s<count($city);$s++){ ?>
                                            <option <?php if(isset($school)){ if($school[0]['city_id']==$city[$s]['id_city']){ echo "selected='selected'"; } } ?> value="<?=$city[$s]['id_city']?>"><?=$city[$s]['city']?></option>
                                        <?php } } ?>
                                    </select>

                                </div>
                            </div>
                        <h4><u>School Admin</u></h4>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">First name <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="first_name" id="first_name" value="<?php if(isset($school)){ echo $school[0]['first_name']; }?>" class="form-control"/>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Last name <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="last_name" id="last_name" value="<?php if(isset($school)){ echo $school[0]['first_name']; }?>" class="form-control"/>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Email <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="email" id="email" <?php if(isset($school)){ echo "disabled"; } ?> value="<?php if(isset($school)){ echo $school[0]['email']; }?>" class="form-control"/>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Mobile Number <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="phone_number" id="phone_number" value="<?php if(isset($school)){ echo $school[0]['phone_number']; }?>" class="form-control"/>
                                    </div>

                                </div>
                            </div>


                        </div>
                        <div class="text-center">
                            <button class="btn btn-default">Clear</button>
                            <button class="btn btn-primary">Save</button>
                        </div>
                    <input type="hidden" name="id_school" id="id_school" value="<?php if(isset($school)){ echo encode($school[0]['id_school']); }else{ echo 0; }?>">
                    <input type="hidden" name="id_user" id="id_user" value="<?php if(isset($school)){ echo encode($school[0]['id_user']); }else{ echo 0; }?>">
                    </form></div>

                </div>
            </div>
        </div>
    </div>

</section>



