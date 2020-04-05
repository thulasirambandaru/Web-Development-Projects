
    <section class="col-lg-10 right-section">	
        <ul class="breadcrumb border-btm">
            <li class="">
                <a href="<?=BASE_URL?>index.php/Admin/Course"> Home </a>
            </li>
            <li class="active">
                Class List
            </li>
        </ul>
        <a href="<?=BASE_URL?>index.php/Admin/addCourse" class="btn btn-primary m8 float-right p6">Add Class</a>
        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Board Name</th>
                <th>Class Name</th>                
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
		getCourseDataTable();
	});
</script>