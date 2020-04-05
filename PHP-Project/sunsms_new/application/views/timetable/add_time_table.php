<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/timetable/index"> Home </a>
        </li>
        <li class="active">
            Manage Timetable
        </li>
    </ul>
	
	<a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>	
	
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li>
					<a href="#" name="tab1">
						<b><?php 
						if(isset($edit))						 							
							echo "Edit Time Table";							
						else if(isset($preview))							
							echo "Preview Time Table";							
						else 						
							echo "Add Time Table";						
						?></b>
					</a>
				</li>
            </ul>
            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="timetable_form" method="post" action="<?=BASE_URL?>index.php/timetable/createTimeTable" enctype="multipart/form-data" onsubmit="return validateAssignTimetable();">
                        <div class="panel-body">
							<?php if(isset($preview)) { ?> 							
								<!-- Preview Mode -->
								<div class="form-group">
									<label class="col-md-3 col-xs-12 control-label"><b>Start Date</b></label>
									<div class="col-md-3 col-xs-12 m4">
										<?php echo date('d-M-Y',strtotime($class_timing[0]['start_date'])); ?>
										
									</div>
									
									<label class="col-md-3 col-xs-12 control-label"><b>End Date</b></label>
									<div class="col-md-3 col-xs-12 m4">
										<?php echo date('d-M-Y',strtotime($class_timing[0]['end_date'])); ?>
									</div>
								</div>
							
                            <div class="form-group">
								<label class="col-md-3 col-xs-12 control-label"><b>Board</b></label>
                                <div class="col-md-3 col-xs-12 m4">
									<?php
									
										for($s=0;$s<count($board);$s++) { 
											if($class_timing[0]['board_id']==$board[$s]['id_board'])
											{
												echo $board[$s]['board_name'];
											}
										}										
									?>											
                                </div>
								
                                <label class="col-md-3 col-xs-12 control-label"><b>Class</b></label>
                                <div class="col-md-3 col-xs-12 m4">                                    
									<?php
									
										for($s=0;$s<count($course);$s++) { 
											if($class_timing[0]['course_id']==$course[$s]['id_course'])
											{
												echo $course[$s]['course_name'];
											}
										}										
									?>
                                </div>
                                
                            </div>	
							
							<div class="form-group" id="course_section_id_div" <?php if(isset($preview) && $class_timing[0]['section_id'] > 0) { echo "style='display:block;'"; } else { echo "style='display:none;'"; } ?> >
                                <label class="col-md-3 col-xs-12 control-label"><b>Section</b></label>
                                <div class="col-md-3 col-xs-12">
                                    
                                        <?php
                                        if(isset($section)) {                                        
                                            for($s=0;$s<count($section);$s++) { 
												if($class_timing[0]['section_id']==$section[$s]['id_section'])
												{
													echo $section[$s]['section_name'];
												}
											}
										}
										?>										
                                </div>
							</div>
							
							<?php } else { ?> 
							
								<!-- Create & Edit Mode -->
								<div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Start Date <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
									<div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        <input type="text" name="start_date" id="start_date" value="<?php if(isset($class_timing)){ echo date('d-M-Y',strtotime($class_timing[0]['start_date'])); } ?>" class="form-control datepicker"/>
                                    </div>
                                </div>
								
								<label class="col-md-3 col-xs-12 control-label">End Date <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        <input type="text" name="end_date" id="end_date" value="<?php if(isset($class_timing)){ echo date('d-M-Y',strtotime($class_timing[0]['end_date'])); } ?>" class="form-control datepicker"/>
                                    </div>
                                </div>
                            </div>
							
                            <div class="form-group">
								<label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" <?php if(isset($class_timing)) { ?> disabled='disabled' <?php } ?> name="board_id" id="board_id" onchange='getCourses(this.value);'>
                                        <option value="0">Select Board</option>
                                        <?php for($s=0;$s<count($board);$s++){ ?>
                                            <option <?php if(isset($class_timing)){ if($class_timing[0]['board_id']==$board[$s]['id_board']){ echo "selected='selected'"; } } ?> value="<?=$board[$s]['id_board']?>"><?=$board[$s]['board_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
								
                                <label class="col-md-3 col-xs-12 control-label">Select Class <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select"  <?php if(isset($class_timing)) { ?> disabled='disabled' <?php } ?> name="student_course_id" id="student_course_id" onchange="manageSections(this.value,'timetable');" >
                                        <option value="0">Select Class </option>
                                        <?php
											if(isset($class_timing)) {
												for($c=0;$c<count($course);$c++){ ?>
													<option <?php if(isset($class_timing)){ if($class_timing[0]['course_id']==$course[$c]['id_course']){ echo "selected='selected'"; } } ?> value="<?=$course[$c]['id_course']?>"><?=$course[$c]['course_name']?></option>
											<?php } 
											}
										?>
                                    </select>
                                </div>
                                <?php
                                if(isset($class_timing)){ ?>
									<input type="hidden" name="course_id" value="<?=$class_timing[0]['course_id']?>">
                                <?php } ?>
                            </div>	
							
							<div class="form-group" id="course_section_id_div" <?php if(isset($edit) && $class_timing[0]['section_id'] > 0) { echo "style='display:block;'"; } else { echo "style='display:none;'"; } ?> >
                                <label class="col-md-3 col-xs-12 control-label">Select Section <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" <?php if(isset($class_timing)) { ?> disabled='disabled' <?php } ?> name="course_section_id" id="course_section_id" onchange="getTimeTable(this.value);">
                                        <option value="0">Select Section </option>
                                        <?php
                                        if(isset($section))
                                        {
                                            for($s=0;$s<count($section);$s++) { ?>
                                                <option value="<?=$section[$s]['id_section']?>" <?php if(isset($class_timing)){ if($class_timing[0]['section_id']==$section[$s]['id_section']){ echo "selected='selected'"; } } ?>><?=$section[$s]['section_name']?></option>
                                            <?php }
                                        }?>
                                    </select>
                                </div>
								
							<?php } ?>						
	                            
							</div>
							
                            <div class="form-group error" id="sel_timetable_err"></div>
							<div class="form-group" id="time-table-div">								
								<?php if(isset($class_timing)){ echo $html; } ?>
							</div>                        
						
						<?php if(!isset($preview)) { ?>
						
							<div class="text-center" id="buttons-div" <?php if(!isset($edit)) {?> style='display:none;' <?php } ?>>         
								<button class="btn btn-primary">Save</button>&nbsp;<input type="button" class="btn btn-primary" onclick="getTimeTable(1);" value="Reset">
							</div>
						<?php } ?>
						
						<input type="hidden" name="assign_vals_id" id="assign_vals_id" <?php if(isset($edit)) { ?> value="1" <?php } ?>>
                        <input type="hidden" name="id_class_time_table" id="id_class_time_table" value="<?php if(isset($class_timing)){ echo encode($class_timing[0]['id_class_time_table']); } else { echo 0; } ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>


<div id="dialog-timetable" title="Select Staff and Subject" style='display:none;'>
	<div id='staff_subject'></div>
</div>
	
<!-- Modal -->
<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

            <div class="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body" id="sub_timing">

                </div>
                <div class="modal-footer" id="m-footer">

                </div>
            </div>

    </div>
</div>-->


