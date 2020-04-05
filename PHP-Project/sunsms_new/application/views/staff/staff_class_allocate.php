
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li class="">
            <a href="<?=BASE_URL?>index.php/Staff"> Home </a>
        </li>
        <li class="active">
            Class Teacher List
        </li>
    </ul>
    <a href="<?=BASE_URL?>index.php/staff/addUpdateClassTeacher" class="btn btn-primary m8 float-right p6">Add Class Teacher</a>
    <table id="table" class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Class Teacher</th>
			<th>Board</th>
			<th>Class</th>
			<th>Section</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</section>

<script type="text/javascript">
    $(function () {
        getStaffClassDateTable();
    });
</script>