
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Admin/academicYear"> Home </a>
        </li>
        <li class="active">
            Add Academic year
        </li>
    </ul>
    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($school)){ ?>Edit Academic Year<?php } else { ?>Add Academic Year<?php } ?></a></li>
            </ul>
            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="academic_form" method="post" action="<?=BASE_URL?>index.php/admin/createAcademicYear" enctype="multipart/form-data">
                        <div class="panel-body">													<?php //echo ERROR_HTML; ?>							
                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="name" id="name" value="<?php if(isset($academic_year)){ echo $academic_year[0]['name']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label">Start Date <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                                                                                    
										<input type="text" class="form-control datepicker" name="start_date" id="start_date" value="<?php if(isset($academic_year)){ echo date('d-m-Y',strtotime($academic_year[0]['start_date'])); } ?>" onkeypress="return false" title="start date"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label">End Date <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>                                                                                 
                                        <input type="text" class="form-control datepicker" name="end_date" id="end_date" value="<?php if(isset($academic_year)){ echo date('d-m-Y',strtotime($academic_year[0]['end_date'])); } ?>" onkeypress="return false"  title="end date"/>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-6 col-xs-12 control-label">Description <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">									
                                    <textarea rows="5" class="form-control" name="description" id="description"><?php if(isset($academic_year)){ echo $academic_year[0]['description']; } ?></textarea>									
                                </div>
                            </div>
                            <div class="form-group" <?php if(!isset($academic_year)){ ?>style="display: none;"<?php } ?>>
                                <label class="col-md-6 col-xs-12 control-label">Status</label>
                                <div class="col-md-6 col-xs-12">
                                    <select class="form-control select" name="status" id="status">
                                        <option <?php if(isset($academic_year)){ if($academic_year[0]['status']==1){ echo "selected='selected'"; } } ?> value="1">Active</option>
                                        <option <?php if(isset($academic_year)){ if($academic_year[0]['status']==0){ echo "selected='selected'"; } } ?> value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary">Save</button>
                        </div>
                        <input type="hidden" name="id_academic_year" id="id_academic_year" value="<?php if(isset($academic_year)){ echo encode($academic_year[0]['id_academic_year']); } else { echo 0; } ?>">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>



