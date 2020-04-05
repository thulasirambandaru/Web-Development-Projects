<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends CI_Controller {

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
		$this->load->model("mstudent");
		$this->load->model("mwelcome");
		if($this->session->userdata('user_id') && $this->session->userdata('user_type_id') > 0){}
		else{
			redirect(BASE_URL);
		}
	}

	function index()
	{
		if($this->session->userdata('user_id'))
		{			
			$user_type_id = $this->session->userdata('user_type_id');
			if($user_type_id == STUDENT || $user_type_id == PARENT_ID)
				redirect(BASE_URL.'index.php/student/studentList');
			else
				redirect(BASE_URL.'index.php/student/studentDashboard');							
		}
		else
		{
			$data['header']="header";
			$data['left_menu']="";
			$data['middle_content']='login';
			$data['footer']='footer';
			$this->load->view('landing',$data);
		}
	}

	function getStudentDataTable()
	{
		$results = json_decode($this->mstudent->getStudentDataTable($_POST, $this->session->userdata('user_type_id'), $this->session->userdata('user_id')));

		for($s=0;$s<count($results->data);$s++) {
			$results->data[$s][0] = "<a href='".BASE_URL."index.php/student/addStudent/".encode($results->data[$s][6])."/p'>".$results->data[$s][0]."</a>";						
			$results->data[$s][6] = encode($results->data[$s][6]);
		}
		echo json_encode($results);
	}
	
	function getNewAdmissionsDataTable()
	{
		$academic_year = $this->mwelcome->getAcademicYear();
		$results = json_decode($this->mstudent->getNewAdmissionsDataTable($_POST, $academic_year));

		for($s=0;$s<count($results->data);$s++) {
			$results->data[$s][0] = "<a href='".BASE_URL."index.php/student/addStudent/".encode($results->data[$s][6])."/p'>".$results->data[$s][0]."</a>";						
			$results->data[$s][6] = encode($results->data[$s][6]);
		}
		echo json_encode($results);
	}
	
	function getExistParentInfo()
	{
		$html = '';
		$parent = $this->mstudent->getExistParentInfo(array(
			'parent_first_name' => $_POST['parent_name'],
			'parent_middle_name' => $_POST['parent_name'],
			'parent_last_name' => $_POST['parent_name']
		));
		
		echo json_encode(array('response' => 1, 'data' => $parent)); exit;
	}
	
	function studentList()
	{
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='student/student';
		$data['footer']='footer';
		$data['menu'] = 'student';
		$this->load->view('landing',$data);		
	}
	
	function studentDashboard()
	{
		$total_students = $this->mstudent->getTotalStudents();
		$academic_year = $this->mwelcome->getAcademicYear();
		$new_admissions = $this->mstudent->getNewAdmissions($academic_year);
		$total_employees = $this->mstudent->getTotalEmployees();			
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='student/student_dashboard';
		$data['footer']='footer';
		$data['menu'] = 'student';
		$data['total_students'] = $total_students;
		$data['new_admissions'] = $new_admissions;
		$data['total_employees'] = $total_employees;
		$this->load->view('landing',$data);
	}
	
	function addStudent($student_id=0, $active_tab=0)
	{
		$studentData=array();
		$parentsData=array();
		$studentPrevInfoData=array();
		$studentDocs=array();
		if($student_id===0){
			
		}
		else{
			$studentData = $this->mstudent->getStudent(array('id_student' => decode($student_id)));
			$data['student']=$studentData;
			

			//Fetch students parent details
			$parent = $this->mstudent->getParent(array('id_student' => decode($student_id)));
			if(count($parent) > 0)
			{
				$data['parent'] = $parent;
				$parentsData=$parent;
			}

			//Fetch students previous institute details
			$student_prev_info = $this->mstudent->getStudentPrevoiusInfo(array('id_student' => decode($student_id)));
			if(count($student_prev_info) > 0)
			{
				$data['student_prev_info'] = $student_prev_info;
				$studentPrevInfoData=$student_prev_info;
			}

			// Fetch students documents
			$student_docs = $this->mstudent->getStudentDocuments(array('id_student' => decode($student_id)));
			if(count($student_docs) > 0)
			{
				$data['student_docs'] = $student_docs;
				$studentDocs = $student_docs;
			}

			if(empty($data['student'])){ unset($data['student']); }
			else{
				//$data['state'] = $this->mwelcome->getState(array('country_id' => $data['student'][0]['country_id']));
				//$data['city'] = $this->mwelcome->getCity(array('state_id' => $data['student'][0]['state_id']));
				//$data['city'] = $this->mwelcome->getCountry(array('id_country' => $data['student'][0]['id_country']));
			}
		}
		
		$data['StudentDynamicFields']=$this->getDynamicFields(array('module_id'=>7,'tab_id'=>10,'sub_tab_id'=>18),$studentData);
		$data['StudentPersonalDynamicFields']=$this->getDynamicFields(array('module_id'=>7,'tab_id'=>10,'sub_tab_id'=>19),$studentData);
		$data['StudentContactDynamicFields']=$this->getDynamicFields(array('module_id'=>7,'tab_id'=>10,'sub_tab_id'=>20),$studentData);
		
		$data['SParentsPersonalDynamicFields']=$this->getDynamicFields(array('module_id'=>7,'tab_id'=>11,'sub_tab_id'=>22),$parentsData);
		$data['SParentsContactDynamicFields']=$this->getDynamicFields(array('module_id'=>7,'tab_id'=>11,'sub_tab_id'=>23),$parentsData);
		
		$data['SPreviousInfoDynamicFields']=$this->getDynamicFields(array('module_id'=>7,'tab_id'=>12,'sub_tab_id'=>24),$studentPrevInfoData);
		
		$data['studentDocumentsDynamicFields']=$this->getDynamicFields(array('module_id'=>7,'tab_id'=>13,'sub_tab_id'=>25),$studentDocs);

		$result = $this->mwelcome->getMaxAdmissionNumber();		
		$data['admission_number'] = '';		
		//print count($result[0]['admission_number']);die;
		if(count($result[0]['admission_number']) == 0) {
			$result = $this->mwelcome->getSchool();
			if(isset($result[0]['admission_number']))
				$data['admission_number'] = $result[0]['admission_number'];
		}
		else {
			$data['admission_number'] = ($result[0]['admission_number'])+1;
		}		
		
		if($active_tab === 0)
			$data['active_tab']=encode($active_tab);
		else
			$data['active_tab']=$active_tab;
		
		$data['board'] = $this->mwelcome->getBoard();
		$data['course'] = $this->mwelcome->getCourse();
		$data['section'] = $this->mwelcome->getSection();
		$data['county'] = $this->mwelcome->getCountry();		
		$data['header']="header";
		$data['left_menu']="left_menu";
		$data['middle_content']='student/add_student';
		$data['footer']='footer';
		$data['menu'] = 'student';
		$this->load->view('landing',$data);
	}

	function getCourseByBoard()
	{
		$html = '';
		$courses = $this->mstudent->getCourseByBoard(array(
			'board_id' => $_POST['board_id'],
			'status' => $_POST['status']
		));
		$html.= "<option value='0'>Select Class</option>";
		for($i=0; $i<count($courses);$i++) {
			$html.= "<option value='".$courses[$i]['id_course']."'>".$courses[$i]['course_name']."</option>";
		}

		echo json_encode(array('response' => 1, 'data' => $html)); exit;
	}

	function getSectionByCourse()
	{
		$html = '';
		$sections = $this->mstudent->getSectionByCourse(array(
			'course_id' => $_POST['course_id'],
			'status' => $_POST['status']
		));
		
		for($i=0; $i<count($sections);$i++) {
			if($i==0)
				$html.= "<option value='0'>Select Section</option>";
			
			$html.= "<option value='".$sections[$i]['id_section']."'>".$sections[$i]['section_name']."</option>";
		}

		echo json_encode(array('response' => 1, 'data' => $html)); exit;
	}
	
	function createStudent()
	{
		if($this->session->userdata('user_id'))
		{			
			if(isset($_FILES['profile_photo']['name']) && $_FILES['profile_photo']['name']!='') {
				$file_type = check_file_type(strtolower($_FILES['profile_photo']['name']),'image');	
				$ext = pathinfo($_FILES['profile_photo']['name'], PATHINFO_EXTENSION);
				if($file_type) 
				{
					$upload_path = STUDENT_PICTURES.$_POST['admission_no']."/";
					if(!is_dir($upload_path)) 
						mkdir($upload_path, 0777, TRUE);
					
					$config['upload_path'] = $upload_path;
					$config['allowed_types']    = 'gif|jpg|png|jpeg';
					$file_name = $_POST['admission_no'].'_'.$this->session->userdata('academic_year').'.'.$ext;	
					
					$config['file_name'] = $file_name;
					
					if(file_exists($upload_path.$file_name))
						unlink($upload_path.$file_name);
						
					$this->load->library('upload', $config);
					$this->upload->initialize($config);										
					$this->upload->do_upload('profile_photo');
										
					$_POST['profile_photo'] = $file_name;
				}
			}
			else{
				$_POST['profile_photo'] = '';
			}
			
			if(!$_POST['id_student'])
			{
				//$password = generate_password(6);
				$user_arr = array(
					'user_type_id' => STUDENT,
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'username' => $_POST['admission_no'],
					'password' => md5(date('dmY',strtotime($_POST['dob']))),
					'phone_number' => $_POST['phone_number'],
					'user_status' => 1
				);
				$user_input_arr = array_map('ucfirst', $user_arr);
				$user_id = $this->mwelcome->addUser($user_input_arr);
				
				$post_arr = array(
					'admission_number' => $_POST['admission_no'],
					'admission_date' => date('Y-m-d',strtotime($_POST['admission_date'])),
					'board_id' => $_POST['board_id'],
					'course_id' => $_POST['student_course_id'],
					'section_id' => $_POST['course_section_id'],
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'middle_name' => $_POST['middle_name'],
					'gender' => $_POST['gender_id'],
					'dob' => date('Y-m-d',strtotime($_POST['dob'])),
					'blood_group' => $_POST['blood_group'],
					'birth_place' => $_POST['birthplace'],
					'nationality' => $_POST['nationality'],
					'religion' => $_POST['religion'],
					'address_line_1' => $_POST['address_line_1'],
					'address_line_2' => $_POST['address_line_2'],
					'student_city' => $_POST['student_city'],
					'student_state' => $_POST['student_state'],
					'fk_country_id' => $_POST['country_id'],
					'pincode' => $_POST['pin_code'],
					'phone_number' => $_POST['phone_number'],
					'alternate_phone_number' => $_POST['alternate_phone'],
					'email' => $_POST['email'],
					'photo' => $_POST['profile_photo'],
					'fk_id_user' => $user_id,
					'fk_id_academic_year' => $this->session->userdata('academic_year')
				);
				
				$dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>7,'tab_id'=>10));
				
				if(count($dynamicFields)>0)
				{
					foreach ($dynamicFields as $dvalus)
					{
						if(isset($_POST[$dvalus['field_name']]) && $_POST[$dvalus['field_name']]!=NULL)
						{
							if($dvalus['field_type_id']==6)
								$post_arr[$dvalus['field_name']]=date('Y-m-d',strtotime($_POST[$dvalus['field_name']]));
							else
								$post_arr[$dvalus['field_name']]=$_POST[$dvalus['field_name']];
						}
					}
				}
				
				$student_arr = array_map('ucfirst', $post_arr);
				$student_arr['email'] = strtolower($_POST['email']);				
				$student_id = $this->mstudent->addStudent($student_arr);
			}
			else
			{				
				/*if($_POST['profile_photo']=='')
					$_POST['profile_photo'] = $_POST['prev_profile_photo'];
				else {
					if(isset($_POST['prev_profile_photo']))
						unlink("uploads/".$_POST['prev_profile_photo']);
				}*/
				
				$user_arr = array(
					'id_user' => decode($_POST['id_user']),
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'phone_number' => $_POST['phone_number']
				);
				
				$user_input_arr = array_map('ucfirst', $user_arr);
				$user_id = $this->mwelcome->updateUser($user_input_arr);
				
				$student_id = decode($_POST['id_student']);
				$post_arr = array(
					'id_student' => $student_id,
					'admission_number' => $_POST['admission_no'],
					'admission_date' => date('Y-m-d',strtotime($_POST['admission_date'])),
					'board_id' => $_POST['board_id'],
					'course_id' => $_POST['student_course_id'],
					'section_id' => $_POST['course_section_id'],
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'middle_name' => $_POST['middle_name'],
					'gender' => $_POST['gender_id'],
					'dob' => date('Y-m-d',strtotime($_POST['dob'])),
					'blood_group' => $_POST['blood_group'],
					'birth_place' => $_POST['birthplace'],
					'nationality' => $_POST['nationality'],
					'religion' => $_POST['religion'],
					'address_line_1' => $_POST['address_line_1'],
					'address_line_2' => $_POST['address_line_2'],
					'student_city' => $_POST['student_city'],
					'student_state' => $_POST['student_state'],
					'fk_country_id' => $_POST['country_id'],
					'pincode' => $_POST['pin_code'],
					'phone_number' => $_POST['phone_number'],
					'alternate_phone_number' => $_POST['alternate_phone'],
					'email' => $_POST['email'],
					'photo' => $_POST['profile_photo']
				);
				
				$dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>7,'tab_id'=>10));
				
				if(count($dynamicFields)>0)
				{
					foreach ($dynamicFields as $dvalus)
					{
						if(isset($_POST[$dvalus['field_name']]) && $_POST[$dvalus['field_name']]!=NULL)
						{
							if($dvalus['field_type_id']==6)
								$post_arr[$dvalus['field_name']]=date('Y-m-d',strtotime($_POST[$dvalus['field_name']]));
							else
								$post_arr[$dvalus['field_name']]=$_POST[$dvalus['field_name']];
						}
					}
				}
								
				$student_arr = array_map('ucfirst', $post_arr);
				$student_arr['email'] = strtolower($_POST['email']);	
				$this->mstudent->updateStudent($student_arr);
			}

			redirect(BASE_URL.'index.php/student/addStudent/'.encode($student_id).'/'.encode(0));
		}
		else
		{
			redirect(BASE_URL);
		}
	}

	function createParent()
	{
		if($this->session->userdata('user_id'))
		{
			// If Parent is New...
			if(!$_POST['exist_parent_id']) {
				if(!$_POST['id_parent'])
				{
					//$password = generate_password(6);					
					$user_arr = array(
					'user_type_id' => PARENT_ID,
					'first_name' => $_POST['parent_first_name'],
					'last_name' => $_POST['parent_last_name'],
					'username' => $_POST['admission_no']."_p",
					'password' => md5($_POST['admission_no']),
					'phone_number' => $_POST['phone_number'],
					'user_status' => 1
					);
					
					$user_input_arr = array_map('ucfirst', $user_arr);
					$user_id = $this->mwelcome->addUser($user_input_arr);
					
					if(empty($_POST['parent_dob']))
						$parent_dob = null;
					else
						$parent_dob = date('Y-m-d',strtotime($_POST['parent_dob']));
						
					$post_arr = array(
						//'fk_id_user' => $user_id,
						//'student_id' => decode($_POST['id_student']),
						'parent_first_name' => $_POST['parent_first_name'],
						'parent_last_name' => $_POST['parent_last_name'],
						'parent_relation' => $_POST['relation_id'],
						'parent_dob' => $parent_dob,
						'parent_education' => $_POST['parent_education'],
						'parent_occupation' => $_POST['parent_occupation'],
						'parent_phone' => $_POST['parent_phone'],
						'parent_alt_phone' => $_POST['parent_alt_phone'],
						'parent_email' => $_POST['parent_email'],
						'parent_ofc_phone' => $_POST['parent_ofc_phone'],
						'parent_ofc_address' => $_POST['parent_ofc_addr'],
						'parent_city' => $_POST['parent_city'],
						'parent_state' => $_POST['parent_state'],
						//'fk_id_user' => $user_id,
						'parent_fk_country_id' => $_POST['parent_country_id']
					);
					
					$dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>7,'tab_id'=>11));
					
					if(count($dynamicFields)>0)
					{
						foreach ($dynamicFields as $dvalus)
						{
							if(isset($_POST[$dvalus['field_name']]) && $_POST[$dvalus['field_name']]!=NULL)
							{
								if($dvalus['field_type_id']==6)
									$post_arr[$dvalus['field_name']]=date('Y-m-d',strtotime($_POST[$dvalus['field_name']]));
								else
									$post_arr[$dvalus['field_name']]=$_POST[$dvalus['field_name']];
							}
						}
					}
					
					$parent_arr = array_map('ucfirst', $post_arr);
					$parent_arr['parent_email'] = strtolower($_POST['parent_email']);
					$parent_id = $this->mstudent->addParent($parent_arr);					
					
					//Populating association table....
					$this->mstudent->addStudentParentAssoc(array(
						'parent_id' => $parent_id,
						'student_id' => decode($_POST['id_student']),
						'user_id' => $user_id
					));
				}
				else
				{
					$user_arr = array(
						'id_user' => decode($_POST['id_user']),
						'first_name' => $_POST['parent_first_name'],
						'last_name' => $_POST['parent_last_name'],						
						'phone_number' => $_POST['parent_phone']
					);					
					$user_input_arr = array_map('ucfirst', $user_arr);
					$user_id = $this->mwelcome->updateUser($user_input_arr);					
					
					if(empty($_POST['parent_dob']))
						$parent_dob = null;
					else
						$parent_dob = date('Y-m-d',strtotime($_POST['parent_dob']));					
					
					$post_arr = array(
						'id_parent' => decode($_POST['id_parent']),
						//'fk_id_user' => decode($_POST['id_user']),
						//'student_id' => decode($_POST['id_student']),
						'parent_first_name' => $_POST['parent_first_name'],
						'parent_last_name' => $_POST['parent_last_name'],
						'parent_relation' => $_POST['relation_id'],
						'parent_dob' => $parent_dob,
						'parent_education' => $_POST['parent_education'],
						'parent_occupation' => $_POST['parent_occupation'],
						'parent_phone' => $_POST['parent_phone'],
						'parent_alt_phone' => $_POST['parent_alt_phone'],
						'parent_email' => $_POST['parent_email'],
						'parent_ofc_phone' => $_POST['parent_ofc_phone'],
						'parent_ofc_address' => $_POST['parent_ofc_addr'],
						'parent_city' => $_POST['parent_city'],
						'parent_state' => $_POST['parent_state'],
						'parent_fk_country_id' => $_POST['parent_country_id']
					);
					
					$dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>7,'tab_id'=>11));
						
					if(count($dynamicFields)>0)
					{
						foreach ($dynamicFields as $dvalus)
						{
							if(isset($_POST[$dvalus['field_name']]) && $_POST[$dvalus['field_name']]!=NULL)
							{
								if($dvalus['field_type_id']==6)
									$post_arr[$dvalus['field_name']]=date('Y-m-d',strtotime($_POST[$dvalus['field_name']]));
								else
									$post_arr[$dvalus['field_name']]=$_POST[$dvalus['field_name']];
							}
						}
					}
					
					$parent_arr = array_map('ucfirst', $post_arr);
					$parent_arr['parent_email'] = strtolower($_POST['parent_email']);
					$parent_id = $this->mstudent->updateParent($parent_arr);
				}
			}
			else {
				// If Parent is OLD....
				$this->mstudent->addStudentParentAssoc(array(
					'parent_id' => $_POST['exist_parent_id'],
					'student_id' => decode($_POST['id_student']),
					'user_id' => $_POST['id_user_exist']
				));
			}
			redirect(BASE_URL.'index.php/student/addStudent/'.$_POST['id_student'].'/'.encode(1));			
		}
		else
		{
			redirect(BASE_URL);
		}
	}

	function createStudentPreviousInfo()
	{
		if($this->session->userdata('user_id'))
		{
			if(!$_POST['id_student_previous_info'])
			{				
				$post_arr = array(
					'student_id' => decode($_POST['id_student']),
					'previous_institution' => $_POST['student_prev_institute'],
					'previous_year' => $_POST['student_prev_year'],
					'previous_class' => $_POST['student_prev_class'],
					'previous_grade' => $_POST['student_prev_result']
				);	

				$dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>7,'tab_id'=>12));
					
				if(count($dynamicFields)>0)
				{
					foreach ($dynamicFields as $dvalus)
					{
						if(isset($_POST[$dvalus['field_name']]) && $_POST[$dvalus['field_name']]!=NULL)
						{
							if($dvalus['field_type_id']==6)
								$post_arr[$dvalus['field_name']]=date('Y-m-d',strtotime($_POST[$dvalus['field_name']]));
							else
								$post_arr[$dvalus['field_name']]=$_POST[$dvalus['field_name']];
						}
					}
				}
				
				$prev_arr = array_map('ucfirst', $post_arr);				
				$this->mstudent->createStudentPreviousInfo($prev_arr);
			}
			else
			{				
				$post_arr = array(
					'id_student_previous_info' => decode($_POST['id_student_previous_info']),
					'student_id' => decode($_POST['id_student']),
					'previous_institution' => $_POST['student_prev_institute'],
					'previous_year' => $_POST['student_prev_year'],
					'previous_class' => $_POST['student_prev_class'],
					'previous_grade' => $_POST['student_prev_result']
				);
				
				$dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>7,'tab_id'=>12));
					
				if(count($dynamicFields)>0)
				{
					foreach ($dynamicFields as $dvalus)
					{
						if(isset($_POST[$dvalus['field_name']]) && $_POST[$dvalus['field_name']]!=NULL)
						{
							if($dvalus['field_type_id']==6)
								$post_arr[$dvalus['field_name']]=date('Y-m-d',strtotime($_POST[$dvalus['field_name']]));
							else
								$post_arr[$dvalus['field_name']]=$_POST[$dvalus['field_name']];
							
						}
					}
				}
				
				$prev_arr = array_map('ucfirst', $post_arr);				
				$this->mstudent->updateStudentPreviousInfo($prev_arr);
			}
			redirect(BASE_URL.'index.php/student/addStudent/'.$_POST['id_student'].'/'.encode(2));
		}
		else
		{
			redirect(BASE_URL);
		}
	}

	function createStudentDocuments()
	{
		if($this->session->userdata('user_id'))
		{
			if($_POST['id_student'] !== 0)
			{	//echo '<pre>';print_r($_POST);die;
				if($_POST['student_documents_id']!=''){
					$ids=explode(',',$_POST['student_documents_id']);
					$this->mstudent->deleteStudentDocuments($ids);
				}
				
				$upload_path = STUDENT_DOCUMENTS.$_POST['admission_no']."/";
				if(isset($_FILES['documents']['name'][0]) && $_FILES['documents']['name'][0]!='') {
					if(!is_dir($upload_path)) 
						mkdir($upload_path, 0777, TRUE);
						
					$config = array(
						'upload_path'   => $upload_path,
						'allowed_types' => 'jpg|gif|png|jpeg|doc|docx|xls|xlsx|pdf|csv|txt',
						'overwrite'     => 1,
						'remove_spaces' => FALSE						
					);
					$this->load->library('upload', $config);
					
					$files = $_FILES;
					$cpt = count($_FILES['documents']['name']);
					for($i=0; $i<$cpt; $i++)
					{          
						$_FILES['documents[]']['name']= $files['documents']['name'][$i];
						$_FILES['documents[]']['type']= $files['documents']['type'][$i];
						$_FILES['documents[]']['tmp_name']= $files['documents']['tmp_name'][$i];
						$_FILES['documents[]']['error']= $files['documents']['error'][$i];
						$_FILES['documents[]']['size']= $files['documents']['size'][$i]; 
						
						$file_name = $_POST['admission_no']."_".$files['documents']['name'][$i];
						$documents[] = $file_name;
						$config['file_name'] = $file_name;
						
						$this->upload->initialize($config);
						$this->upload->do_upload('documents[]');
						//print_r($this->upload->data());
						
						$post_arr=array(
								'student_id' => decode($_POST['id_student']),
								'document_name' => $file_name,
								'document_type' => '',
								'document_source' => $upload_path.$file_name
								);
						
						$dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>7,'tab_id'=>13));
						
						if(count($dynamicFields)>0)
						{
							foreach ($dynamicFields as $dvalus)
							{
								if(isset($_POST[$dvalus['field_name']]) && $_POST[$dvalus['field_name']]!=NULL)
								{
									if($dvalus['field_type_id']==6)
										$post_arr[$dvalus['field_name']]=date('Y-m-d',strtotime($_POST[$dvalus['field_name']]));
									else
										$post_arr[$dvalus['field_name']]=$_POST[$dvalus['field_name']];
								}
							}
						}
						
						
						$this->mstudent->addStudentDocuments($post_arr);
					}
				}
			} 
			redirect(BASE_URL.'index.php/student/addStudent/'.$_POST['id_student'].'/'.encode(3));
		}
		else
		{
			redirect(BASE_URL);
		}
	}
	
