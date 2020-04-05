<?php
class MStudent extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
    }

    function getStudentDataTable($data, $user_type_id, $user_id)
    {
        $this->datatables->select('CONCAT_WS(" ",s.first_name, s.last_name) as sname,s.admission_number,b.board_name,c.course_name,se.section_name,s.gender,s.id_student',FALSE)
		->from('student s')
		->join('board b','b.id_board=s.board_id','inner')
		->join('course c','c.id_course=s.course_id','inner')
		->join('section se','se.id_section=s.section_id','left');
		if($user_type_id == STUDENT)
			$this->datatables->where('s.fk_id_user',$user_id);
		if($user_type_id == PARENT_ID) {
			$this->datatables->join('student_parent_assoc sp', 's.id_student=sp.student_id','inner');
			$this->datatables->where('sp.user_id',$user_id);
			$this->datatables->group_by('sp.id_student_parent');
		}
			
		$this->datatables->group_by('s.id_student');
		//echo $this->db->last_query();die;
        return $this->datatables->generate();
    }
	
	function getNewAdmissionsDataTable($data, $academic_data)
    {
        $this->datatables->select('CONCAT_WS(" ",s.first_name, s.last_name) as sname,s.admission_number,b.board_name,c.course_name,se.section_name,s.gender,s.id_student',FALSE)
		->from('student s')
		->join('user u', 's.fk_id_user=u.id_user')
		->join('board b','b.id_board=s.board_id','inner')
		->join('course c','c.id_course=s.course_id','inner')
		->join('section se','se.id_section=s.section_id','left')
		->where('u.user_status',1)
		->where('s.admission_date >=', $academic_data[0]['start_date'])
		->where('s.admission_date <=', $academic_data[0]['end_date'])
		->group_by('s.id_student');
        return $this->datatables->generate(); 		
    }
	
    function addStudent($data){
        $this->db->insert('student',$data);
        return $this->db->insert_id();
    }

    function updateStudent($data){
        $this->db->where('id_student',$data['id_student']);
        $this->db->update('student', $data);
    }

    function addParent($data){
        $this->db->insert('student_parent',$data);
        return $this->db->insert_id();
    }
	
	function addStudentParentAssoc($data){
        $this->db->insert('student_parent_assoc',$data);
        return $this->db->insert_id();
    }

    function updateParent($data){
        $this->db->where('id_parent',$data['id_parent']);
        $this->db->update('student_parent', $data);
    }

    function createStudentPreviousInfo($data){
        $this->db->insert('student_previous_info',$data);
        return $this->db->insert_id();
    }

    function updateStudentPreviousInfo($data){
        $this->db->where('id_student_previous_info',$data['id_student_previous_info']);
        $this->db->update('student_previous_info', $data);
    }

    public function addStudentDocuments($data){
        $this->db->insert('student_documents',$data);
        return $this->db->insert_id();
    }

    public function deleteStudentDocuments($data){
        if ($data) {
            for ($i = 0; $i <= count($data); $i++)
            {
				$this->db->select('*');
				$this->db->from('student_documents');
				$this->db->where('id_student_document',$data[$i]);
				$query = $this->db->get();
				$records = $query->result_array();
				
				if(unlink($records[0]['document_source']))
					$this->db->delete('student_documents', array('id_student_document' => $data[$i]));
            }
        }
    }

    function getCourseByBoard($data) {
        $this->db->select('*');
        $this->db->from('course');
        if(isset($data['board_id']))
            $this->db->where('board_id',$data['board_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getSectionByCourse($data) {
        $this->db->select('*');
        $this->db->from('section');
        if(isset($data['course_id']))
            $this->db->where('course_id',$data['course_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        return $query->result_array();
    }
	
    function getExistParentInfo($data) {
        $this->db->select('sp.parent_first_name,sp.parent_last_name,sp.id_parent,st.first_name,st.last_name,st.id_student,c.course_name, spa.user_id');
        $this->db->from('student_parent sp');
        $this->db->join('student_parent_assoc spa','sp.id_parent=spa.parent_id','inner');
        $this->db->join('student st','st.id_student=spa.student_id','inner');
        $this->db->join('course c','c.id_course=st.course_id','inner');
        $this->db->or_like('sp.parent_first_name', $data['parent_first_name']);        
        $this->db->or_like('sp.parent_last_name', $data['parent_last_name']);
		//$this->db->group_by('spa.parent_id');
        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function getStudent($data){
        $this->db->select('s.*,st.id_country,s.fk_id_user as id_user,s.id_student');
        $this->db->from('student s');
        $this->db->join('user u','s.fk_id_user=u.id_user');
        //$this->db->join('city c','c.id_city=s.fk_city_id','left');
        //$this->db->join('state st','st.id_state=c.state_id','left');
        $this->db->join('country st','st.id_country=s.fk_country_id','left');
        if(isset($data['id_student']))
            $this->db->where('s.id_student', $data['id_student']);
        if(isset($data['user_id']))
            $this->db->where('s.user_id', $data['user_id']);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function getParent($data){
        $this->db->select('s.*,sp.*,st.id_country');
        $this->db->from('student_parent s');
        $this->db->join('student_parent_assoc sp','s.id_parent=sp.parent_id');        
        //$this->db->join('user u','sp.user_id=u.id_user');        
        $this->db->join('country st','st.id_country=s.parent_fk_country_id','left');
        if(isset($data['id_student']))
            $this->db->where('sp.student_id', $data['id_student']);
        if(isset($data['user_id']))
            $this->db->where('sp.user_id', $data['user_id']);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function getStudentPrevoiusInfo($data){
        $this->db->select('*');
        $this->db->from('student_previous_info s');
        if(isset($data['id_student']))
            $this->db->where('s.student_id', $data['id_student']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStudentDocuments($data){
        $this->db->select('*');
        $this->db->from('student_documents s');
        if(isset($data['id_student']))
            $this->db->where('s.student_id', $data['id_student']);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function getTotalStudents() {
		$this->db->select('count(id_student) as Student_CNT');
        $this->db->from('student s');
		$this->db->join('user u', 's.fk_id_user=u.id_user');
		$this->db->where('u.user_status',1);
		$query = $this->db->get();
        $result = $query->row();
		return $result->Student_CNT;  
	}
	
	public function getNewAdmissions($academic_data) {
		$this->db->select('count(id_student) as Admissions_CNT');
        $this->db->from('student s');
		$this->db->join('user u', 's.fk_id_user=u.id_user');
		$this->db->where('u.user_status',1);
		$this->db->where('s.admission_date >=', $academic_data[0]['start_date']);
		$this->db->where('s.admission_date <=', $academic_data[0]['end_date']);	
		$query = $this->db->get();
		$result = $query->row();
		return $result->Admissions_CNT;
	}
	
	public function getTotalEmployees() {
		$this->db->select('count(id_staff) as Staff_CNT');
        $this->db->from('staff s');
		$this->db->join('user u', 's.fk_id_user=u.id_user');
		$this->db->where('u.user_status',1);
		$query = $this->db->get();
        $result = $query->row();
		return $result->Staff_CNT;  
	}
	
	function getStudentInfo($data)
	{
		$query=$this->db->select('CONCAT_WS(" ",s.first_name, s.last_name) as student_name,s.admission_number,b.board_name,c.course_name,se.section_name,s.id_student',FALSE)
		->from('student s')
		->join('board b','b.id_board=s.board_id','inner')
		->join('course c','c.id_course=s.course_id','inner')
		->join('section se','se.id_section=s.section_id','left')
		->or_like('s.first_name', $data['first_name'])
		->or_like('s.middle_name', $data['middle_name'])
		->or_like('s.last_name', $data['last_name'])
		->get();
		return $query->result_array();
	}
}