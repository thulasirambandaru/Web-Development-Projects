
    <section class="col-lg-10 right-section">	
        <ul class="breadcrumb border-btm">
            <li class="">
                <a href="<?=BASE_URL?>index.php/Admin/Section"> Home </a>
            </li>
            <li class="active">
                Section List
            </li>
        </ul>
        <a href="<?=BASE_URL?>index.php/admin/addSection" class="btn btn-primary m8 float-right p6">Add Section</a>
        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>                
                <th>Board</th>
                <th>Course</th>
                <th>Section</th>
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
		getSectionDataTable();
	});
</script>