<?php
/**
 * Created by PhpStorm.
 * User: ASHOK
 * Date: 28/6/16
 * Time: 8:19 PM
 */

class Category extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Datatables');
        $this->load->model("mcategory");

        if($this->session->userdata('user_id') && $this->session->userdata('user_type_id') > 0){}
        else{
            redirect(BASE_URL);
        }
    }

    function index()
    {
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='admin/category';
        $data['footer']='footer';
        $data['menu'] = 'settings';
        $this->load->view('landing',$data);
    }

    function getCategoryDataTable(){
        $results = json_decode($this->mcategory->getCategoryDataTable($_POST));

        for($s=0;$s<count($results->data);$s++)
        {
            $results->data[$s][1] = encode($results->data[$s][1]);
        }
        echo json_encode($results);
    }


    function addUpdateCategoryView($category_id=0)
    {
        if($category_id===0){}
        else{
            $data['category_details'] = $this->mcategory->getCategory(array('category_id' => decode($category_id)));
        }
        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='admin/add_update_category';
        $data['footer']='footer';
        $data['menu'] = 'settings';
        $this->load->view('landing',$data);
    }

    function insertUpdateCategory()
    {
        if(isset($_POST))
        {

            if(!$_POST['id_category'])
            {
                $this->mcategory->insertCategory(array(
                    'category_name' => $_POST['category_name']
                ));
            }
            else
            {
                $this->mcategory->updateCategory(array(
                    'id_category' => decode($_POST['id_category']),
                    'category_name' => $_POST['category_name']
                ));
            }

            redirect(BASE_URL.'index.php/category');
        }
    }


    function deleteCategory($id)
    {
        $this->mcategory->deleteCategory(decode($id));
        echo json_encode(array('response' => 1,'data' =>''));
    }
} 