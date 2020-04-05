<?php
/**
 * Created by PhpStorm.
 * User: VENKATESH-LENOVO
 * Date: 02-07-2016
 * Time: 03:44 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Driver extends CI_Controller
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
        $this->load->model("mdriver");
        $this->load->model("mvehicle");
    }

    function index()
    {
        //$this->load->view('driver');
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='driver';
        $data['footer']='footer';
        $data['menu'] = 'transport';
        $this->load->view('landing',$data);

    }
    
    function addDriver($dview='',$driver_id=0)
    {
    	if($driver_id===0){
    		$driverData=array();
    	}
    	else{
    		$driverData=$this->mdriver->getDriver(array('driver_id'=>$driver_id));
    		$data['driver'] = $driverData;
    	}
    	 
    	$data['dview']=$dview;
    	$data['header']="header";
    	$data['left_menu']="left_menu";
    	$data['middle_content']='add_driver';
    	$data['footer']='footer';
    	$data['menu'] = 'transport';
    	$this->load->view('landing',$data);
    }
    

    function drivervehicle()
    {
        //$this->load->view('drivervehicle');
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='drivervehicle';
        $data['footer']='footer';
        $data['menu'] = 'transport';
        $this->load->view('landing',$data);
    }
    
    function addDriverVehicle($driver_vehicle_id=0)
    {
    	if($driver_vehicle_id===0){
    		$drivervehicleData=array();
    	}
    	else{
    		$drivervehicleData=$this->mdriver->getDriverVehicle(array('driver_vehicle_id'=>$driver_vehicle_id));
    		$data['drivervehicle'] = $drivervehicleData;
    	}
    	$data['driver_list']=$this->mdriver->getDriver();
    	$data['vehicle_list']=$this->mvehicle->getVehicle();
    	$data['header']="header";
    	$data['left_menu']="left_menu";
    	$data['middle_content']='assign_driver_to_vehicle';
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

    function driver_list()
    {
        $list = $this->mdriver->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $driver) {
            $no++;
            $row = array();
            $row[] = $driver->firstName;
            $row[] = $driver->lastName;
            $row[] = $driver->phoneNumber;
            //add html for action
            $src="driver";
           $row[] = '<div class="mod-more tooltipsample actions"><a id="edit" title="Edit" class="edit" href="'.BASE_URL.'index.php/driver/addDriver/'.encode($driver->driver_id).'"><i class="fa fa-pencil"></i></span></a>' ." ".
             '<a id="edit" title="Edit" class="edit" href="'.BASE_URL.'index.php/driver/addDriver/dview/'.encode($driver->driver_id).'"><i class="fa fa-eye"></i></span></a>' ." ".
		 '<a id="delete" title="Delete" class="edit" href="javascript:void(0)" title="Hapus" onclick="manageDelOperation('."'".$src."'".",". "'".$driver->driver_id."'".')"><i class="fa fa-trash"></i></span></a></div>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdriver->count_all(),
            "recordsFiltered" => $this->mdriver->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function driver_edit($id)
    {
        $data = $this->mdriver->get_by_id($id);
        echo json_encode($data);
    }

    public function driver_add()
    {
        $this->_validate();
        
        if(!$_POST['driver_id'])
        {
        	$data = array(
        			'firstName' => $this->input->post('firstName'),
        			'lastName' => $this->input->post('lastName'),
        			'phoneNumber' => $this->input->post('phoneNumber'),
        			'dob' => date('Y-m-d',strtotime($this->input->post('dob'))),
        			'licenceNumber' => $this->input->post('licenceNumber'),
        			'expiryDate' => date('Y-m-d',strtotime($this->input->post('expiryDate'))),
        			'address' => $this->input->post('txaAddress')
        	);
        
        	
        	$insert = $this->mdriver->save($data);
        	echo json_encode(array("status" => TRUE));
        	
        }
        else
        {
        	 
        	$data = array(
        			'driver_id'=>$this->input->post('driver_id'),
        			'firstName' => $this->input->post('firstName'),
        			'lastName' => $this->input->post('lastName'),
        			'phoneNumber' => $this->input->post('phoneNumber'),
        			'dob' => date('Y-m-d',strtotime($this->input->post('dob'))),
        			'licenceNumber' => $this->input->post('licenceNumber'),
        			'expiryDate' => date('Y-m-d',strtotime($this->input->post('expiryDate'))),
        			'address' => $this->input->post('txaAddress')
        	);
        	 
        	$this->mdriver->updateDriver($data);
        }
        redirect(BASE_URL.'index.php/driver');
   }

    public function driver_update()
    {
        $this->_validate();
        $data = array(
            'firstName' => $this->input->post('firstName'),
            'lastName' => $this->input->post('lastName'),
            'phoneNumber' => $this->input->post('phoneNumber'),
            'dob' => $this->input->post('dob'),
            'licenceNumber' => $this->input->post('licenceNumber'),
            'expiryDate' => $this->input->post('expiryDate'),
            'address' => $this->input->post('txaAddress'),
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
            $this->mdriver->updateDriver(array('driver_id' => $this->input->post('id')), $data);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function driver_delete($id)
    {
        $this->mdriver->delete_by_id($id);
         echo json_encode(array('response' => 1,'data' =>''));
    }
   

    function driver_vehicle_list()
    {
        $list = $this->mdriver->get_drivervehicle_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $drivervehicle) {
            $no++;
            $row = array();
            $row[] = $drivervehicle->firstName;
            $row[] = $drivervehicle->vehicleNumber;
            //add html for action
            $src="drivervehicle";
            $row[] = '<div class="mod-more tooltipsample actions"><a id="edit" title="Edit" class="edit" href="'.BASE_URL.'index.php/driver/addDriverVehicle/'.encode($drivervehicle->driver_vehicle_id).'"><i class="fa fa-pencil"></i></span></a>' ." ".
            	' <a id="delete" title="Delete" class="edit" href="javascript:void(0)" title="Hapus" onclick="manageDelOperation('."'".$src."'".",". "'".$drivervehicle->driver_vehicle_id."'".')"><i class="fa fa-trash"></i></span></a></div>';
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdriver->drivervehicle_count_all(),
            "recordsFiltered" => $this->mdriver->drivervehicle_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function get_drivers()
    {
        $data = $this->mdriver->get_drivers();
        echo json_encode($data);
    }

    public function drivervehicle_add()
    {
        //$this->_dv_validate();
                
        if(!$_POST['driver_vehicle_id'])
        {
        	$data = array(
        			'fk_driver_id' =>$this->input->post('driverList'),
        			'fk_vehicle_id' => $this->input->post('vehicleList')
        	);
        
        	 
        	$insert = $this->mdriver->savedrivervehicle($data);
            echo json_encode(array("status" => TRUE));
        	 
        }
        else
        {
        
        	$data = array(
        			'driver_vehicle_id'=>$this->input->post('driver_vehicle_id'),
        			'fk_driver_id' =>$this->input->post('driverList'),
        			'fk_vehicle_id' => $this->input->post('vehicleList')
        	);
        
        	$this->mdriver->updateDriverVehicle($data);
        }
        redirect(BASE_URL.'index.php/driver/drivervehicle');
    }

    function drivervehicle_edit($id)
    {
        $data = $this->mdriver->get_drivervehicle_by_id($id);
        echo json_encode($data);
    }

    public function drivervehicle_update()
    {
        $this->_dv_validate();
        $data = array(
            'fk_driver_id' => $this->input->post('driverId'),
            'fk_vehicle_id' => $this->input->post('vehicleId'),
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
            $this->mdriver->update_drivervehicle(array('driver_vehicle_id' => $this->input->post('id')), $data);
            echo json_encode(array("status" => TRUE));
        }
    }

    public function drivervehicle_delete($id)
    {
        $this->mdriver->delete_drivervehicle_by_id($id);
        echo json_encode(array('response' => 1,'data' =>''));
    }


    private function _dv_validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
        if($this->input->post('driverId') == '')
        {
            $data['inputerror'][] = 'driverId';
            $data['error_string'][] = 'Please Select Driver';
            $data['status'] = FALSE;
        }
        if($this->input->post('vehicleId') == '')
        {
            $data['inputerror'][] = 'vehicleId';
            $data['error_string'][] = 'Please Select Vehicle';
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
        if($this->input->post('firstName') == '')
        {
            $data['inputerror'][] = 'firstName';
            $data['error_string'][] = 'First Name is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('lastName') == '')
        {
            $data['inputerror'][] = 'lastName';
            $data['error_string'][] = 'Last Name is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('phoneNumber') == '')
        {
            $data['inputerror'][] = 'phoneNumber';
            $data['error_string'][] = 'Phone Number is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('dob') == '')
        {
            $data['inputerror'][] = 'dob';
            $data['error_string'][] = 'Date Of Birth is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('licenceNumber') == '')
        {
            $data['inputerror'][] = 'licenceNumber';
            $data['error_string'][] = 'Licence is required';
            $data['status'] = FALSE;
        }
        if($this->input->post('expiryDate') == '')
        {
            $data['inputerror'][] = 'expiryDate';
            $data['error_string'][] = 'Expiry Date is required';
            $data['status'] = FALSE;
        }
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}