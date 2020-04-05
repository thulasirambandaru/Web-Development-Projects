
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="<?=BASE_URL?>index.php/Staff">Home</a>
        </li>
        <li class="active">
            Add Staff
        </li>
    </ul>
	
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"> Staff Details </a></li>                
				<li><a href="#" name="tab2"> Staff Contact Details </a></li>                
				<li><a href="#" name="tab3"> Staff Documents </a></li>
                <!--<li style="display: <?php //if(isset($teacher_details)){ echo 'block'; }else{ echo 'none';} ?> "><a href="#" name="tab2"> Teacher Contact Details </a></li>
                <li style="display: <?php //if(isset($teacher_details)){ echo 'block'; }else{ echo 'none';} ?> "><a href="#" name="tab3"> Teacher Documents</a></li>-->
            </ul>
            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="staff_details" method="post" action="<?=BASE_URL?>index.php/staff/createStaffDetails" enctype="multipart/form-data">
                        <div class="panel-body">
                          <div>
                            <h5>General Details</h5>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label"> Staff Code <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="teacher_number" id="teacher_number" value="<?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['teacher_number']); } else { echo $teacher_number;} ?>" class="form-control"/>
                                    </div>
                                </div>
                                <label class="col-md-3 col-xs-12 control-label"> Joining Date <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        <input type="text" class="form-control datepicker" name="joining_date" id="joining_date" value="<?php if(isset($teacher_details)){ echo htmlentities(date('d-M-Y',strtotime($teacher_details[0]['joining_date']))); } ?>" onkeypress="return false" title="joining date"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label"> First Name <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="first_name" id="first_name" value="<?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['first_name']); } ?>" class="form-control"/>
                                    </div>
                                </div>								
                                <label class="col-md-3 col-xs-12 control-label"> Last Name <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="last_name" id="last_name" value="<?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['last_name']); } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label"> Gender<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="gender" id="gender">
                                        <option value="0">Select Gender </option>
                                        <option value="Male" <?php if(isset($teacher_details)){ if($teacher_details[0]['gender']=='Male'){ echo "selected='selected'"; } } ?>>Male </option>
                                        <option value="Female" <?php if(isset($teacher_details)){ if($teacher_details[0]['gender']=='Female'){ echo "selected='selected'"; } } ?>>Female </option>
                                    </select>
                                </div>
                                <label class="col-md-3 col-xs-12 control-label"> Date Of Birth <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        <input type="text" class="form-control datepicker" name="date_of_birth" id="date_of_birth" value="<?php if(isset($teacher_details)){ echo htmlentities(date('d-M-Y',strtotime($teacher_details[0]['dob']))); } ?>" onkeypress="return false"  title="Date Of Birth"/>

                                    </div>
                                </div>
                            </div>
                           <div class="form-group">
                               <label class="col-md-3 col-xs-12 control-label"> Staff Department <span class="clr-red">*</span></label>
                               <div class="col-md-3 col-xs-12">
                                   <select class="form-control select" name="teacher_department" id="teacher_department">
                                       <option value="0">Select Department </option>
                                       <?php for($s=0;$s<count($department);$s++){ ?>
                                           <option <?php if(isset($teacher_details)){ if($teacher_details[0]['teacher_department']==$department[$s]['id_department']){ echo "selected='selected'"; } } ?> value="<?=$department[$s]['id_department']?>"><?=$department[$s]['department_name']?></option>
                                       <?php } ?>
                                   </select>
                               </div>
                               <label class="col-md-3 col-xs-12 control-label"> Staff Type <span class="clr-red">*</span></label>
                               <div class="col-md-3 col-xs-12">
                                   <select class="form-control select" name="teacher_type" id="teacher_type">
                                       <option value="0">Select Type</option>
                                       <?php for($s=0;$s<count($staff_type);$s++){ ?>
                                           <option <?php if(isset($teacher_details)){ if($teacher_details[0]['teacher_type']==$staff_type[$s]['id_staff_type']){ echo "selected='selected'"; } } ?> value="<?=$staff_type[$s]['id_staff_type']?>"><?=$staff_type[$s]['staff_type_name']?></option>
                                       <?php } ?>
                                   </select>
                               </div>
                           </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label"> Qualification <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="qualification" id="qualification" value="<?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['qualification']); } ?>" class="form-control"/>
                                    </div>
                                </div>
                                <label class="col-md-3 col-xs-12 control-label"> Job Title</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="job_title" id="job_title" value="<?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['job_title']); } ?>" class="form-control"/>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <!--<p style="margin-left:75px"> Experience </p>-->
