
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            hostel type
        </li>
    </ul>

    <div id="form" >
        <form class="form-horizontal" id="fee_form" method="post" action="<?=BASE_URL?>index.php/Hostel/createHostel" enctype="multipart/form-data" >
            <div class="panel-body" style="background: none;">
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Hostel Type <span class="clr-red">*</span></label>
                        <div class="col-md-3 col-xs-12 m4">
                            <select class="form-control" name="hostel_type_id" id="hostel_type_id">
                                <option value="0">Select Type</option>
                                <?php for($s=0;$s<count($hostel_type);$s++){ ?>
                                    <option <?php if(isset($hostel)){ if($hostel[0]['hostel_type_id']==$hostel_type[$s]['id_hostel_type']){ echo "selected='selected'"; } } ?> value="<?=$hostel_type[$s]['id_hostel_type']?>"><?=$hostel_type[$s]['hostel_type']?></option>
                                <?php } ?>
                            </select>
                        </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Hostel Name <span class="clr-red">*</span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <input type="text" name="hostel_name" id="hostel_name" value="<?php if(isset($hostel)){ echo $hostel[0]['hostel_name']; } ?>">
                        <span id="hostel_name_err" class="error"></span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Hostel Address <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <textarea name="hostel_address" rows="4"  id="hostel_address"><?php if(isset($hostel)){ echo $hostel[0]['hostel_address']; } ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Hostel Phone Number <span class="clr-red">*</span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <input type="text" name="hostel_phone_number" id="hostel_phone_number" value="<?php if(isset($hostel)){ echo $hostel[0]['hostel_phone_number']; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Warden Name <span class="clr-red">*</span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <input type="text" name="warden_name" id="warden_name" value="<?php if(isset($hostel)){ echo $hostel[0]['warden_name']; } ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Warden Address <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <textarea name="warden_address" rows="4" id="warden_address"><?php if(isset($hostel)){ echo $hostel[0]['warden_address']; } ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Warden Number <span class="clr-red">*</span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <input type="text" name="warden_phone_number" id="warden_phone_number" value="<?php if(isset($hostel)){ echo $hostel[0]['warden_phone_number']; } ?>">
                    </div>
                </div>

                <div class="form-group" id="status_div" >
                    <label class="col-md-3 col-xs-12 control-label">Status <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <select class="form-control select" name="status" id="status">
                            <option <?php if(isset($hostel)){ if($hostel[0]['status']==1){ echo "selected='selected'"; } } ?> value="1">Active </option>
                            <option <?php if(isset($hostel)){ if($hostel[0]['status']==0){ echo "selected='selected'"; } } ?> value="0">Inactive </option>
                        </select>
                    </div>
                </div>
            </div>
            <p style="text-align:center;" id="s_btn"><input onclick="validateHostel();" type="button" name="sub" value="Save" class="btn"></p>
            <input type="hidden" name="id_hostel" id="id_hostel" value="<?php if(isset($hostel)){ echo $hostel[0]['id_hostel']; } ?>">
        </form>
    </div>
</section>


<script type="text/javascript">
    function validateHostel()
    {
        var flag = 0;
        var hostel_type_id = $('#hostel_type_id').val();
        var hostel_name = $('#hostel_name').val();
        var hostel_phone_number = $('#hostel_phone_number').val();
        var warden_name = $('#warden_name').val();
        var warden_phone_number = $('#warden_phone_number').val();

        $('#hostel_type_id').css('border','1px solid #cccccc');
        $('#hostel_name').css('border','1px solid #cccccc');
        $('#hostel_phone_number').css('border','1px solid #cccccc');
        $('#warden_name').css('border','1px solid #cccccc');
        $('#warden_phone_number').css('border','1px solid #cccccc');
        $('#hostel_name_err').text('');

        if(hostel_type_id==0){
            $('#hostel_type_id').css('border','1px solid red');
            flag++;
        }
        if(hostel_name==''){
            $('#hostel_name').css('border','1px solid red');
            flag++;
        }
        if(hostel_phone_number==''){
            $('#hostel_phone_number').css('border','1px solid red');
            flag++;
        }
        else if(isNaN(hostel_phone_number)){
            $('#hostel_phone_number').css('border','1px solid red');
            flag++;
        }
        if(warden_name==''){
            $('#warden_name').css('border','1px solid red');
            flag++;
        }
        if(warden_phone_number==''){
            $('#warden_phone_number').css('border','1px solid red');
            flag++;
        }
        else if(isNaN(warden_phone_number)){
            $('#warden_phone_number').css('border','1px solid red');
            flag++;
        }

        if(flag==0)
        {
            $.ajax({
                async: true,
                type: 'POST',
                url: BASE_URL + 'index.php/Hostel/checkHostel/',
                data: {hostel_name:$('#hostel_name').val(),id_hostel_not:$('#id_hostel').val()},
                dataType: 'json',
                success: function (res) {
                    if(res.response==1){
                        $('#fee_form').submit();
                    }
                    else
                    {
                        $('#hostel_name_err').text(res.data);
                    }
                }
            });
        }
        else{ return false; }

    }
</script>