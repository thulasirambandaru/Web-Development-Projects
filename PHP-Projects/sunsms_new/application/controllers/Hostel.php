<?php
/**
 * Created by PhpStorm.
 * User: VENKATESH-LENOVO
 * Date: 02-07-2016
 * Time: 03:44 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Hostel extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *        http://example.com/index.php/welcome
     *    - or -
     *        http://example.com/index.php/welcome/index
     *    - or -
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
        $this->load->model("Mhostel");
    }

    public function index()
    {
        if($this->session->userdata('user_type_id') && $this->session->userdata('user_type_id')==PARENT_ID){
            redirect(BASE_URL.'index.php/Hostel/studentBed/');
        }
        else if($this->session->userdata('user_type_id') && $this->session->userdata('user_type_id')==STUDENT){
            redirect(BASE_URL.'index.php/Hostel/studentBed/'.$this->session->userdata('user_id'));
        }

        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='hostel/hostel';
        $data['footer']='footer';

        $data['menu'] = 'hostel';
        $this->load->view('landing',$data);
    }

    /*public function student($id)
    {
        $id = base64_decode($id);
        $data['student'] = $this->Mhostel->getStudent(array('id_student' => $id));
        if(empty($data['student'])){
            redirect(BASE_URL.'index.php/Fee');
        }
        //echo "<pre>";print_r($data['student'] ); exit;
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='fee/student';
        $data['footer']='footer';

        $data['menu'] = 'fee';
        $this->load->view('landing',$data);
    }*/

    public function hostelType()
    {
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='hostel/hostel_type';
        $data['footer']='footer';

        $data['menu'] = 'hostel';
        $this->load->view('landing',$data);
    }

    public function getHostelTypeDataTable()
    {
        $results = json_decode($this->Mhostel->getHostelTypeDataTable($_POST));
        echo json_encode($results);
    }

    public function addHostelType($id=0)
    {
        if($id!=0){
            $data['hostel_type'] = $this->Mhostel->getHostelType(array('id_hostel_type' => $id));
        }
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='hostel/add_hostel_type';
        $data['footer']='footer';

        $data['menu'] = 'hostel';
        $this->load->view('landing',$data);
    }

    public function createHostelType()
    {
        if(isset($_POST)){
            unset($_POST['sub']);
            unset($_POST['hostel_type_name']);
            if($_POST['id_hostel_type']){
                $this->Mhostel->updateHostelType($_POST);
            }
            else{
                unset($_POST['id_hostel_type']);
                $this->Mhostel->addHostelType(array(
                    'hostel_type' => $_POST['hostel_type'],
                    'status' => $_POST['status']
                ));
            }
        }
        redirect(BASE_URL.'index.php/hostel/hostelType');
    }

    public function getHostelDataTable()
    {
        $results = json_decode($this->Mhostel->getHostelDataTable($_POST));
        echo json_encode($results);
    }

    public function addHostel($id=0)
    {
        if($id!=0){
            $data['hostel'] = $this->Mhostel->getHostel(array('id_hostel' => $id));
        }
        $data['hostel_type'] = $this->Mhostel->getHostelType(array('status' => 1));
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='hostel/add_hostel';
        $data['footer']='footer';

        $data['menu'] = 'hostel';
        $this->load->view('landing',$data);
    }

    public function createHostel()
    {
        if(isset($_POST)){
            if($_POST['id_hostel']){
                $this->Mhostel->updateHostel(array(
                    'id_hostel' => $_POST['id_hostel'],
                    'hostel_type_id' => $_POST['hostel_type_id'],
                    'hostel_name' => $_POST['hostel_name'],
                    'hostel_address' => $_POST['hostel_address'],
                    'hostel_phone_number' => $_POST['hostel_phone_number'],
                    'warden_name' => $_POST['warden_name'],
                    'warden_address' => $_POST['warden_address'],
                    'warden_phone_number' => $_POST['warden_phone_number'],
                    'status' => $_POST['status']
                ));
            }
            else{
                $this->Mhostel->addHostel(array(
                    'hostel_type_id' => $_POST['hostel_type_id'],
                    'hostel_name' => $_POST['hostel_name'],
                    'hostel_address' => $_POST['hostel_address'],
                    'hostel_phone_number' => $_POST['hostel_phone_number'],
                    'warden_name' => $_POST['warden_name'],
                    'warden_address' => $_POST['warden_address'],
                    'warden_phone_number' => $_POST['warden_phone_number'],
                    'status' => $_POST['status']
                ));
            }
        }
        redirect(BASE_URL.'index.php/Hostel/index');
    }

    public function floor()
    {
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='hostel/floor';
        $data['footer']='footer';

        $data['menu'] = 'hostel';
        $this->load->view('landing',$data);
    }

    public function getFloorDataTable()
    {
        $results = json_decode($this->Mhostel->getFloorDataTable($_POST));
        echo json_encode($results);
    }

    public function addFloor($id=0)
    {
        if($id!=0){
            $data['floor'] = $this->Mhostel->getFloor(array('id_floor' => $id));
        }
        $data['hostel'] = $this->Mhostel->getHostel(array('status' => 1));
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='hostel/add_floor';
        $data['footer']='footer';

        $data['menu'] = 'hostel';
        $this->load->view('landing',$data);
    }

    public function createFloor()
    {
        $data = $_POST;
        //echo "<pre>";print_r($data); exit;
        $char_list = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','X','Y','Z');
        if(isset($data['id_floor']) && $data['id_floor']!='' && $data['id_floor']!=0)
        {
            $this->Mhostel->updateFloor(array(
                'id_floor' => $data['id_floor'],
                'hostel_id' => $data['hostel_id'],
                'floor_number' => $data['floor_number'],
                'no_of_rooms' => count($data['room_number'])+count($data['room_number1']),
                'status' => $data['status']
            ));

            if(isset($data['room_id'])){
                for($s=0;$s<count($data['room_id']);$s++){
                    $this->Mhostel->deleteBed(array('id_room' => $data['room_id'][$s]));
                    $this->Mhostel->deleteRoom(array('id_room' => $data['room_id'][$s]));
                }
            }

            if(isset($data['room_number']))
                for($s=0;$s<count($data['room_number']);$s++)
                {
                    $add = array(
                        'floor_id' => $data['id_floor'],
                        'room_number' => $data['room_number'][$s],
                        'no_of_beds' => $data['no_of_beds'][$s]
                    );
                    $this->Mhostel->addRoom($add);
                }


        }
        else
        {
            $floor_id = $this->Mhostel->addFloor(array(
                'hostel_id' => $data['hostel_id'],
                'floor_number' => $data['floor_number'],
                'no_of_rooms' => count($data['room_number']),
                'status' => $data['status']
            ));
            $add = array();
            if(isset($data['room_number']))
            for($s=0;$s<count($data['room_number']);$s++)
            {
                $room_id = $this->Mhostel->addRoom(array(
                                        'floor_id' => $floor_id,
                                        'room_number' => $data['room_number'][$s],
                                        'no_of_beds' => $data['no_of_beds'][$s]
                                    ));

                for($r=0;$r<$data['no_of_beds'][$s];$r++){
                    $bed_data = array(
                        'floor_id' => $floor_id,
                        'room_id' => $room_id,
                        'bed' => $char_list[$r],
                        'status' => 1
                    );
                    $this->Mhostel->addBed($bed_data);
                }
            }
        }

        redirect(BASE_URL.'index.php/Hostel/floor');
    }

    public function checkFloor()
    {
        $data = $this->Mhostel->getFloor($_POST);
        if(!empty($data))
            echo json_encode(array('response' => 0,'data' => 'Floor already exists'));
        else
            echo json_encode(array('response' => 1,'data' => ''));
    }

    public function checkRoomNumber()
    {
        $data = $this->Mhostel->checkRoomNumber($_POST);
        if(!empty($data))
            echo json_encode(array('response' => 0,'data' => 'Room already exists'));
        else
            echo json_encode(array('response' => 1,'data' => ''));
    }

    public function allotStudent()
    {
        $data['hostel'] = $this->Mhostel->getHostel();
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='hostel/student';
        $data['footer']='footer';

        $data['menu'] = 'hostel';
        $this->load->view('landing',$data);
    }

    public function getFloorByHostelId()
    {
        $data = $this->Mhostel->getFloor(array('hostel_id' => $_POST['hostel_id'],'status' => 1,'group_by' => 'id_floor'));
        echo json_encode(array('response' => 1,'data' => $data));
    }

    public function getBedInfoByFloorId()
    {
        $data = $this->Mhostel->getBedInfoByFloorId($_POST);
        echo json_encode(array('response' => 1,'data' => $data));
    }

    public function getStudentByName()
    {
        $data = $this->Mhostel->getStudentByName($_REQUEST);
        $val = array();
        for($s=0;$s<count($data);$s++){
            $val[] = array(
                'id' => $data[$s]['id_student'],
                'label' => $data[$s]['first_name'].' '.$data[$s]['middle_name'].' '.$data[$s]['last_name'].' - '.$data[$s]['admission_number'],
                'value' => $data[$s]['first_name'].' '.$data[$s]['middle_name'].' '.$data[$s]['last_name']
            );
        }
        echo json_encode($val);
    }

    public function addStudentToBed()
    {
        $this->Mhostel->addStudentBed(array(
            'room_id' => $_POST['room_id'],
            'bed_id' => $_POST['bed_id'],
            'student_id' => $_POST['student_id'],
            'food_preference' => $_POST['food_preference'],
            'description' => $_POST['description'],
            'status' => 1,
            'date_of_joining' => date('Y-m-d')
        ));
        $this->session->set_userdata('message','Student allotted successfully.');
        redirect(BASE_URL.'index.php/Hostel/allotStudent');
    }

    public function studentBed()
    {
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='hostel/parent_student';
        $data['footer']='footer';

        $data['menu'] = 'hostel';
        $this->load->view('landing',$data);
    }

    public function getStudentHostelDetails()
    {
        $data = $this->Mhostel->getStudentHostelDetails($_POST);
        echo $data;
    }

    public function getRoommates()
    {
        $student = $this->Mhostel->getStudentRoom($_POST);
        $data = $this->Mhostel->getStudentHostelDetails(array('room_id'=>$student[0]['student_room_id'],'student_id_not' => $_POST['student_id']));
        echo $data;
    }

    public function checkStudentBed()
    {
        $student = $this->Mhostel->checkStudentBed(array('id' => $_POST['id']));
        //echo "<pre>";print_r($student); exit;
        if(empty($student)){
            /*$student = $this->Mhostel->checkStudentBed(array('bed_id' => $_POST['bed_id']));
            if(empty($student))
                echo json_encode(array('response' => 1,'data' => ''));
            else
                echo json_encode(array('response' => 0,'data' => 'Bed already assigned to some one'] ));*/
            echo json_encode(array('response' => 1,'data' => ''));
        }
        else{
            echo json_encode(array('response' => 0,'data' => 'Student already assigned to room no - '.$student[0]['room_number'].' bed '.$student[0]['bed'] ));
        }
    }

    public function checkHostel()
    {
        $data = $this->Mhostel->getHostel($_POST);
        if(empty($data)){
            echo json_encode(array('response' => 1,'data' => ''));
        }
        else{
            echo json_encode(array('response' => 0,'data' => 'Hostel name already exists'));
        }
    }

    public function roomSearch($type='all')
    {
        $data['room_list'] = $this->Mhostel->getSearchRoom(array('type' => $type));
        //echo "<pre>";print_r($data['room_list']); exit;
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='hostel/room_search';
        $data['footer']='footer';
        $data['type'] = $type;
        $data['menu'] = 'hostel';
        $this->load->view('landing',$data);
    }

    public function editRoom($room_id)
    {
        if($room_id==0 || $room_id==''){
            redirect(BASE_URL.'index.php/Hostel/');
        }
        $data['room'] = $this->Mhostel->getSearchRoom(array('id_room' => $room_id));
        //echo "<pre>";print_r($data['room']); exit;
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='hostel/edit_room';
        $data['footer']='footer';
        $data['menu'] = 'hostel';
        $this->load->view('landing',$data);
    }

    public function checkBed()
    {
        $data = $this->Mhostel->checkStudentBed(array('bed_id' => $_POST['bed_id']));
        if(empty($data)){
            $this->Mhostel->deleteBedBYBedId($_POST['bed_id']);
            echo json_encode(array('response' => 1,'data' => ''));
        }
        else{
            echo json_encode(array('response' => 0,'data' => 'Bed Assigned to student'));
        }
    }

    public function updateRoom()
    {
        $update = array(
            'id_room' => $_POST['id_room'],
            'room_number' => $_POST['room_number']
        );
        $this->Mhostel->updateRoom($update);
        redirect(BASE_URL.'index.php/Hostel/roomSearch');
    }

    public function studentSearch()
    {
        if(isset($_POST['hostel_id']) && isset($_POST['student_id'])){
            $data['details'] = $this->Mhostel->getStudentHostelDetailsByStudent($_POST);
        }
        $data['hostel'] = $this->Mhostel->getHostel(array('status' => 1));
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='hostel/student_search';
        $data['footer']='footer';
        $data['menu'] = 'hostel';
        $this->load->view('landing',$data);
    }

    public function DeleteFloorRoom()
    {
        $data = $this->Mhostel->getStudentBedByRoom($_POST);
        if(empty($data)){
            $this->Mhostel->deleteBed(array('id_room' => $_POST['id_room']));
            $this->Mhostel->deleteRoom(array('id_room' => $_POST['id_room']));
            echo json_encode(array('response' => 1,'data' => ''));
        }
        else{
            echo json_encode(array('response' => 0,'data' => 'some beds already assigned to students...'));
        }
    }
}