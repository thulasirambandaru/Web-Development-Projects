<?php
/**
 * Created by PhpStorm.
 * User: VENKATESH-LENOVO
 * Date: 02-07-2016
 * Time: 03:44 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle extends CI_Controller
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
        $this->load->model("mvehicle");
    }

    function index()
    {
        //if ($this->session->userdata('user_id'))
        {
/*            $data['header'] = "header";
            $data['left_menu'] = "left_menu";
            $data['middle_content'] = 'vehicle';
            $data['footer'] = 'footer';
            $data['menu'] = 'school';*/
            //$this->load->view('vehicle');
        }

        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='vehicle';
        $data['footer']='footer';
        $data['menu'] = 'transport';
        $this->load->view('landing',$data);

    }
    
    function addVehicle($vehicle_id=0)
    {
   		 if($vehicle_id===0){
			$vehicleData=array();
		}
		else{
			$vehicleData=$this->mvehicle->getVehicle(array('vehicle_id'=>$vehicle_id));
			$data['vehicle'] = $vehicleData;
		}
    	
    	$data['header']="header";
    	$data['left_menu']="left_menu";
    	$data['middle_content']='add_vehicle';
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

    function vehicle_list()
    {
        $list = $this->mvehicle->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $vehicle) {
            $no++;
            $row = array();
            $row[] = $vehicle->vehicleNumber;
            $row[] = $vehicle->capacity;
            $row[] = $vehicle->vehicleType;
            //add html for action
            $src="vehicle";
            $row[] = '<div class="mod-more tooltipsample actions"><a id="edit" title="Edit" class="edit" href="'.BASE_URL.'index.php/vehicle/addVehicle/'.encode($vehicle->vehicle_id).'"><i class="fa fa-pencil"></i></span></a>' ." ".
				  ' <a id="delete" title="Delete" class="edit" href="javascript:void(0)" title="Hapus" onclick="manageDelOperation('."'".$src."'".",". "'".$vehicle->vehicle_id."'".')"><i class="fa fa-trash"></i></span></a></div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mvehicle->count_all(),
            "recordsFiltered" => $this->mvehicle->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function vehicle_edit($id)
    {
        $data = $this->mvehicle->get_by_id($id);
        echo json_encode($data);
    }

    public function vehicle_add()
    {
        $this->_validate();
        
        if(!$_POST['vehicle_id'])
        {
	        $data = array(
	            'vehicleNumber' => $this->input->post('vehicleNumber'),
	            'capacity' => $this->input->post('capacity'),
	            'vehicleType' => $this->input->post('vehicleType')
	        );
	
	        $check_vehicle_name = $this->mvehicle->check_vehicle_name($data);
	        if($check_vehicle_name > 0)
	        {
	            $data['inputerror'][] = 'vehicleNumber';
	            $data['error_string'][] = 'Vehicle Number already exists';
	            $data['status'] = FALSE;
	            echo json_encode($data);
	        }
	        else
	        {
	            $insert = $this->mvehicle->save($data);
	            echo json_encode(array("status" => TRUE));
	        }
        }
        else
        {
        	
        	$data = array(
        		'vehicle_id'=>$_POST['vehicle_id'],
	            'vehicleNumber' => $this->input->post('vehicleNumber'),
	            'capacity' => $this->input->post('capacity'),
	            'vehicleType' => $this->input->post('vehicleType')
	       		 );
        	
        	$this->mvehicle->updateVehicle($data);
        }
        redirect(BASE_URL.'index.php/vehicle');
    }

    public function vehicle_update()
    {
        $this->_validate();
        $data = array(
            'vehicleNumber' => $this->input->post('vehicleNumber'),
            'capacity' => $this->input->post('capacity'),
            'vehicleType' => $this->input->post('vehicleType'),
            'updated_date' => date('Y-m-d H:i:s')
        );
        $check_vehicle_name = $this->mvehicle->check_vehicle_name($data);
        if($check_vehicle_name > 0)
        {
            $data['inputerror'][] = 'vehicleNumber';
            $data['error_string'][] = 'Vehicle Number already exists';
            $data['status'] = FALSE;
            echo json_encode($data);
        }
        else
        {
            $this->mvehicle->update(array('vehicle_id' => $this->input->post('id')), $data);
            echo json_encode(array("status" => TRUE));
        }
    }

    function get_vehicles()
    {
        $data = $this->mvehicle->get_vehicles();
        echo json_encode($data);
    }


    public function vehicle_delete($id)
    {
        $this->mvehicle->delete_by_id($id);
       echo json_encode(array('response' => 1,'data' =>''));
    }
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('vehicleNumber') == '')
        {
            $data['inputerror'][] = 'vehicleNumber';
            $data['error_string'][] = 'Vehicle Number is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('capacity') == '')
        {
            $data['inputerror'][] = 'capacity';
            $data['error_string'][] = 'Capacity is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('vehicleType') == '')
        {
            $data['inputerror'][] = 'vehicleType';
            $data['error_string'][] = 'Please select vehicle type';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
    function validateVehicle()
    {
    	$data['vehicleNumber']=$_POST['vehicleNumber'];
    	
    	$vehicleData=$this->mvehicle->validateVehicle($data);
    	if(count($vehicleData)>0 && $_POST['vehicle_id']=='NULL')
    		echo (json_encode(false));
    	else
    		echo (json_encode(true));
    }
}