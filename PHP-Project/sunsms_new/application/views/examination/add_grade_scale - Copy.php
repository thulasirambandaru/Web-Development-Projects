
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/examination"> Home </a>
        </li>
        <li class="active">
            Add Grade Scale
        </li>
    </ul>
	
	<a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>
	
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><b>
				Add Grades
				<?php $show_elements = "style='display:none;'"; ?>
				</b></a></li>
            </ul>
            <div id="content">
                <div id="tab1">
					<?php //echo '<pre>';print_r($exam_schedule); ?>
                    <form class="form-horizontal" id="exam_exam_form" method="post" action="<?=BASE_URL?>index.php/examination/createExamMarks" enctype="multipart/form-data">
                        <div class="panel-body">
						
							<div class="form-group">													
                                <label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" <?php if(isset($exam_schedule)) { ?> disabled='disabled' <?php } ?> name="board_id" id="board_id" onchange='getCourses(this.value);'>
                                        <option value="0">Select Board</option>
                                        <?php for($s=0;$s<count($board);$s++){ ?>
                                            <option <?php if(isset($exam_schedule)){ if($exam_schedule[0]['board_id']==$board[$s]['id_board']){ echo "selected='selected'"; } } ?> value="<?=$board[$s]['id_board']?>"><?=$board[$s]['board_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
								
								<label class="col-md-3 col-xs-12 control-label">Select Class <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select multiple class="form-control select"  <?php if(isset($exam_schedule)) { ?> disabled='disabled' <?php } ?> name="student_course_id" id="student_course_id" onchange="showGradesList();" >
                                        <option value="0">Select Class </option>
                                        <?php
											if(isset($exam_schedule)) {
												for($c=0;$c<count($course);$c++){ ?>
													<option <?php if(isset($exam_schedule)){ if($exam_schedule[0]['course_id']==$course[$c]['id_course']){ echo "selected='selected'"; } } ?> value="<?=$course[$c]['id_course']?>"><?=$course[$c]['course_name']?></option>
											<?php } 
											}
										?>
                                    </select>
								</div>
                            </div>							
							
							<p>&nbsp;</p>							
							<div class="form-group error" id="sel_exam_schedule_err"></div>
							<div class="form-group" id="exam-schedule-div" <?php echo $show_elements; ?>>																
								<table class="commonTBL" id="tbl_exam_schedule">
									<tr>
										<th>Subject</th>
										<th>Exam Date</th>
										<th>Start Time</th>
										<th>End Time</th>                
									</tr>
									<tbody>
				
									<?php
									if(isset($exam_timetable)) {
										for($s=0;$s<$exam_timetable;$s++) {
									?>
									<tr id="<?php echo $s ?>" <?php echo $show_elements; ?>>
										<td>
											<select class="form-control select" name="course_subject_id[]" id="course_subject_id<?php echo $s ?>"> 
											<option value="0">Select Subject</option>
											<?php
												if(isset($exam_schedule)) {
													if(isset($subject)) {
														for($i=0;$i<count($subject);$i++) {
															$selected = '';
															if($exam_schedule[$s]['subject_id']==$subject[$i]['id_subject']){ $selected = "selected='selected'"; }
															echo "<option value='".$subject[$i]['id_subject']."' $selected>".$subject[$i]['subject_name']."</option>";
														}
													}
												}
											?>
										</td>
					
										<td>
										<input type="text" name="exam_date[]" id="exam_date<?php echo $s?>" class="form-control datepicker" value="<?php if(isset($exam_schedule)) { if(!empty($exam_schedule[$s]['exam_date'])) { echo date('d-M-Y',strtotime($exam_schedule[$s]['exam_date'])); } } ?>"/>
										</td>
					
										<td>		
											<select class="form-control select" name="start_time[]" id="start_time<?php echo $s?>"><option value="0">Select Time</option></select>											
										</td>
					
										<td>
											<select class="form-control select" name="end_time[]" id="end_time<?php echo $s?>"><option value="0">Select Time</option></select>																		
										</td>					
									</tr>
									<input type="hidden" name="exam_schedule_data_id[]" value="<?php if(isset($exam_schedule)) { if(isset($exam_schedule[$s]['id_exam_schedule_data'])) { echo $exam_schedule[$s]['id_exam_schedule_data']; } } ?>" >
						<?php }						
						}
						?>
							</table>
								
						</div> 
						
                        <div class="text-center" id="buttons-div" <?php if(!isset($edit)){?> style='display:none;' <?php } ?>>      
							<button class="btn btn-primary">Save</button>&nbsp;<input type="button" class="btn btn-primary" onclick="manageResetOperation('exam_schedule_reset');" value="Reset">
						</div>
						
                        <input type="hidden" name="id_exam_schedule" id="id_exam_schedule" value="<?php if(isset($exam_schedule)){ echo encode($exam_schedule[0]['id_exam_schedule']); } else { echo 0; } ?>">
						
						<input type="hidden" name="subject_count" id="subject_count" value="<?php if(isset($exam_schedule)){ echo count($exam_schedule); } ?>">
				
				
				</div>
				</form>
                
			</div>
            </div>
        </div>
    </div>
</section>
