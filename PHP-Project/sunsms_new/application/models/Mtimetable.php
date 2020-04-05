<?php
class Mtimetable extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
    }

    function getClassTimeTableDataTable($data, $user_type_id, $input_arr=null)
    {	
        $this->datatables->select('b.board_name,c.course_name,s.section_name,ct.start_date,ct.end_date,ct.status,ct.id_class_time_table',FALSE)
            ->from('class_time_table ct')            
            ->join('course c','c.id_course=ct.course_id','left')
			->join('board b','b.id_board=c.board_id','left')
			->join('section s','s.id_section = ct.section_id', 'left outer');			
		
		if($user_type_id == TEACHER)			
			$this->datatables->where_in('ct.id_class_time_table',$input_arr);
		else if($user_type_id == PARENT_ID || $user_type_id == STUDENT)
			$this->datatables->where_in('ct.course_id',$input_arr);
		
		$this->datatables->where('fk_id_academic_year',$this->session->userdata('academic_year'));
					
        return $this->datatables->generate();
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
	
    function getClassTimeTable($data)
    {
        $this->db->select('*');
        $this->db->from('class_time_table ct');
		$this->db->join('course c','c.id_course=ct.course_id','left');
        if(isset($data['id_class_time_table']))
            $this->db->where('id_class_time_table',$data['id_class_time_table']);
		if(isset($data['course_id']))
            $this->db->where('course_id',$data['course_id']);
		if(isset($data['status']))
            $this->db->where('ct.status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addClassTimeTable($data)
    {
        $this->db->insert('class_time_table',$data);
        return $this->db->insert_id();
    }

    function updateClassTimeTable($data)
    {
        $this->db->where('id_class_time_table',$data['id_class_time_table']);
        $this->db->update('class_time_table', $data);
        //echo $this->db->last_query(); exit;
        return 1;
    }

    function addTimeTable($data)
    {
        $this->db->insert_batch('time_table',$data);
        return $this->db->insert_id();
    }

    function getTimeTableData($data)
    {
        $this->db->select('*');
        $this->db->from('time_table tt');
        $this->db->join('subject s','tt.subject_id=s.id_subject','left');
        $this->db->join('staff st','tt.teacher_id=st.id_staff','left');
        if(isset($data['class_time_table_id']))
            $this->db->where('tt.class_time_table_id',$data['class_time_table_id']);
        if(isset($data['class_timing_id']))
            $this->db->where('tt.class_timing_id',$data['class_timing_id']);
        if(isset($data['day_id']))
            $this->db->where('tt.day_id',$data['day_id']);
        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function updateTimeTable($data)
    {
        $this->db->update_batch('time_table', $data, 'id_time_table');
    }

    function deleteTimeTable($id)
    {
        $this->db->where('class_time_table_id',$id);
        $this->db->delete('time_table');
        return 1;
    }
	
	function disableExistingTimetable($data)
	{
		$this->db->select('id_class_time_table');
        $this->db->from('class_time_table ct');
		
		if(isset($data['course_id'])) {
            $this->db->where('course_id',$data['course_id']);		
            $this->db->where('ct.status',1);
		}

		if(isset($data['section_id'])) {
            $this->db->where('section_id',$data['section_id']);		
            $this->db->where('ct.status',1);
		}
        $query = $this->db->get();
		if($query->num_rows() > 0 ) {
			$record = $query->result_array();			
			$this->db->where('id_class_time_table', $record[0]['id_class_time_table']);
			$this->db->update('class_time_table', array('status' => 0));			
			return 1;
		}        
	}
	
    function deleteClassTimeTable($id)
    {
        $this->db->where('id_class_time_table',$id);
        $this->db->delete('class_time_table');
        return 1;
    }
	
}
?>