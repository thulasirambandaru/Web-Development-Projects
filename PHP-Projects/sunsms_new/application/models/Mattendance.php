<?php
/**
 * Created by PhpStorm.
 * User: VENKATESH-LENOVO
 * Date: 02-07-2016
 * Time: 05:09 PM
 */
class Mattendance extends CI_Model
{
    var $table = 'attendance';
    var $table1 = 'attendance_data';
    var $column_order = array('id_attendance','class_id','section_id',null); //set column field database for datatable orderable
    var $column_search = array('id_attendance','class_id','section_id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('id_attendance' => 'desc'); // default order

    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
    }

    function getAttendance($data)
    {
        if(isset($data['academic_year_id']))
            $this->db->where('academic_year_id',$data['academic_year_id']);
        if(isset($data['board_id']))
            $this->db->where('board_id',$data['board_id']);
        if(isset($data['course_id']))
            $this->db->where('course_id',$data['course_id']);
        if(isset($data['section_id']))
            $this->db->where('section_id',$data['section_id']);
        if(isset($data['staff_id']))
            $this->db->where('staff_id',$data['staff_id']);
        $query = $this->db->get($this->table);
        //echo $this->db->last_query();
        return $query->result_array();
    }

    function getStudents($data)
    {
        if(isset($data['board_id']))
            $this->db->where('board_id',$data['board_id']);
        if(isset($data['course_id']))
            $this->db->where('course_id',$data['course_id']);
        if(isset($data['section_id']))
            $this->db->where('section_id',$data['section_id']);
        $query = $this->db->get('student');
        return $query->result_array();
    }

    function getAttendanceData($data)
    {//echo "<pre>";print_r($data); exit;
        $this->db->select('*,DATE_FORMAT(date,"%e") as day');
        $this->db->from('attendance_data');
        if(isset($data['attendance_id']))
            $this->db->where('attendance_id',$data['attendance_id']);
        if(isset($data['student_id']))
            $this->db->where('student_id',$data['student_id']);
        if(isset($data['month']))
            $this->db->where('DATE_FORMAT(date,"%m")',$data['month']);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }

    function getWeekdays($data)
    {
        $this->db->select('*');
        $this->db->from('week_day w');
        if(isset($data['school_id']))
            $this->db->where('school_id',$data['school_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
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


    function addAttendance($data)
    {
        $this->db->insert('attendance',$data);
        return $this->db->insert_id();
    }

    function addAttendanceData($data)
    {
        $this->db->insert('attendance_data',$data);
        return $this->db->insert_id();
    }

    function updateAttendanceData($data)
    {
        $this->db->where('id_attendance_data',$data['id_attendance_data']);
        $this->db->update('attendance_data',$data);
        return 1;
    }

    function getStaff()
    {
        $this->db->select('*');
        $this->db->from('staff');
        if(isset($data['school_id']))
            $this->db->where('school_id',$data['school_id']);
        if(isset($data['staff_status']))
            $this->db->where('staff_status',$data['staff_status']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getUser($data)
    {
        $this->db->select('*');
        $this->db->from('user');
        if(isset($data['user_id']))
            $this->db->where('id_user',$data['user_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function deleteAttendanceData($data)
    {
        $this->db->where('id_attendance_data',$data['id_attendance_data']);
        $this->db->delete('attendance_data');
        return 1;
    }

}

