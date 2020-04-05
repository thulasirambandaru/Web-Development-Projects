
    <section class="col-lg-10 right-section">

        <ul class="breadcrumb border-btm">
            <li class="">
                <a href="<?=BASE_URL?>index.php/Admin/Subject"> Home </a>
            </li>

            <li class="active">
                Subjects List
            </li>
        </ul>

        <a href="<?=BASE_URL?>index.php/admin/addSubject" class="btn btn-primary m8 float-right p6">Add Subject</a>

        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Board</th>
                <th>Course</th>
                <th>Subject</th>                
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
		getSubjectDataTable();
	});
</script>