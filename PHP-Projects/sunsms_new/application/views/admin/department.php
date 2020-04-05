<?php
/**
 * Created by PhpStorm.
 * User: ASHOK
 * Date: 28/6/16
 * Time: 10:08 PM
 */ ?>
<section class="col-lg-10 right-section">

    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Admin/Department"> Home </a>
        </li>

        <li class="active">
            Department List
        </li>
    </ul>

    <a href="<?=BASE_URL?>index.php/Admin/addDepartment" class="btn btn-primary m8 float-right p6">Add Department </a>

    <table id="table" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Department Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>



        </tbody>

    </table>

</section>


<script type="text/javascript">
    $(function () {
        getDepartmentDataTable();
    });
</script>