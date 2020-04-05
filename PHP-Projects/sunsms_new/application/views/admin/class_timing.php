

    <section class="col-lg-10 right-section">

        <ul class="breadcrumb border-btm">
            <li class="">
                <a href="<?=BASE_URL?>index.php/admin/classTiming"> Home </a>
            </li>

            <li class="active">
                Class Timing List
            </li>
        </ul>

        <a href="<?=BASE_URL?>index.php/admin/addClassTiming" class="btn btn-primary m8 float-right p6">Add Class Timing</a>

        <table id="table" class="table table-bordered table-hover">
            <thead>
            <tr>                
                <th>Name</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Is Break</th>
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
		getClassTimingDataTable();
	});
</script>