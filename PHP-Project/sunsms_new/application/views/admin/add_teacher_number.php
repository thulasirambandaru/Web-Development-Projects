<section class="col-lg-10 right-section">
	<ul class="breadcrumb border-btm">
		<li class="">
			<a href="
				<?=BASE_URL?>index.php/Admin/teacherNumber"> Home 
			</a>
		</li>
		<li class="active">Add Teacher Number</li>
	</ul>
	<div class="">
		<div class="tabs-wrapper">
			<ul id="tabs">
				<li>
					<a href="#" name="tab1">Add Teacher Number</a>
				</li>
			</ul>
			<div id="content">
				<div id="tab1">
					<form class="form-horizontal" id="teacher_form" method="post" action="<?=BASE_URL?>index.php/admin/addTeacherNumber" enctype="multipart/form-data">						
						<p class="err_msg">
							<?php if($this->session->userdata('message')){ echo $this->session->userdata('message'); $this->session->unset_userdata('message'); } ?>
						</p>
						<div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label">Teacher Number 
									<span class="clr-red">*</span>
								</label>
								<div class="col-md-6 col-xs-12">
									<div class="input-group">
										<span class="input-group-addon">
											<span class="fa fa-pencil"></span>
										</span>
										<input type="text" name="teacher_number" id="teacher_number" value="<?php if(isset($teacher_number)){ echo $teacher_number[0]['teacher_number']; } ?>" class="form-control"/>											
									</div>
									</div>
								</div>
							</div>
							<div class="text-center">
								<button class="btn btn-primary">Save</button>
							</div>
							<input type="hidden" name="id_teacher_no" id="id_teacher_no" value="<?php if(isset($teacher_number)){ echo encode($teacher_number[0]['id_teacher_number']); } ?>">
								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>