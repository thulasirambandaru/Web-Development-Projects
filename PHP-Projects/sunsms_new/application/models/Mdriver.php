<?php
/**
 * Created by PhpStorm.
 * User: VENKATESH-LENOVO
 * Date: 02-07-2016
 * Time: 05:09 PM
 */
class MDriver extends CI_Model
{
    var $table = 'driver';
    var $column_order = array('firstName','lastName','phoneNumber',null); //set column field database for datatable orderable
    var $column_search = array('firstName','lastName','phoneNumber'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('driver_id' => 'desc'); // default order

    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
    }

    private function _get_datatables_query()
    {

        $this->db->from($this->table);

        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function check_vehicle_name($data)
    {
        $this->db->from($this->table);
        $this->db->where("vehicleNumber",$data['vehicleNumber']);
        if(isset($data['vehicle_id']))
            $this->db->where('vehicle_id!=', $data['vehicle_id']);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id)
    {
        $this->db->where('driver_id', $id);
        $this->db->delete($this->table);
        return 1;
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('driver_id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_drivervehicle_datatables()
    {
        $this->_get_drivervehicle_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_drivervehicle_datatables_query()
    {
        $this->db->from('driver_vehicle dv');
        $this->db->join('driver d','d.driver_id=dv.fk_driver_id');
        $this->db->join('vehicle v','v.vehicle_id=dv.fk_vehicle_id');
        $i = 0;
        $column_dv_order = array('d.firstName','v.vehicleNumber' ,null);
        $column_dv_search = array('d.firstName','v.vehicleNumber');
        $dv_order = array('dv.driver_vehicle_id' => 'desc'); // default order
        foreach ($column_dv_search as $item) // loop column
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {

                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if(count($column_dv_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($column_dv_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }
        else if($dv_order)
        {
            $order = $dv_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function drivervehicle_count_filtered()
    {
        $this->_get_drivervehicle_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function drivervehicle_count_all()
    {
        $this->db->from('driver_vehicle');
        return $this->db->count_all_results();
    }

    public function savedrivervehicle($data)
    {
        $this->db->insert('driver_vehicle', $data);
        return $this->db->insert_id();
    }

    public function get_drivers()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_drivervehicle_by_id($id)
    {
        $this->db->from('driver_vehicle');
        $this->db->where('driver_vehicle_id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_drivervehicle($where, $data)
    {
        $this->db->update('driver_vehicle', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_drivervehicle_by_id($id)
    {
        $this->db->where('driver_vehicle_id', $id);
        $this->db->delete('driver_vehicle');
    }
    
    function updateDriver($data)
    {
    	$this->db->where('driver_id',$data['driver_id']);
    	$this->db->update('driver', $data);
    }
    
    function updateDriverVehicle($data)
    {
    	$this->db->where('driver_vehicle_id',$data['driver_vehicle_id']);
    	$this->db->update('driver_vehicle', $data);
    }
    
    function getDriver($data=null)
    {
    	$this->db->select('*');
    	$this->db->from('driver');
    	if(isset($data['driver_id']))
    		$this->db->where('driver_id',decode($data['driver_id']));
    	$query = $this->db->get();
    	return $query->result_array();
    }

    function getDriverVehicle($data=null)
    {
    	$this->db->select('*');
    	$this->db->from('driver_vehicle');
    	if(isset($data['driver_vehicle_id']))
    		$this->db->where('driver_vehicle_id',decode($data['driver_vehicle_id']));
    	$query = $this->db->get();
    	return $query->result_array();
    }
}

