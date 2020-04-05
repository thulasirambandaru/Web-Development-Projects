<?php
/**
 * Created by PhpStorm.
 * User: ASHOK
 * Date: 28/6/16
 * Time: 8:32 PM
 */

class MCategory extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
    }

    function getCategoryDataTable($data)
    {
        $this->datatables->select('c.category_name,c.id_category',FALSE)
            ->from('category As c');
        return $this->datatables->generate();
    }

    function getAllCatgories(){
        $this->db->select('*');
        $this->db->from('category');
        $query = $this->db->get();
        return $query->result_array();
    }


    public function getCategory($data){
        $this->db->select('*');
        $this->db->from('category');
        $this->db->where('id_category',$data['category_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insertCategory($post){
        $data = array(
            'category_name' => $post['category_name']
        );
        $this->db->insert('category', $data);
    }
    public function updateCategory($post){
        $data = array(
            'category_name' => $post['category_name']
        );

        $this->db->where('id_category', $post['id_category']);
        $this->db->update('category', $data);
    }
	
    public function deleteCategory($id_category){
        $this->db->delete('category', array('id_category' => $id_category));
    }

} 