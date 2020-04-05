
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Admin/Section"> Home </a>
        </li>
        <li class="active">
            Add Section
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($section)){ ?>Edit Section<?php } else { ?>Add Section<?php } ?></a></li>
            </ul>
			
            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="section_form" method="post" action="<?=BASE_URL?>index.php/admin/createSection" enctype="multipart/form-data">
                        <div class="panel-body">

                            <div class="form-group">
								<label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select multiple class="form-control select" name="board_id[]" id="board_id" onchange='getBoardCourses();'>
                                        <option value="0">Select Board</option>
                                        <?php for($s=0;$s<count($board);$s++){ ?>
                                            <option <?php if(isset($section)){ if($section[0]['board_id']==$board[$s]['id_board']){ echo "selected='selected'"; } } ?> value="<?=$board[$s]['id_board']?>"><?=$board[$s]['board_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
								
                                <label class="col-md-3 col-xs-12 control-label">Select Class <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select multiple class="form-control select" name="course_id[]" id="course_id">
                                        <option value="0">Select Class</option>
                                        <?php for($s=0;$s<count($course);$s++){ ?>
                                            <option <?php if(isset($section)){ if($section[0]['course_id']==$course[$s]['id_course']){ echo "selected='selected'"; } } ?> value="<?=$course[$s]['id_course']?>"><?=$course[$s]['course_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
							
							<div id="sectionDiv">
								<div class="form-group">
									<label class="col-md-3 col-xs-12 control-label">Section <span class="clr-red">*</span></label>
									<div class="col-md-3 col-xs-12 m4">
										<div class="input-group">
											<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
											<input type="text" name="section_name[]" id="section_name" value="<?php if(isset($section)){ echo $section[0]['section_name']; } ?>" class="form-control"/>
										</div>
									</div>
								</div>								
							</div>

                            <!--<div class="form-group" <?php if(!isset($course)){ ?>style="display: none;"<?php } ?>>
                                <label class="col-md-6 col-xs-12 control-label">Status</label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control select" name="status" id="status">
                                        <option <?php //if(isset($section)){ if($section[0]['status']==1){ echo "selected='selected'"; } } ?> value="1">Active</option>
                                        <option <?php //if(isset($section)){ if($section[0]['status']==0){ echo "selected='selected'"; } } ?> value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>-->
							
                        </div>

                        <div class="text-center">
							<?php if(!isset($section)) { ?> <a class="btn btn-primary" onclick="addAnotherSection();">Add Another</a> <?php } ?>                            
                            <button class="btn btn-primary">Save</button>
                        </div>
						<input type='hidden' name='add_section_cnt' id='add_section_cnt'>
                        <input type="hidden" name="id_section" id="id_section" value="<?php if(isset($section)){ echo encode($section[0]['id_section']); } else { echo 0; } ?>">
                    </form>
                </div>
            </div>
		</div>
	</div>    
</section>

<script type="text/javascript">
	inc = 0;
	function addAnotherSection() {
		inc = inc+1;
		var _html= '<div class="form-group li-group">'+
			'<label class="col-md-3 col-xs-12 control-label">Section</label>'+
			'<div class="col-md-3 col-xs-12 m4">'+
			'<div class="input-group">'+
			'<span class="input-group-addon"><span class="fa fa-pencil"></span></span>'+
			'<input type="text" name="section_name[]" id="section_name'+inc+'" class="form-control" />'+
			'<label class="error" id="section_name_err'+inc+'" style="display: none">Please Enter Subject Name</label>' +
			'</div></div>'+					
			'<div class="col-md-3 col-xs-12">'+
			'<span class="deleteSpan"><a title="delete" onclick="deleteNewlyAddSection(this)"><span class="circle"><i class="fa fa-trash"></i></span></a></a></span>'+
			'</div>'+
			'</div>';
		$('#sectionDiv').append(_html);		
		$('#add_section_cnt').val(inc);		
	}
	
	function deleteNewlyAddSection(e){ alert(inc);
        $(e).parent().closest('.li-group').remove();
		inc = inc-1;
		$('#add_section_cnt').val(inc);
        if($('#sectionDiv').find('.form-group').length==0){
            addAnotherSection();
        }
    }
		
	
</script>