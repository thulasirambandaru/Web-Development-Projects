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
            <a href="<?=BASE_URL?>index.php/Staff"> Home </a>
        </li>

        <li class="active">
            Add Staff Type
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($staff_type_details)){ ?>Edit Staff Type<?php } else { ?>Add Staff Type<?php } ?></a></li>

            </ul>

            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="staff_type_form" method="post" action="<?=BASE_URL?>index.php/staff/insertUpdateStaffType">
                        <div class="panel-body">
                             <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="staff_type_name" id="staff_type_name" value="<?php if(isset($staff_type_details)){ echo htmlentities($staff_type_details[0]['staff_type_name']); } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary"><?php if(isset($staff_type_details)){ ?>Update<?php } else { ?>Save<?php } ?></button>
                        </div>
                        <input type="hidden" name="id_staff_type" id="id_staff_type" value="<?php if(isset($staff_type_details)){ echo encode($staff_type_details[0]['id_staff_type']); } else { echo 0; } ?>">
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>

</section>