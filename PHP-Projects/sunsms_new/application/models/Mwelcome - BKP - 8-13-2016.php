<?php
class MWelcome extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('mcommon');
    }




    function login($post)
    {
        $this->db->select('*');
        $this->db->from('user u');
        $this->db->where('u.username',$post['username']);
        $this->db->where('u.password',md5($post['password']));
        $this->db->where('u.user_status',1);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function getCustomerDataTable($data)
    {
        $this->datatables->select('s.school_name,u.first_name,u.email,c.city,st.state,DATE_FORMAT(s.created_date_time, \'%d %b %Y\') as date,s.id_school',FALSE)
            ->from('school As s')
            ->join('user AS u','s.user_id = u.id_user', 'left')
            ->join('country AS cu','s.city_id = cu.id_country', 'left')
            ->join('state AS st','s.state_id = st.id_state', 'left')
            ->join('city AS c','s.city_id = c.id_city', 'left')
            ->group_by('s.id_school');

        return $this->datatables->generate();
    }

    function getSchool($data)
    {
        $this->db->select('*');
        $this->db->from('school s');
        $this->db->join('user u','s.user_id=u.id_user','left');
        if(isset($data['id_school']))
            $this->db->where('s.id_school', $data['id_school']);
        if(isset($data['user_id']))
            $this->db->where('s.user_id', $data['user_id']);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function getCountry()
    {
        $query = $this->db->get('country');
        return $query->result_array();
    }

    function getState($data)
    {
        $this->db->select('*');
        $this->db->from('state');
        if(isset($data['country_id']))
            $this->db->where('country_id',$data['country_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getCity($data)
    {
        $this->db->select('*');
        $this->db->from('city');
        if(isset($data['state_id']))
            $this->db->where('state_id',$data['state_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addUser($data)
    {
        $this->db->insert('user',$data);
        return $this->db->insert_id();
    }

    function addSchool($data)
    {
        $this->db->insert('school',$data);
        return $this->db->insert_id();
    }

    function updateUser($data)
    {
        $this->db->where('id_user',$data['id_user']);
        $this->db->update('user', $data);
    }

    function updateSchool($data)
    {
        $this->db->where('id_school',$data['id_school']);
        $this->db->update('school', $data);
    }

    function getAcademicYearDataTable($data)
    {
        $this->datatables->select('a.name,DATE_FORMAT(a.start_date, \'%d %b %Y\') as start_date,DATE_FORMAT(a.end_date, \'%d %b %Y\') as end_date,a.status,a.id_academic_year',FALSE)
            ->from('academic_year As a')
            ->where('a.school_id',$this->session->userdata('school_id'));

        return $this->datatables->generate();
    }

    function getAcademicYear($data)
    {
        $this->db->select('*');
        $this->db->from('academic_year');
        if(isset($data['id_academic_year']))
            $this->db->where('id_academic_year',$data['id_academic_year']);
        if(isset($data['school_id']))
            $this->db->where('school_id',$data['school_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addAcademicYear($data)
    {
        $this->db->insert('academic_year',$data);
        //echo $this->db->last_query();
        return $this->db->insert_id();
    }

    function updateAcademicYear($data)
    {
        $this->db->where('id_academic_year',$data['id_academic_year']);
        $this->db->update('academic_year', $data);
    }

    function deleteAcademicYear($id)
    {
        $this->db->where('id_academic_year',$id);
        $this->db->delete('academic_year');
        return 1;
    }

    function getBoardDataTable($data)
    {
        $this->datatables->select('b.board_name,b.status,b.id_board',FALSE)
            ->from('board As b')
            ->where('b.school_id',$this->session->userdata('school_id'));

        return $this->datatables->generate();
    }

    function getBoard($data)
    {
        $this->db->select('*');
        $this->db->from('board');
        if(isset($data['id_board']))
            $this->db->where('id_board',$data['id_board']);
        if(isset($data['school_id']))
            $this->db->where('school_id',$data['school_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addBoard($data)
    {
        $this->db->insert('board',$data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    function updateBoard($data)
    {
        $this->db->where('id_board',$data['id_board']);
        $this->db->update('board', $data);
    }

    function deleteBoard($id)
    {
        $this->db->where('id_board',$id);
        $this->db->delete('board');
        return 1;
    }
    function getCourseDataTable($data)
    {
        $this->datatables->select('b.board_name,c.course_name,c.code,c.status,c.id_course',FALSE)
            ->from('course As c')
            ->join('board b','b.id_board=c.board_id','left')
            ->where('c.school_id',$this->session->userdata('school_id'));

        return $this->datatables->generate();
    }

    function getCourse($data)
    {
        $this->db->select('*');
        $this->db->from('course');
        if(isset($data['id_course']))
            $this->db->where('id_course',$data['id_course']);
        if(isset($data['board_id']))
            $this->db->where('board_id',$data['board_id']);
        if(isset($data['school_id']))
            $this->db->where('school_id',$data['school_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        //echo $this->db->last_query(); exit;
        return $query->result_array();
    }

    function addCourse($data)
    {
        $this->db->insert('course',$data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    function updateCourse($data)
    {
        $this->db->where('id_course',$data['id_course']);
        $this->db->update('course', $data);
    }

    function deleteCourse($id)
    {
        $this->db->where('id_course',$id);
        $this->db->delete('course');
        return 1;
    }

    function getSubjectDataTable($data)
    {
        $this->datatables->select('c.course_name,s.subject_name,s.subject_code,s.status,s.id_subject',FALSE)
            ->from('subject As s')
            ->join('course c','c.id_course=s.course_id','left')
            ->where('c.school_id',$this->session->userdata('school_id'));

        return $this->datatables->generate();
    }

    function getSubject($data)
    {
        $this->db->select('*');
        $this->db->from('subject');
        if(isset($data['id_subject']))
            $this->db->where('id_subject',$data['id_subject']);
        if(isset($data['course_id']))
            $this->db->where('course_id',$data['course_id']);
        if(isset($data['school_id']))
            $this->db->where('school_id',$data['school_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addSubject($data)
    {
        $this->db->insert('subject',$data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    function updateSubject($data)
    {
        $this->db->where('id_subject',$data['id_subject']);
        $this->db->update('subject', $data);
    }

    function deleteSubject($id)
    {
        $this->db->where('id_subject',$id);
        $this->db->delete('subject');
        return 1;
    }

    function getWeekDay($data)
    {
        $this->db->select('*');
        $this->db->from('week_day');
        if(isset($data['day']))
            $this->db->where('day',$data['day']);
        if(isset($data['school_id']))
            $this->db->where('school_id',$data['school_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addWeekDay($data)
    {
        $this->db->insert('week_day',$data);
        //echo $this->db->last_query(); exit;
        return $this->db->insert_id();
    }

    function updateWeekDay($data)
    {
        $this->db->where('id_week_day',$data['id_week_day']);
        $this->db->update('week_day', $data);
        return 1;
    }

    function getClassTimingDataTable($data)
    {
        $this->datatables->select('c.course_name,ct.name,ct.start_time,ct.end_time,ct.is_break,ct.id_class_timing',FALSE)
            ->from('class_timing ct')
            ->join('course c','c.id_course=ct.course_id','left')
            ->where('c.school_id',$this->session->userdata('school_id'));

        return $this->datatables->generate();
    }

    function getClassTiming($data)
    {
        $this->db->select('c.course_name,ct.course_id,ct.name,ct.start_time,ct.end_time,ct.is_break,ct.id_class_timing');
        $this->db->from('class_timing ct');
        $this->db->join('course c','c.id_course=ct.course_id','left');
        if(isset($data['course_id']))
            $this->db->where('ct.course_id',$data['course_id']);
        if(isset($data['school_id']))
            $this->db->where('c.school_id',$data['school_id']);
        if(isset($data['id_class_timing']))
            $this->db->where('id_class_timing',$data['id_class_timing']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function addClassTiming($data)
    {
        $this->db->insert('class_timing',$data);
        return $this->db->insert_id();
    }

    function updateClassTiming($data)
    {
        $this->db->where('id_class_timing',$data['id_class_timing']);
        $this->db->update('class_timing', $data);
        //echo $this->db->last_query(); exit;
        return 1;
    }

    function deleteClassTiming($id_class_timing)
    {
        $this->db->where('id_class_timing',$id_class_timing);
        $this->db->delete('class_timing');
        //echo $this->db->last_query(); exit;
        return 1;
    }

    function getClassTimeTableDataTable($data)
    {
        $this->datatables->select('c.course_name,ct.start_date,ct.end_date,ct.status,ct.id_class_time_table',FALSE)
            ->from('class_time_table ct')
            ->join('course c','c.id_course=ct.course_id','left')
            ->where('c.school_id',$this->session->userdata('school_id'));

        return $this->datatables->generate();
    }

    function getClassTimeTable($data)
    {
        $this->db->select('*');
        $this->db->from('class_time_table');
        if(isset($data['id_class_time_table']))
            $this->db->where('id_class_time_table',$data['id_class_time_table']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getStaff($data)
    {
        $this->db->select('s.id_staff,CONCAT(s.first_name," ",s.last_name) as name');
        $this->db->from('staff s');
        if(isset($data['school_id']))
            $this->db->where('s.school_id',$data['school_id']);

        $query = $this->db->get();
        return $query->result_array();
    }

    function addClassTimeTable($data)
    {
        $this->db->insert('class_time_table',$data);
        return $this->db->insert_id();
    }

    function updateClassTimeTable($data)
    {
        $this->db->where('id_class_time_table',$data['id_class_time_table']);
        $this->db->update('class_time_table', $data);
        //echo $this->db->last_query(); exit;
        return 1;
    }

    function addTimeTable($data)
    {
        $this->db->insert_batch('time_table',$data);
        return $this->db->insert_id();
    }

    function getTimeTableData($data)
    {
        $this->db->select('*');
        $this->db->from('time_table tt');
        $this->db->join('subject s','tt.subject_id=s.id_subject','left');
        $this->db->join('staff st','tt.teacher_id=st.id_staff','left');
        if(isset($data['class_time_table_id']))
            $this->db->where('tt.class_time_table_id',$data['class_time_table_id']);
        if(isset($data['class_timing_id']))
            $this->db->where('tt.class_timing_id',$data['class_timing_id']);
        if(isset($data['day_id']))
            $this->db->where('tt.day_id',$data['day_id']);
        $query = $this->db->get();
        return $query->result_array();
    }

    function updateTimeTable($data)
    {
        $this->db->update_batch('time_table', $data, 'id_time_table');
    }

    function deleteTimeTable($id)
    {
        $this->db->where('class_time_table_id',$id);
        $this->db->delete('time_table');
        return 1;
    }

    function deleteClassTimeTable($id)
    {
        $this->db->where('id_class_time_table',$id);
        $this->db->delete('class_time_table');
        return 1;
    }

    function getSection($data)
    {
        $this->db->select('*');
        $this->db->from('section');
        if(isset($data['id_section']))
            $this->db->where('id_section',$data['id_section']);
        if(isset($data['course_id']))
            $this->db->where('course_id',$data['course_id']);
        if(isset($data['status']))
            $this->db->where('status',$data['status']);
        $query = $this->db->get();
        return $query->result_array();
    }
}
?>