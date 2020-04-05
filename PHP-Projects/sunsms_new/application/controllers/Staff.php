<?php
class Staff extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Datatables');
        //$this->load->model("mdepartment");
        $this->load->model("mcategory");
        $this->load->model("mwelcome");
        $this->load->model("mstaff");
        if($this->session->userdata('user_id') && $this->session->userdata('user_type_id') > 0){}
        else{
            redirect(BASE_URL);
        }
    }
    function index()
    {
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='staff/staff';
        $data['footer']='footer';
        $data['menu'] = 'staff';
        $this->load->view('landing',$data);
    }
	
    function staffDateTable()
    {
        $results = json_decode($this->mstaff->getStaffDataTable($_POST));
        for($s=0;$s<count($results->data);$s++) { 
			$results->data[$s][0] = "<a href='".BASE_URL."index.php/staff/createStaffView/".encode($results->data[$s][5])."/p'>".$results->data[$s][0]."</a>";
            $results->data[$s][5] = encode($results->data[$s][5]);
        }
        echo json_encode($results);
    }

    function createStaffView($id_staff=0, $active_tab=0)
    {
        $data['department'] = $this->mwelcome->getAllDepartments();
        //$data['category'] = $this->mcategory->getAllCatgories();
        $data['staff_type'] = $this->mstaff->getAllStaffTypes();
        $data['county'] = $this->mwelcome->getCountry();
        $staffData=array();
        $StaffContactData=array();
        $staffDocs=array();
        if($id_staff===0){}
        else{
            $staffData = $this->mstaff->getStaffDetails(array('id_staff' => decode($id_staff)));
            $data['teacher_details']=$staffData;
            
            $teacher_contact = $this->mstaff->getStaffContact(array('id_staff' => decode($id_staff)));
			if(count($teacher_contact) > 0)
			{
				$data['teacher_contact'] = $teacher_contact;
				$StaffContactData=$teacher_contact;
			}
				
            $teacher_documents = $this->mstaff->getStaffDocuments(array('id_staff' => decode($id_staff)));
            if(count($teacher_documents) > 0)
            {
				$data['teacher_documents'] = $teacher_documents;
				$staffDocs=$teacher_documents;
            }
        }
        
        
        $data['staffGeneralDetails']=$this->getDynamicFields(array('module_id'=>8,'tab_id'=>14,'sub_tab_id'=>26),$staffData);
        $data['staffPersonalDynamicFields']=$this->getDynamicFields(array('module_id'=>8,'tab_id'=>14,'sub_tab_id'=>27),$staffData);

        $data['staffContactDynamicFields']=$this->getDynamicFields(array('module_id'=>8,'tab_id'=>15,'sub_tab_id'=>28),$StaffContactData);
        
        $data['staffDocumentsDynamicFields']=$this->getDynamicFields(array('module_id'=>8,'tab_id'=>16,'sub_tab_id'=>29),$staffDocs);
        
        
		$result = $this->mwelcome->getMaxTeacherNumber();		
		$data['teacher_number'] = '';		
		
		if(count($result[0]['teacher_number']) == 0) {
			$result = $this->mwelcome->getSchool();
			if(isset($result[0]['teacher_number']))
				$data['teacher_number'] = $result[0]['teacher_number'];
		}
		else {
			$data['teacher_number'] = ($result[0]['teacher_number'])+1;
		}
		
		if($active_tab === 0)
			$data['active_tab']=$active_tab;
		else
			$data['active_tab']=$active_tab;
			
        $data['blood_group'] = $this->mstaff->getAllBloodGroups();
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='staff/add_staff';
        $data['footer']='footer';
        $data['menu'] = 'staff';
        $this->load->view('landing',$data);
    }
	
    function createStaffDetails()
    {
        if($this->session->userdata('user_id'))
        {
            //if($_POST['id_staff'] == 0)
			if(!$_POST['id_staff'])
            {	                
				if(isset($_FILES['profile_pic']['name']) && $_FILES['profile_pic']['name']!='') {
					$file_type = check_file_type(strtolower($_FILES['profile_pic']['name']),'image');	
					$ext = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);
					if($file_type) 
					{
						$upload_path = STAFF_PICTURES.$_POST['teacher_number']."/";
						if(!is_dir($upload_path)) 
							mkdir($upload_path, 0777, TRUE);
						
						$config['upload_path'] = $upload_path;
						$config['allowed_types']    = 'gif|jpg|png|jpeg';
						$file_name = $_POST['teacher_number'].'_'.$this->session->userdata('academic_year').'.'.$ext;	
						
						$config['file_name'] = $file_name;
						
						if(file_exists($upload_path.$file_name))
							unlink($upload_path.$file_name);
							
						$this->load->library('upload', $config);
						$this->upload->initialize($config);										
						$this->upload->do_upload('profile_pic');
											
						$_POST['profile_pic'] = $file_name;
					}
				}
				else{
					$_POST['profile_pic'] = '';
				}
			                
				$user_arr = array(
					'user_type_id' => TEACHER,
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'username' => $_POST['teacher_number'],
					'password' => md5(date('dmY',strtotime($_POST['date_of_birth']))),
					'phone_number' => $_POST['phone_number'],
					'user_status' => 1
				);
				$user_input_arr = array_map('ucfirst', $user_arr);
				$user_id = $this->mwelcome->addUser($user_input_arr);
				
                $post_arr = array(                    
                    'fk_id_user' => $user_id,
                    'teacher_number' => $_POST['teacher_number'],
                    'joining_date' =>  date('Y-m-d',strtotime($_POST['joining_date'])),
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'gender' => $_POST['gender'],
                    'dob' => date('Y-m-d',strtotime($_POST['date_of_birth'])),
                    'teacher_department' => $_POST['teacher_department'],
                    'teacher_type' => $_POST['teacher_type'],
                    'qualification' => $_POST['qualification'],
                    'job_title' => $_POST['job_title'],
                    'years' => $_POST['year_id'],
                    'months' => $_POST['months_id'],
                    'experience_details' => $_POST['experience_details'],
                    'marital_status' => $_POST['marital_status'],
                    'blood_group_id' => $_POST['blood_group'],
                    'father_name' => $_POST['father_name'],
                    'mother_name' => $_POST['mother_name'],
                    'relation_name' => $_POST['relation_name'],
                    'children_count' => $_POST['children_count'],
                    'nationality_id' => $_POST['nationality_id'],                    
                    'email' => $_POST['email'],
                    'phone_number' => $_POST['phone_number'],
                    'profile_pic' => $_POST['profile_pic'],
					'fk_id_academic_year' => $this->session->userdata('academic_year')
                );	

                $dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>8,'tab_id'=>14));
                
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
				
				$staff_arr = array_map('ucfirst', $post_arr);
				$staff_arr['email'] = strtolower($_POST['email']);				
				$staff_id = $this->mstaff->addStaff($staff_arr);				
            }
            else
            {	//echo '<pre>';print_r($_POST);die;
				$user_arr = array(
					'id_user' => decode($_POST['id_user']),
					'first_name' => $_POST['first_name'],
					'last_name' => $_POST['last_name'],
					'phone_number' => $_POST['phone_number']
				);
				
				$user_input_arr = array_map('ucfirst', $user_arr);
				$user_id = $this->mwelcome->updateUser($user_input_arr);
				$staff_id = decode($_POST['id_staff']);
				
                $post_arr = array(
                    'id_staff' => $staff_id,
                    'teacher_number' => $_POST['teacher_number'],
                    'joining_date' =>  date('Y-m-d',strtotime($_POST['joining_date'])),
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
                    'gender' => $_POST['gender'],
                    'dob' => date('Y-m-d',strtotime($_POST['date_of_birth'])),
                    'teacher_department' => $_POST['teacher_department'],
                    'teacher_type' => $_POST['teacher_type'],
                    'qualification' => $_POST['qualification'],
                    'job_title' => $_POST['job_title'],
                    'years' => $_POST['year_id'],
                    'months' => $_POST['months_id'],
                    'experience_details' => $_POST['experience_details'],
                    'marital_status' => $_POST['marital_status'],
                    'blood_group_id' => $_POST['blood_group'],
                    'father_name' => $_POST['father_name'],
                    'mother_name' => $_POST['mother_name'],
                    'relation_name' => $_POST['relation_name'],
                    'children_count' => $_POST['children_count'],
                    'nationality_id' => $_POST['nationality_id'],
                    'email' => $_POST['email'],
                    'phone_number' => $_POST['phone_number']
                );
                
                $dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>8,'tab_id'=>14));
                
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
				
				$staff_arr = array_map('ucfirst', $post_arr);
				$staff_arr['email'] = strtolower($_POST['email']);	
				$this->mstaff->updateStaff($staff_arr);
            }
            redirect(BASE_URL.'index.php/staff/createStaffView/'.encode($staff_id).'/0');
        }
		else
		{
			redirect(BASE_URL);
		}
    }
	
    function createStaffContact()
    {
		
        if(isset($_POST))
        {
			if(!$_POST['id_staff_contact'])
			{	
				$post_arr = array(                    
                    'staff_id' => decode($_POST['id_staff']),
                    'home_address_line1' => $_POST['home_address_line1'],
					'home_address_line2' => $_POST['home_address_line2'],
					'home_city' => $_POST['home_city'],
					'home_state' => $_POST['home_state'],
					'home_country_id' => $_POST['home_country_id'],
					'home_pincode' => $_POST['home_pincode']
                );	

				$dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>8,'tab_id'=>15));
				
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
				
				$staff_contact_arr = array_map('ucfirst', $post_arr);							
				$staff_contact_id = $this->mstaff->addStaffContact($staff_contact_arr);				             
			}
			else
			{	
				
				$post_arr = array(
					'id_staff_contact' => decode($_POST['id_staff_contact']),
					'home_address_line1' => $_POST['home_address_line1'],
					'home_address_line2' => $_POST['home_address_line2'],
					'home_city' => $_POST['home_city'],
					'home_state' => $_POST['home_state'],
					'home_country_id' => $_POST['home_country_id'],
					'home_pincode' => $_POST['home_pincode']
                );
				
				
				$dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>8,'tab_id'=>15));
				
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
				$staff_contact_arr = array_map('ucfirst', $post_arr);
				$this->mstaff->updateStaffContact($staff_contact_arr);
			}
            redirect(BASE_URL.'index.php/staff/createStaffView/'.$_POST['id_staff'].'/1');
        }
    }
	
    function deleteStaff($id)
    {
        $this->mstaff->deleteStaff(decode($id));
        echo json_encode(array('response' => 1,'data' =>''));
    }
	
    function createStaffDocuments() 
	{	
        if($this->session->userdata('user_id'))
		{
			if($_POST['id_staff'] !== 0)
			{	
				if($_POST['staff_documents_id']!='')
				{
					$ids=explode(',',$_POST['staff_documents_id']);
					$this->mstaff->deleteStaffDocuments($ids);
				}
				
				$upload_path = STAFF_DOCUMENTS.$_POST['teacher_number']."/";
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
						
						$file_name = $_POST['teacher_number']."_".$files['documents']['name'][$i];
						$documents[] = $file_name;
						$config['file_name'] = $file_name;
						
						$this->upload->initialize($config);
						$this->upload->do_upload('documents[]');
						//print_r($this->upload->data());
						
						$post_arr=array(
							'staff_id' => decode($_POST['id_staff']),
							'document_name' => $file_name,
							'document_type' => '',
							'document_source' => $upload_path.$file_name
						);
						
						
						$dynamicFields=$this->mwelcome->getAllDynamicField(array('module_id'=>8,'tab_id'=>16));
						
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
						
					$this->mstaff->addStaffDocuments($post_arr);
					}
				}
			} 
			redirect(BASE_URL.'index.php/staff/createStaffView/'.$_POST['id_staff'].'/2');
		}
		else
		{
			redirect(BASE_URL);
		}
    }
	
	/**** Staff type related code starts here ****/
	
	function staffType()
    {
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='staff/staff_type';
        $data['footer']='footer';
        $data['menu'] = 'staff';
        $this->load->view('landing',$data);
    }
	
	function getStaffTypeDateTable()
    {
        $results = json_decode($this->mstaff->getStaffTypeDateTable($_POST));
        for($s=0;$s<count($results->data);$s++) {        
            $results->data[$s][1] = encode($results->data[$s][1]);
        }
        echo json_encode($results);
    } 
	
	function addUpdateStaffType($staff_type_id=0)
    {
        if($staff_type_id===0){}
        else{
            $data['staff_type_details'] = $this->mstaff->getStaffType(array('id_staff_type' => decode($staff_type_id)));
        }
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='staff/add_staff_type';
        $data['footer']='footer';
        $data['menu'] = 'staff';
        $this->load->view('landing',$data);
    }
	
	function insertUpdateStaffType()
    {
        if(isset($_POST))
        {
            if(!$_POST['id_staff_type'])
            {
                $this->mstaff->insertStaffType(array(
                    'staff_type_name' => ucfirst($_POST['staff_type_name'])
                ));
            }
            else
            {
                $this->mstaff->updateStaffType(array(
                    'id_staff_type' => decode($_POST['id_staff_type']),
                    'staff_type_name' => ucfirst($_POST['staff_type_name'])
                ));
            }

            redirect(BASE_URL.'index.php/staff/staffType');
        }
    }
	
	function deleteStaffType($id)
    {
        $this->mstaff->deleteStaffType(decode($id));
        echo json_encode(array('response' => 1,'data' =>''));
    }
	
	/**** Staff type related code ends here ****/
	
	/**** Class Teacher Allocation related code starts here ****/
	function classTeacher()
    {				
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='staff/staff_class_allocate';
        $data['footer']='footer';
        $data['menu'] = 'staff';
        $this->load->view('landing',$data);
    }
	
	function getStaffClassDateTable()
    {
        $results = json_decode($this->mstaff->getStaffClassDateTable($_POST));
        for($s=0;$s<count($results->data);$s++) {        
            $results->data[$s][4] = encode($results->data[$s][4]);
        }
        echo json_encode($results);
    }
	
	function addUpdateClassTeacher($class_staff_id=0)
    {
        if($class_staff_id===0){}
        else{
            $data['class_teacher'] = $this->mstaff->getClassTeacher(array('id_staff_class_allocate' => decode($class_staff_id)));
        }
		
		$data['board'] = $this->mwelcome->getBoard();
		$data['course'] = $this->mwelcome->getCourse();
		$data['section'] = $this->mwelcome->getSection();
		$data['staff'] = $this->mstaff->getStaff();
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='staff/add_staff_class_allocate';
        $data['footer']='footer';
        $data['menu'] = 'staff';
        $this->load->view('landing',$data);
    }
	
	function insertUpdateClassTeacher()
    {
        if(isset($_POST))
        {
            if(!$_POST['id_staff_class_allocate'])
            {
                $this->mstaff->insertClassTeacher(array(
                    'board_id' => $_POST['board_id'],
                    'course_id' => $_POST['student_course_id'],
                    'section_id' => $_POST['course_section_id'],
                    'staff_id' => $_POST['teacher_id']
                ));
            }
            else
            {
                $this->mstaff->updateClassTeacher(array(
                    'id_staff_class_allocate' => decode($_POST['id_staff_class_allocate']),
                    'board_id' => $_POST['board_id'],
                    'course_id' => $_POST['student_course_id'],
                    'section_id' => $_POST['course_section_id'],
                    'staff_id' => $_POST['teacher_id']
                ));
            }
            redirect(BASE_URL.'index.php/staff/classTeacher');
        }
    }
		
	function deleteClassTeacher($id)
    {
        $this->mstaff->deleteClassTeacher(decode($id));
        echo json_encode(array('response' => 1,'data' =>''));
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
    
    
	
	/**** Class Teacher Allocation related code ends here ****/
}