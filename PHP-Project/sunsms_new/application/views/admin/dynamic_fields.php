<section class="col-lg-10 right-section">

    <ul class="breadcrumb border-btm">
        <li class="active">
            <a href="<?=BASE_URL?>index.php/admin/dynamicFields">Add Dynamic Field</a>
        </li>
    </ul>
    <a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1">Dynamic Field Information</a></li>
            </ul>
			
            <div id="content">
            	
                <div id="tab1">
                    <form class="form-horizontal" id="dynamic_form" method="post" action="<?=BASE_URL?>index.php/admin/addDynamicFields" enctype="multipart/form-data">

                        <div class="panel-body" id='dynamicFields'>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Field Name<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="field_name" id="field_name" value="<?php if(isset($dynamicField)){ echo $dynamicField[0]['display_name']; } ?>" class="form-control"/>
									</div>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Field Type<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <select class="form-control select" name="field_type_id" id="field_type_id" onchange="addFieldValues(this.value);">
	                                        <option value="">Select Field Type</option>
	                                        <?php for($s=0;$s<count($field_type);$s++){ ?>
	                                            <option <?php if(isset($dynamicField)){ if($dynamicField[0]['field_type_id']==$field_type[$s]['master_id']){ echo "selected='selected'"; } } ?> value="<?=$field_type[$s]['master_id']?>"><?=$field_type[$s]['master_name']?></option>
	                                        <?php } ?>
                                    	</select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Required</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                    	 <?php $required= (isset($dynamicField) && $dynamicField[0]['required']==1) ? $required= "selected='selected'" :''; ?>
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <select class="form-control select" name="required_id" id="required_id">
	                                        <option value="0">No</option>
	                                        <option value="1" <?php echo $required;?>>Yes</option>
	                                       
                                    	</select>
                                    </div>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Select Module</label>
                                <div class="col-md-3 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <select class="form-control select" name="module_id" id="module_id" onchange="getTabByModule(this.value);">
	                                        <option value="">Select Module</option>
	                                        <?php for($s=0;$s<count($module);$s++){ ?>
	                                            <option <?php if(isset($dynamicField)){ if($dynamicField[0]['module_id']==$module[$s]['master_id']){ echo "selected='selected'"; } } ?> value="<?=$module[$s]['master_id']?>"><?=$module[$s]['master_name']?></option>
	                                        <?php } ?>
	                                       
                                    	</select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">

                                <label class="col-md-3 col-xs-12 control-label">Tab Selection<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12">
                                    <select class="form-control select" name="tab_id" id="tab_id" onchange="getSubTab(this.value);">
                                        <option value="">Select Tab</option>
                                        <?php 
                                        if(isset($dynamicField)) {
                                        for($s=0;$s<count($tab);$s++){ ?>
                                            <option <?php if(isset($dynamicField)){ if($dynamicField[0]['tab_id']==$tab[$s]['master_id']){ echo "selected='selected'"; } } ?> value="<?=$tab[$s]['master_id']?>"><?=$tab[$s]['master_name']?></option>
                                        <?php } }?>
                                   	 </select>
                                </div>

                                <label class="col-md-3 col-xs-12 control-label">Sub Tab Selection<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" name="sub_tab_id" id="sub_tab_id" onchange="getState(this.value);">
                                        <option value="">Select Sub Tab</option>
                                        <?php
                                        if(isset($dynamicField)) {
                                        for($s=0;$s<count($sub_tab);$s++){ ?>
                                            <option <?php if(isset($dynamicField)){ if($dynamicField[0]['sub_tab_id']==$sub_tab[$s]['master_id']){ echo "selected='selected'"; } } ?> value="<?=$sub_tab[$s]['master_id']?>"><?=$sub_tab[$s]['master_name']?></option>
                                        <?php } }?>
                                    </select>
                                </div>

                            </div>                       
                        </div>
                        <div class="text-center">
                        	<span id='addAnotherField' class='btn_field'></span>
                            <button class="btn btn-primary">Save</button>
                            <input type='hidden' name='field_id' id='field_id' value="<?php if(isset($dynamicField)){ echo $dynamicField[0]['field_id']; } ?>">
                            <input type='hidden' name='old_field_name' id='old_field_name' value="<?php if(isset($dynamicField)){ echo $dynamicField[0]['field_name']; } ?>">
                            <input type="hidden" name="field_count" id="field_count" value="0" >
                        </div>
                    </form></div>

                </div>
            </div>
        </div>
    

</section>


<script type='text/javascript'>

function addFieldValues(field_id){
	var field_count=$('#field_count').val();

	var _html= '<div class="form-group li-group">'+
		'<label class="col-md-3 col-xs-12 control-label"> Field Value</label>'+
		'<div class="col-md-3 col-xs-12 m4">'+
		'<div class="input-group">'+
		'<span class="input-group-addon"><span class="fa fa-pencil"></span></span>'+
		'<input type="text" class="form-control course " name="field_value[]" id="field_value"  />'+
		'<label class="error1" style="display: none">Please Enter Field Value</label>' +
		'</div></div>'+		
		'<div class="col-md-3 col-xs-12">'+		
		'<span class="deleteSpan"><a title="delete" onclick="deleteNewlyAddedFieldValues(this)"><span class="circle"><i class="fa fa-trash"></i></span></a></a></span>'+
		'</div>'+
		'</div>';
		if((field_id==3 || field_id==4 || field_id==5 || field_id=='') && field_count==0)
		{
			var add_button='<a class="btn btn-primary" onclick="addFieldValues(\'d\');">Add Another Field Value</a>';
			$('#dynamicFields').append(_html);
			$('#addAnotherField').append(add_button);
			$('#field_count').val(parseInt(field_count)+parseInt(1));
		}
		else if(field_id=='d')
		{
			$('#dynamicFields').append(_html);
			$('#field_count').val(parseInt(field_count)+parseInt(1));
		}
}

function deleteNewlyAddedFieldValues(e){
	var field_count=$('#field_count').val();
	$(e).parent().closest('.li-group').remove();
	$('#field_count').val(parseInt(field_count)-parseInt(1));
	if($('#dynamicFields').find('.form-group').length==0){
		addFieldValues();
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

<?php 
	if(isset($dynamicField) && $dynamicField[0]['field_type_id']!='')
	{ ?>
		<script type='text/javascript'>
			addFieldValues('<?php echo $dynamicField[0]['field_type_id'];?>');
		</script>
<?php } 
?>

