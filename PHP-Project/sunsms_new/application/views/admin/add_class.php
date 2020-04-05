
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/admin/Course"> Home </a>
        </li>
        <li class="active">
            Add Class 
        </li>
    </ul>
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($school)){ ?>Edit Class<?php } else { ?>Add Class<?php } ?></a></li>
            </ul>
            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="course_form" method="post" action="<?=BASE_URL?>index.php/admin/createCourse" enctype="multipart/form-data">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select multiple class="form-control select" name="board_id[]" id="board_id">
                                        <option value="0">Select Board </option>
                                        <?php for($s=0;$s<count($board);$s++){ ?>
                                            <option <?php if(isset($course)){ if($course[0]['board_id']==$board[$s]['id_board']){ echo "selected='selected'"; } } ?> value="<?=$board[$s]['id_board']?>"><?=$board[$s]['board_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
							<div id="courseDiv">
								<div class="form-group">
									<label class="col-md-3 col-xs-12 control-label">Class Name <span class="clr-red">*</span></label>
									<div class="col-md-3 col-xs-12 m4">
									
										<div class="input-group">
											<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
											<input type="text" name="class_name[]" id="class_name" value="<?php if(isset($course)){ echo htmlentities($course[0]['course_name']); } ?>" class="form-control"/>
											
										</div>
										
									</div>

									<!--<label class="col-md-3 col-xs-12 control-label">Code <span class="clr-red">*</span></label>
									<div class="col-md-3 col-xs-12">
										<div class="input-group">
											<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
											<input type="text" name="class_code" id="class_code[]" value="<?php //if(isset($course)){ echo $course[0]['code']; } ?>" class="form-control"/>
										</div>
									</div>-->
									
								</div>
								
								<div class="form-group" <?php if(!isset($course)){ ?>style="display: none;"<?php } ?>>
									<label class="col-md-6 col-xs-12 control-label">Status</label>
									<div class="col-md-6 col-xs-12">
										<select class="form-control select" name="status" id="status">
											<option <?php if(isset($course)){ if($course[0]['status']==1){ echo "selected='selected'"; } } ?> value="1">Active</option>
											<option <?php if(isset($course)){ if($course[0]['status']==0){ echo "selected='selected'"; } } ?> value="0">Inactive</option>
										</select>
									</div>
								</div>
							</div>
                        </div>
                        <div class="text-center">
							<?php if(!isset($course)) { ?>
								<a class="btn btn-primary" onclick="addAnotherCourse();">Add Another</a>
							<?php } ?>
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <input type="hidden" name="id_course" id="id_course" value="<?php if(isset($course)){ echo encode($course[0]['id_course']); } else { echo 0; } ?>">
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script type='text/javascript'>

function addAnotherCourse(){

	var _html= '<div class="form-group li-group">'+
		'<label class="col-md-3 col-xs-12 control-label"> Class Name</label>'+
		'<div class="col-md-3 col-xs-12 m4">'+
		'<div class="input-group">'+
		'<span class="input-group-addon"><span class="fa fa-pencil"></span></span>'+
		'<input type="text" class="form-control course " name="class_name[]" id="class_name"  />'+
		'<label class="error1" style="display: none">Please Enter Class Name</label>' +
		'</div></div>'+		
		'<div class="col-md-3 col-xs-12">'+		
		'<span class="deleteSpan"><a title="delete" onclick="deleteNewlyAddCourse(this)"><span class="circle"><i class="fa fa-trash"></i></span></a></a></span>'+
		'</div>'+
		'</div>';
	$('#courseDiv').append(_html);
}

function deleteNewlyAddCourse(e){
	$(e).parent().closest('.li-group').remove();
	if($('#courseDiv').find('.form-group').length==0){
		addAnotherCourse();
	}
}

/*function ValidateAddAnotherCourse() {	
	var flag=0;        
        $('.course').each(function(){
			alert($(this).val());
			
            if($(this).val()==''){	
				$('#course_form').submit();
				var _parent= $(this).parent();
				$(_parent).find('.error1').text('Please Enter Class Name1').show();
				flag=1;
            }
			
        });	
		
        if(flag==1){			
			return false;			
        }else{
            $('#course_form').submit();
			//alert('submit');
        }
}*/
	
</script>