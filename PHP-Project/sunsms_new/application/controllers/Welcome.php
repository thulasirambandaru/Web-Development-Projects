<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		if($this->session->userdata('user_id') && $this->session->userdata('user_type_id') > 0) {
			redirect(BASE_URL.'index.php/admin');
		}
	}

	function index()
	{
		if($this->session->userdata('user_id'))
		{
			$data['header']="header";
			$data['left_menu']="left_menu";
			$data['middle_content']='school';
			$data['footer']='footer';
			$data['menu'] = 'school';
			$this->load->view('landing',$data);
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

	function makeLogin()
	{
		if(isset($_POST) && !empty($_POST) && !empty($_POST['username']) && !empty($_POST['password']))
		{			
			$data=$this->mwelcome->login($_POST);			
			if(!empty($data)) 
			{			
				$user_type_id = $this->setAccessControl($data[0]['user_type_id']);
				if($user_type_id > 0)
				{
					$academic_year = $this->mwelcome->getAcademicYear();
					$school = $this->mwelcome->getSchool();					
					$data = array(  'user_id'=> $data[0]['id_user'],
						'user_type_id'=> $user_type_id,
						'display_name'=> $data[0]['first_name'].' '.$data[0]['last_name'],
						'username'=> $data[0]['username'],
						'user_image'=> $data[0]['user_image'],
						'school_id' => 1,
						'school_name' => $school[0]['school_name'],
						'school_logo' => $school[0]['school_logo'],
						'academic_year' => $academic_year[0]['id_academic_year']
					);
										
					$this->session->set_userdata($data);
					redirect(BASE_URL.'index.php/admin/');
				}				
			}
			else{
				$this->session->set_userdata('message','Invalid Username or Password');
				redirect(BASE_URL);
			}
		}
		else
		{
			$this->session->set_userdata('message','Invalid Username or Password');
			redirect(BASE_URL);
		}
	}
	
	function setAccessControl($user_type_id)
	{
		if($user_type_id == ADMIN) 		
			return ADMIN;	
		else if($user_type_id == TEACHER)
			return TEACHER;
		else if($user_type_id == PARENT_ID) 
			return PARENT_ID;
		else if($user_type_id == STUDENT) 
			return STUDENT;		
		else
			return 0;			
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

	function getCustomerDataTable()
	{
		$results = json_decode($this->mwelcome->getCustomerDataTable($_POST));

		for($s=0;$s<count($results->data);$s++)
		{
			$results->data[$s][6] = encode($results->data[$s][6]);
		}
		echo json_encode($results);
	}

	function addSchool($school_id=0)
	{
		if($school_id===0){	}
		else{
			$data['school'] = $this->mwelcome->getSchool(array('id_school' => decode($school_id)));
			if(empty($data['school'])){ unset($data['school']); }
			else{
				$data['state'] = $this->mwelcome->getState(array('country_id' => $data['school'][0]['country_id']));
				$data['city'] = $this->mwelcome->getCity(array('state_id' => $data['school'][0]['state_id']));
			}
		}
		$data['county'] = $this->mwelcome->getCountry();
		$data['header']="header";
		$data['left_menu']="";
		$data['middle_content']='add_school';
		$data['footer']='footer';
		$this->load->view('landing',$data);
	}

	function createSchool()
	{
		if($this->session->userdata('user_id'))
		{
			if(isset($_FILES['school_logo']['name']) && $_FILES['school_logo']['name']!=''){
				$file_type = check_file_type($_FILES['school_logo']['name'],'image');
				if($file_type) {
					$school_image = do_upload($_FILES['school_logo']['name'], $_FILES['school_logo']['tmp_name'], $this->session->userdata('school_id'));
					$_POST['school_logo'] = $school_image;
				}
			}
			else{
				$_POST['school_logo'] = '';
			}

			if(!$_POST['id_school'])
			{
				$password = generate_password(6);
				$user_id = $this->mwelcome->addUser(array(
					'user_type_id' => 1,
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'email' => $_POST['email'],
					'password' => md5($password),
					'phone_number' => $_POST['phone_number']
				));

				$this->mwelcome->addSchool(array(
					'school_name' => $_POST['school_name'],
					'school_logo' => $_POST['school_logo'],
					'country_id' => $_POST['country_id'],
					'state_id' => $_POST['state_id'],
					'city_id' => $_POST['city_id'],
					'address' => $_POST['address'],
					'user_id' => $user_id
				));
			}
			else
			{
				if($_POST['school_logo']=='')
					$_POST['school_logo'] = $_POST['prev_school_logo'];
				$user_id = $this->mwelcome->updateUser(array(
					'id_user' => decode($_POST['id_user']),
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'phone_number' => $_POST['phone_number']
				));

				$this->mwelcome->updateSchool(array(
					'id_school' => decode($_POST['id_school']),
					'school_name' => $_POST['school_name'],
					'school_logo' => $_POST['school_logo'],
					'country_id' => $_POST['country_id'],
					'state_id' => $_POST['state_id'],
					'city_id' => $_POST['city_id'],
					'address' => $_POST['address'],
				));
			}

			redirect(BASE_URL.'index.php/welcome/index');
		}
		else
		{
			redirect(BASE_URL);
		}
	}

	function getState()
	{
		$data = $this->mwelcome->getState(array('country_id' => $_REQUEST['country_id']));
		echo json_encode(array('response' => 1,'data' => $data));
	}

	function getCity()
	{
		$data = $this->mwelcome->getCity(array('state_id' => $_REQUEST['state_id']));
		echo json_encode(array('response' => 1,'data' => $data));
	}



}
