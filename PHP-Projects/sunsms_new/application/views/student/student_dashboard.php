
<section class="col-lg-10 right-section">
    <ul class="breadcrumb border-btm">
        <li>
            <a href="<?=BASE_URL?>index.php/Student/">Home</a>
        </li>
        <li class="active">
            Student
        </li>
    </ul>

    <div class="col-md-12">
		<div class="row">
			<div class="col-md-4">
				<!-- START WIDGET MESSAGES -->
				<div class="widget widget-default widget-item-icon" onclick="#">
					<div class="widget-item-left">
						<i class="fa fa-graduation-cap icon-blue" aria-hidden="true"></i>
					</div>
					<div class="widget-data">
						<div class="widget-int num-count"><?php echo $new_admissions;?></div>
						<div class="widget-title">New Admissions</div>
						<!--<div class="widget-subtitle">subtitle</div>-->
					</div>
					<!--<div class="widget-controls">
						<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget">
							<span class="fa fa-times"></span>
						</a>
					</div>-->
				</div>
				<!-- END WIDGET MESSAGES -->
			</div>
			<div class="col-md-4">
				<!-- START WIDGET MESSAGES -->
				<div class="widget widget-default widget-item-icon" onclick="#">
					<div class="widget-item-left">
						<i class="fa fa-user icon-red"></i>
					</div>
					<div class="widget-data">
						<div class="widget-int num-count"><?php echo $total_students;?></div>
						<div class="widget-title">Total Students</div>
						<!--<div class="widget-subtitle">subtitle</div>-->
					</div>
					<!--<div class="widget-controls">
						<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget">
							<span class="fa fa-times"></span>
						</a>
					</div>-->
				</div>
				<!-- END WIDGET MESSAGES -->
			</div>
			<div class="col-md-4">
				<!-- START WIDGET MESSAGES -->
				<div class="widget widget-default widget-item-icon" onclick="#">
					<div class="widget-item-left">
						<i class="fa fa-users icon-green"></i>
					</div>
					<div class="widget-data">
						<div class="widget-int num-count"><?php echo $total_employees;?></div>
						<div class="widget-title">Employees</div>
						<!--<div class="widget-subtitle">subtitle</div>-->
					</div>
					<!--<div class="widget-controls">
						<a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget">
							<span class="fa fa-times"></span>
						</a>
					</div>-->
				</div>
				<!-- END WIDGET MESSAGES -->
			</div>
		</div>
		<!-- END row class -->
	</div>
	
	<p>&nbsp;</p>
	<p><b>New Admissions</b></p>
	
	    <table id="NewAdmissionsTable" class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Student Name</th>
            <th>Admission No</th>
            <th>Board</th>
            <th>Class</th>
            <th>Section</th>
            <th>Gender</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>

    </table>

</section>


<script type="text/javascript">
    $(function () {
        getNewAdmissionsDataTable();        
    });
</script>