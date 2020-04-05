<?php
/**
 * Created by PhpStorm.
 * User: VENKATESH-LENOVO
 * Date: 02-07-2016
 * Time: 05:09 PM
 */
class Mhostel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
    }

    function getHostelType($data)
    {
        $this->db->select('*');
        if(isset($data['id_hostel_type']))
            $this->db->where('id_hostel_type',$data['id_hostel_type']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get('hostel_type');
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


    public function getHostelTypeDataTable($data)
    {
        $this->datatables->select('hostel_type,status,id_hostel_type',FALSE)
            ->from('hostel_type');

        return $this->datatables->generate();
    }

    public function updateHostelType($data)
    {
        $this->db->where('id_hostel_type',$data['id_hostel_type']);
        $this->db->update('hostel_type',$data);
        return 1;
    }

    public function addHostelType($data)
    {
        $this->db->insert('hostel_type',$data);
        return 1;
    }

    public function getHostelDataTable()
    {
        $this->datatables->select('ht.hostel_type,h.hostel_name,h.hostel_phone_number,h.warden_name,h.warden_phone_number,h.status,h.id_hostel',FALSE)
            ->from('hostel h')
            ->join('hostel_type ht','h.hostel_type_id=ht.id_hostel_type','left');

        return $this->datatables->generate();
    }

    public function getHostel($data = array())
    {
        $this->db->select('*');
        $this->db->from('hostel h');
        $this->db->join('hostel_type ht','h.hostel_type_id=ht.id_hostel_type','left');
        if(isset($data['id_hostel']))
            $this->db->where('h.id_hostel',$data['id_hostel']);
        if(isset($data['id_hostel_not']))
            $this->db->where('h.id_hostel !=',$data['id_hostel_not']);
        if(isset($data['hostel_name']))
            $this->db->where('h.hostel_name',$data['hostel_name']);

        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function addHostel($data)
    {
        $this->db->insert('hostel',$data);
        return 1;
    }

    public function updateHostel($data)
    {
        $this->db->where('id_hostel',$data['id_hostel']);
        $this->db->update('hostel',$data);
        return 1;
    }

    public function getFloorDataTable($data)
    {
        $this->datatables->select('h.hostel_name,f.floor_number,f.no_of_rooms,f.status,f.id_floor',FALSE)
            ->from('floor f')
            ->join('hostel h','h.id_hostel=f.hostel_id','left');

        return $this->datatables->generate();
    }

    public function getFloor($data)
    {
        $this->db->select('*');
        $this->db->from('floor f');
        $this->db->join('hostel h','f.hostel_id=h.id_hostel','left');
        $this->db->join('room r','f.id_floor=r.floor_id','left');
        if(isset($data['hostel_id']))
            $this->db->where('f.hostel_id',$data['hostel_id']);
        if(isset($data['floor_number']))
            $this->db->where('f.floor_number',$data['floor_number']);
        if(isset($data['floor_id_not']) && $data['floor_id_not'])
            $this->db->where('f.id_floor!=',$data['floor_id_not']);
        if(isset($data['id_floor']) && $data['id_floor'])
            $this->db->where('f.id_floor',$data['id_floor']);
        if(isset($data['status']))
            $this->db->where('f.status',$data['status']);
        if(isset($data['group_by']))
            $this->db->group_by($data['group_by']);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function addFloor($data)
    {
        $this->db->insert('floor',$data);
        return $this->db->insert_id();
    }

    public function updateFloor($data)
    {
        $this->db->where('id_floor',$data['id_floor']);
        $this->db->update('floor',$data);
        return 1;
    }

    public function addRoom($data)
    {
        $this->db->insert('room',$data);
        return $this->db->insert_id();
    }

    public function addBed($data)
    {
        $this->db->insert('bed',$data);
        return $this->db->insert_id();
    }

    public function deleteRoom($data)
    {
        $this->db->where('id_room',$data['id_room']);
        $this->db->delete('room');
        return 1;
    }

    public function deleteBed($data)
    {
        $this->db->where('room_id',$data['id_room']);
        $this->db->delete('bed');
        return 1;
    }

    public function checkRoomNumber($data)
    {
        $this->db->select('*');
        $this->db->from('room r');
        $this->db->join('floor f','r.floor_id=f.id_floor','left');
        if(isset($data['hostel_id']))
            $this->db->where('f.hostel_id',$data['hostel_id']);
        if(isset($data['floor_number']))
            $this->db->where('f.floor_number',$data['floor_number']);
        if(isset($data['room_number']))
            $this->db->where('r.room_number',$data['room_number']);
        if(isset($data['room_id']))
            $this->db->where('r.id_room',$data['room_id']);
        if(isset($data['room_id_not']))
            $this->db->where('r.id_room !=',$data['room_id_not']);
        if(isset($data['id_floor']))
            $this->db->where('f.id_floor',$data['id_floor']);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function getBedInfoByFloorId($data)
    {
        $this->db->select('*');
        $this->db->from('room r');
        $this->db->join('bed b','r.id_room=b.room_id','left');
        if(isset($data['floor_id']))
            $this->db->where('r.floor_id',$data['floor_id']);

        $this->db->where('b.id_bed not in (select bed_id from student_bed where status=1)');

        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function getStudentByName($data)
    {
        $this->db->select('*');
        $this->db->from('student s');
        if(isset($data['term'])) {
            $this->db->where('s.first_name like "%'.$data['term'].'%" or s.middle_name like "%'.$data['term'].'%" or s.last_name like "%'.$data['term'].'% "or s.admission_number like "%'.$data['term'].'%" ');
        }

        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function addStudentBed($data)
    {
        $this->db->insert('student_bed',$data);
        return 1;
    }

    public function getStudentHostelDetails($data)
    {
        $this->datatables->select('h.hostel_name,f.floor_number,r.room_number,b.bed,sb.date_of_joining,CONCAT(s.first_name , " " , s.middle_name , " " , s.last_name),s.admission_number',FALSE);
        $this->datatables->from('hostel h');
        $this->datatables->join('floor f','h.id_hostel=f.hostel_id','left');
        $this->datatables->join('room r','f.id_floor=r.floor_id','left');
        $this->datatables->join('bed b','r.id_room=b.room_id','left');
        $this->datatables->join('student_bed sb','b.id_bed=sb.bed_id','left');
        $this->datatables->join('student s','sb.student_id=s.id_student','left');
        if(isset($data['student_id']))
            $this->datatables->where('sb.student_id',$data['student_id']);
        if(isset($data['room_id']))
            $this->datatables->where('b.room_id',$data['room_id']);
        if(isset($data['student_id_not']))
            $this->datatables->where('sb.student_id !=',$data['student_id_not']);

        return $this->datatables->generate();
    }

    public function getStudentHostelDetailsByStudent($data)
    {
        $this->db->select('h.hostel_name,f.floor_number,r.room_number,b.bed,sb.date_of_joining,CONCAT(s.first_name , " " , s.middle_name , " " , s.last_name) as student,s.admission_number',FALSE);
        $this->db->from('hostel h');
        $this->db->join('floor f','h.id_hostel=f.hostel_id','left');
        $this->db->join('room r','f.id_floor=r.floor_id','left');
        $this->db->join('bed b','r.id_room=b.room_id','left');
        $this->db->join('student_bed sb','b.id_bed=sb.bed_id','left');
        $this->db->join('student s','sb.student_id=s.id_student','left');
        if(isset($data['student_id']))
            $this->db->where('sb.student_id',$data['student_id']);
        if(isset($data['hostel_id']))
            $this->db->where('h.id_hostel',$data['hostel_id']);
        if(isset($data['room_id']))
            $this->db->where('b.room_id',$data['room_id']);
        if(isset($data['student_id_not']))
            $this->db->where('sb.student_id !=',$data['student_id_not']);

        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function checkStudentBed($data)
    {
        $this->db->select('*');
        $this->db->from('student_bed sb');
        $this->db->join('bed b','sb.bed_id=b.id_bed','left');
        $this->db->join('room r','b.room_id=r.id_room','left');
        $this->db->join('floor f','r.floor_id=f.id_floor','left');

        if(isset($data['student_id']))
            $this->db->where('sb.student_id',$data['student_id']);
        if(isset($data['id']))
            $this->db->where('sb.student_id',$data['id']);
        if(isset($data['bed_id']))
            $this->db->where('sb.bed_id',$data['bed_id']);
        $this->db->where('sb.status',1);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function getStudentRoom()
    {
        $this->db->select('*,b.room_id as student_room_id');
        $this->db->from('student_bed sb');
        $this->db->join('bed b','sb.bed_id=b.id_bed','left');
        if(isset($data['student_id']))
            $this->db->where('sb.student_id',$data['student_id']);
        $this->db->where('sb.status',1);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function getDashboard()
    {
        $query = $this->db->query('select (select count(*) from bed where status=1) as total_beds,count(*) as total_student from student_bed where status=1');
        //$this->db->from('tmp');
        //echo 'select (select count(*) from bed where status=1) as total_beds,count(*) as total_vacant from student_bed where status=1';
        //$query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function getSearchRoom($data)
    {
        $this->db->select('h.hostel_name,f.id_floor,f.floor_number,r.id_room,r.room_number,group_concat(b.bed) as bed,group_concat(b.id_bed) as id_bed, group_concat(sb.id_student_bed) as student_bed',FALSE);
        $this->db->from('hostel h');
        $this->db->join('floor f','h.id_hostel=f.hostel_id','left');
        $this->db->join('room r','f.id_floor=r.floor_id','left');
        $this->db->join('bed b','r.id_room=b.room_id','left');
        $this->db->join('student_bed sb','b.id_bed=sb.bed_id and sb.status=1','left');
        if(isset($data['type']) && $data['type']=='occupied')
            $this->db->where('sb.status',1);
        if(isset($data['type']) && $data['type']=='vacant')
            $this->db->where('b.id_bed not in (select bed_id from student_bed)');
        if(isset($data['room_id']))
            $this->db->where('b.room_id',$data['room_id']);
        if(isset($data['student_id_not']))
            $this->db->where('sb.student_id !=',$data['student_id_not']);
        if(isset($data['id_room']))
            $this->db->where('r.id_room',$data['id_room']);
        $this->db->group_by('r.id_room');
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    public function deleteBedBYBedId($id)
    {
        $this->db->where('id_bed',$id);
        $this->db->delete('bed');
        return 1;
    }

    public function updateRoom($data)
    {
        $this->db->where('id_room',$data['id_room']);
        $this->db->update('room',$data);
        return 1;
    }

    public function getStudentBedByRoom($data)
    {
        $this->db->select('*');
        $this->db->from('student_bed sb');
        $this->db->join('bed b','sb.bed_id=b.id_bed','left');
        if(isset($data['id_room']))
            $this->db->where('b.room_id',$data['id_room']);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

}

