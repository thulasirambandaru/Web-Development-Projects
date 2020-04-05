
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="<?=BASE_URL?>index.php/Student/">Home</a>
        </li>
        <li class="active">
            Add Student
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"> Student Info </a></li>
                <li><a href="#" name="tab2"> Parent Info</a></li>
                <li><a href="#" name="tab3"> Previous Info</a></li>
                <li><a href="#" name="tab4"> Documents</a></li>
                <!--<li><a href="#" name="tab1"><?php //if(isset($student)){ ?>Edit Student<?php //} else { ?>Add Student<?php //} ?></a></li>-->
            </ul>

            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="student_form" method="post" action="<?=BASE_URL?>index.php/student/createStudent" enctype="multipart/form-data">

                        <div class="panel-body">
                            <h5>Student</h5>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Admission No <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="admission_no" id="admission_no" value="<?php if(isset($student)){ echo htmlentities($student[0]['admission_number']); } else { echo $admission_number; } ?>" class="form-control"/>

                                    </div>

                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Admission Date <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="text" name="admission_date" onkeydown="return false" id="admission_date"  value="<?php if(isset($student)){ echo htmlentities(date('d-M-Y',strtotime($student[0]['admission_date']))); } ?>" class="form-control datepicker"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="board_id" id="board_id" onchange="getCourses(this.value);">
                                        <option value="0">Select Board </option>
                                        <?php for($b=0;$b<count($board);$b++){ ?>
                                            <option value="<?=$board[$b]['id_board']?>" <?php if(isset($student)){ if($student[0]['board_id']==$board[$b]['id_board']){ echo "selected='selected'"; } } ?>><?=$board[$b]['board_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Select Class <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="student_course_id" id="student_course_id" onchange="getSections(this.value);">
                                        <option value="0">Select Class </option>
                                        <?php
                                        if(isset($student))
                                        {
                                            for($c=0;$c<count($course);$c++) { ?>
                                                <option value="<?=$course[$c]['id_course']?>" <?php if(isset($student)){ if($student[0]['course_id']==$course[$c]['id_course']){ echo "selected='selected'"; } } ?>><?=$course[$c]['course_name']?></option>
                                            <?php }
                                        }?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Section </label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="course_section_id" id="course_section_id">
                                        <option value="0">Select Section </option>
                                        <?php
                                        if(isset($student))
                                        {
                                            for($s=0;$s<count($section);$s++) { ?>
                                                <option value="<?=$section[$s]['id_section']?>" <?php if(isset($student)){ if($student[0]['section_id']==$section[$s]['id_section']){ echo "selected='selected'"; } } ?>><?=$section[$s]['section_name']?></option>
                                            <?php }
                                        }?>
                                    </select>
                                </div>
                            </div>
                            <?php 
                            	echo $StudentDynamicFields;
                            ?>

                            <h5>Personal Details</h5>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">First Name <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="first_name" id="first_name" value="<?php if(isset($student)){ echo htmlentities($student[0]['first_name']); } ?>" class="form-control"/>

                                    </div>

                                </div>
                                <label class="col-md-3 col-xs-12 control-label">Middle Name</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="middle_name" id="middle_name" value="<?php if(isset($student)){ echo htmlentities($student[0]['middle_name']); } ?>" class="form-control"/>

                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Last Name <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="last_name" id="last_name" value="<?php if(isset($student)){ echo htmlentities($student[0]['last_name']); } ?>" class="form-control"/>

                                    </div>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Date of Birth <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                        <input type="text" name="dob" id="dob" onkeydown="return false" value="<?php if(isset($student)){ echo htmlentities(date('d-M-Y',strtotime($student[0]['dob']))); } ?>" class="form-control datepicker"/>

                                    </div>

                                </div>
                            </div>

                            <!--<div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">National Student ID</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="national_student_id" id="national_student_id" value="<?php //if(isset($student)){ echo htmlentities($student[0]['national_student_id']); } ?>" class="form-control"/>

                                    </div>

                                </div>
                            
                                <label class="col-md-3 col-xs-12 control-label">Date of Birth <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="dob" id="dob" value="<?php //if(isset($student)){ echo htmlentities(date('d-m-Y',strtotime($student[0]['dob'])); } ?>" class="form-control datepicker"/>

                                    </div>

                                </div>
                            </div>-->

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Gender <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="gender_id" id="gender_id">
                                        <option value="0">Select Gender</option>
                                        <option value="Male" <?php if(isset($student)){ if($student[0]['gender']=='Male'){ echo "selected='selected'"; } } ?>>Male</option>
                                        <option value="Female" <?php if(isset($student)){ if($student[0]['gender']=='Female'){ echo "selected='selected'"; } } ?>>Female</option>
                                    </select>

                                </div>
                                <label class="col-md-3 col-xs-12 control-label">Blood Group</label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="blood_group" id="blood_group">
                                        <option value="0">Select Blood Group</option>
                                        <option value="AB+" <?php if(isset($student)){ if($student[0]['blood_group']=='AB+'){ echo "selected='selected'"; } } ?>>AB+</option>
                                        <option value="AB-" <?php if(isset($student)){ if($student[0]['blood_group']=='AB-'){ echo "selected='selected'"; } } ?>>AB-</option>
                                        <option value="A+" <?php if(isset($student)){ if($student[0]['blood_group']=='A+'){ echo "selected='selected'"; } } ?>>A+</option>
                                        <option value="A-" <?php if(isset($student)){ if($student[0]['blood_group']=='A-'){ echo "selected='selected'"; } } ?>>A-</option>
                                        <option value="B+" <?php if(isset($student)){ if($student[0]['blood_group']=='B+'){ echo "selected='selected'"; } } ?>>B+</option>
                                        <option value="B-" <?php if(isset($student)){ if($student[0]['blood_group']=='B-'){ echo "selected='selected'"; } } ?>>B-</option>
                                        <option value="O+" <?php if(isset($student)){ if($student[0]['blood_group']=='O+'){ echo "selected='selected'"; } } ?>>O+</option>
                                        <option value="O-" <?php if(isset($student)){ if($student[0]['blood_group']=='O-'){ echo "selected='selected'"; } } ?>>O-</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Birth Place</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="birthplace" id="birthplace" value="<?php if(isset($student)){ echo htmlentities($student[0]['birth_place']); } ?>" class="form-control"/>

                                    </div>

                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Religion</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="religion" id="religion" value="<?php if(isset($student)){ echo htmlentities($student[0]['religion']); } ?>" class="form-control"/>

                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <!--<label class="col-md-3 col-xs-12 control-label">Language</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="language" id="language" value="<?php //if(isset($student)){ echo htmlentities($student[0]['language']); } ?>" class="form-control"/>

                                    </div>

                                </div>-->
                                <label class="col-md-3 col-xs-12 control-label">Nationality <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="nationality" id="nationality">
                                        <option value="0">Select Nationality</option>
                                        <option value="Indian" <?php if(isset($student)){ if($student[0]['nationality']=='Indian'){ echo "selected='selected'"; } } ?>>Indian</option>
                                    </select>

                                </div>

                                <!--<label class="col-md-3 col-xs-12 control-label">Student Category</label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="student_category" id="student_category">
                                        <option value="0">Select Category</option>
                                        <option value="General" <?php //if(isset($student)){ if($student[0]['student_category']=='General'){ echo "selected='selected'"; } } ?>>General</option>
                                        <option value="Special" <?php //if(isset($student)){ if($student[0]['student_category']=='Special'){ echo "selected='selected'"; } } ?>>Special</option>
                                    </select>

                                </div>-->

                            </div>
                            
                            <?php 
                            	echo $StudentPersonalDynamicFields;
                            ?>
                            
                            <!--<div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Student Category</label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="student_category" id="student_category">
                                        <option value="0">Select Category</option>
                                        <option value="General" <?php //if(isset($student)){ if($student[0]['student_category']=='General'){ echo "selected='selected'"; } } ?>>General</option>
                                        <option value="Special" <?php //if(isset($student)){ if($student[0]['student_category']=='Special'){ echo "selected='selected'"; } } ?>>Special</option>
                                    </select>

                                </div>
                            </div>-->
                            <h5>Contact Details</h5>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Address Line 1 <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <textarea class="form-control" id="address_line_1" name="address_line_1" rows="3"><?php if(isset($student)){ echo htmlentities($student[0]['address_line_1']); } ?></textarea>

                                </div>
                                <label class="col-md-3 col-xs-12 control-label">Address Line 2 </label>
                                <div class="col-md-3 col-xs-12">
                                    <textarea class="form-control" id="address_line_2" name="address_line_2" rows="3"><?php if(isset($student)){ echo htmlentities($student[0]['address_line_2']); } ?></textarea>

                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">City </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="student_city" id="student_city" value="<?php if(isset($student)){ echo htmlentities($student[0]['student_city']); } ?>" class="form-control"/>
                                    </div>
                                </div>

                                <!--<label class="col-md-3 col-xs-12 control-label">City <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="city_id" id="city_id">
                                        <option value="0">Select City</option>
                                        <?php //if(isset($student)){ for($s=0;$s<count($city);$s++){ ?>
                                            <option <?php //if(isset($student)){ if($student[0]['city_id']==$city[$s]['id_city']){ echo "selected='selected'"; } } ?> value="<?=$city[$s]['id_city']?>"><?=$city[$s]['city']?></option>
                                        <?php //} } ?>
                                    </select>

                                </div>-->

                                <label class="col-md-3 col-xs-12 control-label">State </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="student_state" id="student_state" value="<?php if(isset($student)){ echo htmlentities($student[0]['student_state']); } ?>" class="form-control"/>
                                    </div>
                                </div>

                                <!--<label class="col-md-3 col-xs-12 control-label">State <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="state_id" id="state_id" onchange="getCity(this.value)">
                                        <option value="0">Select State</option>
                                        <?php //if(isset($student)){ for($s=0;$s<count($state);$s++){ ?>
                                            <option <?php //if(isset($student)){ if($student[0]['state_id']==$state[$s]['id_state']){ echo "selected='selected'"; } } ?> value="<?=$state[$s]['id_state']?>"><?=$state[$s]['state']?></option>
                                        <?php //} } ?>
                                    </select>

                                </div>-->
                            </div>

                            <?php //echo "<pre>"; print_r($student[0]['id_country']); die; ?>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Country <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <!--onchange="getState(this.value);"-->
                                    <select class="form-control select" name="country_id" id="country_id" />
                                    <option value="0">Select Country</option>
                                    <?php for($s=0;$s<count($county);$s++){ ?>
                                        <option <?php if(isset($student)){ if($student[0]['id_country']==$county[$s]['id_country']){ echo "selected='selected'"; } } ?> value="<?=$county[$s]['id_country']?>"><?=$county[$s]['country']?></option>
                                    <?php } ?>
                                    </select>

                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Pin Code </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="pin_code" id="pin_code" value="<?php if(isset($student)){ echo htmlentities($student[0]['pincode']); } ?>" class="form-control"/>

                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Phone Number</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                                        <input type="text" name="phone_number" id="phone_number" value="<?php if(isset($student)){ echo htmlentities($student[0]['phone_number']); } ?>" class="form-control"/>

                                    </div>

                                </div>
                                <label class="col-md-3 col-xs-12 control-label">Phone 2</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                                        <input type="text" name="alternate_phone" id="alternate_phone" value="<?php if(isset($student)){ echo htmlentities($student[0]['alternate_phone_number']); } ?>" class="form-control"/>

                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Email</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">

                                        <span class="input-group-addon">@</span></span>
                                        <input type="text" name="email" id="email" value="<?php if(isset($student)){ echo htmlentities($student[0]['email']); } ?>" class="form-control"/>

                                    </div>

                                </div>
                                <label class="col-md-3 col-xs-12 control-label">Upload Photo </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-upload"></span></span>
                                        <input type="file" class="fileinput btn-primary " name="profile_photo" id="profile_photo" title="Photo"/>
                                    </div>
                                </div>
                            </div>
                            <?php 
                            	echo $StudentContactDynamicFields;
                            ?>
                            
                            <?php if(isset($student) && !empty($student[0]['photo'])){ ?>
                                <!--<div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label"></label>
                                    <div class="col-md-6 col-xs-12">
                                        <img src="<?=BASE_URL?>uploads/<?=$student[0]['photo']?>" width="150px" height="150px">
                                    </div>
                                </div>-->
                                <input type="hidden" name="prev_profile_photo" value="<?=$student[0]['photo']?>">
                            <?php } ?>
                            
                            
                        </div>
                        <div class="text-center">
                            <!--<button class="btn btn-default">Clear</button>-->
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <input type="hidden" name="id_student" id="id_student" value="<?php if(isset($student)){ echo encode($student[0]['id_student']); }else{ echo 0; }?>">
                        <input type="hidden" name="id_user" id="id_user" value="<?php if(isset($student)){ echo encode($student[0]['id_user']); }else{ echo 0; }?>">
                    </form>
                </div>

                <!-- Tab2 Start -->
                <div id="tab2">
                    <form class="form-horizontal" id="student_parent_form" method="post" action="<?=BASE_URL?>index.php/student/createParent" enctype="multipart/form-data">

                        <div class="panel-body">
                            <?php if(!isset($parent)) { ?>
                                <h5>Parent</h5>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Existing Parent </label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <!--<span class="input-group-addon">-->
                                            <input type="radio" name="parent_state" id="parent_exists" onclick="showParentSection(this.id, 'parent_new', 1);" aria-label="Radio button for following text input">
                                            <!--</span>-->
                                            <!--<input type="text" class="form-control" value="Existing Parent" readonly>-->
                                        </div>

                                    </div>

                                    <label class="col-md-3 col-xs-12 control-label">New Parent </label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <!--<span class="input-group-addon">-->
                                            <input type="radio" name="parent_state" id="parent_new" onclick="showParentSection(this.id, 'parent_exists');" checked="checked" aria-label="Radio button for following text input">
                                            <!--</span>-->
                                            <!--<input type="text" class="form-control" value="New Parent" readonly>-->
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                            <div id="parent_new_div">
                                <h5>Personal Details</h5>
                                <div class="form-group">

                                    <label class="col-md-3 col-xs-12 control-label">First Name <span class="clr-red">*</span></label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="parent_first_name" id="parent_first_name" value="<?php if(isset($parent)){ echo htmlentities($parent[0]['parent_first_name']); } ?>" class="form-control"/>
                                        </div>
                                    </div>

                                    <label class="col-md-3 col-xs-12 control-label">Last Name</label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="parent_last_name" id="parent_last_name" value="<?php if(isset($parent)){ echo htmlentities($parent[0]['parent_last_name']); } ?>" class="form-control"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Relation <span class="clr-red">*</span></label>
                                    <div class="col-md-3 col-xs-12">
                                        <select class="form-control select" name="relation_id" id="relation_id">
                                            <option value="0">Select Relation</option>
                                            <option value="Father" <?php if(isset($parent)){ if($parent[0]['parent_relation']=='Father'){ echo "selected='selected'"; } } ?>>Father</option>
                                            <option value="Mother" <?php if(isset($parent)){ if($parent[0]['parent_relation']=='Mother'){ echo "selected='selected'"; } } ?>>Mother</option>
                                            <option value="Others" <?php if(isset($parent)){ if($parent[0]['parent_relation']=='Others'){ echo "selected='selected'"; } } ?>>Others</option>
                                        </select>

                                    </div>
                                    <label class="col-md-3 col-xs-12 control-label">Date of Birth </label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                            <input type="text" name="parent_dob" id="parent_dob" onkeydown="return false" value="<?php if(isset($parent) && $parent[0]['parent_dob']!='0000-00-00'){ echo htmlentities(date('d-M-Y',strtotime($parent[0]['parent_dob']))); } ?>" class="form-control datepicker"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Education</label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">

                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="parent_education" id="parent_education" value="<?php if(isset($parent)){ echo htmlentities($parent[0]['parent_education']); } ?>" class="form-control"/>

                                        </div>

                                    </div>
                                    <label class="col-md-3 col-xs-12 control-label">Occupation</label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">

                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="parent_occupation" id="parent_occupation" value="<?php if(isset($parent)){ echo htmlentities($parent[0]['parent_occupation']); } ?>" class="form-control"/>

                                        </div>

                                    </div>
                                </div>
                                
                                <?php 
                                	echo $SParentsPersonalDynamicFields;
                                ?>

                                <h5>Contact Details</h5>
                                <div class="form-group">

                                    <label class="col-md-3 col-xs-12 control-label">Mobile Phone <span class="clr-red">*</span></label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                                            <input type="text" name="parent_phone" id="parent_phone" value="<?php if(isset($parent)){ echo htmlentities($parent[0]['parent_phone']); } ?>" class="form-control"/>
                                        </div>
                                    </div>

                                    <label class="col-md-3 col-xs-12 control-label">Alternate Phone </label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                                            <input type="text" name="parent_alt_phone" id="parent_alt_phone" value="<?php if(isset($parent)){ echo htmlentities($parent[0]['parent_alt_phone']); } ?>" class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">

                                    <label class="col-md-3 col-xs-12 control-label">Email </label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" name="parent_email" id="parent_email" value="<?php if(isset($parent)){ echo htmlentities($parent[0]['parent_email']); } ?>" class="form-control"/>
                                        </div>
                                    </div>

                                    <label class="col-md-3 col-xs-12 control-label">Office Phone </label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-phone"></span></span>
                                            <input type="text" name="parent_ofc_phone" id="parent_ofc_phone" value="<?php if(isset($parent)){ echo htmlentities($parent[0]['parent_ofc_phone']); } ?>" class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">

                                    <label class="col-md-3 col-xs-12 control-label">Office Address </label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="parent_ofc_addr" id="parent_ofc_addr" value="<?php if(isset($parent)){ echo htmlentities($parent[0]['parent_ofc_address']); } ?>" class="form-control"/>
                                        </div>
                                    </div>

                                    <label class="col-md-3 col-xs-12 control-label">City </label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="parent_city" id="parent_city" value="<?php if(isset($parent)){ echo htmlentities($parent[0]['parent_city']); } ?>" class="form-control"/>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">

                                    <label class="col-md-3 col-xs-12 control-label">State </label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" name="parent_state" id="parent_state" value="<?php if(isset($parent)){ echo htmlentities($parent[0]['parent_state']); } ?>" class="form-control"/>
                                        </div>
                                    </div>

                                    <label class="col-md-3 col-xs-12 control-label">Country <span class="clr-red">*</span></label>
                                    <div class="col-md-3 col-xs-12">
                                        <!--onchange="getState(this.value);"-->
                                        <select class="form-control select" name="parent_country_id" id="parent_country_id" />
                                        <option value="0">Select Country</option>
                                        <?php for($s=0;$s<count($county);$s++){ ?>
                                            <option <?php if(isset($parent)){ if($parent[0]['parent_fk_country_id']==$county[$s]['id_country']){ echo "selected='selected'"; } } ?> value="<?=$county[$s]['id_country']?>"><?=$county[$s]['country']?></option>
                                        <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <?php 
                                	echo $SParentsContactDynamicFields;
                                 ?>
                            </div> <!-- End of new_parent_div -->
                            <?php if(!isset($parent)) { ?>
                                <div id="parent_exists_div">
                                    <p>&nbsp;</p>
                                    <h5>Search Parent</h5>
                                    <div class="form-group">

                                        <label class="col-md-3 col-xs-12 control-label">Parent Name <span class="clr-red">*</span></label>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" name="parent_search_name" id="parent_search_name" class="form-control"/>
                                                <div id="parent_input" class="error"></div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-xs-12">
                                            <a class="btn btn-primary" id="parent_search" onclick="getExistingParentInfo();">Search</a>
                                        </div>

                                    </div>
                                    <p>&nbsp;</p>
                                    <div class="form-group" id="exists_parent_div">

                                    </div>

                                </div> <!-- End of existing_parent_div -->
                            <?php } ?>

                        </div>

                        <input type="hidden" name="id_student" id="id_student" value="<?php if(isset($student)){ echo encode($student[0]['id_student']); }else{ echo 0; }?>">
						<input type="hidden" name="admission_no" id="admission_no" value="<?php if(isset($student)){ echo $student[0]['admission_number']; } ?>">
                        <input type="hidden" name="id_parent" id="id_parent" value="<?php if(isset($parent)){ echo encode($parent[0]['id_parent']); }else{ echo 0; }?>">
                        <input type="hidden" name="id_user" id="id_user" value="<?php if(isset($parent)){ echo encode($parent[0]['user_id']); }else{ echo 0; }?>">
                        <input type="text" name="id_user_exist" id="id_user_exist">

                        <div class="text-center">
                            <!--<button class="btn btn-default">Clear</button>-->
							<?php if(isset($student)) { ?>
								<button id="save_button_id" class="btn btn-primary">Save</button>
								<button id="save_button_id_1" class="btn btn-primary" onclick='return select_parent();' style='display:none;'>Save</button>
							<?php } ?>
                        </div>

                    </form>
                </div>
                <!-- Tab2 End -->


                <!-- Tab3 Start -->
                <div id="tab3">
                    <form class="form-horizontal" id="student_prev_info" method="post" action="<?=BASE_URL?>index.php/student/createStudentPreviousInfo" enctype="multipart/form-data">

                        <div class="panel-body">

                            <h5>Previous Institution</h5>
                            <div class="form-group">

                                <label class="col-md-3 col-xs-12 control-label">Institution <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="student_prev_institute" id="student_prev_institute" value="<?php if(isset($student_prev_info)){ echo $student_prev_info[0]['previous_institution']; } ?>" class="form-control"/>
                                    </div>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Year <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="student_prev_year" id="student_prev_year" value="<?php if(isset($student_prev_info)){ echo $student_prev_info[0]['previous_year']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">

                                <label class="col-md-3 col-xs-12 control-label">Class </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="student_prev_class" id="student_prev_class" value="<?php if(isset($student_prev_info)){ echo $student_prev_info[0]['previous_class']; } ?>" class="form-control"/>
                                    </div>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Mark/Grade </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="student_prev_result" id="student_prev_result" value="<?php if(isset($student_prev_info)){ echo $student_prev_info[0]['previous_grade']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            
                            <?php 
                            	echo $SPreviousInfoDynamicFields;
                            ?>


                        </div>
                        <input type="hidden" name="id_student" id="id_student" value="<?php if(isset($student)){ echo encode($student[0]['id_student']); }else{ echo 0; }?>">
                        <input type="hidden" name="id_student_previous_info" id="id_student_previous_info" value="<?php if(isset($student_prev_info)){ echo encode($student_prev_info[0]['id_student_previous_info']); }else{ echo 0; }?>">
                        <div class="text-center">
                            <!--<button class="btn btn-default">Clear</button>-->
							<?php if(isset($parent)) { ?>
								<button class="btn btn-primary">Save</button>
							<?php } ?>
                        </div>

                    </form>
                </div>
                <!-- Tab3 End -->


                <!-- Tab4 Start -->
                <div id="tab4">

                    <form class="form-horizontal" id="student_documents" method="post" action="<?=BASE_URL?>index.php/student/createStudentDocuments" enctype="multipart/form-data">
                        <div class="panel-body">
                            <div id="existingDocumentDiv">
                                <?php if(isset($student_docs)){
                                    if(count($student_docs)>0){?>
                                        <h4>
                                            <u>Documents</u>
                                        </h4>
                                        <ol>
                                            <?php for($s=0;$s<count($student_docs);$s++){ ?>
                                                <li class="li-group">
                                                    <span class=""><a href="<?php echo BASE_URL.$student_docs[$s]['document_source'] ;?>" target="_blank"> <?PHP echo $student_docs[$s]['document_name'];?></a> <span><a id="<?php echo $student_docs[$s]['id_student_document']?>" title="delete" class="edit" onclick="deleteDocuments(this)"><span class="circle"><i class="fa fa-trash"></i></span></a></a></span></span>
                                                </li>
                                            <?php } ?>
                                        </ol>
                                    <?php } ?>
                                <?php }?>
                            </div>
                            <p>&nbsp; </p>
                            <div id="doumentsDiv">
                                <div class="form-group li-group">
                                    <label class="col-md-3 col-xs-12 control-label"> Documents <?php //if(!isset($student_docs)){ ?> <span class="clr-red">*</span><?php //} ?></label>
                                    <div class="col-md-3 col-xs-12">
                                        <div class="input-group">
                                            <input type="file" class="fileinput btn-primary document " name="documents[]"  title="logo"/>
                                            <label class="error" style="display: none">Please Select Document</label>
                                        </div>
                                        <span class="deleteSpan" ><a title="delete" onclick="deleteNewlyAddDocument(this)"><span class="circle"><i class="fa fa-trash"></i></span></a></a></span>
                                    </div>
                                </div>
                                <?php 
                                	echo $studentDocumentsDynamicFields;
                                ?>
                            </div>
                        </div>
						
						<?php if(isset($student_prev_info)) { ?>
							<div class="text-center">
								<a class="btn btn-primary" onclick="addAnotherDocument();">Add Another</a>
								<button class="btn btn-primary" <?php //if(!isset($student_docs)){ ?> onclick="return checkDocumentValidation();" <?php //} ?>>Save</button>
								<!--<a class="btn btn-primary" onclick="checkDocumentValidation();">Save</a>-->
							</div>
						<?php } ?>
                        <input type="hidden" name="student_documents_id" id="id_document" value=""/>
						<input type="hidden" name="admission_no" id="admission_no" value="<?php if(isset($student)){ echo $student[0]['admission_number']; } ?>">
                        <input type="hidden" name="id_student" id="id_student" value="<?php if(isset($student)){ echo encode($student[0]['id_student']); }else{ echo 0; }?>">

                    </form>

                </div>
                <!-- Tab4 End -->


            </div>
        </div>
    </div>

</section>

<script type="text/javascript">
    $(function(){
        $(".tabs-wrapper #content").find("[id^='tab']").hide(); // Hide all content
        $(".tabs-wrapper #tabs li:eq(<?=decode($active_tab)?>)").attr("id","current"); // Activate the first tab
        $(".tabs-wrapper #content #tab<?=(decode($active_tab)+1)?>").fadeIn(); // Show first tab's content

        $('#tabs a').click(function(e) {
            e.preventDefault();
            if ($(this).closest("li").attr("id") == "current"){ //detection for current tab
                return;
            }
            else{
                $(".tabs-wrapper #content").find("[id^='tab']").hide(); // Hide all content
                $(".tabs-wrapper #tabs li").attr("id",""); //Reset id's
                $(this).parent().attr("id","current"); // Activate this
                $('#' + $(this).attr('name')).fadeIn(); // Show content for the current tab
            }
        });

        $('#parent_exists_div').hide();
    });


    function addAnotherDocument(){

        var _html= '<div class="form-group li-group">'+
            '<label class="col-md-3 col-xs-12 control-label"> Documents <span class="clr-red">*</span></label>'+
            '<div class="col-md-3 col-xs-12">'+
            '<div class="input-group">'+
            '<input type="file" class="fileinput btn-primary document " name="documents[]"  title="logo"/>'+
            '<label class="error" style="display: none">Please Select Document</label>' +
            '</div>'+
            '<span class="deleteSpan"><a title="delete" onclick="deleteNewlyAddDocument(this)"><span class="circle"><i class="fa fa-trash"></i></span></a></a></span>'+
            '</div>'+
            '</div>';
        $('#doumentsDiv').append(_html);
    }


    function deleteNewlyAddDocument(e){

        $(e).parent().closest('.li-group').remove();
        if($('#doumentsDiv').find('.form-group').length==0){
            addAnotherDocument();
        }
    }

    function deleteDocuments(e){

        var _id=$(e).attr('id');
        $(e).parent().closest('.li-group').remove();
        var all_ids=$('#id_document').val();
        if(all_ids==''){
            $('#id_document').val(_id);

        }else{
            all_ids=all_ids+','+_id;
            $('#id_document').val(all_ids);
        }
    }

    function checkDocumentValidation()
    {
        var flag=0;
        //var doc_length=$('#doumentsDiv').find('.li-group').length;
        //alert(doc_length);
        $('.document').each(function(){

            if($(this).val()!=''){
                var _parent= $(this).parent();
                $(_parent).find('.error').hide();
                var flDoc=$(this).val();
                var flExt=flDoc.substring(flDoc.lastIndexOf('.')+1);
                //alert(flExt);
                if(flExt == "doc" || flExt == "docx" || flExt == "pdf" || flExt == "txt" || flExt == "xls" || flExt == "xlsx" || flExt == "csv" || flExt == "gif" || flExt == "png" || flExt == "jpg" || flExt == "jpeg")
                //if(flExt != "")
                {
                }else{
                    flag=1;
                    $(_parent).find('.error').text('Invalid Format It Allows doc, docx , xls, xlsx, csv, pdf, txt, gif, png, jpg, jpeg only!').show()
                }

            }else
            {
                if($('#id_document').val()=='') {
					var _parent= $(this).parent();
					$(_parent).find('.error').text('Please Select Document').show();
					flag=1;
                }
				else
					$('#student_documents').submit();
            }
        });

        if(flag==1){			
			return false;			
        }else{
            $('#student_documents').submit();
        }
    }

    function showParentSection(showID, hideID, saveID=0) {
        $('#'+showID+'_div').show();
        $('#'+hideID+'_div').hide();
        $('#save_button_id').show();
        $('#save_button_id_1').hide();
        //$('#ExistParentTable').hide();
        if(saveID > 0) {
            $('#save_button_id').hide();
            $('#exists_parent_div').html('');
            $('#parent_search_name').val('');
        }
    }

    $(document).on("keypress", "form", function(event) {
        return event.keyCode != 13;
    });
</script>