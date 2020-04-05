



<section class="col-lg-10 right-section">

    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/admin/index"> Dashboard </a>
        </li>

        <li class="active">
            Class Timing
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($school)){ ?>Edit Class Timing<?php } else { ?>Add Class Timing<?php } ?></a></li>

            </ul>

            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="class_timeing_form" method="post" action="<?=BASE_URL?>index.php/admin/createClassTiming" enctype="multipart/form-data">



                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Course <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" name="course_id" id="course_id">
                                        <option value="0">Select Course </option>
                                        <?php for($s=0;$s<count($course);$s++){ ?>
                                            <option <?php if(isset($class_timing)){ if($class_timing[0]['course_id']==$course[$s]['id_course']){ echo "selected='selected'"; } } ?> value="<?=$course[$s]['id_course']?>"><?=$course[$s]['course_name']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="name" id="name" value="<?php if(isset($class_timing)){ echo $class_timing[0]['name']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Start Time <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <!--<input type="text" name="start_time" id="start_time" value="<?php /*if(isset($class_timing)){ echo $class_timing[0]['start_time']; } */?>" class="form-control"/>-->
                                        <select class="form-control" name="start_time" id="start_time">
                                            <option value="">Select Time</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">end Time <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <!--<input type="text" name="end_time" id="end_time" value="<?php /*if(isset($class_timing)){ echo $class_timing[0]['end_time']; } */?>" class="form-control"/>-->
                                        <select class="form-control" name="end_time" id="end_time">
                                            <option value="">Select Time</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label"></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <label class="check"><input type="checkbox" name="is_break" <?php if(isset($class_timing)){ if($class_timing[0]['is_break']==1){ echo "checked='checked'"; } } ?> value="1" class=""> Is break</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="text-center">
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
</script>