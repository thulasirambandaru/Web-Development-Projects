<?php

class McommonFuncs extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
    }

    function getStaffIdByUserID($user_id) 
	{
		$this->db->select('id_staff');
        $this->db->from('staff');
        $this->db->where('fk_id_user', $user_id);
		$query = $this->db->get();
		return $query->result_array()[0]['id_staff'];
	}
	
	function getCourseByParentorStudent($user_id, $user_type_id)
	{
		$this->db->select('course_id');
        $this->db->from('student s');
		if($user_type_id == PARENT_ID) {
			$this->db->join('student_parent_assoc sp', 's.id_student=sp.student_id','inner');
			$this->db->where('user_id', $user_id);
		}
		else
			$this->db->where('fk_id_user', $user_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getTimetableByTeacherID($teacher_id) 
	{
		$this->db->distinct();
		$this->db->select('class_time_table_id');
        $this->db->from('time_table');
        $this->db->where('teacher_id', $teacher_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function getCourseSubjects($data) {
        $this->db->select('*');
        $this->db->from('subject');
        if(isset($data['course_id']))
            $this->db->where('course_id',$data['course_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
		$this->db->order_by('id_subject', 'ASC');
        $query = $this->db->get();		
        return $query->result_array();
    }
	
	function getSubjectsCount($data) {        
		$this->db->distinct();
		$this->db->select('subject_name');
        $this->db->from('subject');        
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();		
        return $query->num_rows();
    }

} 