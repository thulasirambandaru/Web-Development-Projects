
<?php $user_type_id = $this->session->userdata('user_type_id') ?>

<section class="col-lg-10 right-section">    
	<ul class="breadcrumb border-btm">
		<li class="">
			<a href="<?=BASE_URL?>index.php/Timetable/index"> Home </a>
		</li>
		<li class="active">
			Timetable List
		</li>
    </ul>
	
	<?php if($user_type_id == ADMIN) { ?>
    <a href="<?=BASE_URL?>index.php/Timetable/addTimeTable" class="btn btn-primary m8 float-right p6">Add Time Table</a>
	<?php } ?>
	
	<table id="table" class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Board</th>
			<th>Class</th>
			<th>Section</th>
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
		getClassTimeTableDataTable(<?php echo $user_type_id; ?>);
	});
</script>