
    <section class="col-lg-10 right-section">
        <ul class="breadcrumb border-btm">
            <li class="">
                <a href="<?=BASE_URL?>index.php/admin/dynamicFields"> Home </a>
            </li>
            <li class="active">
                Dynamic Filed List
            </li>
        </ul>
        <a href="<?=BASE_URL?>index.php/admin/dynamicFields" class="btn btn-primary m8 float-right p6">Add New Field</a> 
        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Field Name</th>
                <th>Field Type</th>
                <th>Module</th>
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
		getDynamicFieldsDataTable();
	});
</script>