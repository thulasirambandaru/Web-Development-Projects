<?php
/**
 * Created by PhpStorm.
 * User: ASHOK
 * Date: 28/6/16
 * Time: 8:27 PM
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

    <a href="<?=BASE_URL?>index.php/category/addUpdateCategoryView" class="btn btn-primary m8 float-right p6">Add Category</a>

    <table id="table" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Category Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>



        </tbody>

    </table>

</section>





<script type="text/javascript">
    $(function () {

        getCategoryDataTable();


    });
</script>