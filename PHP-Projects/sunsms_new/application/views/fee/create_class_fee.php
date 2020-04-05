<script type="text/javascript">
function getClassByBoard1(board_id,course_id)
{
    var html = '<option value="0">Select Class</option>';
    $('#section_id').html('<option value="0">Select Section</option>');

    $.ajax({
        async: true,
        type: 'POST',
        url: BASE_URL+'index.php/Attendance/getCourse/',
        data: {'board_id':board_id},
        dataType: 'json',
        success:function(res){
            if(res.response==1){
                var data = res.data;
                for(var s=0;s<data.length;s++)
                {
                    html+='<option value="'+data[s].id_course+'">'+data[s].course_name+'</option>';
                }
                $('#course_id').html(html);
                if(course_id){ $('#course_id').val(course_id); }
            }
        }
    });
}
</script>
<?php 
 	$result = array();
 if(isset($classFeeStructure) && count($classFeeStructure)>0)
 {
   for($s=0;$s<count($classFeeStructure);$s++){
      $result[$classFeeStructure[$s]['id_fee_structure']]['id_fee_structure'] = $classFeeStructure[$s]['id_fee_structure'];
      $result[$classFeeStructure[$s]['id_fee_structure']]['board_id'] = $classFeeStructure[$s]['id_board'];
      $result[$classFeeStructure[$s]['id_fee_structure']]['board_name'] = $classFeeStructure[$s]['board_name'];
      $result[$classFeeStructure[$s]['id_fee_structure']]['course_id'] = $classFeeStructure[$s]['id_course'];
      $result[$classFeeStructure[$s]['id_fee_structure']]['course_name'] = $classFeeStructure[$s]['course_name'];
      $result[$classFeeStructure[$s]['id_fee_structure']]['status'] = $classFeeStructure[$s]['class_fee_status'];
      $result[$classFeeStructure[$s]['id_fee_structure']]['fee_type_'.$classFeeStructure[$s]['fee_type_id']] = $classFeeStructure[$s]['amount'];
   }
   $result = array_values($result);
 }
       
?>
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/fee"> Home </a>
        </li>
        <li class="active">
           Create Class Fee
        </li>
    </ul>
    <a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1">Create Class Fee</a></li>
            </ul>
            <div id="content">
                <div id="tab1">
                     <form class="form-horizontal" id="feesform" name="feesform" method="post" action="<?=BASE_URL?>index.php/fee/addFeeStructure" enctype="multipart/form-data">
					<div class="panel-body" style="background: none;">
					<div class="form-group">
						<label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
						<div class="col-md-3 col-xs-12 m4">
							<select class="form-control select" name="board_id" id="board_id" onchange="getClassByBoard1(this.value)">
								<option value=''>Select Board </option>
								<?php for($s=0;$s<count($board);$s++){ ?>
									<option <?php if(isset($classFeeStructure)){ if($classFeeStructure[0]['board_id']==$board[$s]['id_board']){ echo "selected='selected'"; } } ?>
										<?php if(isset($_REQUEST['board_id'])){ if(base64_decode($_REQUEST['board_id'])==$board[$s]['id_board']){ echo "selected='selected'"; } } ?>
										value="<?=$board[$s]['id_board']?>"><?=$board[$s]['board_name']?></>
								<?php } ?>
							</select>
						</div>
						<label class="col-md-3 col-xs-12 control-label">Select Class <span class="clr-red">*</span></label>
						<div class="col-md-3 col-xs-12 m4">
							<select class="form-control select" name="course_id" id="course_id" >
								<option value=''>Select Class</option>
							</select>
						</div>
					</div>
					<?php for($s=0;$s<count($fee_type);$s++){ 
						if($s%2==0)
						{
							?>
						<div class="form-group">
						<?php } ?>
							<label class="col-md-3 col-xs-12 control-label"><?=$fee_type[$s]['fee_type']?><span class="clr-red"></span></label>
							<div class="col-md-3 col-xs-12 m4">
							<?php 
								$fee_type_id=$fee_type[$s]['id_fee_type'];
								$fee_value=(isset($classFeeStructure)) ? $result[0]['fee_type_'.$fee_type_id] : '0';
							?>
								<input type="text" id="fee_type_<?=$fee_type[$s]['id_fee_type']?>" name="fee_type_<?=$fee_type[$s]['id_fee_type']?>" value='<?php echo $fee_value;?>' >
							</div>
							<?php if($s%2==1) { ?>
						</div>
					<?php } } ?>
					<?php if($s%2==1) { ?>
					</div>
					<?php } ?>
					<div class="form-group" id="status_div" style="display:none">
						<label class="col-md-3 col-xs-12 control-label">Status <span class="clr-red">*</span></label>
						<div class="col-md-3 col-xs-12 m4">
							<select class="form-control select" name="status" id="status">
								<option value="1">Active </option>
								<option value="0">Inactive </option>
							</select>
						</div>
					</div>
				</div>
            	<div class="text-center">
                	<button class="btn btn-primary">Save</button>
               </div>
            <input type="hidden" name="id_fee_structure" id="id_fee_structure" value="0">
			</form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php 
if(isset($classFeeStructure) && $classFeeStructure[0]['board_id'])
{
	?>
	<<script type="text/javascript">
	var board_id=<?php echo $classFeeStructure[0]['id_board'] ?>;
	var course_id=<?php echo $classFeeStructure[0]['id_course'] ?>;
	getClassByBoard1(board_id,course_id);
</script>
<?php 	
}
?>



