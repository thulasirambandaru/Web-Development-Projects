<?php
/**
 * Created by PhpStorm.
 * User: ASHOK
 * Date: 1/7/16
 * Time: 7:51 PM
 */

class MStaff extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
    }

    function getStaffDataTable($data)
    {
        $this->datatables->select('CONCAT_WS(" ",s.first_name, s.last_name), s.teacher_number, s.qualification, CONCAT_WS(".",s.years, s.months), s.gender, s.id_staff',FALSE)
            ->from('staff As s');
        return $this->datatables->generate();
    }

    public function getStaffDetails($data){
        $this->db->select('*');
        $this->db->from('staff s');
		$this->db->join('user u','s.fk_id_user=u.id_user');
        $this->db->where('s.id_staff',$data['id_staff']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getAllBloodGroups(){
        $this->db->select('*');
        $this->db->from('blood_group');
        $query = $this->db->get();
        return $query->result_array();
    }

    function addStaff($data)
    {
        $this->db->insert('staff',$data);
        return $this->db->insert_id();
    }

    function updateStaff($data)
    {
        $this->db->where('id_staff',$data['id_staff']);
        $this->db->update('staff', $data);
    }

    public function deleteStaff($id_staff){
        $this->db->delete('staff', array('id_staff' => $id_staff));
    }
	
	function addStaffContact($data)
    {
        $this->db->insert('staff_contact',$data);
        return $this->db->insert_id();
    }

    function updateStaffContact($data)
    {
        $this->db->where('id_staff_contact',$data['id_staff_contact']);
        $this->db->update('staff_contact', $data);
    }
    
	public function getStaffContact($data){
        $this->db->select('*');
        $this->db->from('staff_contact s');		
        $this->db->where('s.staff_id',$data['id_staff']);
        $query = $this->db->get();
        return $query->result_array();
    }
	
    public function getStaffDocuments($data){
        $this->db->select('*');
        $this->db->from('staff_documents');
        $this->db->where('staff_id',$data['id_staff']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function addStaffDocuments($data){
        $this->db->insert('staff_documents',$data);
        return $this->db->insert_id();
    }

    public function deleteStaffDocuments($data){        
		if ($data) {
            for ($i=0; $i<=count($data);$i++)
            {
				$this->db->select('*');
				$this->db->from('staff_documents');
				$this->db->where('id_staff_document',$data[$i]);
				$query = $this->db->get();
				$records = $query->result_array();
				
				if(unlink($records[0]['document_source']))
					$this->db->delete('staff_documents', array('id_staff_document' => $data[$i]));
            }
        }
    }
	
	/**** Staff Type related code starts here ****/
	
	function getStaffTypeDateTable($data)
    {
        $this->datatables->select('s.staff_type_name, s.id_staff_type',FALSE)
			 ->from('staff_type As s');
        return $this->datatables->generate();
    }
	
	function getAllStaffTypes(){
        $this->db->select('*');
        $this->db->from('staff_type');
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function getStaffType($data){
        $this->db->select('*');
        $this->db->from('staff_type');
        $this->db->where('id_staff_type',$data['id_staff_type']);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function insertStaffType($post){
        $data = array(
            'staff_type_name' => $post['staff_type_name']
        );
        $this->db->insert('staff_type', $data);
    }
	
    public function updateStaffType($post){
        $data = array(
            'staff_type_name' => $post['staff_type_name']
        );

        $this->db->where('id_staff_type', $post['id_staff_type']);
        $this->db->update('staff_type', $data);
    }
	
	public function deleteStaffType($id_staff_type){
        $this->db->delete('staff_type', array('id_staff_type' => $id_staff_type));
    }
	/**** Staff Type related code ends here ****/
	
	
	/**** Staff Class Allocation related code ends here ****/
	
	function getStaffClassDateTable($data)
    {
        $this->datatables->select('CONCAT_WS(" ",s.first_name, s.last_name), b.board_name, c.course_name, se.section_name, sa.id_staff_class_allocate')
			 ->from('staff_class_allocate As sa')
			 ->join('staff s', 's.id_staff=sa.staff_id')
			 ->join('board b', 'b.id_board=sa.board_id')
			 ->join('course c', 'c.id_course=sa.course_id')
			 ->join('section se', 'se.id_section=sa.section_id','left');
        return $this->datatables->generate();
    }
	
	function getStaff()
	{
		$this->db->select('id_staff, CONCAT_WS(" ",s.first_name, s.last_name) as staff_name');
        $this->db->from('staff s');
		$this->db->join('user u','s.fk_id_user=u.id_user');
        $this->db->where('u.user_status',1);
        $query = $this->db->get();
        return $query->result_array();
	}
	
	public function getClassTeacher($data){
        $this->db->select('*');
        $this->db->from('staff_class_allocate');
        $this->db->where('id_staff_class_allocate',$data['id_staff_class_allocate']);
        $query = $this->db->get();
        return $query->result_array();
    }
	 
	public function insertClassTeacher($data){
		$this->db->insert('staff_class_allocate',$data);
        return $this->db->insert_id();        
    }
	
    public function updateClassTeacher($data){
        $this->db->where('id_staff_class_allocate',$data['id_staff_class_allocate']);
        $this->db->update('staff_class_allocate', $data);
    }
	
	public function deleteClassTeacher($id_staff_class_allocate){
        $this->db->delete('staff_class_allocate', array('id_staff_class_allocate' => $id_staff_class_allocate));
    }
	/**** Staff Class Allocation related code ends here ****/
} 