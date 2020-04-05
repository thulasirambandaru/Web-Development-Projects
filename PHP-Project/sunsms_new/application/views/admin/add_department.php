<?php
/**
 * Created by PhpStorm.
 * User: ASHOK
 * Date: 28/6/16
 * Time: 8:46 PM
 */ ?>
<section class="col-lg-10 right-section">

    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Admin/Department"> Home </a>
        </li>

        <li class="active">
            Add Department
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($department_details)){ ?>Edit Department<?php } else { ?>Create Department<?php } ?></a></li>

            </ul>

            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="department_form" method="post" action="<?=BASE_URL?>index.php/admin/createDepartment">



                        <div class="panel-body">

                            <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="department_name" id="department_name" value="<?php if(isset($department_details)){ echo $department_details[0]['department_name']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary"><?php if(isset($department_details)){ ?>Update<?php } else { ?>Save<?php } ?></button>
                        </div>
                        <input type="hidden" name="id_department" id="id_department" value="<?php if(isset($department_details)){ echo encode($department_details[0]['id_department']); } else { echo 0; } ?>">
                    </form>
                </div>

            </div>
        </div>
    </div>
    

</section>