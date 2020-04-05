<?php
$academic_year = $this->mfee->getAcademicYear(array('status' => 1));
if(!empty($academic_year))
    $academic_year_id = $academic_year[0]['id_academic_year'];
else $academic_year_id = 0;
$fee_type = $this->mfee->getClassFee(array('academic_year_id' => $academic_year_id,'class_id' => $student[0]['course_id']));
$total_fee = $this->mfee->getTotalFeeAmount(array('academic_year_id' => $academic_year_id,'class_id' => $student[0]['course_id']));
$paid_fee = $this->mfee->getTotalFeeCollected(array('academic_year_id' => $academic_year_id,'class_id' => $student[0]['course_id'],'student_id' => $student[0]['id_student']));
?>
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/admin/index"> Dashboard </a>
        </li>
        <li class="active">
            Fee
        </li>
    </ul>
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1">Fee</a></li>
            </ul>
            <div id="content">
                <div id="tab1">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div onclick="#" class="widget widget-default widget-item-icon">
                                    <div class="widget-item-left">
                                        <i aria-hidden="true" class="fa fa-dollar icon-blue"></i>
                                    </div>
                                    <div class="widget-data">
                                        <div class="widget-int num-count"><?=$total_fee[0]['amount']?></div>
                                        <div class="widget-title">Total</div>
                                        <div class="widget-subtitle">subtitle</div>
                                    </div>
                                    <div class="widget-controls"></div>
                                </div>                                        <!-- END WIDGET MESSAGES -->        </div>
                            <div class="col-md-4">                        <!-- START WIDGET MESSAGES -->
                                <div onclick="#" class="widget widget-default widget-item-icon">
                                    <div class="widget-item-left"><i class="fa fa-dollar icon-green"></i></div>
                                    <div class="widget-data">
                                        <div class="widget-int num-count"><?=$paid_fee[0]['amount']?></div>
                                        <div class="widget-title">Paid</div>
                                        <div class="widget-subtitle">subtitle</div>
                                    </div>
                                    <div class="widget-controls"></div>
                                </div>                                    <!-- END WIDGET MESSAGES -->        </div>
                            <div class="col-md-4">                            <!-- START WIDGET MESSAGES -->
                                <div onclick="#" class="widget widget-default widget-item-icon">
                                    <div class="widget-item-left"><i class="fa fa-dollar icon-red"></i></div>
                                    <div class="widget-data">
                                        <div class="widget-int num-count"><?=($total_fee[0]['amount']-$paid_fee[0]['amount'])?></div>
                                        <div class="widget-title">Due</div>
                                        <div class="widget-subtitle">subtitle</div>
                                    </div>
                                    <div class="widget-controls"></div>
                                </div>                                        <!-- END WIDGET MESSAGES -->        </div>
                        </div> <!-- END row class -->
                   <!--      <div>
                            <p style="float: right;"><form method="post" action="<?=BASE_URL.'index.php/fee/downloadPdf/'.base64_encode($student[0]['id_student'])?>"><input type="submit" class="btn" value="Download"></form></p>
                        </div> -->
                    </div>

                    
                      <form class="form-horizontal" id="course_form" method="post" action="" enctype="multipart/form-data"> 
                       <div class="panel-body">
                    <!-- Content of Fee structure -->
                    <div class="col-xs-12">

                                <div class="">
                                    <h5>Fee Details</h5>
                                    <?php for($s=0;$s<count($fee_type);$s++){ 
                                       if($s%2==0)
										{
											?>
										<div class="form-group">
										<?php } ?>
                                            <label style="width:170px" class="col-md-3 col-xs-12 control-label"><?=$fee_type[$s]['fee_type']?> : </label>
                                            <div class="col-md-3 col-xs-12 m4">
                                                <label><?=$fee_type[$s]['amount']?></label>
                                            </div>
                                        <?php if($s%2==1) { ?>
									</div>
								<?php }  } ?>
								<?php if($s%2==1) { ?>
								</div>
								<?php } ?>
                                </div>

                            </div>
                    <!-- End of Fee Structure -->
                    
                    <!-- Contents of Fee payment details  -->
                    <br><br>
               
                      
                        
                        
                        
                         <h5>Fee Pay Details</h5>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label style="width:170px" class="col-md-3 col-xs-12 control-label">Admission Number : </label>
                                    <div class="col-md-3 col-xs-12 m4">
                                        <label><?=$student[0]['admission_number']?></label>
                                    </div>
                                
                                    <label class="col-md-3 col-xs-12 control-label">Name : </label>
                                    <div class="col-md-3 col-xs-12 m4">
                                        <label><?=$student[0]['first_name'].' '.$student[0]['last_name']?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Section : </label>
                                    <div class="col-md-3 col-xs-12 m4">
                                        <label><?=$student[0]['section_name']?></label>
                                    </div>
                               
                                    <label class="col-md-3 col-xs-12 control-label">Course : </label>
                                    <div class="col-md-3 col-xs-12 m4">
                                        <label><?=$student[0]['course_name']?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Board Name : </label>
                                    <div class="col-md-3 col-xs-12 m4">
                                        <label><?=$student[0]['board_name']?></label>
                                    </div>
                                
                                    <label class="col-md-3 col-xs-12 control-label">Total Fee : </label>
                                    <div class="col-md-3 col-xs-12 m4">
                                        <label><?=$total_fee[0]['amount']?></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Paid Fee : </label>
                                    <div class="col-md-3 col-xs-12 m4">
                                        <label><?=$total_fee[0]['amount']?></label>
                                    </div>
                                </div>
                                <?php if($this->session->userdata('user_type_id')==ADMIN){ ?>
                                
                                <?php
                                //$fee_type_value=array(); 
                                for($s=0;$s<count($fee_type);$s++){ 
                                	//$fee_type_value[]=$fee_type[$s]['fee_type'];
                                	//$fee_type_name=strtolower($fee_type[$s]['fee_type']);
                                	$fee_type_name=str_replace(' ', '_', strtolower($fee_type[$s]['fee_type']));
                                	if($s%2==0)
                                	{
                                    ?>
                                <div class="form-group">
                                <?php } ?>
                                    <label class="col-md-3 col-xs-12 control-label"><?=$fee_type[$s]['fee_type']?></label>
                                    <div class="col-md-3 col-xs-12 m4">
                                         <input type='text' name="<?=$fee_type_name?>" id="<?=$fee_type_name?>">
                                         <span class="error" id="<?=$fee_type_name?>_error"></span>
                                    </div>
                                 <?php if($s%2==1) { ?>
                                </div>
                                <?php } } ?>
                                <?php if($s%2==1) { ?>
								</div>
								<?php } ?>
                                <!-- <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Pay : </label>
                                    <div class="col-md-6 col-xs-12 m4">
                                        <input type="text" name="fee_amount" id="fee_amount" onkeypress="return isNumberKey(event)" value="0">
                                        <span class="error" id="fee_err"></span>
                                    </div>
                                </div>  -->
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label"></label>
                                    <div class="col-md-6 col-xs-12 m4">
                                        <input type="checkbox" name="notify" id="notify"> Notify
                                        <input type="button" onclick="payAmount();" class="btn"  id="fee_pay" value="Pay">
                                        <span class="error" id="fee_err"></span>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            
                        


                   
                     </div>
                    <!-- End of Fee payment details  -->
                    </form>
                    
                    <div class="form-horizontal">
                        <div style="width: auto;overflow: auto">
                        <table id="table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Fee type</th>
                                <th>Paid</th>
                                <th>Due</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                        </div>
                        <input type="hidden" id="student_id" value="<?=$student[0]['id_student']?>">
                        <input type="hidden" id="remain" value="<?=($total_fee[0]['amount']-$paid_fee[0]['amount'])?>">
                        <input type="hidden" id="academic_year_id" value="<?=$academic_year_id ?>">
                        <input type="hidden" id="class_id" value="<?=$student[0]['course_id'] ?>">
                        <input type='hidden' id='fee_type_value' name='fee_type_value' value='<?= json_encode($fee_type_value); ?>'>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function() {
        getStudentFeeDetails();
    });
</script>