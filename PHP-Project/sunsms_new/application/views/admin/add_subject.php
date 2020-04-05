
<section class="col-lg-10 right-section">

    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Admin/Subject">Home</a>
        </li>

        <li class="active">
            Add Subject
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($school)){ ?>Edit Subject<?php } else { ?>Add Subject<?php } ?></a></li>

            </ul>

            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="subject_form" method="post" action="<?=BASE_URL?>index.php/admin/createSubject" enctype="multipart/form-data">

                        <div class="panel-body">

                            <div class="form-group">
								<label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select multiple class="form-control select" name="board_id[]" id="board_id" onchange='getBoardCourses();'>
                                        <option value="0">Select Board</option>
                                        <?php for($s=0;$s<count($board);$s++){ ?>
                                            <option <?php if(isset($subject)){ if($subject[0]['board_id']==$board[$s]['id_board']){ echo "selected='selected'"; } } ?> value="<?=$board[$s]['id_board']?>"><?=$board[$s]['board_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
								
                                <label class="col-md-3 col-xs-12 control-label">Select Class <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select multiple class="form-control select" name="course_id[]" id="course_id">
                                        <option value="0">Select Class</option>
                                        <?php for($s=0;$s<count($course);$s++){ ?>
                                            <option <?php if(isset($subject)){ if($subject[0]['course_id']==$course[$s]['id_course']){ echo "selected='selected'"; } } ?> value="<?=$course[$s]['id_course']?>"><?=$course[$s]['course_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
							
							<div id="subjectDiv">
								<div class="form-group">
									<label class="col-md-3 col-xs-12 control-label">Subject Name <span class="clr-red">*</span></label>
									<div class="col-md-3 col-xs-12 m4">
										<div class="input-group">
											<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
											<input type="text" name="subject_name[]" id="subject_name" value="<?php if(isset($subject)){ echo $subject[0]['subject_name']; } ?>" class="form-control"/>
										</div>
									</div>
									<?php if(isset($subject)) { ?>
										<label class="col-md-6 col-xs-12 control-label">Status</label>
										<div class="col-md-3 col-xs-12 m4">
											<select class="form-control select" name="status" id="status">
												<option <?php if(isset($subject)){ if($subject[0]['status']==1){ echo "selected='selected'"; } } ?> value="1">Active</option>
												<option <?php if(isset($subject)){ if($subject[0]['status']==0){ echo "selected='selected'"; } } ?> value="0">Inactive</option>
											</select>

										</div>
									<?php } ?>
									
								</div>								
							</div>

                        </div>
                        <div class="text-center">
							<?php if(!isset($subject)) { ?>
								<a class="btn btn-primary" onclick="addAnotherSubject();">Add Another</a>
							<?php } ?>							
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <input type="hidden" name="id_subject" id="id_subject" value="<?php if(isset($subject)){ echo encode($subject[0]['id_subject']); } else { echo 0; } ?>">
                    </form>
                </div>

                </div>
            </div>
        </div>
    </div>

</section>

<script type='text/javascript'>

function addAnotherSubject(){

	var _html= '<div class="form-group li-group">'+
		'<label class="col-md-3 col-xs-12 control-label">Subject Name</label>'+
		'<div class="col-md-3 col-xs-12 m4">'+
		'<div class="input-group">'+
		'<span class="input-group-addon"><span class="fa fa-pencil"></span></span>'+
		'<input type="text" class="form-control course " name="subject_name[]" id="subject_name"  />'+
		'<label class="error1" style="display: none">Please Enter Subject Name</label>' +
		'</div></div>'+		
		'<div class="col-md-3 col-xs-12">'+		
		'<span class="deleteSpan"><a title="delete" onclick="deleteNewlyAddSubject(this)"><span class="circle"><i class="fa fa-trash"></i></span></a></a></span>'+
		'</div>'+
		'</div>';
	$('#subjectDiv').append(_html);
}

function deleteNewlyAddSubject(e){
	$(e).parent().closest('.li-group').remove();
	if($('#subjectDiv').find('.form-group').length==0){
		addAnotherSubject();
	}
}
	
</script>

