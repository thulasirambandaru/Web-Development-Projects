
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/admin/index"> Dashboard </a>
        </li>
        <li class="active">
            Attendance
        </li>
    </ul>
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1">Attendance</a></li>
            </ul>
            <div id="content">
                <div id="tab1">
                    <?php if($this->session->userdata('user_type_id')==ADMIN && $type!='student_attendance'){ ?>
                        <form class="form-horizontal" id="course_form" method="post" action="<?=BASE_URL?>index.php/Attendance/addStaffAttendance" enctype="multipart/form-data" onsubmit="setPostData();">
                    <?php } else { ?>
                            <form class="form-horizontal" id="course_form" method="post" action="<?=BASE_URL?>index.php/Attendance/addAttendance" enctype="multipart/form-data" onsubmit="setPostData();">
                    <?php } ?>
                        <div class="panel-body">
                            <?php if($this->session->userdata('user_type_id')==ADMIN && $type!='student_attendance'){ ?>
                                <div class="form-group">
                                    <!--<div>
                                    <label class="col-md-3 col-xs-12 control-label">Select Staff <span class="clr-red">*</span></label>
                                    <div class="col-md-3 col-xs-12 m4">
                                        <select class="form-control select" name="staff_id" id="staff_id" onchange="getClassByBoard(this.value)">
                                            <option value="0">Select Staff </option>
                                            <?php /*for($s=0;$s<count($staff);$s++){ */?>
                                                <option <?php /*if(isset($_REQUEST['staff_id'])){ if(base64_decode($_REQUEST['staff_id'])==$staff[$s]['id_staff']){ echo "selected='selected'"; } } */?>

                                                    value="<?/*=$staff[$s]['id_staff']*/?>"><?/*=$staff[$s]['name']*/?></>
                                            <?php /*} */?>
                                        </select>
                                    </div>
                                    </div>-->
                                    <div>
                                        <label class="col-md-3 col-xs-12 control-label">Select Month<span class="clr-red">*</span></label>
                                        <div class="col-md-3 col-xs-12 m4">
                                            <?php if(isset($_REQUEST['month'])){
                                                if(base64_decode($_REQUEST['month'])<10){
                                                    $_REQUEST['month'] = str_replace('0','',base64_decode($_REQUEST['month']));
                                                    $_REQUEST['month'] = base64_encode($_REQUEST['month']); }
                                            }
                                            //echo base64_decode($_REQUEST['month']); exit; ?>
                                            <select class="form-control select" name="month" id="month" onchange="getStaffAttendance();getWorkingDays(this.value);">
                                                <?php

                                                for($m=1;$m<=12;$m++){ ?>
                                                    <option
                                                        <?php
                                                        if(isset($_REQUEST['month'])){ if($m==base64_decode($_REQUEST['month'])){ echo 'selected="selected"'; } }
                                                        else if($m==date('m')){ echo 'selected="selected"'; } ?>
                                                        value="<?=$m?>"><?=date('F', mktime(0, 0, 0, $m, 10));?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                
                                    <label class="col-md-3 col-xs-12 control-label"  style="width:163px;padding-right: 2px;">No of working days : </label>
                                    <div class="col-md-3 col-xs-12 m4" style="padding-left: 0px;">
                                        <span  id="working_days"></span>
                                    </div>
                                </div>
                              <!--   <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label" style="color:red;width:163px;padding-right: 2px;">Note : </label>
                                    <div class="col-md-3 col-xs-12 m4" style="padding-left: 0px;">
                                        <span  id="">Click on Attendance to change</span>
                                    </div>
                                </div> -->
                                <input type="hidden" name="course_id" value="0">
                                <input type="hidden" name="board_id" value="0">
                                <input type="hidden" name="section_id" value="0">

                            <?php } else if(($this->session->userdata('user_type_id')==TEACHER || $this->session->userdata('user_type_id')==ADMIN) && $type=='student_attendance'){ ?>
                            <div class="form-group">
                                <div>
                                <label class="col-md-3 col-xs-12 control-label">Select Board<span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" name="board_id" id="board_id" onchange="getClassByBoard(this.value)">
                                        <option value="0">Select Board </option>
                                        <?php for($s=0;$s<count($board);$s++){ ?>
                                            <option <?php if(isset($course)){ if($course[0]['board_id']==$board[$s]['id_board']){ echo "selected='selected'"; } } ?>
                                                    <?php if(isset($_REQUEST['board_id'])){ if(base64_decode($_REQUEST['board_id'])==$board[$s]['id_board']){ echo "selected='selected'"; } } ?>
                                                value="<?=$board[$s]['id_board']?>"><?=$board[$s]['board_name']?></>
                                        <?php } ?>
                                    </select>
                                </div>
                                </div>
                                    <div>
                                    <label class="col-md-3 col-xs-12 control-label">Select Class <span class="clr-red">*</span></label>
                                    <div class="col-md-3 col-xs-12 m4">
                                        <select class="form-control select" name="course_id" id="course_id" onchange="getSectionByCourse(this.value)">
                                            <option value="0">Select Class</option>
                                        </select>
                                    </div>
                                    </div>
                            </div>


                            <div class="form-group">
                                <div>
                                <label class="col-md-3 col-xs-12 control-label">Select Section <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" name="section_id" id="section_id" onchange="getAttendance();">
                                        <option value="0">Select Section</option>
                                    </select>
                                </div>
                                </div>
                                <div>
                                    <label class="col-md-3 col-xs-12 control-label">Select Month <span class="clr-red">*</span></label>
                                    <div class="col-md-3 col-xs-12 m4">
                                        <?php if(isset($_REQUEST['month'])){
                                            if(base64_decode($_REQUEST['month'])<10){
                                                $_REQUEST['month'] = str_replace('0','',base64_decode($_REQUEST['month']));
                                                $_REQUEST['month'] = base64_encode($_REQUEST['month']); }
                                        }
                                        //echo base64_decode($_REQUEST['month']); exit; ?>
                                        <select class="form-control select" name="month" id="month" onchange="getAttendance();getWorkingDays(this.value);">
                                            <?php

                                            for($m=1;$m<=12;$m++){ ?>
                                                <option
                                                    <?php
                                                    if(isset($_REQUEST['month'])){ if($m==base64_decode($_REQUEST['month'])){ echo 'selected="selected"'; } }
                                                    else if($m==date('m')){ echo 'selected="selected"'; } ?>
                                                    value="<?=$m?>"><?=date('F', mktime(0, 0, 0, $m, 10));?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label" style="width:163px;padding-right: 2px;">No of working days : </label>
                                    <div class="col-md-3 col-xs-12 m4" style="padding-left: 0px;">
                                        <span  id="working_days"></span>
                                    </div>
                                </div>
                                <input type="hidden" name="staff_id" value="0">
                              <!--   <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label" style="color:red;width:163px;padding-right: 2px;">Note : </label>
                                    <div class="col-md-3 col-xs-12 m4" style="padding-left: 0px;">
                                        <span  id="">Click on Attendance to change</span>
                                    </div>
                                </div> -->
                            <?php } else{  ?>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Month <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <?php if(isset($_REQUEST['month'])){
                                        if(base64_decode($_REQUEST['month'])<10){
                                            $_REQUEST['month'] = str_replace('0','',base64_decode($_REQUEST['month']));
                                            $_REQUEST['month'] = base64_encode($_REQUEST['month']); }
                                    }
                                    //echo base64_decode($_REQUEST['month']); exit; ?>
                                    <select class="form-control select" name="month" id="month" onchange="getAttendance(); getWorkingDays(this.value);">
                                        <?php

                                        for($m=1;$m<=12;$m++){ ?>
                                            <option
                                                <?php
                                                if(isset($_REQUEST['month'])){ if($m==base64_decode($_REQUEST['month'])){ echo 'selected="selected"'; } }
                                                else if($m==date('m')){ echo 'selected="selected"'; } ?>
                                                value="<?=$m?>"><?=date('F', mktime(0, 0, 0, $m, 10));?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php if($this->session->userdata('user_type_id')!=ADMIN && $type = 'attendance'){ ?>
                            <input type="hidden" name="type" id="type" value="1">
                        <?php } else { ?>
                            <input type="hidden" name="type" id="type" value="0">
                        <?php } ?>
                        <input type="hidden" name="user_id" id="user_id" value="<?=$this->session->userdata('user_id')?>">
                        <!--<div class="text-center">
                            <button class="btn btn-primary">Save</button>
                        </div>-->
                        <?php $days = get_days_in_month(date('m'),date('Y')); ?>
                        <div style="width: auto;overflow: auto"><span style="color:red;width:163px;padding-right: 2px;"> Note </span> <span>: Click on Attendance to change</span>
                        
                        <table id="table" class="table table-bordered table-hover">
                            <thead id="header">
                            <tr>
                                <th>Name</th>
                                <?php for($s=0;$s<$days;$s++){
                                	$day_of_month=$s+1;
                                echo '<td>'.date('D',strtotime(($s+1).'-'.date('m').'-'.date('Y'))).'<br>'.$day_of_month.'</td>';
                                } ?>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                        </div>
                        <p style="text-align:center;display: none" id="s_btn">
                            <input type="submit" name="sub" value="Save" class="btn">
                            <input type="button" class="btn" onclick="checkNotify();" value="Save & Notify">
                        </p>

                        <!--<input type="hidden" name="month" id="month" value="<?/*=date('m')*/?>">-->
                        <input type="hidden" name="url" id="url" value="<?php echo $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>">
                        <input type="hidden" name="notify_check" id="notify_check" value="0">
                        <div id="notify_students">

                        </div>
                        <div id="students_div">

                        </div>
                    </form>

                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function() {
		        <?php if(isset($_REQUEST['board_id'])){ ?>
            getClassByBoard('<?=base64_decode($_REQUEST['board_id'])?>','<?=base64_decode($_REQUEST['course_id'])?>');
        <?php } ?>
        <?php if(isset($_REQUEST['course_id'])){ ?>
            getSectionByCourse('<?=base64_decode($_REQUEST['course_id'])?>','<?=base64_decode($_REQUEST['section_id'])?>');
        <?php } ?>

        <?php // if(isset($_REQUEST['staff_id']))
        if($this->session->userdata('user_type_id')==TEACHER || $this->session->userdata('user_type_id')==STUDENT)        
        { ?>
        
            getAttendance();
        <?php } ?>
        //$('#table').dataTable();
        getWorkingDays($('#month').val());
        <?php if($this->session->userdata('user_type_id')==ADMIN && $type!='student_attendance'){ ?>
            getStaffAttendance();
        <?php } ?>
    });

    function getWorkingDays(month)
    {
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL + 'index.php/Attendance/getWorkingDays/',
            data: {'month':month},
            dataType: 'json',
            success: function (res) {
                if (res.response == 1) {
                    $('#working_days').text(res.days);
                }
            }
        });
    }

    function checkNotify()
    {
        $('#notify_check').val(1);
        $('#course_form').submit();
    }

    <?php if($this->session->userdata('user_type_id')==ADMIN && $type!='student_attendance'){ ?>

    function getStaffAttendance()
    {
		var month = $('#month').val();
        $.ajax({
            async: true,
            type: 'POST',
            url: BASE_URL + 'index.php/Attendance/getStaffAttendance/',
            data: {'month':month},
            dataType: 'json',
            success: function (res) {
                if (res.response == 1)
                {
                    $('#tbody').html(res.data);
                    $('#header').html(res.header);
                    $('#s_btn').css('display', 'block');
                }
            }
        });
    }


    <?php } ?>
    function setPostData()
    {
        //$('#table').r.attr("disabled", "disabled").off('click');
        var el = $('#table');
        $('input', el).each(function(){
            $(this).attr('disabled', 'disabled');
        });
    }
</script>