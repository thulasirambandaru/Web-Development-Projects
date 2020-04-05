
    <section class="col-lg-10 right-section">
        <ul class="breadcrumb border-btm">
            <li class="">
                <a href="<?=BASE_URL?>index.php/admin/academicYear"> Home </a>
            </li>
            <li class="active">
                Academic year List
            </li>
        </ul>
        <a href="<?=BASE_URL?>index.php/admin/addAcademicYear" class="btn btn-primary m8 float-right p6">Add Academic Year</a>
        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>		
    </section>
<script type="text/javascript">
	$(function () {
		getAcademicYearDataTable();
	});
</script>