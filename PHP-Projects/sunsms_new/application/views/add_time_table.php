



<section class="col-lg-10 right-section">

    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/admin/index"> Dashboard </a>
        </li>

        <li class="active">
            Time Table
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($school)){ ?>Edit Time Table<?php } else { ?>Add Time Table<?php } ?></a></li>

            </ul>

            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="timetable_form" method="post" action="<?=BASE_URL?>index.php/admin/createTimeTable" enctype="multipart/form-data">



                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Course <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" name="course_id" id="course_id" <?php if(isset($class_timing)){ echo "disabled"; } ?> onchange="getTimeTable(this.value);">
                                        <option value="0">Select Course </option>
                                        <?php for($s=0;$s<count($course);$s++){ ?>
                                            <option <?php if(isset($class_timing)){ if($class_timing[0]['course_id']==$course[$s]['id_course']){ echo "selected='selected'"; } } ?> value="<?=$course[$s]['id_course']?>"><?=$course[$s]['course_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <?php
                                if(isset($class_timing)){ ?>
                                <input type="hidden" name="course_id" value="<?=$class_timing[0]['course_id']?>">
                                <?php } ?>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Start Date <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="start_date" id="start_date" value="<?php if(isset($class_timing)){ echo date('d-m-Y',strtotime($class_timing[0]['start_date'])); } ?>" class="form-control datepicker"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">End Date <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="end_date" id="end_date" value="<?php if(isset($class_timing)){ echo date('d-m-Y',strtotime($class_timing[0]['end_date'])); } ?>" class="form-control datepicker"/>
                                    </div>
                                </div>
                            </div>

                        <div class="form-group" id="time-table-div">
                            <?php if(isset($class_timing)){ echo $html; } ?>
                        </div>

                        </div>
                        <div class="text-center">
                            <button id="save-btn" style="display: none" class="btn btn-primary">Save</button>
                        </div>
                        <input type="hidden" name="id_class_time_table" id="id_class_time_table" value="<?php if(isset($class_timing)){ echo encode($class_timing[0]['id_class_time_table']); } else { echo 0; } ?>">
                    </form>
                </div>

                </div>
            </div>
        </div>
    </div>

</section>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">

            <div class="">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel"></h4>
                </div>
                <div class="modal-body" id="sub_timing">

                </div>
                <div class="modal-footer" id="m-footer">

                </div>
            </div>

    </div>
</div>