<!--                                <label class="col-md-3 col-xs-12 control-label">  <span class="clr-red">*</span></label>-->
<!--                                <div class="col-md-3 col-xs-12">-->
<!--                                    <div class="input-group">-->
<!--                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>-->
<!--                                        <input type="text" name="experience" id="experience" value="--><?php //if(isset($teacher_details)){ echo $teacher_details[0]['experience']; } ?><!--" class="form-control"/>-->
<!--                                    </div>-->
<!--                                </div>-->
                                <label class="col-md-3 col-xs-12 control-label"> Experience <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="year_id" id="year_id">
                                        <option value="-1"> Years </option>
										<?php
											for($y=0;$y<=50;$y++) { ?>
												<option value="<?php echo $y; ?>" <?php if(isset($teacher_details)){ if($teacher_details[0]['years']==$y){ echo "selected='selected'"; } } ?>><?php echo $y; ?></option>
									<?php } ?>
										
                                    <!--<option value="0" <?php //if(isset($teacher_details)){ if($teacher_details[0]['year_id']==0){ echo "selected='selected'"; } } ?>>0</option>-->                                        
                                    </select>
                                </div>
								
                                <label class="col-md-3 col-xs-12 control-label"> </label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="months_id" id="months">
                                        <option value="-1"> Months </option>
										<?php
											for($m=0;$m<=12;$m++) { ?>
												<option value="<?php echo $m; ?>" <?php if(isset($teacher_details)){ if($teacher_details[0]['months']==$m){ echo "selected='selected'"; } } ?>><?php echo $m; ?></option>
									<?php } ?>
									
                                       <!--<option value="0" <?php //if(isset($teacher_details)){ if($teacher_details[0]['months_id']==0){ echo "selected='selected'"; } } ?>>0</option>-->                                        
                                    </select>
                                </div>
								
                            </div>
							
                              <div class="form-group">
                                  <label class="col-md-3 col-xs-12 control-label"> Phone Number <span class="clr-red">*</span></label>
                                  <div class="col-md-3 col-xs-12">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-mobile"></span></span>
                                          <input type="text" name="phone_number" id="phone_number" value="<?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['phone_number']); } ?>" class="form-control"/>
                                      </div>
                                  </div>
                                  <label class="col-md-3 col-xs-12 control-label"> Email </label>
                                  <div class="col-md-3 col-xs-12">
                                      <div class="input-group">
                                          <span class="input-group-addon">@</span></span>
                                          <input type="text" name="email" id="email" value="<?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['email']); } ?>" class="form-control"/>
                                      </div>
                                  </div>

                              </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label"> Experience Details</label>
                                <div class="col-md-9 col-xs-12">
                                    <textarea rows="5" class="form-control" name="experience_details" id="experience_details"><?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['experience_details']); } ?></textarea>
                                </div>
                            </div>
							
                          <!--<div class="form-group">
                              <label class="col-md-3 col-xs-12 control-label"> Status<span class="clr-red">*</span></label>
                              <div class="col-md-3 col-xs-12">
                                  <select class="form-control select" name="staff_status" id="staff_status">
                                      <option value="1" <?php //if(isset($teacher_details)){ if($teacher_details[0]['staff_status']==1){ echo "selected='selected'"; } } ?>>Active </option>
                                      <option value="0" <?php //if(isset($teacher_details)){ if($teacher_details[0]['staff_status']==0){ echo "selected='selected'"; } } ?>>InActive </option>
                                  </select>
                              </div>
                          </div>-->
                          
                          <?php 
                          	echo $staffGeneralDetails;
                          ?>
						  
                       </div>
                        <div>
                            <h5>Personal Details</h5>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label"> Marital Status </label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="marital_status" id="marital_status" onchange='showRelationFields(this.value);'>
										<option value="0"> Select </option>
                                        <option value="Single" <?php if(isset($teacher_details)){ if($teacher_details[0]['marital_status']=='Single'){ echo "selected='selected'"; } } ?>>Single </option>
                                        <option value="Married" <?php if(isset($teacher_details)){ if($teacher_details[0]['marital_status']=='Married'){ echo "selected='selected'"; } } ?>>Married </option>
                                    </select>
                                </div>
                                <label class="col-md-3 col-xs-12 control-label"> Blood Group </label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="blood_group" id="blood_group">
                                        <option value="0">Select Blood Group </option>
                                        <?php for($s=0;$s<count($blood_group);$s++){ ?>
                                            <option <?php if(isset($teacher_details)){ if($teacher_details[0]['blood_group_id']==$blood_group[$s]['id_blood_group']){ echo "selected='selected'"; } } ?> value="<?=$blood_group[$s]['id_blood_group']?>"><?=$blood_group[$s]['name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label"> Father Name</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="father_name" id="father_name" value="<?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['father_name']); } ?>" class="form-control"/>
                                    </div>
                                </div>
                                <label class="col-md-3 col-xs-12 control-label"> Mother Name</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="mother_name" id="mother_name" value="<?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['mother_name']); } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
							
                            <div class="form-group" id='relation_fields' style='display:none;'>
                                <label class="col-md-3 col-xs-12 control-label"> Husband / Spouse</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="relation_name" id="relation_name" value="<?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['relation_name']); } ?>" class="form-control"/>
                                    </div>
                                </div>
								
                                <label class="col-md-3 col-xs-12 control-label"> Children Count</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="children_count" id="children_count" value="<?php if(isset($teacher_details)){ echo htmlentities($teacher_details[0]['children_count']); } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
							
                            <div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"> Nationality </label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="nationality_id" id="nationality_id">
                                        <option value="0">Select Nationality </option>
                                        <option value="1" <?php if(isset($teacher_details)){ if($teacher_details[0]['nationality_id']==1){ echo "selected='selected'"; } } ?>>Indian </option>
                                        <!--<option value="2" <?php //if(isset($teacher_details)){ if($teacher_details[0]['nationality_id']==2){ echo "selected='selected'"; } } ?>>Us </option>-->
                                    </select>
                                </div>
								
                                <label class="col-md-3 col-xs-12 control-label"> Upload Photo </label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
										<span class="input-group-addon"><span class="fa fa-upload"></span></span>
                                        <input type="file" class="fileinput btn-primary" name="profile_pic"  title="logo"/>
                                    </div>
                                </div>
                            </div>
                            
                            <?php 
                            	echo $staffPersonalDynamicFields;
                            
                            ?>

<!--                          <div class="form-group">-->
<!--                                <label class="col-md-3 col-xs-12 control-label"> Address</label>-->
<!--                                <div class="col-md-9 col-xs-12">-->
<!--                                    <textarea rows="5" class="form-control" name="address" id="address">--><?php //if(isset($teacher_details)){ echo $teacher_details[0]['address']; } ?><!--</textarea>-->
<!--                                </div>-->
<!--                            </div>-->

                        </div>
                      </div>
                        <div class="text-center">
                            <!--<button class="btn btn-primary"><?php //if(isset($teacher_details)){ ?>Update<?php //} else { ?>Save<?php //} ?></button>-->
							<button class="btn btn-primary">Save</button>
                        </div>
                        <input type="hidden" name="id_staff" id="id_staff" value="<?php if(isset($teacher_details)){ echo encode($teacher_details[0]['id_staff']); } else { echo 0; } ?>">
						<input type="hidden" name="id_user" id="id_user" value="<?php if(isset($teacher_details)){ echo encode($teacher_details[0]['id_user']); }else{ echo 0; }?>">
                    </form>
                </div>
				
                <div id="tab2">
                    <form class="form-horizontal" id="staff_contact_details" method="post" action="<?=BASE_URL?>index.php/staff/createStaffContact" >
                        <div class="panel-body">
                          <div>
                              <h5>Home Address</h5>
                              <div class="form-group">							  
                                  <label class="col-md-3 col-xs-12 control-label"> Address Line 1 <span class="clr-red">*</span></label>
                                  <div class="col-md-3 col-xs-12">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input type="text" name="home_address_line1" id="home_address_line1" value="<?php if(isset($teacher_contact)){ echo htmlentities($teacher_contact[0]['home_address_line1']); } ?>" class="form-control"/>
                                      </div>
                                  </div>
                                  <label class="col-md-3 col-xs-12 control-label"> Address Line 2 </label>
                                  <div class="col-md-3 col-xs-12">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input type="text" name="home_address_line2" id="home_address_line2" value="<?php if(isset($teacher_contact)){ echo htmlentities($teacher_contact[0]['home_address_line2']); } ?>" class="form-control"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">							  
                                  <label class="col-md-3 col-xs-12 control-label"> City <span class="clr-red">*</span></label>
                                  <div class="col-md-3 col-xs-12">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input type="text" name="home_city" id="home_city" value="<?php if(isset($teacher_contact)){ echo htmlentities($teacher_contact[0]['home_city']); } ?>" class="form-control"/>
                                      </div>
                                  </div>
                                  <label class="col-md-3 col-xs-12 control-label"> State <span class="clr-red">*</span></label>
                                  <div class="col-md-3 col-xs-12">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input type="text" name="home_state" id="home_state" value="<?php if(isset($teacher_contact)){ echo htmlentities($teacher_contact[0]['home_state']); } ?>" class="form-control"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-3 col-xs-12 control-label"> Country <span class="clr-red">*</span></label>
                                  <div class="col-md-3 col-xs-12">
                                      <select class="form-control select" name="home_country_id" id="home_country_id" onchange="getState(this.value);">
                                          <option value="0">Select Country</option>
                                          <?php for($s=0;$s<count($county);$s++){ ?>
                                              <option <?php if(isset($teacher_contact)){ if($teacher_contact[0]['home_country_id']==$county[$s]['id_country']){ echo "selected='selected'"; } } ?> value="<?=$county[$s]['id_country']?>"><?=$county[$s]['country']?></option>
                                          <?php } ?>
                                      </select>
                                  </div>
                                  <label class="col-md-3 col-xs-12 control-label"> Pincode </label>
                                  <div class="col-md-3 col-xs-12">
                                      <div class="input-group">
                                          <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                          <input type="text" name="home_pincode" id="home_pincode" value="<?php if(isset($teacher_contact)){ echo htmlentities($teacher_contact[0]['home_pincode']); } ?>" class="form-control"/>
                                      </div>
                                  </div>
                              </div>
                              
                              <?php 
                              	echo $staffContactDynamicFields;
                              ?>
                          </div>                            
                        </div>
						                        
						<?php if(isset($teacher_details)) { ?>
							<div class="text-center">
								<button class="btn btn-primary">Save</button>
							</div>
						<?php } ?>
						
                        <input type="hidden" name="id_staff_contact" id="id_staff_contact" value="<?php if(isset($teacher_contact)){ echo encode($teacher_contact[0]['id_staff_contact']); } else { echo 0; } ?>">
                        <input type="hidden" name="id_staff" id="id_staff" value="<?php if(isset($teacher_details)){ echo encode($teacher_details[0]['id_staff']); } else { echo 0; } ?>">						
                    </form>
                </div>
				
                <div id="tab3">
					<form class="form-horizontal" id="staff_documents" method="post" action="<?=BASE_URL?>index.php/staff/createStaffDocuments" enctype="multipart/form-data">
                        <div class="panel-body">
                            <div id="existingDocumentDiv">
                                <?php if(isset($teacher_documents))
								{
                                    if(count($teacher_documents)>0){?>
                                        <h4>
                                            <u>Documents</u>
                                        </h4>
                                        <ol>
                                            <?php for($s=0;$s<count($teacher_documents);$s++){ ?>
                                                <li class="li-group">
                                                    <span class=""><a href="<?php echo BASE_URL.$teacher_documents[$s]['document_source'] ;?>" target="_blank"> <?PHP echo $teacher_documents[$s]['document_name'];?></a> <span><a id="<?php echo $teacher_documents[$s]['id_staff_document']?>" title="delete" class="edit" onclick="deleteDocuments(this)"><span class="circle"><i class="fa fa-trash"></i></span></a></a></span></span>
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
                              		echo $staffDocumentsDynamicFields;
                              	?>
                            </div>
                        </div>
						
						<?php if(isset($teacher_contact)) { ?>
							<div class="text-center">
								<a class="btn btn-primary" onclick="addAnotherDocument();">Add Another</a>
								<button class="btn btn-primary" <?php //if(!isset($student_docs)){ ?> onclick="return checkDocumentValidation();" <?php //} ?>>Save</button>
								<!--<a class="btn btn-primary" onclick="checkDocumentValidation();">Save</a>-->
							</div>
						<?php } ?>
                        <input type="hidden" name="staff_documents_id" id="id_document" value=""/>
						<input type="hidden" name="teacher_number" id="teacher_number" value="<?php if(isset($teacher_details)){ echo $teacher_details[0]['teacher_number']; } ?>">
                        <input type="hidden" name="id_staff" id="id_staff" value="<?php if(isset($teacher_details)){ echo encode($teacher_details[0]['id_staff']); }else{ echo 0; }?>">

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(function(){
        $(".tabs-wrapper #content").find("[id^='tab']").hide(); // Hide all content
        $(".tabs-wrapper #tabs li:eq(<?=$active_tab;?>)").attr("id","current"); // Activate the first tab
        $(".tabs-wrapper #content #tab<?=($active_tab+1);?>").fadeIn(); // Show first tab's content

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
		showRelationFields($('#marital_status').val());
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
					$('#staff_documents').submit();
            }
        });

        if(flag==1){			
			return false;			
        }else{
            $('#staff_documents').submit();
        }
    }
	
	function showRelationFields(val) {
		if(val == "Married") {
			$('#relation_fields').show();
		}
		else {
			$('#relation_fields').hide();
			$('#relation_name').val('');
			$('#children_count').val('');
		}
	}
    
    $(document).on("keypress", "form", function(event) {
        return event.keyCode != 13;
    });
</script>