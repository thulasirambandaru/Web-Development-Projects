
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/examination"> Home </a>
        </li>
        <li class="active">
            Manage Exam
        </li>
    </ul>
	
	<a href="javascript:history.back()" class="btn btn-primary m8 float-right p6">Back</a>
	
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><b><?php if(isset($exam)){ ?>Edit Exam<?php } else { ?>Add Exam<?php } ?></b></a></li>
            </ul>
            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="exam_form" method="post" action="<?=BASE_URL?>index.php/examination/createExam" enctype="multipart/form-data">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Exam Name <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="name" id="name" value="<?php if(isset($exam)){ echo $exam
										[0]['exam_name']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group" <?php if(!isset($exam)){ ?>style="display: none;"<?php } ?>>
                                <label class="col-md-6 col-xs-12 control-label">Status</label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control select" name="status" id="status">
                                        <option <?php if(isset($exam)){ if($exam[0]['status']==1){ echo "selected='selected'"; } } ?> value="1">Active</option>
                                        <option <?php if(isset($exam)){ if($exam[0]['status']==0){ echo "selected='selected'"; } } ?> value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <input type="hidden" name="id_exam" id="id_exam" value="<?php if(isset($exam)){ echo encode($exam[0]['id_exam']); } else { echo 0; } ?>">
                    </form>
                </div>
			</div>
            </div>
        </div>
    </div>
</section>