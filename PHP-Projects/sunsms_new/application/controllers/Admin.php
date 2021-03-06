<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Datatables');
		$this->load->model("mwelcome");
		$this->load->model("mcommonfuncs");

		if($this->session->userdata('user_id') && $this->session->userdata('user_type_id') > 0){}
		else{
			redirect(BASE_URL);
		}
	}

	function index()
	{
		$data['school'] = $this->mwelcome->getSchool(array());
		$data['state'] = $this->mwelcome->getState(array('country_id' => $data['school'][0]['country_id']));
		$data['city'] = $this->mwelcome->getCity(array('state_id' => $data['school'][0]['state_id']));
		$data['county'] = $this->mwelcome->getCountry();

		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/admin_dashboard';
		//$data['middle_content']='admin/school_setup';
		$data['footer']='footer';
		$data['menu'] = 'school-setup';
		$this->load->view('landing',$data);
	}

	function logout()
	{
		$this->session->set_userdata( array(
				'user_id' => '',
				'user_type_id' => '',
				'display_name' => '',
				'username' => '',
				'user_image'=> '',
				'school_id' => '',
				'school_name' => '',
				'school_logo' => '',
				'academic_year' => ''
			)
		);

		$this->session->unset_userdata();
		redirect(BASE_URL.'index.php/welcome/index');
	}

	function updateSchool()
	{
		if(isset($_FILES['school_logo']['name']) && $_FILES['school_logo']['name']!=''){
			$file_type = check_file_type($_FILES['school_logo']['name'],'image');
			if($file_type) {
				$school_image = do_upload($_FILES['school_logo']['name'], $_FILES['school_logo']['tmp_name'], $this->session->userdata('school_id'));
				$_POST['school_logo'] = $school_image;
			}
		}
		else{
			$_POST['school_logo'] = $_POST['prev_school_logo'];
		}
		if(isset($_FILES['fav_icon']['name']) && $_FILES['fav_icon']['name']!=''){
			$file_type = check_file_type($_FILES['fav_icon']['name'],'image');
			if($file_type) {
				$school_image = do_upload($_FILES['fav_icon']['name'], $_FILES['fav_icon']['tmp_name'], $this->session->userdata('school_id'));
				$_POST['fav_icon'] = $school_image;
			}
		}
		else{
			$_POST['fav_icon'] = $_POST['prev_fav_icon'];
		}

		$this->mwelcome->updateSchool(array(
			'id_school' => $this->session->userdata('school_id'),
			'school_name' => $_POST['school_name'],
			'registration_id' => $_POST['registration_id'],
			'founded_on' => date('Y-m-d',strtotime($_POST['founded_on'])),
			'curriculam' => $_POST['curriculam'],
			'school_logo' => $_POST['school_logo'],
			'country_id' => $_POST['country_id'],
			'state_id' => $_POST['state_id'],
			'city_id' => $_POST['city_id'],
			'address' => $_POST['address'],
			'pincode' => $_POST['pincode'],
			'phone' => $_POST['phone'],
			'alternative_phone' => $_POST['alternative_phone'],
			'email' => $_POST['email'],
			'fax' => $_POST['fax'],
			'principle_name' => $_POST['principle_name'],
			'principle_email' => $_POST['principle_email'],
			'principle_phone' => $_POST['principle_phone'],
			'principle_mobile' => $_POST['principle_mobile'],
		));


		redirect(BASE_URL.'index.php/admin/');
	}

	function academicYear()
	{
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/academic_year';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}

	function getAcademicYearDataTable()
	{
		$results = json_decode($this->mwelcome->getAcademicYearDataTable($_POST));

		for($s=0;$s<count($results->data);$s++)
		{
			$results->data[$s][4] = encode($results->data[$s][4]);
		}
		echo json_encode($results);
	}

	function addAcademicYear($academic_year=0)
	{
		if($academic_year===0){}
		else{
			$data['academic_year'] = $this->mwelcome->getAcademicYear(array('id_academic_year' => decode($academic_year)));
		}
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/add_academic_year';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}

	function createAcademicYear()
	{
		if(isset($_POST))
		{
			if(!isset($_POST['status'])){ $status=0; }
			else{ $status = $_POST['status']; }

			if(!$_POST['id_academic_year'])
			{
				$this->mwelcome->addAcademicYear(array(					
					'name' => $_POST['name'],
					'start_date' => date('Y-m-d',strtotime($_POST['start_date'])),
					'end_date' => date('Y-m-d',strtotime($_POST['end_date'])),
					'description' => $_POST['description'],
					'school_id' => $this->session->userdata('school_id'),
					'status' => $status
				));
			}
			else
			{
				$this->mwelcome->updateAcademicYear(array(
					'id_academic_year' => decode($_POST['id_academic_year']),
					'name' => $_POST['name'],
					'start_date' => date('Y-m-d',strtotime($_POST['start_date'])),
					'end_date' => date('Y-m-d',strtotime($_POST['end_date'])),
					'description' => $_POST['description'],
					'status' => $status
				));
			}

			redirect(BASE_URL.'index.php/admin/academicYear');
		}
	}

	function deleteAcademicYear($id)
	{
		$this->mwelcome->deleteAcademicYear(decode($id));
		echo json_encode(array('response' => 1,'data' =>''));
	}

	function Board()
	{
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/board';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}

	function getBoardDataTable()
	{
		$results = json_decode($this->mwelcome->getBoardDataTable($_POST));

		for($s=0;$s<count($results->data);$s++)
		{
			$results->data[$s][2] = encode($results->data[$s][2]);
		}
		echo json_encode($results);
	}

	function addBoard($board_id=0)
	{
		if($board_id===0){}
		else{
			$data['board'] = $this->mwelcome->getBoard(array('id_board' => decode($board_id)));
		}

		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/add_board';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}

	function createBoard()
	{
		//echo "<pre>";print_r($_POST); exit;
		if(isset($_POST))
		{
			if(!isset($_POST['status'])){ $status=0; }
			else{ $status = $_POST['status']; }

			if(!$_POST['id_board'])
			{
				$this->mwelcome->addBoard(array(
					'school_id' => $this->session->userdata('school_id'),
					'board_name' => $_POST['name'],
					'board_description' => $_POST['description'],
					'status' => $status
				));
			}
			else
			{
				$this->mwelcome->updateBoard(array(
					'id_board' => decode($_POST['id_board']),
					'board_name' => $_POST['name'],
					'board_description' => $_POST['description'],
					'status' => $status
				));
			}

			redirect(BASE_URL.'index.php/admin/board');
		}
	}
	
	
	function addAdmissionNumber()
	{	
		if(isset($_POST))
		{	
			if($_POST['id_admission_no'] == NULL)
			{	
				$this->mwelcome->addAdmissionNumber(array(					
					'admission_number' => $_POST['admission_number']					
				));
				$this->session->set_userdata('message','Admission Number Added successfully!');
			}
			else
			{	
				$this->mwelcome->updateAdmissionNumber(array(
					'id_admission_number' => decode($_POST['id_admission_no']),
					'admission_number' => $_POST['admission_number']	
				));
				$this->session->set_userdata('message','Admission Number Updated successfully!');
			}

			redirect(BASE_URL.'index.php/admin/admissionNumber');
		}
	}
	
	
	function admissionNumber()
	{
		$admission_res = $this->mwelcome->getAdmissionNumber();
		if(count($admission_res) > 0) 
			$data['admission_number'] = $admission_res;
		
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/add_admission_number';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}
	
	function teacherNumber()
	{
		$teacher_res = $this->mwelcome->getTeacherNumber();
		if(count($teacher_res) > 0) 
			$data['teacher_number'] = $teacher_res;
		
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/add_teacher_number';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}
	
	function addTeacherNumber()
	{	
		if(isset($_POST))
		{	
			if($_POST['id_teacher_no'] == NULL)
			{	
				$this->mwelcome->addTeacherNumber(array(					
					'teacher_number' => $_POST['teacher_number']					
				));
				$this->session->set_userdata('message','Teacher Number Added successfully!');
			}
			else
			{	
				$this->mwelcome->updateTeacherNumber(array(
					'id_teacher_number' => decode($_POST['id_teacher_no']),
					'teacher_number' => $_POST['teacher_number']	
				));
				$this->session->set_userdata('message','Teacher Number Updated successfully!');
			}
			
			redirect(BASE_URL.'index.php/admin/teacherNumber');
		}
	}
	
	function deleteBoard($id)
	{
		$this->mwelcome->deleteBoard(decode($id));
		echo json_encode(array('response' => 1,'data' =>''));
	}

	function course()
	{
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/class';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}

	function getCourseDataTable()
	{
		$results = json_decode($this->mwelcome->getCourseDataTable($_POST));

		for($s=0;$s<count($results->data);$s++)
		{
			$results->data[$s][3] = encode($results->data[$s][3]);
		}
		echo json_encode($results);
	}

	function addCourse($board_id=0)
	{
		if($board_id===0){}
		else{
			$data['course'] = $this->mwelcome->getCourse(array('id_course' => decode($board_id)));
		}
		$data['board'] = $this->mwelcome->getBoard(array('school_id' => $this->session->userdata('school_id'),'status' => 1));
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/add_class';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}

	function createCourse()
	{
		//echo "<pre>";print_r($_POST); exit;
		if(isset($_POST))
		{
			if(!isset($_POST['status'])){ $status=0; }
			else{ $status = $_POST['status']; }

			if(!$_POST['id_course'])
			{
				for($b=0;$b<count($_POST['board_id']);$b++) {
					for($c=0;$c<count($_POST['class_name']);$c++) {
						$same_records = $this->mwelcome->getCourseDuplicates(array('board_id' => $_POST['board_id'][$b], 'class_name' => $_POST['class_name'][$c]));						
						if(count($same_records) == 0) {
							$this->mwelcome->addCourse(array(					
								'board_id' => $_POST['board_id'][$b],
								'course_name' => ucfirst($_POST['class_name'][$c]),					
								'status' => $status
							));
						}
					}					
				}				
			}
			else
			{
				$same_records = $this->mwelcome->getCourseDuplicates(array('board_id' => $_POST['board_id'][0], 'class_name' => $_POST['class_name'][0]));
				if(count($same_records) == 0) {
					$this->mwelcome->updateCourse(array(
						'id_course' => decode($_POST['id_course']),
						'board_id' => $_POST['board_id'][0],
						'course_name' => $_POST['class_name'][0],					
						'status' => $status
					));
				}				
			}

			redirect(BASE_URL.'index.php/Admin/Course');
		}
	}

	function deleteCourse($id)
	{
		$this->mwelcome->deleteCourse(decode($id));
		echo json_encode(array('response' => 1,'data' =>''));
	}
	
	function section()
	{
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/section';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}
	
	function getSectionDataTable()
	{
		$results = json_decode($this->mwelcome->getSectionDataTable($_POST));

		for($s=0;$s<count($results->data);$s++)
		{
			$results->data[$s][4] = encode($results->data[$s][4]);
		}
		echo json_encode($results);
	}
	
	function addSection($id_section=0)
	{	
		if($id_section===0){}
		else{
			$data['section'] = $this->mwelcome->getSection(array('id_section' => decode($id_section)));
		}
		
		$data['board'] = $this->mwelcome->getBoard(array('status' => 1));
		$data['course'] = $this->mwelcome->getCourse(array('status' => 1));		
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/add_section';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}
	
	function createSection()
	{				
		if(isset($_POST))
		{
			if(isset($_POST['status'])){ $status=$_POST['status']; }
			else{ $status = 1; }

			if(!$_POST['id_section'])
			{
				for($c=0;$c<count($_POST['course_id']);$c++) {
					for($s=0;$s<count($_POST['section_name']);$s++) {
						$same_records = $this->mwelcome->getSectionDuplicates(array('course_id' => $_POST['course_id'][$c], 'section_name' => $_POST['section_name'][$s]));						
						if(count($same_records) == 0 && !empty($_POST['section_name'][$s])) {
							$this->mwelcome->addSection(array(
								'course_id' => $_POST['course_id'][$c],
								'section_name' => ucfirst($_POST['section_name'][$s]),					
								'status' => $status
							));
						}
					}					
				}				
			}
			else
			{
				$this->mwelcome->updateSection(array(
					'id_section' => decode($_POST['id_section']),
					'course_id' => $_POST['course_id'][0],
					'section_name' => ucfirst($_POST['section_name'][0]),					
					'status' => $status
				));
			}

			redirect(BASE_URL.'index.php/Admin/Section');
		}
	}
	
	function manageSection($id_section)
	{	
		$status = $this->mwelcome->getSection(array('id_section' => decode($id_section)));
		if($status[0]['status'] == 1)
			$status = 0;
		else
			$status = 1;
			
		$this->mwelcome->manageSection(array(
			'id_section' => decode($id_section),
			'status' => $status
		));
		redirect(BASE_URL.'index.php/Admin/Section');
	}
	
	function subject()
	{
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/subject';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}

	function getSubjectDataTable()
	{
		$results = json_decode($this->mwelcome->getSubjectDataTable($_POST));

		for($s=0;$s<count($results->data);$s++)
		{
			$results->data[$s][4] = encode($results->data[$s][4]);
		}
		echo json_encode($results);
	}
	
	function getBoardCourses()
	{								
		$courses = $this->mwelcome->getBoardCourses(array(
			'board_id' => $_POST['board_id'],
			'status' => $_POST['status']
		));
		echo json_encode(array('response' => 1, 'data' => $courses)); exit;
	}
	
	function addSubject($subject_id=0)
	{
		if($subject_id===0){}
		else{
			$data['subject'] = $this->mwelcome->getSubject(array('id_subject' => decode($subject_id)));
		}
		//echo "<pre>";print_r($data['subject']); exit;
		$data['board'] = $this->mwelcome->getBoard(array('status' => 1));
		$data['course'] = $this->mwelcome->getCourse(array('status' => 1));		
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/add_subject';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}

	function createSubject()
	{
		//echo '<pre>';print_r($_POST);die;
		if(isset($_POST))
		{
			if(isset($_POST['status'])){ $status=$_POST['status']; }
			else{ $status = 1; }

			if(!$_POST['id_subject'])
			{
				for($c=0;$c<count($_POST['course_id']);$c++) {
					for($s=0;$s<count($_POST['subject_name']);$s++) {
						$same_records = $this->mwelcome->getSubjectDuplicates(array('course_id' => $_POST['course_id'][$c], 'subject_name' => $_POST['subject_name'][$s]));						
						if(count($same_records) == 0 && !empty($_POST['subject_name'][$s])) {
							$this->mwelcome->addSubject(array(
								'course_id' => $_POST['course_id'][$c],
								'subject_name' => ucfirst($_POST['subject_name'][$s]),					
								'status' => $status
							));
						}
					}					
				}				
			}
			else
			{
				$this->mwelcome->updateSubject(array(
					'id_subject' => decode($_POST['id_subject']),
					'course_id' => $_POST['course_id'][0],
					'subject_name' => ucfirst($_POST['subject_name'][0]),					
					'status' => $status
				));
			}

			redirect(BASE_URL.'index.php/Admin/Subject');
		}
	}

	function deleteSubject($id)
	{
		$this->mwelcome->deleteSubject(decode($id));
		echo json_encode(array('response' => 1,'data' =>''));
	}

	function weekDays()
	{		
		$data['week_day'] = $this->mwelcome->getWeekDay();
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/weekdays';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}

	function updateWeekDay()
	{	
		if(isset($_POST))
		{		
			for($d=1;$d<=count($_POST);$d++) {
				
				if($_POST["day".$d]!='') {
					if($_POST['day'.$d] > 0)
						$status=1;
					else
						$status=0;
					$day = $this->mwelcome->getWeekDay(array('day' => $d));
					
					if(empty($day)) { 
						$this->mwelcome->addWeekDay(array(
							'day' => $d,												
							'status' => $status
						));
					}
					else
					{
						$_POST['id_week_day'] = $day[0]['id_week_day'];
						$this->mwelcome->updateWeekDay(array(
							'id_week_day' => $day[0]['id_week_day'],
							'day' => $d,								
							'status' => $status
						));
					}
				}			
			}
			redirect(BASE_URL.'index.php/Admin/weekDays');
		}
	}

	function classTiming()
	{
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/class_timing';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}

	function getClassTimingDataTable()
	{
		$results = json_decode($this->mwelcome->getClassTimingDataTable($_POST));

		for($s=0;$s<count($results->data);$s++)
		{
			$results->data[$s][1] = strtoupper(date('g:i a', strtotime($results->data[$s][1])));
			$results->data[$s][2] = strtoupper(date('g:i a', strtotime($results->data[$s][2])));
			$results->data[$s][5] = encode($results->data[$s][5]);
		}
		echo json_encode($results);
	}

	function addClassTiming($class_timing=0)
	{
		if($class_timing===0){}
		else{
			$data['class_timing'] = $this->mwelcome->getClassTiming(array('id_class_timing' => decode($class_timing)));
		}
		
		//$data['board'] = $this->mwelcome->getBoard(array('status' => 1));
		//$data['course'] = $this->mwelcome->getCourse(array('status' => 1));
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='admin/add_class_timing';
		$data['footer']='footer';
		$data['menu'] = 'settings';
		$this->load->view('landing',$data);
	}

	function createClassTiming()
	{
		//echo '<pre>';print_r($_POST); die;
		if(isset($_POST))
		{
			if(isset($_POST['status'])){ $status=$_POST['status']; }
			else{ $status = 1; }

			if(!$_POST['id_class_timing'])
			{
				for($n=0;$n<count($_POST['name']);$n++) {
					if(!empty($_POST['name'][$n])) {
						$this->mwelcome->addClassTiming(array(					
							'name' => ucfirst($_POST['name'][$n]),
							'start_time' => $_POST['start_time'][$n],
							'end_time' => $_POST['end_time'][$n],
							'is_break' => $_POST['is_break_val'.$n],
							'status' => $status
						));
					}
				}				
			}
			else
			{
				if(isset($_POST['is_break0'])){ $is_break=1; }
				else{ $is_break=0; }
				$this->mwelcome->updateClassTiming(array(
					'id_class_timing' => decode($_POST['id_class_timing']),					
					'name' => $_POST['name'][0],
					'start_time' => $_POST['start_time'][0],
					'end_time' => $_POST['end_time'][0],
					'is_break' => $is_break,
					'status' => $_POST['status']
				));
			}

			redirect(BASE_URL.'index.php/Admin/classTiming');
		}
	}

	function deleteClassTiming($id)
	{
		$this->mwelcome->deleteClassTiming(decode($id));
		echo json_encode(array('response' => 1,'data' =>''));
	}
	
	function Department()
    {
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='admin/department';
        $data['footer']='footer';
        $data['menu'] = 'settings';
        $this->load->view('landing',$data);
    }

    function getDepartmentDataTable(){
        $results = json_decode($this->mwelcome->getDepartmentDataTable($_POST));

        for($s=0;$s<count($results->data);$s++)
        {
            $results->data[$s][1] = encode($results->data[$s][1]);
        }
        echo json_encode($results);
    }


    function addDepartment($category_id=0)
    {
        if($category_id===0){}
        else{
            $data['department_details'] = $this->mwelcome->getDepartment(array('department_id' => decode($category_id)));
        }
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='admin/add_department';
        $data['footer']='footer';
        $data['menu'] = 'settings';
        $this->load->view('landing',$data);
    }

    function createDepartment()
    {
        if(isset($_POST))
        {
            if(!$_POST['id_department'])
            {
                $this->mwelcome->insertDepartment(array(
                    'department_name' => ucfirst($_POST['department_name'])
                ));
            }
            else
            {
                $this->mwelcome->updateDepartment(array(
                    'id_department' => decode($_POST['id_department']),
                    'department_name' => ucfirst($_POST['department_name'])
                ));
            }

            redirect(BASE_URL.'index.php/Admin/Department');
        }
    }

    function deleteDepartment($id)
    {
        $this->mwelcome->deleteDepartment(decode($id));
        echo json_encode(array('response' => 1,'data' =>''));
    }
	
	function getCourseSubjects()
	{
		$html = '';
		$course_subjects = $this->mcommonfuncs->getCourseSubjects(array(
			'course_id' => $_POST['course_id'],
			'status' => $_POST['status']
		));
		$html.= "<option value='0'>Select Subject</option>";
		for($i=0; $i<count($course_subjects);$i++) {
			$html.= "<option value='".$course_subjects[$i]['id_subject']."'>".$course_subjects[$i]['subject_name']."</option>";
		}

		echo json_encode(array('response' => 1, 'data' => $html)); exit;
	}
}
