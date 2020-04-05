<?php
class MWelcome extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
        $this->load->dbforge();
    }


    function login($post)
    {
        $this->db->select('*');
        $this->db->from('user u');
        $this->db->where('u.username',$post['username']);
        $this->db->where('u.password',md5($post['password']));
        $this->db->where('u.user_status',1);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function getCustomerDataTable($data)
    {
        $this->datatables->select('s.school_name,u.first_name,u.email,c.city,st.state,DATE_FORMAT(s.created_date_time, \'%d %b %Y\') as date,s.id_school',FALSE)
            ->from('school As s')
            ->join('user AS u','s.user_id = u.id_user', 'left')
            ->join('country AS cu','s.city_id = cu.id_country', 'left')
            ->join('state AS st','s.state_id = st.id_state', 'left')
            ->join('city AS c','s.city_id = c.id_city', 'left')
            ->group_by('s.id_school');

        return $this->datatables->generate();
    }

    function getSchool()
    {
        $this->db->select('*');
        $this->db->from('school s');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCountry()
    {
        $query = $this->db->get('country');
        return $query->result_array();
    }

    function getState($data)
    {
        $this->db->select('*');
        $this->db->from('state');
        if(isset($data['country_id']))
            $this->db->where('country_id',$data['country_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCity($data)
    {
        $this->db->select('*');
        $this->db->from('city');
        if(isset($data['state_id']))
            $this->db->where('state_id',$data['state_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addUser($data)
    {
        $this->db->insert('user',$data);
        return $this->db->insert_id();
    }

    function addSchool($data)
    {
        $this->db->insert('school',$data);
        return $this->db->insert_id();
    }

    function updateUser($data)
    {
        $this->db->where('id_user',$data['id_user']);
        $this->db->update('user', $data);
    }

    function updateSchool($data)
    {
        $this->db->where('id_school',$data['id_school']);
        $this->db->update('school', $data);
    }

    function getAcademicYearDataTable($data)
    {
        $this->datatables->select('a.name,DATE_FORMAT(a.start_date, \'%d %b %Y\') as start_date,DATE_FORMAT(a.end_date, \'%d %b %Y\') as end_date,a.status,a.id_academic_year',FALSE)
            ->from('academic_year As a');
        return $this->datatables->generate();
    }

    function getAcademicYear($data=null)
    {
        $this->db->select('*');
        $this->db->from('academic_year');
        $this->db->where('status',1);
        if(isset($data['id_academic_year']))
            $this->db->where('id_academic_year',$data['id_academic_year']);
        if(isset($data['school_id']))
            $this->db->where('school_id',$data['school_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addAcademicYear($data)
    {
        $this->db->insert('academic_year',$data);
        //echo $this->db->last_query();
        return $this->db->insert_id();
    }

    function updateAcademicYear($data)
    {
        $this->db->where('id_academic_year',$data['id_academic_year']);
        $this->db->update('academic_year', $data);
    }

    function deleteAcademicYear($id)
    {
        $this->db->where('id_academic_year',$id);
        $this->db->delete('academic_year');
        return 1;
    }

    function getBoardDataTable($data)
    {
        $this->datatables->select('b.board_name,b.status,b.id_board',FALSE)
            ->from('board As b')
            ->where('b.school_id',$this->session->userdata('school_id'));

        return $this->datatables->generate();
    }

    function getAdmissionNumber()
    {
        $this->db->select('*');
        $this->db->from('admission_number');
        $query = $this->db->get();
        return $query->result_array();
    }

    function addAdmissionNumber($data)
    {
        $this->db->insert('admission_number',$data);
        return $this->db->insert_id();
    }

    function updateAdmissionNumber($data)
    {
        $this->db->where('id_admission_number',$data['id_admission_number']);
        $this->db->update('admission_number', $data);
    }

    function getNewAdmissionNumber()
    {
        $this->db->select('*');
        $this->db->from('admission_number');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getMaxAdmissionNumber()
    {
        $this->db->select_max('admission_number');
        $this->db->from('student');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getTeacherNumber()
    {
        $this->db->select('*');
        $this->db->from('teacher_number');
        $query = $this->db->get();
        return $query->result_array();
    }

    function addTeacherNumber($data)
    {
        $this->db->insert('teacher_number',$data);
        print $this->db->insert_id();
    }

    function updateTeacherNumber($data)
    {
        $this->db->where('id_teacher_number',$data['id_teacher_number']);
        $this->db->update('teacher_number', $data);
    }

    function getNewTeacherNumber()
    {
        $this->db->select('*');
        $this->db->from('teacher_number');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getMaxTeacherNumber()
    {
        $this->db->select_max('teacher_number');
        $this->db->from('staff');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getBoard()
    {
        $this->db->select('*');
        $this->db->from('board');
        if(isset($data['id_board']))
            $this->db->where('id_board',$data['id_board']);
        if(isset($data['school_id']))
            $this->db->where('school_id',$data['school_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addBoard($data)
    {
        $this->db->insert('board',$data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    function updateBoard($data)
    {
        $this->db->where('id_board',$data['id_board']);
        $this->db->update('board', $data);
    }

    function deleteBoard($id)
    {
        $this->db->where('id_board',$id);
        $this->db->delete('board');
        return 1;
    }
    function getCourseDataTable($data)
    {
        $this->datatables->select('b.board_name,c.course_name,c.status,c.id_course',FALSE)
            ->from('course As c')
            ->join('board b','b.id_board=c.board_id','left');

        return $this->datatables->generate();
    }

    function getSectionDataTable($data)
    {
        $this->datatables->select('b.board_name,c.course_name,s.section_name,s.status,s.id_section',FALSE)
            ->from('section As s')
            ->join('course c','c.id_course=s.course_id','left')
            ->join('board b','b.id_board=c.board_id','left');
        return $this->datatables->generate();
    }

    function getCourse($data=null)
    {
        $this->db->select('*');
        $this->db->from('course');
        if(isset($data['id_course']))
            $this->db->where('id_course',$data['id_course']);
        if(isset($data['board_id']))
            $this->db->where('board_id',$data['board_id']);
        if(isset($data['school_id']))
            $this->db->where('school_id',$data['school_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCourseDuplicates($data=null)
    {
        $this->db->select('*');
        $this->db->from('course');
        if(isset($data['board_id']))
            $this->db->where('board_id',$data['board_id']);
        if(isset($data['class_name']))
            $this->db->where('course_name',$data['class_name']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getSection($data=null)
    {
        $this->db->select('*, s.status');
        $this->db->from('section s');
        $this->db->join('course c', 'c.id_course=s.course_id','left');
        if(isset($data['id_section']))
            $this->db->where('id_section',$data['id_section']);
        if(isset($data['course_id']))
            $this->db->where('course_id',$data['course_id']);
        if(isset($data['status']))
            $this->db->where('s.status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addCourse($data)
    {
        $this->db->insert('course',$data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    function addSection($data, $more_sections=null)
    {
        /*$this->db->insert('section',$data);
        if(is_array($more_sections)) {
            for($i=0;$i<count($more_sections);$i++) {
                $mdata = array(
                    'course_id' => $data['course_id'],
                    'section_name' => $more_sections[$i]
                );
                $this->db->insert('section',$mdata);
            }
        }
        //echo $this->db->last_query(); exit; _
        return $this->db->insert_id();*/

        $this->db->insert('section',$data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    function updateSection($data)
    {
        $this->db->where('id_section',$data['id_section']);
        $this->db->update('section', $data);
    }

    function manageSection($data)
    {
        $this->db->where('id_section',$data['id_section']);
        $this->db->update('section', $data);
    }

    function updateCourse($data)
    {
        $this->db->where('id_course',$data['id_course']);
        $this->db->update('course', $data);
    }

    function deleteCourse($id)
    {
        $this->db->where('id_course',$id);
        $this->db->delete('course');
        return 1;
    }

    function getSubjectDataTable($data)
    {
        $this->datatables->select('b.board_name, c.course_name,s.subject_name,s.status,s.id_subject',FALSE)
            ->from('subject As s')
            ->join('course c','c.id_course=s.course_id','left')
            ->join('board b','b.id_board=c.board_id','left');
        return $this->datatables->generate();
    }

    function getSubject($data)
    {
        $this->db->select('*, s.status');
        $this->db->from('subject s');
        $this->db->join('course c', 'c.id_course=s.course_id','left');
        if(isset($data['id_subject']))
            $this->db->where('id_subject',$data['id_subject']);
        if(isset($data['course_id']))
            $this->db->where('course_id',$data['course_id']);
        if(isset($data['status']))
            $this->db->where('s.status',$data['status']);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function getBoardCourses($data)
    {
        $this->db->select('*');
        $this->db->from('course');
        if(isset($data['board_id']))
            $this->db->where_in('board_id',$data['board_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function getSubjectDuplicates($data=null)
    {
        $this->db->select('*');
        $this->db->from('subject');
        if(isset($data['course_id']))
            $this->db->where('course_id',$data['course_id']);
        if(isset($data['subject_name']))
            $this->db->where('subject_name',$data['subject_name']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getSectionDuplicates($data=null)
    {
        $this->db->select('*');
        $this->db->from('section');
        if(isset($data['course_id']))
            $this->db->where('course_id',$data['course_id']);
        if(isset($data['section_name']))
            $this->db->where('section_name',$data['section_name']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addSubject($data)
    {
        $this->db->insert('subject',$data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    function updateSubject($data)
    {
        $this->db->where('id_subject',$data['id_subject']);
        $this->db->update('subject', $data);
    }

    function deleteSubject($id)
    {
        $this->db->where('id_subject',$id);
        $this->db->delete('subject');
        return 1;
    }

    function getWeekDay($data=null)
    {
        $this->db->select('*');
        $this->db->from('week_day');
        if(isset($data['day']))
            $this->db->where('day',$data['day']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addWeekDay($data)
    {
        $this->db->insert('week_day',$data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    function updateWeekDay($data)
    {
        $this->db->where('id_week_day',$data['id_week_day']);
        $this->db->update('week_day', $data);
    }

    function getClassTimingDataTable($data)
    {
        $this->datatables->select('ct.name,ct.start_time,ct.end_time,ct.is_break,ct.status,ct.id_class_timing',FALSE)
            ->from('class_timing ct');
        //->join('course c','c.id_course=ct.course_id','left')
        //->where('c.school_id',$this->session->userdata('school_id'));

        return $this->datatables->generate();
    }

    function getClassTiming($data=null)
    {
        $this->db->select('ct.name,ct.start_time,ct.end_time,ct.is_break,ct.status,ct.id_class_timing');
        $this->db->from('class_timing ct');
        //$this->db->join('course c','c.id_course=ct.course_id','left');
        /*if(isset($data['course_id']))
            $this->db->where('ct.course_id',$data['course_id']);
        if(isset($data['school_id']))
            $this->db->where('c.school_id',$data['school_id']);*/
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        if(isset($data['id_class_timing']))
            $this->db->where('id_class_timing',$data['id_class_timing']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addClassTiming($data)
    {
        $this->db->insert('class_timing',$data);
        return $this->db->insert_id();
    }

    function updateClassTiming($data)
    {
        $this->db->where('id_class_timing',$data['id_class_timing']);
        $this->db->update('class_timing', $data);
        //echo $this->db->last_query(); exit;
        return 1;
    }

    function deleteClassTiming($id_class_timing)
    {
        $this->db->where('id_class_timing',$id_class_timing);
        $this->db->delete('class_timing');
        //echo $this->db->last_query(); exit;
        return 1;
    }

    function getStaff($data=null)
    {
        $this->db->select('s.id_staff,CONCAT(s.first_name," ",s.last_name) as name,s.first_name,s.last_name');
        $this->db->from('staff s');
        $query = $this->db->get();
        return $query->result_array();
    }

    function getDepartmentDataTable($data)
    {
        $this->datatables->select('d.department_name,d.id_department',FALSE)
            ->from('departments As d');
        return $this->datatables->generate();
    }

    function getAllDepartments(){
        $this->db->select('*');
        $this->db->from('departments');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getDepartment($data){
        $this->db->select('*');
        $this->db->from('departments');
        $this->db->where('id_department',$data['department_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertDepartment($post){
        $data = array(
            'department_name' => $post['department_name']
        );
        $this->db->insert('departments', $data);
    }
    public function updateDepartment($post){
        $data = array(
            'department_name' => $post['department_name']
        );

        $this->db->where('id_department', $post['id_department']);
        $this->db->update('departments', $data);
    }

    public function deleteDepartment($id_department){
        $this->db->delete('departments', array('id_department' => $id_department));
    }

    /* Authour : Kiran Shetty
    Date : Feb-10-2017
    */
    function getUserDataTable($data)
    {
        $this->datatables->select('CONCAT(u.first_name," ",u.last_name) as user_name,ut.user_type,u.phone_number,u.username,u.user_status,u.id_user,u.special_user',FALSE)
            ->from('user as u')
            ->join('user_type as ut', 'ut.id_user_type=u.user_type_id');
        return $this->datatables->generate();
    }

    function getUser($data=null)
    {
        $this->db->select('*');
        $this->db->from('user');
        //$this->db->where('user_status',1);
        if(isset($data['id_user']))
            $this->db->where('id_user',decode($data['id_user']));
        $query = $this->db->get();
        return $query->result_array();
    }

    function getUserType()
    {
        $this->db->select('*');
        $this->db->from('user_type');
        $query = $this->db->get();
        return $query->result_array();
    }

    function deleteUser($id)
    {
        $this->db->where('id_user',$id);
        $this->db->delete('user');
        return 1;
    }

    function validateUser($data=null)
    {
        $this->db->select('username');
        $this->db->from('user');
        if(isset($data))
            $this->db->where('username',$data);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function validatePassword($data=null)
    {
    	$this->db->select('*');
    	$this->db->from('user');
    	if(isset($data['oldPassword']))
    		$this->db->where('password',md5($data['oldPassword']));
    	if(isset($data['user_id']))
    		$this->db->where('id_user',$data['user_id']);
    	$query = $this->db->get();
    	return $query->result_array();
    }
    
    function getFieldMasterData($data)
    {
    	$this->db->select('*');
    	$this->db->from('field_master');
    	$this->db->where('master_type',$data['type']);
    	if(isset($data['master_id']))
    	{
    		$this->db->where('parent_master_id',$data['master_id']);
    	}
    	$query = $this->db->get();
    	return $query->result_array();
    }
    
    function getChildFrmMaster($data)
    {
    	$this->db->select('*');
    	$this->db->from('field_master');
    	$this->db->where('parent_master_id',$data['parent_master_id']);
    	$query = $this->db->get();
    	return $query->result_array();
    }
    
    function addDynamicFields($data, $field_value)
    {
    	$this->db->insert('dynamic_fields',$data);
    	$dynamic_field_id=$this->db->insert_id();
    	
	    if($dynamic_field_id)
		{
			if(!empty($field_value))
			{
				for($b=0;$b<count($field_value);$b++) {
					$addFieldValues=array(
							'field_id' => $dynamic_field_id,
							'field_value' => $field_value[$b],
							'status' => 1
					);
					$this->db->insert('dynamic_field_values',$addFieldValues);
				
				}
			}
			
			$table_info='';
			switch ($data['tab_id'])
			{
				case 11: $table_info=11;
						break;
				case 12: $table_info=12;
						break;
				case 13: $table_info=13;
						break;
				case 15: $table_info=15;
						break;
				case 16: $table_info=16;
						break;
			}
			
			if($table_info==NULL)
				$table_info=$data['module_id'];
			switch ($table_info)
			{
				case 7: $table="student";
						break;
				case 8: $table="staff";
						break;
				case 9: $table="user";
						break;
				case 11: $table="student_parent";
						break;
				case 12: $table="student_previous_info";
						break;
				case 13: $table="student_documents";
						break;
				case 15: $table="staff_contact";
						break;
				case 16: $table="staff_documents";
						break;
			}
			
			switch ($data['field_type_id'])
			{
				case 1: $type="VARCHAR";
						$constraint='100';
						break;
				case 2: $type="TEXT";
						$constraint='';
						break;
				case 3: $type="INT";
						$constraint='10';
						break;
				case 4: $type="VARCHAR";
						$constraint='100';
						break;
				case 5: $type="VARCHAR";
						$constraint='100';
						break;
				case 6: $type="DATE";
						$constraint='';
						break;
			}
			
			$fields = array(
					$data['field_name'] => array('type' => $type,'constraint'=>$constraint,'null'=>true)
			);
			$this->dbforge->add_column($table, $fields);
		}
    }
    
    function getDynamicFieldsDataTable($data)
    {
    	$this->datatables->select('display_name, ft.master_name as field_type, m.master_name as module_name,status,field_id,required,tab_id',FALSE)->from('dynamic_fields as d')
    	->join('field_master as ft', 'ft.master_id=d.field_type_id')
    	->join('field_master as m', 'm.master_id=d.module_id')->where('d.status',1);
    	return $this->datatables->generate();
    }
    
    function validateDynamicFields($data=null)
    {
    	$this->db->select('field_name');
    	$this->db->from('dynamic_fields');
    	if(isset($data))
    	{
    		$this->db->where('display_name',$data['field_name']);
    		$this->db->where('module_id',$data['module_id']);
    	}
    	$query = $this->db->get();
    	return $query->result_array();
    }
    
    function getDynamicField($data)
    {
    	$this->db->select('*');
    	$this->db->from('dynamic_fields');
    	if(isset($data))
    	{
    		$this->db->where('field_id',decode($data['field_id']));
    	}
    	$query = $this->db->get();
    	return $query->result_array();
    }
    
    function updateDynamicFieled($data,$old_field_name,$field_value)
    {
    	$this->db->where('field_id',$data['field_id']);
    	$dynamic_field_insert=$this->db->update('dynamic_fields', $data);
    	
    	if(!empty($field_value))
    	{
    		for($b=0;$b<count($field_value);$b++) {
    			$addFieldValues=array(
    					'field_id' => $data['field_id'],
    					'field_value' => $field_value[$b],
    					'status' => 1
    			);
    			$this->db->insert('dynamic_field_values',$addFieldValues);
    	
    		}
    	}
    	
    	if($dynamic_field_insert)
    	{
    		$table_info='';
			switch ($data['tab_id'])
			{
				case 11: $table_info=11;
						break;
				case 12: $table_info=12;
						break;
				case 13: $table_info=13;
						break;
				case 15: $table_info=15;
						break;
				case 16: $table_info=16;
						break;
			}
			
			if($table_info==NULL)
				$table_info=$data['module_id'];
			switch ($table_info)
			{
				case 7: $table="student";
						break;
				case 8: $table="staff";
						break;
				case 9: $table="user";
						break;
				case 11: $table="student_parent";
						break;
				case 12: $table="student_previous_info";
						break;
				case 13: $table="student_documents";
						break;
				case 15: $table="staff_contact";
						break;
				case 16: $table="staff_documents";
						break;
			}
    			
    		switch ($data['field_type_id'])
    		{
    			case 1: $type="VARCHAR";
    			$constraint='100';
    			break;
    			case 2: $type="TEXT";
    			$constraint='';
    			break;
    			case 3: $type="INT";
    			$constraint='10';
    			break;
    			case 4: $type="VARCHAR";
    			$constraint='100';
    			break;
    			case 5: $type="VARCHAR";
    			$constraint='100';
    			break;
    			case 6: $type="DATE";
    			$constraint='';
    			break;
    		}
    		
    		$fields = array($old_field_name => array(
    						'name' => $data['field_name'],
    						'type' => $type,
    						'constraint'=>$constraint,
    						'null'=>true
    				)
    		);
    		$this->dbforge->modify_column($table, $fields);
    	}
    }
    
    function deleteDynamicField($data)
    {
    	$this->db->where('field_id',$data);
    	$dynamic_field_insert=$this->db->update('dynamic_fields', array('status'=>0));
    }
    
	function getAllDynamicField($data)
    {
    	$this->db->select('*');
    	$this->db->from('dynamic_fields');
    	if(isset($data['module_id']))
    	{
    		$this->db->where('module_id',$data['module_id']);
    	}
    	if(isset($data['tab_id']))
    	{
    		$this->db->where('tab_id',$data['tab_id']);
    	}
    	if(isset($data['sub_tab_id']))
    	{
    		$this->db->where('sub_tab_id',$data['sub_tab_id']);
    	}
    	$query = $this->db->get();
    	return $query->result_array();
    } 
    
    function addFieldValues($data)
    {
    	$this->db->insert('dynamic_field_values',$data);
    	return $this->db->insert_id();
    }
    
    function getFieldsOption($data)
    {
    	$this->db->select('*');
    	$this->db->from('dynamic_field_values');
    	if(isset($data['field_id']))
    	{
    		$this->db->where('field_id',$data['field_id']);
    	}
    	$query = $this->db->get();
    	return $query->result_array();
    }
}
?>