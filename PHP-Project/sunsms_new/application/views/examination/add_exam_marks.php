
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/examination"> Home </a>
        </li>
        <li class="active">
            Add Exam Marks
        </li>
    </ul>
	
	<a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>
	
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><b>
				<?php 
					if(isset($marks_record)) 
					{ 
						if(isset($preview))
							echo "Preview Exam Marks";
						else
							echo "Edit Exam Marks";																		
				 } else {
						echo "Add Exam Marks";						
				} ?>
				</b></a></li>
            </ul>
            <div id="content">
                <div id="tab1">
					<?php //echo '<pre>';print_r($marks_record); ?>
                    <form class="form-horizontal" id="exam_marks_form" method="post" action="<?=BASE_URL?>index.php/examination/createExamMarks" enctype="multipart/form-data" autocomplete="off" onsubmit="return validateSubjectMarks();">
						<div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label">Select Exam <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" <?php if(isset($marks_record)) { ?> readonly <?php } ?> name="exam_id" id="exam_id">
                                        <option value="0">Select Exam</option>
                                        <?php for($s=0;$s<count($exams);$s++){ ?>
                                            <option <?php if(isset($marks_record)){ if($marks_record[0]['exam_id']==$exams[$s]['id_exam']){ echo "selected='selected'"; } } ?> value="<?=$exams[$s]['id_exam']?>"><?=$exams[$s]['exam_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
								
                                <label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" <?php if(isset($marks_record)) { ?> readonly <?php } ?> name="board_id" id="board_id" onchange='getCourses(this.value);'>
                                        <option value="0">Select Board</option>
                                        <?php for($s=0;$s<count($board);$s++){ ?>
                                            <option <?php if(isset($marks_record)){ if($marks_record[0]['board_id']==$board[$s]['id_board']){ echo "selected='selected'"; } } ?> value="<?=$board[$s]['id_board']?>"><?=$board[$s]['board_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
							
                            <div class="form-group">
								<label class="col-md-3 col-xs-12 control-label">Select Class <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select"  <?php if(isset($marks_record)) { ?> readonly <?php } ?> name="student_course_id" id="student_course_id" onchange="manageSections(this.value, 'examination');getCourseSubjects(this.value);" >
                                        <option value="0">Select Class </option>
                                        <?php
											if(isset($marks_record)) {
												for($c=0;$c<count($course);$c++){ ?>
													<option <?php if(isset($marks_record)){ if($marks_record[0]['course_id']==$course[$c]['id_course']){ echo "selected='selected'"; } } ?> value="<?=$course[$c]['id_course']?>"><?=$course[$c]['course_name']?></option>
											<?php } 
											}
										?>
                                    </select>
                                </div>
								
								<div id="course_section_id_div" <?php if(isset($marks_record) && $marks_record[0]['section_id'] > 0) { echo "style='display:block;'"; } else { echo "style='display:none;'"; } ?> >
                                <label class="col-md-3 col-xs-12 control-label">Select Section <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" <?php if(isset($marks_record)) { ?> readonly <?php } ?> name="course_section_id" id="course_section_id" onchange="getCourseSubjects();">
                                        <option value="0">Select Section </option>
                                        <?php
                                        if(isset($section))
                                        {
                                            for($s=0;$s<count($section);$s++) { ?>
                                                <option value="<?=$section[$s]['id_section']?>" <?php if(isset($marks_record)){ if($marks_record[0]['section_id']==$section[$s]['id_section']){ echo "selected='selected'"; } } ?>><?=$section[$s]['section_name']?></option>
                                            <?php }
                                        }?>
                                    </select>
                                </div>
								
								</div>
	                            							
							</div>	
							
							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label">Select Subject <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select"  <?php if(isset($marks_record)) { ?> readonly <?php } ?> name="course_subject_id" id="course_subject_id" onchange="getStudentMarks();">
                                        <option value="0">Select Subject </option>
                                        <?php
											if(isset($marks_record)) {
												for($c=0;$c<count($subject);$c++){ ?>
													<option <?php if(isset($marks_record)){ if($marks_record[0]['subject_id']==$subject[$c]['id_subject']){ echo "selected='selected'"; } } ?> value="<?=$subject[$c]['id_subject']?>"><?=$subject[$c]['subject_name']?></option>
											<?php } 
											}
										?>
                                    </select>
                                </div>
																						
							</div>	
							
							<p>&nbsp;</p>							
							<div class="form-group error" id="sel_exam_marks_err"></div>
							<div class="form-group" id="exam-marks-div">																							
							
							</div> 
						
							<div class="text-center" id="hide_buttons-div">      
								<button class="btn btn-primary">Save</button>
							</div>
						                        
						</div>
					</form>
                
				</div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
	<?php if(isset($marks_record)) { ?>
		$(function () {
		<?php if(isset($preview)) { ?>
				getStudentMarks(<?php echo $preview; ?>);
		<?php  } else  {?>
				getStudentMarks();
		<?php } ?>
		});
	<?php } ?>
</script>
