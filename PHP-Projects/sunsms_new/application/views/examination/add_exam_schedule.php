
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/examination"> Home </a>
        </li>
        <li class="active">
            Add Exam Schedule
        </li>
    </ul>
	
	<a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>
	
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><b>
				<?php 
					if(isset($exam_schedule)) 
					{ 
						if(isset($preview))
							echo "Preview Exam Schedule";
						else
							echo "Edit Exam Schedule";
							
						$exam_timetable = count($exam_schedule);
						if(isset($subject)) {
							if(count($subject) > count($exam_schedule)) {
								$exam_timetable = count($subject);
							}
						}						
						$show_elements = "";						
						
				 } else {
						echo "Add Exam Schedule";
						$exam_timetable = $allsubjects;
						$show_elements = "style='display:none;'";
				} ?>
				</b></a></li>
            </ul>
            <div id="content">
                <div id="tab1">
					<?php //echo '<pre>';print_r($exam_schedule); ?>
                    <form class="form-horizontal" id="exam_schedule_form" method="post" action="<?=BASE_URL?>index.php/examination/createExamSchedule" enctype="multipart/form-data" onsubmit="return validateSubjectSelect();">
                        <div class="panel-body">
							<?php if(isset($preview)) { ?>
							<!-- Preview Mode -->
							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><b>Select Exam</b></label>
                                <div class="col-md-3 col-xs-12 m4">                                    
								<?php 
								for($s=0;$s<count($exams);$s++) 
								{ 
									if(isset($exam_schedule)) 
										if($exam_schedule[0]['exam_id']==$exams[$s]['id_exam'])
											echo $exams[$s]['exam_name'];
								}
								?>                                    
                                </div>
								
                                <label class="col-md-3 col-xs-12 control-label"><b>Select Board</b></label>
                                <div class="col-md-3 col-xs-12 m4">                                    
								<?php 
								for($s=0;$s<count($board);$s++)
								{
									if(isset($exam_schedule))
										if($exam_schedule[0]['board_id']==$board[$s]['id_board']) 
											echo$board[$s]['board_name'];
								}
								?>                                    
                                </div>
                            </div>
							
                            <div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><b>Select Class</b></label>
                                <div class="col-md-3 col-xs-12 m4">                                    
								<?php								
								for($c=0;$c<count($course);$c++)
								{ 
									if(isset($exam_schedule))											
										if($exam_schedule[0]['course_id']==$course[$c]['id_course'])	echo $course[$c]['course_name'];
								}
								?>                                    
                                </div>
								
								<div class="form-group" id="course_section_id_div" <?php if(isset($preview) && $exam_schedule[0]['section_id'] > 0) { echo "style='display:block;'"; } else { echo "style='display:none;'"; } ?> >
                                <label class="col-md-3 col-xs-12 control-label"><b>Select Section</b></label>
                                <div class="col-md-3 col-xs-12">
                                    <?php
                                        if(isset($section)) { 
											if(isset($exam_schedule)) {
												for($s=0;$s<count($section);$s++) { 
													if($exam_schedule[0]['section_id']==$section[$s]['id_section'])
													{
														echo $section[$s]['section_name'];
													}
												}
											}
										}
									?>										
                                </div>
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
											
										<?php
											if(isset($exam_schedule)) {
												if(isset($subject)) {
													for($i=0;$i<count($subject);$i++) {
														$selected = '';
														if($exam_schedule[$s]['subject_id']==$subject[$i]['id_subject'])
														{ 
															echo $subject[$i]['subject_name'];
														}
													}
												}
											}
											?>
										</td>
					
										<td>
										<?php if(isset($exam_schedule)) { if(!empty($exam_schedule[$s]['exam_date'])) { echo date('d-M-Y',strtotime($exam_schedule[$s]['exam_date'])); } } ?>
										</td>
					
										<td id="td_start_time<?php echo $s ?>">		
											<select class="form-control select" style="display:none;" name="start_time[]" id="start_time<?php echo $s?>"><option value="0">Select Time</option></select>											
										</td>
					
										<td id="td_end_time<?php echo $s ?>">
											<select class="form-control select" style="display:none;" name="end_time[]" id="end_time<?php echo $s?>"><option value="0">Select Time</option></select>																		
										</td>					
									</tr>
									<input type="hidden" name="exam_schedule_data_id[]" value="<?php if(isset($exam_schedule)) { if(isset($exam_schedule[$s]['id_exam_schedule_data'])) { echo $exam_schedule[$s]['id_exam_schedule_data']; } } ?>" >
						<?php }						
						}
						?>
							</table>
								
						</div> 
						
                        <div class="text-center" id="buttons-div" <?php if(!isset($edit)){?> style='display:none;' <?php } ?>>      
							<button class="btn btn-primary">Save</button>&nbsp;<input type="button" class="btn btn-primary" onclick="getExamSubjects(1);" value="Reset">
						</div>
						
                        <input type="hidden" name="id_exam_schedule" id="id_exam_schedule" value="<?php if(isset($exam_schedule)){ echo encode($exam_schedule[0]['id_exam_schedule']); } else { echo 0; } ?>">
						
						<input type="hidden" name="subject_count" id="subject_count" value="<?php if(isset($exam_schedule)){ echo count($exam_schedule); } ?>">
						                    
				<?php }  else  {?>
						
						<!-- Edit Mode -->
						
						<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label">Select Exam <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" <?php if(isset($exam_schedule)) { ?> disabled='disabled' <?php } ?> name="exam_id" id="exam_id">
                                        <option value="0">Select Exam</option>
                                        <?php for($s=0;$s<count($exams);$s++){ ?>
                                            <option <?php if(isset($exam_schedule)){ if($exam_schedule[0]['exam_id']==$exams[$s]['id_exam']){ echo "selected='selected'"; } } ?> value="<?=$exams[$s]['id_exam']?>"><?=$exams[$s]['exam_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
								
                                <label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" <?php if(isset($exam_schedule)) { ?> disabled='disabled' <?php } ?> name="board_id" id="board_id" onchange='getCourses(this.value);'>
                                        <option value="0">Select Board</option>
                                        <?php for($s=0;$s<count($board);$s++){ ?>
                                            <option <?php if(isset($exam_schedule)){ if($exam_schedule[0]['board_id']==$board[$s]['id_board']){ echo "selected='selected'"; } } ?> value="<?=$board[$s]['id_board']?>"><?=$board[$s]['board_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
							
                            <div class="form-group">
								<label class="col-md-3 col-xs-12 control-label">Select Class <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select"  <?php if(isset($exam_schedule)) { ?> disabled='disabled' <?php } ?> name="student_course_id" id="student_course_id" onchange="manageSections(this.value, 'examination');getExamSubjects(this.value)" >
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
								
								<div class="form-group" id="course_section_id_div" <?php if(isset($edit) && $exam_schedule[0]['section_id'] > 0) { echo "style='display:block;'"; } else { echo "style='display:none;'"; } ?> >
                                <label class="col-md-3 col-xs-12 control-label">Select Section <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" <?php if(isset($exam_schedule)) { ?> disabled='disabled' <?php } ?> name="course_section_id" id="course_section_id">
                                        <option value="0">Select Section </option>
                                        <?php
                                        if(isset($section))
                                        {
                                            for($s=0;$s<count($section);$s++) { ?>
                                                <option value="<?=$section[$s]['id_section']?>" <?php if(isset($exam_schedule)){ if($exam_schedule[0]['section_id']==$section[$s]['id_section']){ echo "selected='selected'"; } } ?>><?=$section[$s]['section_name']?></option>
                                            <?php }
                                        }?>
                                    </select>
                                </div>
								
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
				
				<?php } ?>
				</div>
				</form>
                
			</div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

$(function () 
{			
	//var start_time = '';
	//var end_time = '';
	<?php 
	if(isset($exam_schedule))
	{			
		for($t=0;$t<count($exam_schedule);$t++) 
		{ ?>
			populate('#start_time'+<?php echo $t?>);
			populate('#end_time'+<?php echo $t?>);
		<?php
			if($exam_schedule[$t]['start_time'] != "00:00:00") 
			{
				sscanf($exam_schedule[$t]['start_time'], "%d:%d", $hours, $minutes);
				if($minutes<10) { $minutes = '0'.$minutes; }			
			?>
				start_time = '<?=$hours.':'.$minutes?>';
				<?php
				if(isset($preview))  {?>
					$('#start_time'+<?php echo $t?>).val(start_time);
					start_time_name = $("#start_time<?php echo $t?> option:selected").text();
					
					$('#td_start_time'+<?php echo $t?>).html(start_time_name);
				<?php } else { ?>
					$('#start_time'+<?php echo $t?>).val(start_time);
		<?php 	} 
			} // End If?>
		
		<?php
			if($exam_schedule[$t]['end_time'] != "00:00:00") 
			{
				sscanf($exam_schedule[$t]['end_time'], "%d:%d", $hours1, $minutes1);
				if($minutes1<10) { $minutes1 = '0'.$minutes1; }
			?>	
				end_time = '<?=$hours1.':'.$minutes1?>';
				<?php
				if(isset($preview)) { ?>
					$('#end_time'+<?php echo $t?>).val(end_time);
					end_time_name = $("#end_time<?php echo $t?> option:selected").text();
					$('#td_end_time'+<?php echo $t?>).html(end_time_name);
				<?php } else { ?>
					$('#end_time'+<?php echo $t?>).val(end_time);
		<?php 	}
			} 	//End If					
		} 	// End for
	} // End If?>
});
	
</script>