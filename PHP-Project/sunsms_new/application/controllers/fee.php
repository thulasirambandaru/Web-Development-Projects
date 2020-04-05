<?php
/**
 * Created by PhpStorm.
 * User: VENKATESH-LENOVO
 * Date: 02-07-2016
 * Time: 03:44 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Fee extends CI_Controller
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
        $this->load->model("mfee");
    }

    function index()
    {
        if($this->session->userdata('user_type_id') && $this->session->userdata('user_type_id')==PARENT_ID){
            redirect(BASE_URL.'index.php/Fee/student/');
        }
        if($this->session->userdata('user_type_id') && $this->session->userdata('user_type_id')==STUDENT){
            redirect(BASE_URL.'index.php/Fee/student/'.base64_encode($this->session->userdata('user_id')));
        }
        if($this->session->userdata('user_type_id') && $this->session->userdata('user_type_id')==TEACHER){
            redirect(BASE_URL.'index.php/Fee/studentFee/');
        }
        $data['board'] = $this->mwelcome->getBoard(array('status' => 1));
        $data['fee_type'] = $this->mfee->getFeeType(array('status' => 1));
        $data['header']="header";
        $data['left_menu']="left_menu";
        if($this->session->userdata('user_type_id')==ADMIN)
            $data['middle_content']='fee/fee_structure';
        else if($this->session->userdata('user_type_id')==TEACHER)
            $data['middle_content']='fee/fee';
        else if($this->session->userdata('user_type_id')==PARENT_ID)
            $data['middle_content']='fee/fee';
        else if($this->session->userdata('user_type_id')==STUDENT)
            $data['middle_content']='fee/fee';
        $data['footer']='footer';

        $data['menu'] = 'fee';
        $this->load->view('landing',$data);
    }
    
    function createClassFee($id_fee_structure=0)
    {
    	if(isset($id_fee_structure) && $id_fee_structure!=0)
    		$data['classFeeStructure'] = $this->mfee->getClassFeeStructure(array('id_fee_structure' => $id_fee_structure));
    	
    	
    	if($this->session->userdata('user_type_id') && $this->session->userdata('user_type_id')==PARENT_ID){
    		redirect(BASE_URL.'index.php/Fee/student/');
    	}
    	if($this->session->userdata('user_type_id') && $this->session->userdata('user_type_id')==STUDENT){
    		redirect(BASE_URL.'index.php/Fee/student/'.base64_encode($this->session->userdata('user_id')));
    	}
    	if($this->session->userdata('user_type_id') && $this->session->userdata('user_type_id')==TEACHER){
    		redirect(BASE_URL.'index.php/Fee/studentFee/');
    	}
    	$data['board'] = $this->mwelcome->getBoard(array('status' => 1));
    	$data['fee_type'] = $this->mfee->getFeeType(array('status' => 1));
    	$data['header']="header";
    	$data['left_menu']="left_menu";
    	if($this->session->userdata('user_type_id')==ADMIN)
    		$data['middle_content']='fee/create_class_fee';
    	else if($this->session->userdata('user_type_id')==TEACHER)
    		$data['middle_content']='fee/fee';
    	else if($this->session->userdata('user_type_id')==PARENT_ID)
    		$data['middle_content']='fee/fee';
    	else if($this->session->userdata('user_type_id')==STUDENT)
    		$data['middle_content']='fee/fee';
    	$data['footer']='footer';
    	
    	$data['menu'] = 'fee';
    	$this->load->view('landing',$data);
    	 
    }

    public function addFeeStructure()
    {
        if(isset($_POST)) {
            $academic_year = $this->mfee->getAcademicYear(array('status' => 1));
            $fee_type = $this->mfee->getFeeType(array('status' => 1));
            $board_id = $_POST['board_id'];
            $class_id = $_POST['course_id'];
            $fee_structure_id = $this->mfee->getFeeStructure(array(
                'academic_year_id' => $academic_year[0]['id_academic_year'],
                'board_id' => $board_id,
                'class_id' => $class_id,
                'status-all' => 1
            ));
            //echo "<pre>";print_r($fee_structure_id); exit;
            if (empty($fee_structure_id)){
                $fee_structure_id = $this->mfee->addFeeStructure(array(
                    'academic_year_id' => $academic_year[0]['id_academic_year'],
                    'board_id' => $board_id,
                    'class_id' => $class_id
                ));

                $class_fee = array();
                for($s=0;$s<count($fee_type);$s++)
                {
                    $class_fee[] = array(
                        'fee_structure_id' => $fee_structure_id,
                        'fee_type_id' => $fee_type[$s]['id_fee_type'],
                        'amount' => $_POST['fee_type_'.$fee_type[$s]['id_fee_type']]
                    );
                }

                $this->mfee->addClassFee_batch($class_fee);
            }
            else{

                $fee_structure_id = $fee_structure_id[0]['id_fee_structure'];
                $this->mfee->updateFeeStructure(array('id_fee_structure' => $fee_structure_id,'status' => $_POST['status']));

                $class_fee = $this->mfee->getClassFeeStructure(array('id_fee_structure' => $fee_structure_id));
                $class_fee_update = array();
                for($s=0;$s<count($fee_type);$s++){
                    for ($r = 0; $r < count($class_fee); $r++) {
                        if ($fee_structure_id == $class_fee[$r]['fee_structure_id'] && $fee_type[$s]['id_fee_type'] == $class_fee[$r]['fee_type_id']) {
                            $class_fee_update[] = array(
                                'id_class_fee' => $class_fee[$r]['id_class_fee'],
                                'fee_type_id' => $fee_type[$s]['id_fee_type'],
                                'amount' => $_POST['fee_type_' . $fee_type[$s]['id_fee_type']],
                            );
                            //unset($fee_type[$s]);
                        }
                    }
                }

                if(!empty($class_fee_update)) {
                    $class_fee_type = array_map(function($t){ return $t['fee_type_id'];},$class_fee_update);
                    $this->mfee->updateClassFee_batch($class_fee_update);
                }
                $class_fee_add = array();
                foreach($fee_type as $i){
                    if(!in_array($i['id_fee_type'],$class_fee_type)) {
                        $class_fee_add[] = array(
                            'fee_structure_id' => $fee_structure_id,
                            'fee_type_id' => $i['id_fee_type'],
                            'amount' => $_POST['fee_type_' . $i['id_fee_type']]
                        );
                    }
                }
                if(!empty($class_fee_add))
                    $this->mfee->addClassFee_batch($class_fee_add);
            }

            redirect(BASE_URL.'index.php/fee');
        }
    }

    public function getFeeStructureDataTable()
    {

        $academic_year = $this->mfee->getAcademicYear(array('status' => 1));
        if(!empty($academic_year))
            $_POST['academic_year'] = $academic_year[0]['id_academic_year'];
        else $_POST['academic_year'] = 0;

        $fee_type = $this->mfee->getFeeType(array('status' => 1));
        $data = $this->mfee->getClassFeeStructure(array('academic_year' => $_POST['academic_year']));

        $result = $new = array();
        for($s=0;$s<count($data);$s++)
        {
            if(!isset($result[$data[$s]['id_fee_structure']]['total'])){ $result[$data[$s]['id_fee_structure']]['total']=0; }
            $result[$data[$s]['id_fee_structure']]['board'] =  $data[$s]['board_name'];
            $result[$data[$s]['id_fee_structure']]['course'] =  $data[$s]['course_name'];
            $result[$data[$s]['id_fee_structure']][$data[$s]['id_fee_type']] =  $data[$s]['amount'];
            $result[$data[$s]['id_fee_structure']]['total'] =  ($result[$data[$s]['id_fee_structure']]['total']+$data[$s]['amount']);
            $result[$data[$s]['id_fee_structure']]['id'] =  $data[$s]['id_fee_structure'];
            ksort($result[$data[$s]['id_fee_structure']]);
        }

        $result = array_values($result);
        //echo "<pre>";print_r($result);
        for($r=0;$r<count($result);$r++)
        {
            $new[$r]['board'] = $result[$r]['board'];
            $new[$r]['course'] = $result[$r]['course'];
            for($s=0;$s<count($fee_type);$s++)
            {
                if(isset($result[$r][$fee_type[$s]['id_fee_type']]))
                    $new[$r][$fee_type[$s]['id_fee_type']] = $result[$r][$fee_type[$s]['id_fee_type']];
                else
                    $new[$r][$fee_type[$s]['id_fee_type']] = 0;
            }
            $new[$r]['id'] = $result[$r]['id'];
            $new[$r]['total'] = $result[$r]['total'];
        }
        echo json_encode(array('response' => 1, 'data' => $new));
    }

    function getClassFeeStructure()
    {
        $data = $this->mfee->getClassFeeStructure(array('id_fee_structure' => $_POST['id']));
        $result = array();
        for($s=0;$s<count($data);$s++){
            $result[$data[$s]['id_fee_structure']]['id_fee_structure'] = $data[$s]['id_fee_structure'];
            $result[$data[$s]['id_fee_structure']]['board_id'] = $data[$s]['id_board'];
            $result[$data[$s]['id_fee_structure']]['board_name'] = $data[$s]['board_name'];
            $result[$data[$s]['id_fee_structure']]['course_id'] = $data[$s]['id_course'];
            $result[$data[$s]['id_fee_structure']]['course_name'] = $data[$s]['course_name'];
            $result[$data[$s]['id_fee_structure']]['status'] = $data[$s]['class_fee_status'];
            $result[$data[$s]['id_fee_structure']]['fee_type_'.$data[$s]['fee_type_id']] = $data[$s]['amount'];
        }
        $result = array_values($result);
        echo json_encode(array('response' => 1,'data' => $result));
    }

    function studentFee()
    {
        $data['board'] = $this->mwelcome->getBoard(array('status' => 1));
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='fee/fee';
        $data['footer']='footer';

        $data['menu'] = 'fee';
        $this->load->view('landing',$data);
    }

    function getStudentFee()
    {
        $board_id = $_POST['board_id'];
        $course_id = $_POST['course_id'];
        $section_id = $_POST['section_id'];
        $student = $_POST['student'];
        $academic_year = $this->mfee->getAcademicYear(array('status' => 1));
        if(!empty($academic_year))
            $_POST['academic_year'] = $academic_year[0]['id_academic_year'];
        else $_POST['academic_year'] = 0;
        $students = $this->mfee->getStudent(array('section' => $section_id,'student'=>$student));

        $resultArray = array();
        for($s=0;$s<count($students);$s++)
        {
            $total_fee = $this->mfee->getTotalFeeAmount(array('academic_year_id' => $_POST['academic_year'],'class_id' => $students[$s]['course_id']));
            $paid_fee = $this->mfee->getTotalFeeCollected(array('academic_year_id' => $_POST['academic_year'],'class_id' => $students[$s]['course_id'],'student_id' => $students[$s]['id_student']));

            $resultArray[] = array(
                'id' => $students[$s]['id_student'],
                'course_name' => $students[$s]['course_name'],
                'section_name' => $students[$s]['section_name'],
                'admission_number' => $students[$s]['admission_number'],
                'user_name' => $students[$s]['first_name'].' '.$students[$s]['middle_name'].' '.$students[$s]['last_name'],
                'total' => $total_fee[0]['amount'],
                'paid' => $paid_fee[0]['amount'],
                'due' => ($total_fee[0]['amount']-$paid_fee[0]['amount'])
            );
        }
        //$data = $this->mfee->getStudentFee($_POST);
        echo json_encode(array('response'=>1,'data' => $resultArray));
    }

    function student($id)
    {
        $id = base64_decode($id);
        $data['student'] = $this->mfee->getStudent(array('id_student' => $id));
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
    }

    function getStudentFeeDetails()
    {
        $results = json_decode($this->mfee->getStudentFeeDetails($_POST));
        echo json_encode($results);
    }

    function payAmount()
    {
    	if(isset($_POST)){
    		
    		$fee_type = $this->mfee->getClassFee(array('academic_year_id' => $_POST['academic_year_id'],'class_id' => $_POST['class_id']));
    		
    		for($s=0;$s<count($fee_type);$s++){
    			$fee_type_name=str_replace(' ', '_', strtolower($fee_type[$s]['fee_type']));
    			if($_POST[$fee_type_name]!='' || $_POST[$fee_type_name]!=0)
    			{
    				$this->mfee->addAmount(array(
    						'student_id' => $_POST['student_id'],
    						'class_fee_id' => $fee_type[$s]['id_class_fee'],
    						'amount' => $_POST[$fee_type_name],
    						'due' => ($_POST['remain']-$_POST[$fee_type_name]),
    						'created_date' => date('Y-m-d')
    				));
    			}
    		
    		
    		}
    		
            
        }
        echo 1;
    }

    function downloadPdf($id)
    {
        require_once('mpdf/mpdf.php');
        $student = $this->mfee->getStudent(array('id_student' => base64_decode($id)));
        $html = '';
        $html.='<table style="text-align: center">';
        //$html.='<tr><td>Total Amount</td><td>'.$student[0]["total"].'</td></tr>';
        //$html.='<tr><td>Paid Amount</td><td>'.$student[0]["paid"].'</td></tr>';
        $html.='<tr><td>Admission Number</td><td>'.$student[0]["admission_number"].'</td></tr>';
        $html.='<tr><td>Student Name</td><td>'.$student[0]["first_name"].' '.$student[0]["last_name"].'</td></tr>';
        $html.='<tr><td>Section Name</td><td>'.$student[0]["section_name"].'</td></tr>';
        $html.='<tr><td>Course Name</td><td>'.$student[0]["course_name"].'</td></tr>';
        $html.='<tr><td>Board Name</td><td>'.$student[0]["board_name"].'</td></tr></table>';
        $results = $this->mfee->getStudentFeeDetailsList(array('id_student' => base64_decode($id)));

        if(!empty($results)) {
            $html .= '<table border="1"><tr><th>Fee type</th><th>Amount Paid</th><th>Due</th><th>Date</th></tr>';
            for ($s = 0; $s < count($results); $s++) {
                $html .= '<tr><td>' . $results[$s]['fee_type'] . '</td><td>' . $results[$s]['amount'] . '</td><td>' . $results[$s]['due'] . '</td><td>' . $results[$s]['date'] . '</td></tr>';
            }
            $html .= '</table>';
        }
        $mpdf=new mPDF('c');
        $mpdf->SetDisplayMode('fullpage');
        $mpdf->WriteHTML($html);
        $mpdf->Output("Details.pdf",'D');
    }

    public function feeType()
    {
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='fee/fee_type';
        $data['footer']='footer';

        $data['menu'] = 'fee';
        $this->load->view('landing',$data);
    }

    function getFeeTypeDataTable()
    {
        $results = json_decode($this->mfee->getFeeTypeDataTable($_POST));
        echo json_encode($results);
    }

    public function addFeeType($id=0)
    {
        if($id!=0){
            $data['fee_type'] = $this->mfee->getFeeType(array('id_fee_type' => $id));
        }
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='fee/add_fee_type';
        $data['footer']='footer';

        $data['menu'] = 'fee';
        $this->load->view('landing',$data);
    }

    public function createFeeType()
    {
        //echo "<pre>";print_r($_POST); exit;
        if(isset($_POST)){
            unset($_POST['sub']);
            $_POST['fee_type'] = $_POST['fee_type_name'];
            unset($_POST['fee_type_name']);
            if($_POST['id_fee_type']){
                $this->mfee->updateFeeType($_POST);
            }
            else{
                unset($_POST['id_fee_type']);
                $this->mfee->addFeeType($_POST);
            }
        }
        redirect(BASE_URL.'index.php/fee/feeType');
    }

    public function notify()
    {
        $student = $_POST['student'];
        echo "<pre>";print_r($student); exit;
    }
}