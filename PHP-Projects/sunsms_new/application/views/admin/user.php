
    <section class="col-lg-10 right-section">
        <ul class="breadcrumb border-btm">
            <li class="">
                <a href="<?=BASE_URL?>index.php/admin/user"> Home </a>
            </li>
            <li class="active">
                SUNSMS Users List
            </li>
        </ul>
        <a href="<?=BASE_URL?>index.php/admin/addUser" class="btn btn-primary m8 float-right p6">Add New User</a> 
        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Role</th>
                <th>Phone</th>
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
		getUserDataTable();
	});
</script>