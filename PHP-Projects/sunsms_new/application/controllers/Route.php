<?php
/**
 * Created by PhpStorm.
 * User: VENKATESH-LENOVO
 * Date: 02-07-2016
 * Time: 03:44 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Route extends CI_Controller
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
        $this->load->model("mroute");
        $this->load->model("mvehicle");
        $this->load->model("mstudent");
        
        if($this->session->userdata('user_id') && $this->session->userdata('user_type_id') > 0){}
        else{
        	redirect(BASE_URL);
        }
    }

    function index()
    {
        //$this->load->view('route');
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='route';
        $data['footer']='footer';
        $data['menu'] = 'transport';
        $this->load->view('landing',$data);
    }

    function studentroute()
    {
        //$this->load->view('studentroute');
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='studentroute';
        $data['footer']='footer';
        $data['menu'] = 'transport';
        $this->load->view('landing',$data);
    }

    function getCustomerDataTable()
    {
        $results = json_decode($this->mwelcome->getCustomerDataTable($_POST));

        for($s=0;$s<count($results->data);$s++)
        {
            $results->data[$s][6] = encode($results->data[$s][6]);
        }
        echo json_encode($results);
    }

    function route_list()
    {
        $list = $this->mroute->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $route) {
            $no++;
            $row = array();
            $row[] = $route->routeName;
            $row[] = $route->stops;
            //add html for action
           // $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_route('."'".$route->route_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
			//	  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_route('."'".$route->route_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            $src="route";
            $row[] = '<div class="mod-more tooltipsample actions"><a id="edit" title="Edit" class="edit" href="'.BASE_URL.'index.php/route/addRoute/'.encode($route->route_id).'"><i class="fa fa-pencil"></i></span></a>' ." ".
            		' <a id="delete" title="Delete" class="edit" href="javascript:void(0)" title="Hapus" onclick="manageDelOperation('."'".$src."'".",". "'".$route->route_id."'".')"><i class="fa fa-trash"></i></span></a></div>';
				 
           $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mroute->count_all(),
            "recordsFiltered" => $this->mroute->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function route_edit($id)
    {
        $data = $this->mroute->get_by_id($id);
        echo json_encode($data);
    }
    
    
    function addRoute($route_id=0)
    {
    	if($route_id===0){
    		$routeData=array();
    	}
    	else{
    		$routeData=$this->mroute->getRoute(array('route_id'=>$route_id));
    		$data['route'] = $routeData;
    	}
    	$data['vehicle_list']=$this->mvehicle->getVehicle();
    	$data['header']="header";
    	$data['left_menu']="left_menu";
    	$data['middle_content']='add_route';
    	$data['footer']='footer';
    	$data['menu'] = 'transport';
    	$this->load->view('landing',$data);
    }
    
    function addStudentRoute($student_route_id=0)
    {
    	if($student_route_id===0){
    		$studentRouteData=array();
    	}
    	else{
    		$studentRouteData=$this->mroute->getRoute(array('student_route_id'=>$student_route_id));
    		$data['studentroute'] = $studentRouteData;
    	}
    	$data['route_list']=$this->mroute->getRoute();
    	$data['header']="header";
    	$data['left_menu']="left_menu";
    	$data['middle_content']='add_student_route';
    	$data['footer']='footer';
    	$data['menu'] = 'transport';
    	$this->load->view('landing',$data);
    }

    public function route_add()
    {
       // $this->_validate();
        if(!$_POST['route_id'])
        {
        	$data = array(
            'routeName' => $this->input->post('routeName'),
            'stops' => $this->input->post('totalStops'),
            'fk_vehicle_id' => $this->input->post('vehicleList'),
            'created' => date('Y-m-d H:i:s')
        	);
        
        	$insert = $this->mroute->save($data);
        	echo json_encode(array("status" => TRUE));
        	
        }
        else
        {
        	$data = array(
        	'route_id'=>$this->input->post('route_id'),
            'routeName' => $this->input->post('routeName'),
            'stops' => $this->input->post('totalStops'),
            'fk_vehicle_id' => $this->input->post('vehicleList'),
            'updated' => date('Y-m-d H:i:s')
        	);
        	 
        	$this->mroute->updateRoute($data);
        }
        redirect(BASE_URL.'index.php/route');
        
    }

    public function route_update()
    {
        $this->_validate();
        $data = array(
            'routeName' => $this->input->post('routeName'),
            'stops' => $this->input->post('totalStops'),
            'fk_vehicle_id' => $this->input->post('vehicleId'),
            'updated_date' => date('Y-m-d H:i:s')
        );
        /*$check_vehicle_name = $this->mroute->check_vehicle_name($data);
        if($check_vehicle_name > 0)
        {
            $data['inputerror'][] = 'vehicleNumber';
            $data['error_string'][] = 'Vehicle Number already exists';
            $data['status'] = FALSE;
            echo json_encode($data);
        }
        else*/
        {
            $this->mroute->update(array('route_id' => $this->input->post('id')), $data);
            echo json_encode(array("status" => TRUE));
        }
    }


    public function route_delete($id)
    {
        $this->mroute->delete_by_id($id);
          echo json_encode(array('response' => 1,'data' =>''));
    }

    function student_route_list()
    {
        $list = $this->mroute->get_studentroute_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $studentroute) {
        	//echo "<pre>";
        	//print_r($studentroute);
            $no++;
            $row = array();
            $row[] = $studentroute->first_name." ".$studentroute->middle_name." ".$studentroute->last_name;
            $row[] = $studentroute->routeName;
            //add html for action
            //$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_studentroute('."'".$studentroute->student_route_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				 // <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_studentroute('."'".$studentroute->student_route_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            $src="studentroute";
            $row[] = '<div class="mod-more tooltipsample actions"><a id="edit" title="Edit" class="edit" href="'.BASE_URL.'index.php/route/addStudentRoute/'.encode($studentroute->student_route_id).'"><i class="fa fa-pencil"></i></span></a>' ." ".
            		' <a id="delete" title="Delete" class="edit" href="javascript:void(0)" title="Hapus" onclick="manageDelOperation('."'".$src."'".",". "'".$studentroute->student_route_id."'".')"><i class="fa fa-trash"></i></span></a></div>';
			

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mroute->studentroute_count_all(),
            "recordsFiltered" => $this->mroute->studentroute_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function get_routes()
    {
        $data = $this->mroute->get_routes();
        echo json_encode($data);
    }

    function get_students()
    {
        $data = $this->mroute->get_students();
        echo json_encode($data);
    }

    public function studentroute_add()
    {
        $data = array(
            'fk_student_id' => $this->input->post('id_student'),
            'fk_route_id' => $this->input->post('routeList'),
        	'created'=>date('Y-m-d H:i:s')
        );

        $insert = $this->mroute->savestudentroute($data);
        echo json_encode(array("status" => TRUE));
        $this->session->set_userdata('message','Route has been alloted successfully');
        redirect(BASE_URL.'index.php/route/addStudentRoute');
       
    }

    function studentroute_edit($id)
    {
        $data = $this->mroute->get_studentroute_by_id($id);
        echo json_encode($data);
    }

    public function studentroute_update()
    {
        $this->_st_validate();
        $data = array(
            'fk_student_id' => $this->input->post('studentId'),
            'fk_route_id' => $this->input->post('routeId'),
            'updated_date' => date('Y-m-d H:i:s')
        );
        /*$check_vehicle_name = $this->mdriver->check_vehicle_name($data);
        if($check_vehicle_name > 0)
        {
            $data['inputerror'][] = 'vehicleNumber';
            $data['error_string'][] = 'Vehicle Number already exists';
            $data['status'] = FALSE;
            echo json_encode($data);
        }
        else*/
        {
            $this->mroute->update_studentroute(array('student_route_id' => $this->input->post('id')), $data);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function studentroute_delete($id)
    {
        $this->mroute->delete_studentroute_by_id($id);
        echo json_encode(array('response' => 1,'data' =>''));
    }

    private function _st_validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('studentId') == '')
        {
            $data['inputerror'][] = 'studentId';
            $data['error_string'][] = 'Please Select Student';
            $data['status'] = FALSE;
        }
        if($this->input->post('routeId') == '')
        {
            $data['inputerror'][] = 'routeId';
            $data['error_string'][] = 'Please Select Route';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('routeName') == '')
        {
            $data['inputerror'][] = 'routeName';
            $data['error_string'][] = 'Route Name is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('totalStops') == '')
        {
            $data['inputerror'][] = 'totalStops';
            $data['error_string'][] = 'Total Stops is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('vehicleId') == '')
        {
            $data['inputerror'][] = 'vehicleId';
            $data['error_string'][] = 'Select Vehicle Name';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
    function getStudentInfo()
    {
   		$html = '';
   		$student = $this->mstudent->getStudentInfo(array(
   				'first_name' => $_POST['student_name'],
   				'middle_name' => $_POST['student_name'],
   				'last_name' => $_POST['student_name']
   		));
   	
   		echo json_encode(array('response' => 1, 'data' => $student)); exit;
    }
}