
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
				<?php
					if(isset($exam_grade)) 
						echo "Edit Grade";					
					else
						echo "Add Grade";
				?>			
								
				</b></a></li>
            </ul>
            <div id="content">
                <div id="tab1">		
					<?php //echo "<pre>"; print_r($exam_grade); ?>
                    <form class="form-horizontal" id="exam_grades" method="post" action="<?=BASE_URL?>index.php/examination/createExamGrades" enctype="multipart/form-data">
                        <div class="panel-body">
						
							<div class="form-group">													
                                <label class="col-md-3 col-xs-12 control-label">Grade Name<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <input type="text" name="grade_name" id="grade_name" class="form-control" value="<?php if(isset($exam_grade)) { echo htmlentities($exam_grade[0]['grade_name']); } ?>" />
                                </div>																
                            </div>	
							
							<div class="form-group">													
                                <label class="col-md-3 col-xs-12 control-label">Grade Scale Value<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <input type="text" name="grade_value" id="grade_value" class="form-control" value="<?php if(isset($exam_grade)) { echo htmlentities($exam_grade[0]['grade_value']); } ?>"/>
                                </div>																
                            </div>
							
							<div class="form-group">													
                                <label class="col-md-3 col-xs-12 control-label">Lower Mark Range<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <input type="text" name="low_mark_range" id="low_mark_range" class="form-control" value="<?php if(isset($exam_grade)) { echo htmlentities($exam_grade[0]['lower_mark']); } ?>"/>
                                </div>																
                            </div>
							
							<div class="form-group">													
                                <label class="col-md-3 col-xs-12 control-label">Upper Mark Range<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <input type="text" name="upper_mark_range" id="upper_mark_range" class="form-control" value="<?php if(isset($exam_grade)) { echo htmlentities($exam_grade[0]['upper_mark']); } ?>"/>
                                </div>																
                            </div>
							
						<div class="text-center">
							<button class="btn btn-primary">Save</button>
						</div>
						<input type="hidden" name="id_exam_grades" id="id_exam_grades" value="<?php if(isset($exam_grade)) { echo encode($exam_grade[0]['id_exam_grades']); } ?>">
						
				</div>
				</form>
                
			</div>
            </div>
        </div>
    </div>
</section>
