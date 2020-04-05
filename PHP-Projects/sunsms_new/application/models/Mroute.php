<?php
/**
 * Created by PhpStorm.
 * User: VENKATESH-LENOVO
 * Date: 02-07-2016
 * Time: 05:09 PM
 */
class MRoute extends CI_Model
{
    var $table = 'route';
    var $column_order = array('routeName','stops',null); //set column field database for datatable orderable
    var $column_search = array('routeName','stops'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('route_id' => 'desc'); // default order

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
        $this->db->where('route_id', $id);
        $this->db->delete($this->table);
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('route_id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_studentroute_datatables()
    {
        $this->_get_studentroute_datatables_query();
        if($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_studentroute_datatables_query()
    {
        $this->db->from('student_route sr');
        $this->db->join('student s','s.id_student=sr.fk_student_id');
        $this->db->join('route r','r.route_id=sr.fk_route_id');
        $i = 0;
        $column_dv_order = array('s.first_name','r.routeName' ,null);
        $column_dv_search = array('s.first_name','r.routeName');
        $dv_order = array('sr.student_route_id' => 'desc'); // default order
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

    function studentroute_count_filtered()
    {
        $this->_get_studentroute_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function studentroute_count_all()
    {
        $this->db->from('student_route');
        return $this->db->count_all_results();
    }

    public function get_routes()
    {
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_students()
    {
        $this->db->from('student');
        $query = $this->db->get();
        return $query->result();
    }

    public function savestudentroute($data)
    {
        $this->db->insert('student_route', $data);
        return $this->db->insert_id();
    }

    public function get_studentroute_by_id($id)
    {
        $this->db->from('student_route');
        $this->db->where('student_route_id',$id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_studentroute($where, $data)
    {
        $this->db->update('student_route', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_studentroute_by_id($id)
    {
        $this->db->where('student_route_id', $id);
        $this->db->delete('student_route');
    }
    
	function updateRoute($data)
    {
    	$this->db->where('route_id',$data['route_id']);
    	$this->db->update('route', $data);
    }
    
    function getRoute($data=null)
    {
    	$this->db->select('*');
    	$this->db->from('route');
    	if(isset($data['route_id']))
    		$this->db->where('route_id',decode($data['route_id']));
    	$query = $this->db->get();
    	return $query->result_array();
    }
}

