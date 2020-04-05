
    <section class="col-lg-10 right-section">
        <ul class="breadcrumb border-btm">
            <li class="">
                <a href="<?=BASE_URL?>index.php/Admin/Board"> Home </a>
            </li>
            <li class="active">
                Board List
            </li>
        </ul>
        <a href="<?=BASE_URL?>index.php/admin/addBoard" class="btn btn-primary m8 float-right p6">Add Board</a>
        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>
                <th>Name</th>
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
		getBoardDataTable();
	});
</script>