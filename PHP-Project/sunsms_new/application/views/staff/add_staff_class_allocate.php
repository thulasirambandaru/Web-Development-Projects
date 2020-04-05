
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Staff"> Home </a>
        </li>
        <li class="active">
            Add Class Teacher
        </li>
    </ul>
    
	<div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1">Add Class Teacher</a></li>
            </ul>
            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="class_teacher_form" method="post" action="<?=BASE_URL?>index.php/staff/insertUpdateClassTeacher" enctype="multipart/form-data">
                        <div class="panel-body">  
						
							<div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="board_id" id="board_id" onchange="getCourses(this.value);">
                                        <option value="0">Select Board </option>
                                        <?php for($b=0;$b<count($board);$b++){ ?>
                                            <option value="<?=$board[$b]['id_board']?>" <?php if(isset($class_teacher)){ if($class_teacher[0]['board_id']==$board[$b]['id_board']){ echo "selected='selected'"; } } ?>><?=$board[$b]['board_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Select Class <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="student_course_id" id="student_course_id" onchange="getSections(this.value);">
                                        <option value="0">Select Class </option>
                                        <?php
                                        if(isset($class_teacher))
                                        {
                                            for($c=0;$c<count($course);$c++) { ?>
                                                <option value="<?=$course[$c]['id_course']?>" <?php if(isset($class_teacher)){ if($class_teacher[0]['course_id']==$course[$c]['id_course']){ echo "selected='selected'"; } } ?>><?=$course[$c]['course_name']?></option>
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
                                        if(isset($class_teacher))
                                        {
                                            for($s=0;$s<count($section);$s++) { ?>
                                                <option value="<?=$section[$s]['id_section']?>" <?php if(isset($class_teacher)){ if($class_teacher[0]['section_id']==$section[$s]['id_section']){ echo "selected='selected'"; } } ?>><?=$section[$s]['section_name']?></option>
                                            <?php }
                                        }?>
                                    </select>
                                </div>
								
								<label class="col-md-3 col-xs-12 control-label">Class Teacher <span class="clr-red">*</span></label>
								<div class="col-md-3 col-xs-12 m4">
									<select class="form-control select" name="teacher_id" id="teacher_id">
                                        <option value="0">Select Teacher </option>
                                        <?php                                        
										for($s=0;$s<count($staff);$s++) { ?>
											<option value="<?=$staff[$s]['id_staff']?>" <?php if(isset($class_teacher)){ if($class_teacher[0]['staff_id']==$staff[$s]['id_staff']){ echo "selected='selected'"; } } ?>><?=$staff[$s]['staff_name']?></option>
									<?php } ?>
                                        
                                    </select>
								</div>								
							</div>
							
						</div>
						
						<div class="text-center">
							<button class="btn btn-primary">Save</button>
						</div>
						<input type="hidden" name="id_staff_class_allocate" id="id_staff_class_allocate" value="<?php if(isset($class_teacher)){ echo encode($class_teacher[0]['id_staff_class_allocate']); } else { echo 0; } ?>">	
                    </form>                
                </div>												
            </div>
        </div>									
	</div>
    
</section>