function getDynamicFields($data,$userData)
	{
		$dynamicFields=$this->mwelcome->getAllDynamicField($data);
		$field_str='';
		if(isset($dynamicFields) && count($dynamicFields)>0)
		{
			$i=1;
			foreach($dynamicFields as $dvalues)
            { 
            	
            	switch ($dvalues['field_type_id'])
            	{
            		case 1: $field_values=(isset($userData[0][$dvalues['field_name']]) && $userData[0][$dvalues['field_name']]!=NULL) ? $userData[0][$dvalues['field_name']] : '';
            				$class=(isset($dvalues) && $dvalues['required']==1) ? "form-control required" : "form-control"; 
            				$field='<div class="input-group"><span class="input-group-addon"><span class="fa fa-pencil"></span></span><input class='.$class.' type="text" name='.$dvalues['field_name'].' id='.$dvalues['field_name'].' value='.$field_values.'></div>';
            				 break;
            		case 2: $field_values=(isset($userData[0][$dvalues['field_name']]) && $userData[0][$dvalues['field_name']]!=NULL) ? $userData[0][$dvalues['field_name']] : '';
            				$class=(isset($dvalues) && $dvalues['required']==1) ? "form-control required" : "form-control";
            				$field='<textarea class='.$class.' id='.$dvalues['field_name'].' name='.$dvalues['field_name'].' rows="3">'.$field_values.'</textarea>';
            				break;
            		case 3: $field_option=$this->mwelcome->getFieldsOption(array('field_id'=>$dvalues['field_id']));
            				$class=(isset($dvalues) && $dvalues['required']==1) ? "form-control select required" : "form-control select";
            				if(count($field_option)>0)
            				{	
            					$field='<select class='.$class.' name='.$dvalues['field_name'].' id='.$dvalues['field_name'].'>';
            					$field.='<option value="">Select '.$dvalues['display_name'].'</option>';
            					foreach ($field_option as $field_option_val)
            					{
            						$field_values=(isset($userData[0][$dvalues['field_name']]) && $userData[0][$dvalues['field_name']]==$field_option_val['field_value_id']) ? 'selected="selected"' : '';
            						$field .='<option '.$field_values.' value='.$field_option_val['field_value_id'].'>'.$field_option_val['field_value'].'</option>';
            					}
            					$field .='</select>';
            				}
            				break;
            		case 4: $field_option=$this->mwelcome->getFieldsOption(array('field_id'=>$dvalues['field_id']));
            				$class=(isset($dvalues) && $dvalues['required']==1) ? "required" : "";
            				if(count($field_option)>0)
            				{	$field='';
            					foreach ($field_option as $field_option_val)
            					{
            						$field_values=(isset($userData[0][$dvalues['field_name']]) && $userData[0][$dvalues['field_name']]==$field_option_val['field_value_id']) ? 'checked="checked"' : '';
            						$field .='<input '.$field_values.' class='.$class.' type="radio" name='.$dvalues['field_name'].' id='.$dvalues['field_name'].' aria-label="Radio button for following text input" value='.$field_option_val['field_value_id'].'>'.$field_option_val['field_value']." ";
            					}
            				}
            				break;
            		case 5:  $field_option=$this->mwelcome->getFieldsOption(array('field_id'=>$dvalues['field_id']));
            				$class=(isset($dvalues) && $dvalues['required']==1) ? "required" : "";
            				if(count($field_option)>0)
            				{	$field='';
            					foreach ($field_option as $field_option_val)
            					{
            						$field_values=(isset($userData[0][$dvalues['field_name']]) && $userData[0][$dvalues['field_name']]==$field_option_val['field_value_id']) ? 'checked="checked"' : '';
            						$field .='<input '.$field_values.' type="checkbox" name='.$dvalues['field_name'].' id='.$dvalues['field_name'].' aria-label="Radio button for following text input" class='.$class.' value='.$field_option_val['field_value_id'].'>'.$field_option_val['field_value']." ";
            					}
            				}
            				break;
            				
            		case 6: $field_values=(isset($userData[0][$dvalues['field_name']]) && $userData[0][$dvalues['field_name']]!=NULL) ? date('d-M-Y',strtotime($userData[0][$dvalues['field_name']])) : '';
            				$class=(isset($dvalues) && $dvalues['required']==1) ? "form-control datepicker required" : "form-control datepicker";
            				$field='<div class="input-group"><span class="input-group-addon"><span class="fa fa-calendar"></span></span><input type="text" name='.$dvalues['field_name'].' id='.$dvalues['field_name'].' class='.$class.' value='.$field_values.'></div>';
            				break;
            	}
            	if($i%2==1)
            		$field_str .='<div class="form-group">';
            	
            	$field_str .='<label class="col-md-6 col-xs-12 control-label">'.$dvalues['display_name'];
            	if($dvalues['required']==1) { 
            		$field_str .= '<span class="clr-red">*</span>';
            	}
            	$field_str .='</label><div class="col-md-3 col-xs-12">'.$field.'</div>';
            	
            	if($i%2==0)
            		$field_str .='</div>';
            	
            $i++;
	       }
	       if($i%2==0)
	       		$field_str .='</div>';
         }
         return $field_str;
	}
	
	
}
