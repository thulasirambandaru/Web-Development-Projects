
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Staff"> Home </a>
        </li>
        <li class="active">
            Staff List
        </li>
    </ul>
    <a href="<?=BASE_URL?>index.php/staff/createStaffView" class="btn btn-primary m8 float-right p6">Add Staff</a>
    <table id="table" class="table table-bordered table-hover">
        <thead>
        <tr>            
            <th>Employee Name</th>            
			<th>Teacher Number</th>
            <th>Qualification</th>
            <th>Experience Years</th>
			<th>Gender</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</section>
<script type="text/javascript">
    $(function () {
        getStaffDataTable();
    });
</script>