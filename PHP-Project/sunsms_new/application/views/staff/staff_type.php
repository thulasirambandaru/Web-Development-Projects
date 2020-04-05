
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Staff"> Home </a>
        </li>
        <li class="active">
            Staff Type List
        </li>
    </ul>
    <a href="<?=BASE_URL?>index.php/staff/addUpdateStaffType" class="btn btn-primary m8 float-right p6">Add Staff Type</a>
    <table id="table" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Staff Type</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</section>

<script type="text/javascript">
    $(function () {
        getStaffTypeDateTable();
    });
</script>