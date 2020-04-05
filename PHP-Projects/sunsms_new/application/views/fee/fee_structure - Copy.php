
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="#">Home</a>
        </li>
        <li class="active">
            Student
        </li>
    </ul>
    <div id="grid">
    <!-- <a href="javascript:;" onclick="showGrid(1)" class="btn btn-primary m8 float-right p6">Create Class Fee</a> -->
     <a href="<?=BASE_URL?>index.php/admin/dynamicFields">Add Dynamic Field</a>
        </li>
    </ul>

    <table id="table" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Board</th>
            <th>Class</th>
            <?php for($s=0;$s<count($fee_type);$s++){ ?>
                <th><?=$fee_type[$s]['fee_type']?></th>
            <?php } ?>
            <th>Total</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>

    </table>
    </div>
    <div id="form" style="display:none">
        <a href="javascript:;" onclick="showGrid(0)" class="btn btn-primary m8 float-right p6">Show List</a>
        <form class="form-horizontal" id="fee_form" method="post" action="<?=BASE_URL?>index.php/fee/addFeeStructure" enctype="multipart/form-data">
            <div class="panel-body" style="background: none;">
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Select Board <span class="clr-red">*</span></label>
                    <div class="col-md-3 col-xs-12 m4">
                        <select class="form-control select" name="board_id" id="board_id" onchange="getClassByBoard1(this.value)">
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
                        <select class="form-control select" name="course_id" id="course_id" >
                            <option value="0">Select Class</option>
                        </select>
                    </div>
                </div>
                <?php for($s=0;$s<count($fee_type);$s++){ ?>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"><?=$fee_type[$s]['fee_type']?><span class="clr-red"></span></label>
                        <div class="col-md-3 col-xs-12 m4">
                            <input type="text" id="fee_type_<?=$fee_type[$s]['id_fee_type']?>" name="fee_type_<?=$fee_type[$s]['id_fee_type']?>" value="0">
                        </div>
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
            <p style="text-align:center;" id="s_btn"><input type="submit" name="sub" value="Save" class="btn"></p>
            <input type="hidden" name="id_fee_structure" id="id_fee_structure" value="0">
        </form>
    </div>
</section>


<script type="text/javascript">
    $(function () {
        getFeeStructureDataTable();
    });

    function showGrid(type)
    {
        if(type==1){
            $('#grid').css('display','none');
            $('#form').css('display','block');
        }
        else{
            $('#form').css('display','none');
            $('#grid').css('display','block');
        }
        $('#status_div').css('display','none');
    }
</script>