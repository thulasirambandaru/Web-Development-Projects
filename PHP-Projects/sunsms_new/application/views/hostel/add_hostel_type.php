
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
        <form class="form-horizontal" id="fee_form" method="post" action="<?=BASE_URL?>index.php/Hostel/createHostelType" enctype="multipart/form-data" onsubmit="return validateHostelType()">
            <div class="panel-body" style="background: none;">
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Hostel Type <span class="clr-red">*</span></label>
                        <div class="col-md-3 col-xs-12 m4">
                            <input type="text" value="<?php if(isset($hostel_type)){ echo $hostel_type[0]['hostel_type']; } ?>" name="hostel_type" id="hostel_type">
                        </div>
                </div>


                <div class="form-group" id="status_div" >
                    <label class="col-md-3 col-xs-12 control-label">Status <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <select class="form-control select" name="status" id="status">
                            <option <?php if(isset($hostel_type)){ if($hostel_type[0]['status']==1){ echo "selected='selected'"; } } ?> value="1">Active </option>
                            <option <?php if(isset($hostel_type)){ if($hostel_type[0]['status']==0){ echo "selected='selected'"; } } ?> value="0">Inactive </option>
                        </select>
                    </div>
                </div>
            </div>
            <p style="text-align:center;" id="s_btn"><input type="submit" name="sub" value="Save" class="btn"></p>
            <input type="hidden" name="id_hostel_type" id="id_hostel_type" value="<?php if(isset($hostel_type)){ echo $hostel_type[0]['id_hostel_type']; } ?>">
        </form>
    </div>
</section>


<script type="text/javascript">
    function validateHostelType()
    {
        var fee_type = $('#hostel_type').val();
        if(fee_type==''){
            $('#hostel_type').css('border','1px solid red');
            return false;
        }
        else{
            $('#fee_form').submit();
        }
        return false;
    }
</script>