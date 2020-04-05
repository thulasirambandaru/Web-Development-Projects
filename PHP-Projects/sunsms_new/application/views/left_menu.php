<div id="left" class="mySidenav"> 
    <!-- #Build Left Menu -->
	<?php $user_type_id = $this->session->userdata('user_type_id'); ?>
    <ul id="menu" class="bg-blue dker">
        <li class="nav-header">Quick Shortcuts</li>		
        <li class="nav-divider"></li>		<!-- Dashboard Module Left Menu's -->
        <?php if(isset($menu) && $menu=='school')
        { ?>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/welcome/addSchool">
                    <i class="fa fa-user"></i><span class="link-title"> Add School</span>
                </a>
            </li>
        <?php
        }
		//// Student Module Left Menu's ////
		else if(isset($menu) && $menu=='student') 
		{ 
			if($user_type_id == ADMIN || $user_type_id == TEACHER) { ?>
			<li class="active">
				<a href="<?=BASE_URL?>index.php/student/">
					<i class="fa fa-user"></i><span class="link-title"> Student Dashboard</span>
				</a>
			</li>
			<?php } ?>
			
			<li class="active">
				<a href="<?=BASE_URL?>index.php/student/studentList">
					<i class="fa fa-user"></i><span class="link-title"> Student List</span>
				</a>
			</li>
			
			<li class="active">
				<a href="<?=BASE_URL?>index.php/student/addStudent">
					<i class="fa fa-user"></i><span class="link-title"> Add Student</span>
				</a>
			</li>
		<?php } 				//// Setting Module Left Menu's  ////
        else if(isset($menu) && $menu=='settings')
        { ?>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/admin/admissionNumber">
                    <i class="fa fa-user"></i><span class="link-title"> Set Admission Number</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/admin/teacherNumber">
                    <i class="fa fa-user"></i><span class="link-title"> Set Teacher Number</span>
                </a>
            </li>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/admin/academicYear">
                    <i class="fa fa-user"></i><span class="link-title"> Academic year</span>
                </a>
            </li>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/admin/board">
                    <i class="fa fa-user"></i><span class="link-title"> Board</span>
                </a>
            </li>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/admin/course">
                    <i class="fa fa-user"></i><span class="link-title"> Class</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/admin/section">
                    <i class="fa fa-user"></i><span class="link-title"> Section</span>
                </a>
            </li>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/admin/subject">
                    <i class="fa fa-user"></i><span class="link-title"> Subject</span>
                </a>
            </li>
            <!--<li class="active">
                <a href="<?=BASE_URL?>index.php/category">
                    <i class="fa fa-user"></i><span class="link-title"> Category</span>
                </a>
            </li>-->
            <li class="active">
                <a href="<?=BASE_URL?>index.php/Admin/Department">
                    <i class="fa fa-user"></i><span class="link-title"> Department</span>
                </a>
            </li>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/Admin/weekDays">
                    <i class="fa fa-user"></i><span class="link-title"> Week days</span>
                </a>
            </li>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/admin/classTiming">
                    <i class="fa fa-plus"></i><span class="link-title"> Class Timings</span>
                </a>
            </li>
            <!--<li class="active">
                <a href="<?=BASE_URL?>index.php/admin/timeTable">
                    <i class="fa fa-user"></i><span class="link-title"> Time Table</span>
                </a>
            </li>-->
        <?php }		//// Staff Module Left Menu's ////
        else if(isset($menu) && $menu=='staff')
        { ?>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/staff">
                    <i class="fa fa-user"></i><span class="link-title"> Staff List</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/staff/createStaffView">
                    <i class="fa fa-user"></i><span class="link-title"> Add Staff</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/staff/staffType">
                    <i class="fa fa-user"></i><span class="link-title"> Staff Type</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/staff/classTeacher">
                    <i class="fa fa-user"></i><span class="link-title"> Class Teacher Allocation</span>
                </a>
            </li>
        <?php }
		//// Timetable Module Left Menu ////
		else if(isset($menu) && $menu=='timetable')
        { ?>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/timetable">
                    <i class="glyphicon glyphicon-list"></i><span class="link-title"> Timetable List</span>
                </a>
            </li>
			
			<?php if($user_type_id == ADMIN) { ?>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/Timetable/addTimeTable">
                    <i class="glyphicon glyphicon-plus"></i><span class="link-title"> Add Timetable</span>
                </a>
            </li>
			<?php } ?>
			
        <?php }
		//// Examination Module Left Menu ////
		else if(isset($menu) && $menu=='examination')
        { ?>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/examination">
                    <i class="glyphicon glyphicon-list"></i><span class="link-title"> Examination List</span>
                </a>
            </li>
			
			<?php //if($user_type_id == ADMIN) { ?>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/Examination/addExam">
                    <i class="glyphicon glyphicon-plus"></i><span class="link-title"> Add Exam</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/Examination/examScheduleList">
                    <i class="glyphicon glyphicon-list"></i><span class="link-title"> Exam Schedule List</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/Examination/addExamSchedule">
                    <i class="glyphicon glyphicon-plus"></i><span class="link-title"> Add Exam Schedule</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/Examination/examMarksList">
                    <i class="glyphicon glyphicon-list"></i><span class="link-title"> Exam Marks List</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/Examination/addExamMarks">
                    <i class="glyphicon glyphicon-plus"></i><span class="link-title"> Add Exam Marks</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/Examination/addReportCards">
                    <i class="glyphicon glyphicon-plus"></i><span class="link-title"> Generate Reports</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/Examination/examGradesList">
                    <i class="glyphicon glyphicon-list"></i><span class="link-title"> Exam Grades List</span>
                </a>
            </li>
			<li class="active">
                <a href="<?=BASE_URL?>index.php/Examination/addExamGrades">
                    <i class="glyphicon glyphicon-plus"></i><span class="link-title"> Add Exam Grades</span>
                </a>
            </li>
			<?php //} ?>
			
        <?php }
        //// Transport Module Left Menu's ////
        else if(isset($menu) && $menu=='transport')
        { ?>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/vehicle">
                    <i class="fa fa-user"></i><span class="link-title"> Vehicle</span>
                </a>
            </li>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/driver">
                    <i class="fa fa-user"></i><span class="link-title"> Driver</span>
                </a>
            </li>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/driver/drivervehicle">
                    <i class="fa fa-user"></i><span class="link-title"> Driver Vehicle</span>
                </a>
            </li>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/route">
                    <i class="fa fa-user"></i><span class="link-title"> Route</span>
                </a>
            </li>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/route/studentroute">
                    <i class="fa fa-user"></i><span class="link-title"> Student Route</span>
                </a>
            </li>
	<?php }	else if(isset($menu) && ($menu=='attendance' || $menu=='student_attendance'))
        {  if($this->session->userdata('user_type_id')==TEACHER || $this->session->userdata('user_type_id')==ADMIN){ ?>
            <li class="active">
                <a href="<?=BASE_URL?>index.php/attendance/studentAttendance">
                    <i class="fa fa-user"></i><span class="link-title"> Student Attendance</span>
                </a>
            </li>
            <?php if($this->session->userdata('user_type_id')==ADMIN){ ?>
                <li class="active">
                    <a href="<?=BASE_URL?>index.php/attendance">
                        <i class="fa fa-user"></i><span class="link-title"> Staff Attendance</span>
                    </a>
                </li>
            <?php } else { ?>
                <li class="active">
                    <a href="<?=BASE_URL?>index.php/attendance">
                        <i class="fa fa-user"></i><span class="link-title"> My Attendance</span>
                    </a>
                </li>
            <?php } ?>
        <?php } }
        else if(isset($menu) && $menu=='fee' && $this->session->userdata('user_type_id')==ADMIN) { ?>
        <li class="active">
            <a href="<?=BASE_URL?>index.php/fee/feeType">
                <i class="fa fa-user"></i><span class="link-title"> Fee Type</span>
            </a>
        </li>
        <li class="active">
            <a href="<?=BASE_URL?>index.php/fee/">
                <i class="fa fa-user"></i><span class="link-title"> Fee Structure</span>
            </a>
        </li>
        <li class="active">
            <a href="<?=BASE_URL?>index.php/fee/studentFee">
                <i class="fa fa-user"></i><span class="link-title"> Fee</span>
            </a>
        </li>
        <?php } else if(isset($menu) && $menu=='fee' && $this->session->userdata('user_type_id')==TEACHER) { ?>
        <li class="active">
            <a href="<?=BASE_URL?>index.php/fee/studentFee">
                <i class="fa fa-user"></i><span class="link-title"> Fee</span>
            </a>
        </li>

        <?php } ?>

        <?php if(isset($menu) && $menu=='hostel' && $this->session->userdata('user_type_id')==ADMIN) { ?>
        <li class="active">
            <a href="<?=BASE_URL?>index.php/Hostel/hostelType">
                <i class="fa fa-user"></i><span class="link-title"> Hostel Type</span>
            </a>
        </li>
        <li class="active">
            <a href="<?=BASE_URL?>index.php/Hostel/">
                <i class="fa fa-user"></i><span class="link-title"> Hostel</span>
            </a>
        </li>
        <li class="active">
            <a href="<?=BASE_URL?>index.php/Hostel/floor">
                <i class="fa fa-user"></i><span class="link-title"> Floor</span>
            </a>
        </li>
        <li class="active">
            <a href="<?=BASE_URL?>index.php/Hostel/roomSearch">
                <i class="fa fa-user"></i><span class="link-title"> Room Search</span>
            </a>
        </li>
        <li class="active">
            <a href="<?=BASE_URL?>index.php/Hostel/allotStudent">
                <i class="fa fa-user"></i><span class="link-title"> Allot Student</span>
            </a>
        </li>
        <li class="active">
            <a href="<?=BASE_URL?>index.php/Hostel/studentSearch">
                <i class="fa fa-user"></i><span class="link-title"> Student Details</span>
            </a>
        </li>
        <?php //} else if(isset($menu) && $menu=='fee' && $this->session->userdata('user_type_id')==PARENT) { ?>
        <li class="active">
            <a href="<?=BASE_URL?>index.php/Hostel/studentBed">
                <i class="fa fa-user"></i><span class="link-title"> Student Bed</span>
            </a>
        </li>
        <?php } ?>

    </ul><!-- /#menu ends here -->
</div>