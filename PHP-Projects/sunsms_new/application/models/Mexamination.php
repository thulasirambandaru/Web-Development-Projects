<?php

class Mexamination extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
    }
	
	function getExamDataTable($data)
    {	
        $this->datatables->select('e.exam_name,e.status,e.created,e.id_exam',FALSE)
            ->from('examination e')                        		
			->where('fk_id_academic_year',$this->session->userdata('academic_year'));					
        return $this->datatables->generate();
    }
	
	function getExam($data=null)
    {	
        $this->db->select('*');
        $this->db->from('examination e');
		if(isset($data['id_exam']))
			$this->db->where('id_exam',$data['id_exam']);
		if(isset($data['status']))
			$this->db->where('status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }
	
    function addExam($data)
    {
        $this->db->insert('examination',$data);
        return $this->db->insert_id();
    }

    function updateExam($data)
    {
        $this->db->where('id_exam',$data['id_exam']);
        $this->db->update('examination', $data);        
        return 1;
    }
	
	function deleteExam($id)
    {
        $this->db->where('id_exam',$id);
        $this->db->delete('examination');
        return 1;
    }
	
	function getExamSchedule($data=null)
    {	
        $this->db->select('*');
        $this->db->from('exam_schedule es');
        $this->db->join('exam_schedule_data ed', 'ed.exam_schedule_id=es.id_exam_schedule');
        $this->db->join('course c','c.id_course=es.course_id','left');
        $this->db->join('subject s','s.id_subject=ed.subject_id','left');		
		$this->db->where('s.status', 1);
		if(isset($data['id_exam_schedule']))
			$this->db->where('id_exam_schedule',$data['id_exam_schedule']);
		if(isset($data['status']))
			$this->db->where('status',$data['status']);
		$this->db->order_by('id_exam_schedule_data', 'ASC');
        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        return $query->result_array();
    }
	
	function createExamSchedule($data)
    {
        $this->db->insert('exam_schedule',$data);
        return $this->db->insert_id();
    }
	
	function getExamScheduleDataTable($data)
    {	
        $this->datatables->select('b.board_name,c.course_name,s.section_name,e.exam_name,es.id_exam_schedule')
            ->from('exam_schedule es')     
			->join('examination e','e.id_exam=es.exam_id','left')
            ->join('course c','c.id_course=es.course_id','left')
			->join('board b','b.id_board=c.board_id','left')			
			->join('section s','s.id_section = es.section_id', 'left outer')
			->where("(e.status=1 OR e.status IS NULL)")
			->where("(b.status=1 OR b.status IS NULL)")
			->where("(c.status=1 OR c.status IS NULL)")
			->where("(s.status=1 OR s.status IS NULL)");
			
        return $this->datatables->generate();
    }
	
	function createExamScheduleData($data)
    {
        $this->db->insert('exam_schedule_data',$data);
        return $this->db->insert_id();
    }
	
	function updateExamScheduleData($data)
    {
        $this->db->where('id_exam_schedule_data',$data['id_exam_schedule_data']);
        $this->db->update('exam_schedule_data', $data);        
        return 1;
    }
	
	function checkForRecord($data)
	{
		$this->db->select('id_exam_schedule_data');
        $this->db->from('exam_schedule_data');
		$this->db->where('exam_schedule_id', $data['exam_schedule_id']);
		$this->db->where('subject_id', $data['subject_id']);
		$query = $this->db->get();
        return $query->result_array();
	}
	
	function deleteExamSchedule($id)
    {
		// Delete exam schedule data records first
		$this->db->where('exam_schedule_id',$id);
		$this->db->delete('exam_schedule_data');
		
		// Delete exam schedule record
        $this->db->where('id_exam_schedule',$id);
        $this->db->delete('exam_schedule');
        return 1;
    }
	
	function getExamGradesDataTable($data)
    {	
        $this->datatables->select('eg.grade_name, eg.grade_value, eg.lower_mark, eg.upper_mark, eg.id_exam_grades')
            ->from('exam_grades eg');			
        return $this->datatables->generate();
    }
	
	function getExamGrades($data=null)
    {	
        $this->db->select('*');
        $this->db->from('exam_grades eg');        
		if(isset($data['id_exam_grades']))
			$this->db->where('id_exam_grades',$data['id_exam_grades']);		
		$this->db->order_by('id_exam_grades', 'ASC');
        $query = $this->db->get();
		//echo $this->db->last_query(); exit;
        return $query->result_array();
    }
	
	function createExamGrades($data)
    {
        $this->db->insert('exam_grades',$data);
        return $this->db->insert_id();
    }
	
	function updateExamGrades($data)
    {
        $this->db->where('id_exam_grades',$data['id_exam_grades']);
        $this->db->update('exam_grades', $data);        
        return 1;
    }
	
	function deleteExamGrades($id)
    {		
		$this->db->where('id_exam_grades',$id);
		$this->db->delete('exam_grades');
        return 1;
    }
	
	function getStudentMarks($data) {
		$this->db->select('s.id_student, s.first_name, s.last_name, s.admission_number, m.subject_mark, m.subject_point, m.subject_grade');
        $this->db->from('student s');
		$this->db->join('user u', 's.fk_id_user=u.id_user', 'inner');
		$this->db->join('exam_marks m', 's.id_student=m.student_id AND m.subject_id='.$data['subject_id'], 'left outer');
		$this->db->where('s.course_id', $data['course_id']);
		if($data['section_id'] > 0)
			$this->db->where('s.section_id', $data['section_id']);
		/*if($data['subject_id'] > 0)
			$this->db->where('m.subject_id', $data['subject_id']);*/
		$this->db->where('user_status', 1);
		$this->db->order_by('s.first_name', 'ASC');
		$query = $this->db->get();		
		//echo $this->db->last_query();
        return $query->result_array();
	}
	
	function getExamMarksForReport($data) {
		$this->db->select('s.id_student, s.first_name, s.last_name, m.subject_grade, m.subject_id, su.subject_name, m.subject_point, m.subject_mark');
        $this->db->from('student s');
		$this->db->join('user u', 's.fk_id_user=u.id_user', 'inner');		
		$this->db->join('exam_marks m', 's.id_student=m.student_id', 'left outer');
		$this->db->join('subject su', 'su.id_subject=m.subject_id', 'left outer');
		$this->db->where('m.exam_id', $data['exam_id']);
		$this->db->where('s.course_id', $data['course_id']);
		if($data['section_id'] > 0)
			$this->db->where('s.section_id', $data['section_id']);				
		$this->db->where('user_status', 1);
		$this->db->order_by('s.first_name, m.subject_id', 'ASC');
		$query = $this->db->get();		
		//echo $this->db->last_query();
        return $query->result_array();
	}
	
	function getGradeByPoints($total_point) {
		$this->db->select('grade_name');
		$this->db->from('exam_grades');
		$this->db->where('grade_value', $total_point);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	function deleteExamMarks($id)
    {		
		$this->db->select('exam_id, subject_id');
		$this->db->from('exam_marks');		
		$this->db->where('id_exam_marks',$id);
		$query = $this->db->get();
		$row = $query->result();
				
		$this->db->where('exam_id',$row[0]->exam_id);		
		$this->db->where('subject_id',$row[0]->subject_id);		
		$this->db->delete('exam_marks');
        return 1;
    }
	
	function getExamMarksRecord($data=null)
    {	
        $this->db->select('m.*, s.board_id,s.course_id,s.section_id');
        $this->db->from('exam_marks m');
		$this->db->join('student s','s.id_student=m.student_id','inner');
		//$this->db->join('subject su','su.sub=m.student_id','inner');
		if(isset($data['id_exam_marks']))
			$this->db->where('id_exam_marks',$data['id_exam_marks']);		
        $query = $this->db->get();		
        return $query->result_array();
    }
	
	function generateExamReports($data)
    {
        $this->db->insert_batch('exam_marks_total',$data);
        return $this->db->insert_id();
    }
	
	function getSubjectPoint($data) {
		$this->db->select('grade_value, grade_name');
        $this->db->from('exam_grades');				
		$score = $data['score'];
		$point = $data['point'];
		
		if($score!=null)
			$this->db->where("$score BETWEEN lower_mark and upper_mark");
		
		if($point!=null)
			$this->db->where('grade_value', $data['point']);
		
		$query = $this->db->get();	
		//echo $this->db->last_query();
        return $query->result_array();
	}
	
	function checkExamMarkEntries() {
		$this->db->select('id_exam_marks');
		$this->db->from('exam_marks');
		$this->db->where('exam_id', $_POST['exam_id']);		
		$this->db->where('subject_id', $_POST['course_subject_id']);		
		$query = $this->db->get();			
        return $query->num_rows();
	}
	
	function createExamMarks($data)
    {
        $this->db->insert_batch('exam_marks',$data);
        return $this->db->insert_id();
    }
	
	function updateExamMarks($data)
    {			
		$this->db->where('exam_id', $_POST['exam_id']);
		$this->db->where('subject_id', $_POST['course_subject_id']);
        $this->db->update_batch('exam_marks', $data, 'student_id');
        return 1;
    }
	
	function getExamMarksDataTable($data)
    {	
        $this->datatables->select('b.board_name,c.course_name,se.section_name,e.exam_name,su.subject_name,id_exam_marks')
            ->from('exam_marks em')     
			->join('examination e','e.id_exam=em.exam_id','left')
            ->join('subject su','su.id_subject=em.subject_id','left')
            ->join('student s','s.id_student=em.student_id','left')
			->join('board b','b.id_board=s.board_id','left')			
			->join('course c','c.id_course=s.course_id','left')			
			->join('section se','se.id_section = s.section_id', 'left outer')
			->where("(e.status=1 OR e.status IS NULL)")
			->where("(b.status=1 OR b.status IS NULL)")
			->where("(c.status=1 OR c.status IS NULL)")
			->where("(se.status=1 OR se.status IS NULL)")
			->where('e.fk_id_academic_year',$this->session->userdata('academic_year'))
			->group_by('em.exam_id, em.subject_id');
			
        return $this->datatables->generate();
    }
	
} 