
<?php $user_type_id = $this->session->userdata('user_type_id') ?>

<section class="col-lg-10 right-section">    
	<ul class="breadcrumb border-btm">
		<li class="">
			<a href="<?=BASE_URL?>index.php/Examination/index"> Home </a>
		</li>
		<li class="active">
			Examination List
		</li>
    </ul>
	
	<?php if($user_type_id == ADMIN) { ?>
    <a href="<?=BASE_URL?>index.php/Examination/AddExam" class="btn btn-primary m8 float-right p6">Create Exam</a>
	<?php } ?>
	
	<table id="table" class="table table-bordered table-hover">
		<thead>
		<tr>
			<th>Exam Name</th>
			<th>Status</th>			
			<th>Created</th>			
			<th>Action</th>
		</tr>
		</thead>		
		<tbody>
		</tbody>
	</table>
</section>

<script type="text/javascript">
	$(function () {
		getExamDataTable(<?php echo $user_type_id; ?>);
	});
</script>