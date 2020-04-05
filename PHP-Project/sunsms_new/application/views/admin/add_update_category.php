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
            <a href="<?=BASE_URL?>index.php/admin/index"> Dashboard </a>
        </li>

        <li class="active">
            Category
        </li>
    </ul>

    <div class="">
        <div class="tabs-wrapper">
            <ul id="tabs">
                <li><a href="#" name="tab1"><?php if(isset($category_details)){ ?>Edit Category<?php } else { ?>Add Category<?php } ?></a></li>

            </ul>

            <div id="content">
                <div id="tab1">
                    <form class="form-horizontal" id="category_form" method="post" action="<?=BASE_URL?>index.php/category/insertUpdateCategory">



                        <div class="panel-body">

                             <div class="form-group">
                                <label class="col-md-3 col-xs-12 control-label">Name <span class="clr-red">*</span></label>
                                <div class="col-md-6 col-xs-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                        <input type="text" name="category_name" id="category_name" value="<?php if(isset($category_details)){ echo $category_details[0]['category_name']; } ?>" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary"><?php if(isset($category_details)){ ?>Update<?php } else { ?>Save<?php } ?></button>
                        </div>
                        <input type="hidden" name="id_category" id="id_category" value="<?php if(isset($category_details)){ echo encode($category_details[0]['id_category']); } else { echo 0; } ?>">
                    </form>
                </div>

            </div>
        </div>
    </div>
    </div>

</section>