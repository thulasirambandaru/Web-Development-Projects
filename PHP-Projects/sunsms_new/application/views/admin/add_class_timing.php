
<section class="col-lg-10 right-section">

    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Admin/classTiming"> Home </a>
        </li>

        <li class="active">
           Add Class Timing
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($class_timing)){ ?>Edit Class Timing<?php } else { ?>Add Class Timing<?php } ?></a></li>

            </ul>
			
            <div id="content">
                <div id="tab1">
					
                    <form class="form-horizontal" id="class_timeing_form" method="post" action="<?=BASE_URL?>index.php/admin/createClassTiming" enctype="multipart/form-data">

                        <div class="panel-body">
							<table id='class_timning' class='custom_tbl'>
								<tr>
									<td>
										Name<span class="clr-red">*</span> &nbsp;<input type="text" name="name[]" id="name" value="<?php if(isset($class_timing)){ echo $class_timing[0]['name']; } ?>" class="form-control"/></td>
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
										Is Break &nbsp;
										<input type="checkbox" name="is_break0" id='is_break0' <?php if(isset($class_timing)){ if($class_timing[0]['is_break']==1){ echo "checked='checked'"; } } ?> value="1" onclick='setBreakTiming(0);'>
										<input type='hidden' name='is_break_val0' id='is_break_val0'>
									</td>
									<td>
										<?php if(isset($class_timing)){ ?>
										Status &nbsp;
										<select class="form-control select" name="status" id="status">
											<option <?php if(isset($class_timing)){ if($class_timing[0]['status']==1){ echo "selected='selected'"; } } ?> value="1">Active</option>
											<option <?php if(isset($class_timing)){ if($class_timing[0]['status']==0){ echo "selected='selected'"; } } ?> value="0">Inactive</option>
										</select>
										<?php } ?>
									</td>
								</tr>
																							
							</table>
							
                            <!--<div class="form-group">							
								<label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select multiple class="form-control select" name="board_id[]" id="board_id" onchange='getBoardCourses();'>
                                        <option value="0">Select Board</option>
                                        <?php //for($s=0;$s<count($board);$s++){ ?>
                                            <option <?php //if(isset($subject)){ if($subject[0]['board_id']==$board[$s]['id_board']){ echo "selected='selected'"; } } ?> value="<?=$board[$s]['id_board']?>"><?=$board[$s]['board_name']?></option>
                                        <?php //} ?>
                                    </select>
                                </div>
								
                                <label class="col-md-3 col-xs-12 control-label">Select Course <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select multiple class="form-control select" name="course_id[]" id="course_id">
                                        <option value="0">Select Course </option>
                                        <?php //for($s=0;$s<count($course);$s++){ ?>
                                            <option <?php //if(isset($class_timing)){ if($class_timing[0]['course_id']==$course[$s]['id_course']){ echo "selected='selected'"; } } ?> value="<?=$course[$s]['id_course']?>"><?=$course[$s]['course_name']?></option>
                                        <?php //} ?>
                                    </select>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name <span class="clr-red">*</span></label>                                
								<div class="col-md-3 col-xs-12 m4">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="name" id="name" value="<?php //if(isset($class_timing)){ echo $class_timing[0]['name']; } ?>" class="form-control"/>
                                    </div>
                                </div>
								
								<label class="col-md-3 col-xs-12 control-label"></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <div class="input-group">
                                        <label class="check"><input type="checkbox" name="is_break" <?php //if(isset($class_timing)){ if($class_timing[0]['is_break']==1){ echo "checked='checked'"; } } ?> value="1" class=""> Is break</label>
                                    </div>
                                </div>
                            </div>
							
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Start Time<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">                                                                            

									<select class="form-control select" name="start_time" id="start_time">
										<option value="">Select Time</option>
									</select>                                    
                                </div>
								
								<label class="col-md-3 col-xs-12 control-label">End Time <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">                                                                          

									<select class="form-control select" name="end_time" id="end_time">
										<option value="">Select Time</option>
									</select>                                    
                                </div>								
                            </div>	-->						                            

                        </div>
						<p>&nbsp;</p>
                        <div class="text-center">
							<?php if(!isset($class_timing)) { ?>
								<a class="btn btn-primary" onclick="addAnotherClassTiming();">Add Another</a>
							<?php } ?>	
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <input type="hidden" name="id_class_timing" id="id_class_timing" value="<?php if(isset($class_timing)){ echo encode($class_timing[0]['id_class_timing']); } else { echo 0; } ?>">
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
        <?php if(isset($class_timing)){
        sscanf($class_timing[0]['start_time'], "%d:%d", $hours, $minutes);
        if($minutes<10){ $minutes = '0'.$minutes; }
        sscanf($class_timing[0]['end_time'], "%d:%d", $hours1, $minutes1);
        if($minutes1<10){ $minutes1 = '0'.$minutes1; }
        ?>
        start_time = '<?=$hours.':'.$minutes?>';
        end_time = '<?=$hours1.':'.$minutes1?>';

            $('#start_time').val(start_time);
            $('#end_time').val(end_time);
        <?php } ?>
    });
	
	var inc=0;
	function addAnotherClassTiming(){
		inc = inc+1;
		var _html= '<tr class="add_new">'+
			'<td>Name &nbsp;<input type="text" name="name[]" id="name" class="form-control"/></td>'+
			'<td>Start Time &nbsp; <select class="form-control select" name="start_time[]" id="start_time'+inc+'"> <option value="">Select Time</option></select></td>'+
			'<td>End Time &nbsp; <select class="form-control select" name="end_time[]" id="end_time'+inc+'"> <option value="">Select Time</option></select></td>'+							
			'<td>Is Break &nbsp; <input type="checkbox" name="is_break'+inc+'" id="is_break'+inc+'" value="1" class="" onclick="setBreakTiming('+inc+');"><input type="hidden" name="is_break_val'+inc+'" id="is_break_val'+inc+'"></td>'+			
			'<td><button class="btn btn-primary" onclick="deleteNewlyAddClassTiming(this)">Remove</button></td>'+
			'</tr>';
	
		$('#class_timning').append(_html);
		
		populate('#start_time'+inc);
        populate('#end_time'+inc);
        var start_time = '';
        var end_time = '';
        <?php if(isset($class_timing)){
        sscanf($class_timing[0]['start_time'], "%d:%d", $hours, $minutes);
        if($minutes<10){ $minutes = '0'.$minutes; }
        sscanf($class_timing[0]['end_time'], "%d:%d", $hours1, $minutes1);
        if($minutes1<10){ $minutes1 = '0'.$minutes1; }
        ?>
        start_time = '<?=$hours.':'.$minutes?>';
        end_time = '<?=$hours1.':'.$minutes1?>';

            $('#start_time'+inc).val(start_time);
            $('#end_time'+inc).val(end_time);
        <?php } ?>
	}
	
	function deleteNewlyAddClassTiming(e){
		$(e).parent().closest('.add_new').remove();		
	}
	
	function setBreakTiming(val) {
		if($('#is_break'+val).is(':checked')) {		
			$('#is_break_val'+val).val(1);
		}
		else
			$('#is_break_val'+val).val(0);
	}

</script>