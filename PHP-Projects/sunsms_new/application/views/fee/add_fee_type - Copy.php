
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            fee type
        </li>
    </ul>

    <div id="form" >
        <form class="form-horizontal" id="fee_form" method="post" action="<?=BASE_URL?>index.php/fee/createFeeType" enctype="multipart/form-data" onsubmit="return validateFeeType()">
            <div class="panel-body" style="background: none;">
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Fee Type <span class="clr-red">*</span></label>
                        <div class="col-md-3 col-xs-12 m4">
                            <input type="text" value="<?php if(isset($fee_type)){ echo $fee_type[0]['fee_type']; } ?>" name="fee_type_name" id="fee_type_name">
                        </div>
                </div>


                <div class="form-group" id="status_div" >
                    <label class="col-md-3 col-xs-12 control-label">Status <span class="clr-red"></span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <select class="form-control select" name="status" id="status">
                            <option <?php if(isset($fee_type)){ if($fee_type[0]['fee_type']==1){ echo "selected='selected'"; } } ?> value="1">Active </option>
                            <option <?php if(isset($fee_type)){ if($fee_type[0]['fee_type']==0){ echo "selected='selected'"; } } ?> value="0">Inactive </option>
                        </select>
                    </div>
                </div>
            </div>
            <p style="text-align:center;" id="s_btn"><input type="submit" name="sub" value="Save" class="btn"></p>
            <input type="hidden" name="id_fee_type" id="id_fee_type" value="<?php if(isset($fee_type)){ echo $fee_type[0]['id_fee_type']; } ?>">
        </form>
    </div>
</section>


<script type="text/javascript">
    function validateFeeType()
    {

        var fee_type = $('#fee_type_name').val();
        if(fee_type==''){
            $('#fee_type_name').css('border','1px solid red');
            return false;
        }
        else{
            //$('#fee_form').submit();
        }
    }
</script>