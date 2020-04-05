<section class="col-lg-10 right-section">
	<ul class="breadcrumb border-btm">
		<li class="">
			<a href="
				<?=BASE_URL?>index.php/Admin/admissionNumber"> Home 
			</a>
		</li>
		<li class="active">Add Admission Number</li>
	</ul>
	<div class="">
		<div class="tabs-wrapper">
			<ul id="tabs">
				<li>
					<a href="#" name="tab1">Add Admission Number</a>
				</li>
			</ul>
			<div id="content">
				<div id="tab1">
					<form class="form-horizontal" id="admission_form" method="post" action="<?=BASE_URL?>index.php/admin/addAdmissionNumber" enctype="multipart/form-data">
						<p class="err_msg">
							<?php if($this->session->userdata('message')){ echo $this->session->userdata('message'); $this->session->unset_userdata('message'); } ?>
						</p>
						
						<div class="panel-body">
							<div class="form-group">
								<label class="col-md-3 col-xs-12 control-label">Admission Number 
									<span class="clr-red">*</span>
								</label>
								<div class="col-md-6 col-xs-12">
									<div class="input-group">
										<span class="input-group-addon">
											<span class="fa fa-pencil"></span>
										</span>
										<input type="text" name="admission_number" id="admission_number" value="<?php if(isset($admission_number)){ echo $admission_number[0]['admission_number']; } ?>" class="form-control"/>
											
										</div>
									</div>
								</div>
							</div>
							<div class="text-center">
								<button class="btn btn-primary">Save</button>
							</div>
							<input type="hidden" name="id_admission_no" id="id_admission_no" value="<?php if(isset($admission_number)){ echo encode($admission_number[0]['id_admission_number']); } ?>">								
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>