
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/admin/index"> Dashboard </a>
        </li>
        <li class="active">
            Fee
        </li>
    </ul>
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1">Fee</a></li>
            <div id="content">
                <div class="row">
                    <div class="col-md-4">
                        <?php
                        $academic_year = $this->mfee->getAcademicYear(array('status' => 1));
                        if(!empty($academic_year))
                            $academic_year_id = $academic_year[0]['id_academic_year'];
                        else $academic_year_id = 0;
                        $amount = $this->mfee->getTotalFeeAmount(array('academic_year_id' => $academic_year_id));
                        ?>
                        <div onclick="#" class="widget widget-default widget-item-icon">
                            <div class="widget-item-left">
                                <i aria-hidden="true" class="fa fa-dollar icon-blue"></i>
                            </div>
                            <div class="widget-data">
                                <div class="widget-int num-count"><?=($amount[0]['amount'])?$amount[0]['amount']:0?></div>
                                <div class="widget-title">Total Fees</div>
                                <div class="widget-subtitle"></div>
                            </div>
                            <div class="widget-controls"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?php $collected_amount = $this->mfee->getTotalFeeCollected(array('academic_year_id' => $academic_year_id)); ?>
                        <div onclick="#" class="widget widget-default widget-item-icon">
                            <div class="widget-item-left"><i class="fa fa-dollar icon-green"></i></div>
                            <div class="widget-data">
                                <div class="widget-int num-count"><?=$collected_amount[0]['amount']?></div>
                                <div class="widget-title">Total Fee Collected</div>
                                <div class="widget-subtitle"></div>
                            </div>
                            <div class="widget-controls"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div onclick="#" class="widget widget-default widget-item-icon">
                            <div class="widget-item-left"><i class="fa fa-dollar icon-red"></i></div>
                            <div class="widget-data">
                                <div class="widget-int num-count"><?=$amount[0]['amount']-$collected_amount[0]['amount']?></div>
                                <div class="widget-title">Total Fee Pending</div>
                                <div class="widget-subtitle"></div>
                            </div>
                            <div class="widget-controls"></div>        </div>
                </div>
                <div id="tab1">
                    <form class="form-horizontal" id="course_form" method="post" action="" enctype="multipart/form-data">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
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
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Class <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" name="course_id" id="course_id" onchange="getSectionByCourse(this.value)">
                                        <option value="0">Select Class</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Select Section <span class="clr-red">*</span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <select class="form-control select" name="section_id" id="section_id" onchange="getStudentFee();">
                                        <option value="0">Select Section</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="fee_notify" style="display: none">
                                <label class="col-md-3 col-xs-12 control-label"><span class="clr-red"></span></label>
                                <div class="col-md-3 col-xs-12 m4">
                                    <input type="button" class="btn" value="Notify" onclick="notifyFee()">
                                </div>
                            </div>
                        </div>
                    </form>
                        <div style="width: auto;overflow: auto">
                        <table id="table" class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Course</th>
                                <th>Section</th>
                                <th>Admission Number</th>
                                <th>Student</th>
                                <th>Total</th>
                                <th>Paid</th>
                                <th>Due</th>
                            </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                        </div>


                </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="selected_array" id="selected_array" value="">
</section>
<script>
    $(function() {

        <?php if(isset($_REQUEST['board_id'])){ ?>
            getClassByBoard('<?=base64_decode($_REQUEST['board_id'])?>','<?=base64_decode($_REQUEST['course_id'])?>');
        <?php } ?>
        <?php if(isset($_REQUEST['course_id'])){ ?>
            getSectionByCourse('<?=base64_decode($_REQUEST['course_id'])?>','<?=base64_decode($_REQUEST['section_id'])?>');
        <?php } ?>


        $('#table').dataTable();



    });
</script>