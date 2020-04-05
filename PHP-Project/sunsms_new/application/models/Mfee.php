<?php
/**
 * Created by PhpStorm.
 * User: VENKATESH-LENOVO
 * Date: 02-07-2016
 * Time: 05:09 PM
 */
class Mfee extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
    }

    function getFeeType($data)
    {
        $this->db->select('*');
        if(isset($data['id_fee_type']))
            $this->db->where('id_fee_type',$data['id_fee_type']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get('fee_type');
        return $query->result_array();
    }

    function getFeeStructure($data)
    {
        $this->db->select('*');
        $this->db->from('fee_structure');
        if(isset($data['academic_year_id']))
            $this->db->where('academic_year_id',$data['academic_year_id']);
        if(isset($data['board_id']))
            $this->db->where('board_id',$data['board_id']);
        if(isset($data['class_id']))
            $this->db->where('class_id',$data['class_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        else if(isset($data['status-all'])){}
        else{
            $this->db->where('status',1);
        }


        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function getFeeStructureDataTable($data)
    {
        $this->datatables->select('fs.id_fee_structure,b.board_name,c.course_name,amount,fee_type',FALSE)
            ->from('fee_structure As fs')
            ->join('board b','fs.board_id=b.id_board','left')
            ->join('course c','fs.class_id=c.id_course','left')
            ->join('class_fee cf','fs.id_fee_structure=cf.fee_structure_id','left')
            ->join('fee_type ft','cf.fee_type_id=ft.id_fee_type','left');

        return $this->datatables->generate();
    }

    function getClassFee($data)
    {
        $this->db->select('*');
        $this->db->from('class_fee cf');
        $this->db->join('fee_type ft','cf.fee_type_id=ft.id_fee_type','left');
        $this->db->join('fee_structure fs','fs.id_fee_structure=cf.fee_structure_id','left');
        if(isset($data['academic_year_id']))
            $this->db->where('fs.academic_year_id',$data['academic_year_id']);
        if(isset($data['class_id']))
            $this->db->where('fs.class_id',$data['class_id']);
        $this->db->order_by('cf.fee_type_id','ASC');
        $query =  $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function getClassFeeStructure($data)
    {
        $this->db->select('*,fs.status as class_fee_status',FALSE);
        $this->db->from('fee_structure As fs');
        $this->db->join('board b','fs.board_id=b.id_board','left');
        $this->db->join('course c','fs.class_id=c.id_course','left');
        $this->db->join('class_fee cf','fs.id_fee_structure=cf.fee_structure_id','left');
        $this->db->join('fee_type ft','cf.fee_type_id=ft.id_fee_type','right');

        if(isset($data['id_fee_structure'])){
            $this->db->where('id_fee_structure',$data['id_fee_structure']);
        }
        if(isset($data['academic_year']))
            $this->db->where('fs.academic_year_id',$data['academic_year']);

        if(isset($data['class_id']))
            $this->db->where('fs.class_id',$data['class_id']);

        $this->db->order_by('ft.id_fee_type','ASC');
        $query =  $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function addFeeStructure($data)
    {
        $this->db->insert('fee_structure',$data);
        return $this->db->insert_id();
    }

    function updateFeeStructure($data)
    {
        $this->db->where('id_fee_structure',$data['id_fee_structure']);
        $this->db->update('fee_structure',$data);
        return 1;
    }

    function addClassFee_batch($data)
    {
        $this->db->insert_batch('class_fee',$data);
        return $this->db->insert_id();
    }

    function getAcademicYear($data)
    {
        $this->db->select('*');
        $this->db->from('academic_year');
        if(isset($data['school_id']))
            $this->db->where('school_id',$data['school_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function updateClassFee_batch($data)
    {
        $this->db->update_batch('class_fee',$data, 'id_class_fee');
    }

    function getStudentFee($data)
    {
        $query = $this->db->query('select *,(total-paid) as due from (select s.id_student as id,cu.course_name,se.section_name,s.admission_number,CONCAT(s.first_name," ",s.middle_name) as name,IFNULL(sum(sf.amount),0) as paid,
                            (SELECT sum(amount) from class_fee cf LEFT JOIN fee_structure fs on cf.fee_structure_id=fs.id_fee_structure
                                    LEFT JOIN board b on fs.board_id=b.id_board
                                    where fs.class_id='.$data['course_id'].') as total from student s
                            left join student_fee sf on s.id_student=sf.student_id
                            left join section se on s.section_id=se.id_section
                            left join course cu on se.course_id=cu.id_course
                            where section_id='.$data['section_id'].' GROUP BY s.id_student)tmp');
        return $query->result_array();

    }

    function getStudent($data)
    {
        $this->db->select('s.*,se.*,cu.*,b.*');
        $this->db->from('student s');
        $this->db->join('section se','s.section_id=se.id_section','left');
        $this->db->join('course cu','se.course_id=cu.id_course','left');
        $this->db->join('board b','cu.board_id=b.id_board','left');
        if(isset($data['id_student'])) {
            $this->db->where('s.id_student', $data['id_student']);
        }
        if(isset($data['section'])){
            $this->db->where('s.section_id', $data['section']);
        }

        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();

    }

    public function getStudentFeeDetails($data)
    {
        $this->datatables->select('ft.fee_type,sf.amount,sf.due,DATE_FORMAT(sf.created_date,\'%d %b %y\') as date',FALSE)
            ->from('student_fee sf')
            ->join('class_fee cf','sf.class_fee_id=cf.id_class_fee','left')
            ->join('fee_type ft','cf.fee_type_id=ft.id_fee_type','left')
            ->where('sf.student_id',$data['student_id']);

        return $this->datatables->generate();
    }

    public function getStudentFeeDetailsList($data)
    {
        $this->db->select('ft.fee_type,sf.amount,sf.due,DATE_FORMAT(created_date,\'%d %b %y\') as date');
        $this->db->from('student_fee sf');
        $this->db->join('class_fee cf','sf.class_fee_id=cf.id_class_fee','left');
        $this->db->join('fee_type ft','cf.fee_type_id=ft.id_fee_type','left');
        $this->db->where('sf.student_id',$data['id_student']);
        $this->db->order_by('sf.id_student_fee','DESC');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function addAmount($data)
    {
        $this->db->insert('student_fee',$data);
        return $this->db->insert_id();
    }

    public function getTotalFeeAmount($data)
    {
        $this->db->select('sum(cf.amount) as amount,cf.id_class_fee');
        $this->db->from('fee_structure fs');
        $this->db->join('class_fee cf','fs.id_fee_structure=cf.fee_structure_id','left');
        if(isset($data['academic_year_id']))
            $this->db->where('fs.academic_year_id',$data['academic_year_id']);
        if(isset($data['class_id']))
            $this->db->where('fs.class_id',$data['class_id']);
		$this->db->group_by('cf.id_class_fee');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }
    public function getTotalFeeCollected($data)
    {
        $this->db->select('iFNULL(sum(sf.amount),0) as amount');
        $this->db->from('fee_structure fs');
        $this->db->join('class_fee cf','fs.id_fee_structure=cf.fee_structure_id','left');
        $this->db->join('student_fee sf','cf.id_class_fee=sf.class_fee_id','left');
        if(isset($data['academic_year_id']))
            $this->db->where('fs.academic_year_id',$data['academic_year_id']);
        if(isset($data['class_id']))
            $this->db->where('fs.class_id',$data['class_id']);
        if(isset($data['class_fee_id']))
            $this->db->where('sf.class_fee_id',$data['class_fee_id']);
        if(isset($data['student_id']))
            $this->db->where('sf.student_id',$data['student_id']);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function getFeeTypeDataTable($data)
    {
        $this->datatables->select('fee_type,status,id_fee_type',FALSE)
            ->from('fee_type');

        return $this->datatables->generate();
    }

    public function updateFeeType($data)
    {
        $this->db->where('id_fee_type',$data['id_fee_type']);
        $this->db->update('fee_type',$data);
        return 1;
    }

    public function addFeeType($data)
    {
        $this->db->insert('fee_type',$data);
        return 1;
    }


}

