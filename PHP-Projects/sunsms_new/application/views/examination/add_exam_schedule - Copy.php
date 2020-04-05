
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
                <li><a href="#" name="tab1"><b><?php if(isset($exam_schedule)){ ?>Edit Exam Schedule<?php } else { ?>Add Exam Schedule<?php } ?></b></a></li>
            </ul>
            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="exam_schedule_form" method="post" action="<?=BASE_URL?>index.php/examination/createExamSchedule" enctype="multipart/form-data">
                        <div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label">Select Exam <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" <?php if(isset($exam_schedule)) { ?> disabled='disabled' <?php } ?> name="exam_id" id="exam_id" onchange='getCourses(this.value);'>
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
							
							<table id='exam_schedule' class='custom_tbl'>
								<tr>
									<td>
										Subject<span class="clr-red">*</span> &nbsp;
										<select class="form-control select" name="course_subject_id[]" id="course_subject_id">
											<option value="">Select Subject</option>
											<?php
											if(isset($subject))
											{
												for($s=0;$s<count($subject);$s++) { ?>
													<option value="<?=$subject[$s]['id_subject']?>" <?php if(isset($exam_schedule)){ if($exam_schedule[0]['subject_id']==$subject[$s]['id_subject']){ echo "selected='selected'"; } } ?>><?=$subject[$s]['subject_name']?></option>
												<?php }
											}?>
										</select>											
									</td>
									<td>
										Exam Date<span class="clr-red">*</span> &nbsp;<input type="text" name="start_date[]" id="start_date" value="<?php if(isset($exam_schedule)){ echo date('d-M-Y',strtotime($exam_schedule[0]['start_date'])); } ?>" class="form-control datepicker"/>
									</td>
									<td>
										Start Time<span class="clr-red">*</span> &nbsp;
										<select class="form-control select" name="start_time[]" id="start_time">
											<option value="">Select Time</option>
										</select>
									</td>
									<td>
										End Time<span class="clr-red">*</span> &nbsp;
										<select class="form-control select" name="end_time[]" id="end_time">
											<option value="">Select Time</option>
										</select>
									</td>									
									<td>
										
									</td>
								</tr>
																							
							</table>
						
				
						<p>&nbsp;</p>
						
                        <div class="text-center">
							<a class="btn btn-primary" onclick="addAnotherSubject();">Add Another</a>
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <input type="hidden" name="exam_schedule_id" id="exam_schedule_id" value="<?php if(isset($exam_schedule)){ echo encode($exam_schedule[0]['id_exam_schedule']); } else { echo 0; } ?>">
                    </form>
                </div>
			</div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

$(function () {		
	populate('#start_time');
	populate('#end_time');
	var start_time = '';
	var end_time = '';
	<?php if(isset($exam_schedule)){
	sscanf($exam_schedule[0]['start_time'], "%d:%d", $hours, $minutes);
	if($minutes<10){ $minutes = '0'.$minutes; }
	sscanf($exam_schedule[0]['end_time'], "%d:%d", $hours1, $minutes1);
	if($minutes1<10){ $minutes1 = '0'.$minutes1; }
	?>
	start_time = '<?=$hours.':'.$minutes?>';
	end_time = '<?=$hours1.':'.$minutes1?>';

		$('#start_time').val(start_time);
		$('#end_time').val(end_time);
	<?php } ?>
});

var inc=0;
function addAnotherSubject(){
	inc = inc+1;
	course_id = $('#student_course_id').val();
	getCourseSubjects(course_id, inc);
	var _html= '<tr class="add_new">'+
		'<td>Subject &nbsp;<select class="form-control select" name="subject_name[]" id="course_subject_id'+inc+'"><option value="">Select Subject</option></select></td>'+			
		'<td>Exam Date<input type="text" name="start_date[]" id="start_date1" class="form-control datepicker"/></td>'+																 									
		'<td>Start Time &nbsp; <select class="form-control select" name="start_time[]" id="start_time'+inc+'"> <option value="">Select Time</option></select></td>'+
		'<td>End Time &nbsp; <select class="form-control select" name="end_time[]" id="end_time'+inc+'"> <option value="">Select Time</option></select></td>'+				
		'<td><a id="delete" title="Remove" onclick="deleteNewlyAddSubject(this)" ><span class="circle"><i class="glyphicon glyphicon-trash"></i></span></a></td>'+
		'</tr>';

	$('#exam_schedule').append(_html);				
}

function deleteNewlyAddSubject(e){
	$(e).parent().closest('.add_new').remove();		
}
	
</script>