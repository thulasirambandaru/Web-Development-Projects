<div class="body-nav body-nav-horizontal">
    <button class="nav-toggle">
        <b class="mobile-menu-txt">Menu</b>
        <div class="icon-menu">
            <span class="line line-1"></span>
            <span class="line line-2"></span>
            <span class="line line-3"></span>
        </div>
    </button>
    <div class="main-top-nav">
        <ul  class="nav-menu menu">
            <!-- Superadmin Stuff --->			<?php //if($this->session->userdata('user_type_id')==1){ ?>
            <!--<li class="menu-item <?php //if(isset($menu) && $menu=='school'){ echo 'active'; } ?>">
            <a href="<?=BASE_URL?>" class="menu-link">
            <i class="icon-dashboard icon-large"></i> Dashboard                </a>            </li> -->			<?php //} ?>
            <!-- Superadmin Stuff End --->
            <!-- Menu Items are displayed based on the user type id ex: if($this->session->userdata('user_type_id')==1) -->
			
			<?php
				$user_type_id = $this->session->userdata('user_type_id');
			?>
			
            <li class="menu-item <?php if(isset($menu) && $menu=='school-setup'){ echo 'active'; } ?>">
                <a href="<?=BASE_URL?>index.php/admin/" class="menu-link">
                    <i class="icon-dashboard icon-large"></i> Dashboard
                </a>
            </li>
			<?php	// Admission Module....
				//if(($user_type_id == ADMIN) || ($user_type_id == TEACHER)) 
				//{
			?>
            <!--<li  class="menu-item <?php if(isset($menu) && $menu=='admission'){ echo 'active'; } ?>">
                <a href="<?=BASE_URL?>index.php/student/addStudent" class="menu-link">
                    <i class="fa fa-user icon-large"></i> Admission
                </a>-->
            </li>
			<?php //} ?>
			
            <?php	// Student Module....
				if($user_type_id > 0) 
				{
			?>
				<li  class="menu-item has-dropdown <?php if(isset($menu) && $menu=='student'){ echo 'active'; } ?>">
					<a class="menu-link" href="<?=BASE_URL?>index.php/student">
						<i class="fa fa-user icon-large"></i> Student
					</a>
					<ul class="nav-dropdown menu">
						<li class="menu-item"> <a href="#!" class="menu-link">Admission</a> </li>
						<li class="menu-item"> <a href="#!" class="menu-link">Attendance</a></li>
						<li class="menu-item"> <a href="#!" class="menu-link">Reports</a> </li>
					</ul>
				</li>
			<?php } ?>
			
			<?php	// Staff Module....
				if(($user_type_id == ADMIN) || ($user_type_id == TEACHER)) 
				{
			?>
            <li class="menu-item <?php if(isset($menu) && $menu=='staff'){ echo 'active'; } ?>">
                <a class="menu-link" href="<?=BASE_URL?>index.php/staff">
                    <i class="fa fa-group icon-large"></i> Staff
                </a>
            </li>
			<?php } ?>
			
			<?php	// Fee Module....
				if($user_type_id > 0) 
				{
			?>
            <li  class="menu-item <?php if(isset($menu) && $menu=='fee'){ echo 'active'; } ?>">
                <a href="<?=BASE_URL?>index.php/Fee" class="menu-link">
                    <i class="fa fa-file-text-o icon-large"></i> Fees
                </a>
            </li>
			<?php } ?>
			
			<?php	// Attendance Module....
				if($user_type_id > 0) 
				{
			?>
            <li  class="menu-item <?php if(isset($menu) && $menu=='attendance'){ echo 'active'; } ?>">
                <a href="<?=BASE_URL?>index.php/Attendance" class="menu-link">
                    <i class="icon-list-alt icon-large"></i> Attendance
                </a>
            </li>
			<?php } ?>
			<?php if($this->session->userdata('user_id') && $this->session->userdata('user_type_id')!=TEACHER){ ?>
			<li  class="menu-item <?php if(isset($menu) && $menu=='hostel'){ echo 'active'; } ?>">
				<a href="<?=BASE_URL?>index.php/Hostel/" class="menu-link">
					<i class="icon-list-alt icon-large"></i> Hostel
				</a>
			</li>
			<?php } ?>
			<?php	// Examination Module....
				if($user_type_id > 0) 
				{
			?>			
			<li class="menu-item <?php if(isset($menu) && $menu=='examination'){ echo 'active'; } ?>">
				<a href="<?=BASE_URL?>index.php/examination" class="menu-link">
					<i class="fa fa-pencil-square-o icon-large"></i> Examination
				</a>
			</li>
			<?php } ?>
			
			<?php	// Timetable Module....
				if($user_type_id > 0) 
				{
			?>
			<li class="menu-item <?php if(isset($menu) && $menu=='timetable'){ echo 'active'; } ?>">
				<a href="<?=BASE_URL?>index.php/timetable" class="menu-link">
					<i class="fa fa-calendar icon-large"></i> Timetable
				</a>
			</li>
			<?php } ?>
			
			<?php	// Transport Module....
				if($user_type_id > 0) 
				{
			?>
			<li class="menu-item <?php if(isset($menu) && $menu=='transport'){ echo 'active'; } ?>">
                <a href="<?=BASE_URL?>index.php/vehicle" class="menu-link">
                    <i class="fa fa-bus icon-large"></i> Transport
                </a>
            </li>
			<?php } ?>
			<!--<li class="menu-item">
				<a href="#" class="menu-link">
					<i class="fa fa-calculator icon-large"></i> Accounting
				</a>
			</li>-->
			<!--<li class="menu-item">
				<a href="#" class="menu-link">
					<i class="fa fa-clipboard icon-large"></i> Inventory
				</a>
			</li>-->
			<!--<li  class="menu-item">
				<a href="#" class="menu-link">
					<i class="fa fa-inr icon-large"></i> Payroll
				</a>
			</li>-->
			<!--<li  class="menu-item">
				<a href="#" class="menu-link">
					<i class="fa fa-book icon-large"></i> Library
				</a>
			</li>-->
			<li class="menu-item <?php if(isset($menu) && $menu=='settings'){ echo 'active'; } ?>">
				<a class="menu-link" href="<?=BASE_URL?>index.php/admin/academicYear">
					<i class="icon-cogs icon-large"></i> Settings
				</a>
            </li>	   
		</ul>
		
	</div>		
</div>