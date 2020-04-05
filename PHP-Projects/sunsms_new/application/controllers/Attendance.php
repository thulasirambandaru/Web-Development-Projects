<?php
/**
 * Created by PhpStorm.
 * User: VENKATESH-LENOVO
 * Date: 02-07-2016
 * Time: 03:44 PM
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends CI_Controller
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
        $this->load->model("mattendance");
    }

    function index()
    {
        $data['board'] = $this->mwelcome->getBoard(array('status' => 1));
        $data['staff'] = $this->mwelcome->getStaff(array('staff_status' => 1));

        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='attendance/attendance';
        $data['footer']='footer';
        $data['menu'] = 'attendance';
        $data['type'] = 'attendance';
        $this->load->view('landing',$data);
    }

    function studentAttendance()
    {
        $data['board'] = $this->mwelcome->getBoard(array('status' => 1));
        $data['staff'] = $this->mwelcome->getStaff(array('staff_status' => 1));

        $data['header']="header";
        $data['left_menu']="left_menu";
        $data['middle_content']='attendance/attendance';
        $data['footer']='footer';
        $data['menu'] = 'attendance';
        $data['type'] = 'student_attendance';
        $this->load->view('landing',$data);
    }


    function getCourse()
    {
        $data = $this->mwelcome->getCourse(array('board_id' => $_POST['board_id'],'status' => 1));
        echo json_encode(array('response' => 1,'data' => $data));
    }

    function getSection()
    {
        $data = $this->mwelcome->getSection(array('course_id' => $_POST['course_id'],'status' => 1));
        echo json_encode(array('response' => 1,'data' => $data));
    }

    function getAttendance()
    {
        //echo "<pre>";print_r($_POST); exit;
        if(isset($_POST['board_id']))
            $board_id = $_POST['board_id'];
        else $board_id = 0;
        if(isset($_POST['course_id']))
            $course_id = $_POST['course_id'];
        else $course_id = 0;
        if(isset($_POST['section_id']))
            $section_id = $_POST['section_id'];
        else $section_id = 0;
        $month = $_POST['month'];
        if($month<10){ $month = '0'.$month; }
        if(isset($_POST['staff_id']))
            $staff_id = $_POST['staff_id'];
        else $staff_id = 0;
        $year = date('Y');
        $first_date = date('01-'.$month.'-'.$year);
        $first_date = date('Y-m-d',strtotime($first_date . "-1 days"));
        //echo $first_date; exit;
        $days = get_days_in_month($month,date('Y'));

        if($board_id!=0 && $course_id!=0 && $section_id!=0){ $staff_id=0; }
        else{ $board_id=0; $course_id=0; $section_id=0; }

        $attendance = $this->mattendance->getAttendance($_POST);
        $student = $this->mattendance->getStudents($_POST);

        $week_days = $this->mattendance->getWeekdays(array('status' => 1));
        $week_days = array_map(function($i){ return $i['day']; },$week_days);
        $result = $result_array = array();
        $html='';
        $total_attendance = 0;
        $year = date('Y');
        if(empty($attendance))
        {
            for ($s = 0; $s < count($student); $s++) {
                $html.= '<tr class="atten-grid">';
                for ($r = 0; $r <= $days; $r++) {
                    if ($r == 0) {
                        $html .= '<td>' . $result[$s][$r] = $student[$s]['first_name'] . ' ' . $student[$s]['last_name'] . '<input type="hidden" name="student[]" value="' . $student[$s]['id_student'] . '"></td>';
                    } else {
                        if(strtotime($first_date . "+" . $r . " days")>strtotime(date('d-m-Y'))){
                            $html .= '<td><span>---</span><input type="hidden" value="-1" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '"></td>';
                        }
                        else if (in_array((date('N', strtotime($first_date . "+" . $r . " days"))), $week_days)) {
                            $html .= '<td><span title="Present" onclick="changeAttendance(this,2)" class="present_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                    <input type="hidden" value="1" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    </td>';
                            $total_attendance = $total_attendance + 1;
                        }
                        else
                            $html .= '<td><span title="holiday" class="holiday_icon"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
                                <input type="hidden" value="-1" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                </td>';
                    }
                }
                $html .='<td><span>'.$total_attendance.'</span></td>';
                $html .= '</tr>';
                //echo $html; exit;
            }
        }
        else
        {
            $attendance_data_day = array();
            $attendance_data = $this->mattendance->getAttendanceData(array('attendance_id' => $attendance[0]['id_attendance'],'month' => $month));
            //echo "<pre>";print_r($attendance_data); exit;
            for($s=0;$s<count($attendance_data);$s++)
            {
                $attendance_data_day[$attendance_data[$s]['student_id']][$attendance_data[$s]['date']] = $attendance_data[$s];
            }

            if(empty($attendance_data))
            {
                for ($s = 0; $s < count($student); $s++) {
                    $total_attendance = 0;
                    $html .= '<tr class="atten-grid">';
                    for ($r = 0; $r <= $days; $r++) {
                        //echo $r;
                        if ($r == 0) {
                            $html .= '<td>' . $result[$s][$r] = $student[$s]['first_name'] . ' ' . $student[$s]['last_name'] . '<input type="hidden" name="student[]" value="' . $student[$s]['id_student'] . '"></td>';
                        } else {

                            if(strtotime($first_date . "+" . $r . " days")>strtotime(date('d-m-Y'))){
                                $html .= '<td><span>---</span><input type="hidden" value="-1" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                </td>';
                            }
                            else{
                                if (in_array((date('N', strtotime($first_date . "+" . $r . " days"))), $week_days)) {
                                    $html .= '<td><span title="Present" onclick="changeAttendance(this,2)" class="present_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                    <input type="hidden" value="1" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    </td>';
                                    $total_attendance = $total_attendance+1;
                                }
                                else {
                                    $html .= '<td><span title="holiday" class="holiday_icon"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
                                <input type="hidden" value="-1" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                </td>';
                                }
                            }

                        }
                    }
                    $html .='<td><span>'.$total_attendance.'</span></td>';
                    $html .= '</tr>';
                }
            }
            else
            {
                $m = 0;
                for ($s = 0; $s < count($student); $s++){ $total_attendance = 0;
                    $html .= '<tr class="atten-grid">';
                    for($r=0;$r<=$days;$r++){
                        if($r<10) $r = '0'.$r;

                        if ($r == 0) {
                            $html .= '<td>' . $result[$s][$r] = $student[$s]['first_name'] . ' ' . $student[$s]['last_name'] . '<input type="hidden" name="student[]" value="' . $student[$s]['id_student'] . '"></td>';
                        }
                        else if(strtotime($first_date . "+" . $r . " days")>strtotime(date('d-m-Y'))){
                            $html .= '<td><span>---</span><input type="hidden" value="-1" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                                  <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '"></td>';
                        }
                        else if(!in_array((date('N', strtotime($year.'-'.$month.'-'.$r))), $week_days)) {
                            $html .= '<td><span title="holiday" class="holiday_icon"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
                                        <input type="hidden" value="-1" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                        }
                        else if (isset($attendance_data_day[$student[$s]['id_student']][$year.'-'.$month.'-'.$r]))
                        {
                            //print_r($attendance_data_day[$student[$s]['id_student']][$year.'-'.$month.'-'.$r]); exit;
                            //echo date('N', strtotime($attendance_data_day[$student[$s]['id_student']][$year.'-'.$month.'-'.$r]['date']));

                            if ($attendance_data_day[$student[$s]['id_student']][$year.'-'.$month.'-'.$r]['attendance'] == 0) {
                                $html .= '<td><span title="absent" onclick="changeAttendance(this,1)" class="absent_icon"><i class="fa fa-times" aria-hidden="true"></i></span>
                                        <input type="hidden" value="' . $attendance_data_day[$student[$s]['id_student']][$year.'-'.$month.'-'.$r]['attendance'] . '" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                            } else if ($attendance_data_day[$student[$s]['id_student']][$year.'-'.$month.'-'.$r]['attendance'] == 2) {
                                $total_attendance = $total_attendance + 0.5;
                                $html .= '<td><span title="half-day" onclick="changeAttendance(this,0)"><i class="fa fa-check present_icon" aria-hidden="true"></i><i class="fa fa-times absent_icon" aria-hidden="true"></i>
                                        <input type="hidden" value="' . $attendance_data_day[$student[$s]['id_student']][$year.'-'.$month.'-'.$r]['attendance'] . '" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                            } else {
                                $total_attendance = $total_attendance + 1;
                                $html .= '<td><span title="prasent" onclick="changeAttendance(this,2)" class="present_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                        <input type="hidden" value="1" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                            }
                        }
                        else {
                            $total_attendance = $total_attendance + 1;
                            $html .= '<td>
                                        <span title="present" onclick="changeAttendance(this,2)" class="present_icon">
                                        <i class="fa fa-check" aria-hidden="true"></i></span>
                                        <input type="hidden" value="1" name="val_' . $student[$s]['id_student'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                        }
                    }
                    $html .='<td><span>'.$total_attendance.'</span></td>';
                    $html .= '</tr>';
                }
            }
        }

        $header = '<tr><td>Name</td>';
        $days = get_days_in_month($month,date('Y'));
        for($s=0;$s<$days;$s++){
        	$day_of_month=$s+1;
            $header.='<td>'.date('D',strtotime(($s+1).'-'.$month.'-'.$year)).'<br>'.$day_of_month.'</td>';
        }
        $header.='<td>Total</td>';
        $header.='</tr>';

        echo json_encode(array('response' => 1,'data' => $html,'header' => $header));
    }

    function addAttendance()
    {
        ini_set('post_max_size', '500M');
        //echo "<pre>";print_r($_POST);
        if(isset($_POST['board_id']))
            $board_id = $_POST['board_id'];
        else $board_id = 0;
        if(isset($_POST['course_id']))
            $course_id = $_POST['course_id'];
        else $course_id = 0;
        if(isset($_POST['section_id']))
            $section_id = $_POST['section_id'];
        else $section_id = 0;
        if (strpos($_POST['url'], 'studentAttendance') !== false) {
            $url = BASE_URL . 'index.php/Attendance/studentAttendance/';
        }
        else{
            $url = BASE_URL . 'index.php/Attendance/';
        }

        if(!isset($_POST['notify'])){
            if($board_id!=0 && $course_id!=0 && $section_id!=0) {
                redirect($url.'?board_id=' . base64_encode($_POST['board_id']) . '&course_id=' . base64_encode($_POST['course_id']) . '&section_id=' . base64_encode($_POST['section_id']) . '&month=' . base64_encode($_POST['month']));
            }
            else{
                redirect($url.'?staff_id=' . base64_encode($_POST['staff_id']) . '&month=' . base64_encode($_POST['month']));
            }
        }
        for($s=0;$s<count($_POST['notify']);$s++)
        {
            $exp = explode('_',$_POST['notify'][$s]);
            $_POST['date'][] = $exp[2];
        }

        $_POST['date'] = array_unique($_POST['date']);
        $month = $_POST['month'];
        if($_POST['month']<10){ $_POST['month'] = '0'.$month; }

        $academic_year = $this->mattendance->getAcademicYear(array('status' => 1));

        $attendance_details = $this->mattendance->getAttendance(array(
            'academic_year_id' => $academic_year[0]['id_academic_year'],
            'board_id' => $_POST['board_id'],
            'course_id' => $_POST['course_id'],
            'section_id' => $_POST['section_id'],
            'staff_id' => 0
        ));


        if(empty($attendance_details)){
            $attendance_id = $this->mattendance->addAttendance(
                array(
                    'academic_year_id' => $academic_year[0]['id_academic_year'],
                    'board_id' => $_POST['board_id'],
                    'course_id' => $_POST['course_id'],
                    'section_id' => $_POST['section_id'],
                    'created_by' => $this->session->userdata('user_id')
                )
            );


            for($s=0;$s<count($_POST['date']);$s++){
                for($r=0;$r<count($_POST['student']);$r++){
                    if(isset($_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n']) && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s]]!=1 && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s]]!=-1)
                    $this->mattendance->addAttendanceData(array(
                        'attendance_id' => $attendance_id,
                        'student_id' => $_POST['student'][$r],
                        'date' => $_POST['date'][$s],
                        'attendance' => $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']
                    ));
                }
            }
        }
        else
        {
            //echo "<pre>";print_r($_POST); exit;
            $attendance_id = $attendance_details[0]['id_attendance'];
            $attendance_data_details = $this->mattendance->getAttendanceData(array('attendance_id' => $attendance_details[0]['id_attendance'],'month' => $_POST['month']));
            //echo "<pre>";print_r($attendance_data_details); exit;
            if(!empty($attendance_data_details))
            {
                for($s=0;$s<count($attendance_data_details);$s++){
                    if(isset($attendance_data_details[$s]))
                        $attendance_data_details[$attendance_data_details[$s]['student_id'].'_'.$attendance_data_details[$s]['date']] = $attendance_data_details[$s];
                }
                //$db_dates = array_map(function($i){ return $i['date']; },$attendance_data_details);
                for($s=0;$s<count($_POST['date']);$s++){
                    for($r=0;$r<count($_POST['student']);$r++){
                        if(isset($attendance_data_details[$_POST['student'][$r].'_'.$_POST['date'][$s]]) && isset($_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n'])){

                            if(isset($_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n']) && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']!=1 && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']!=-1)
                                $this->mattendance->updateAttendanceData(array(
                                    'id_attendance_data' => $attendance_data_details[$_POST['student'][$r].'_'.$_POST['date'][$s]]['id_attendance_data'],
                                    'attendance' => $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']
                                ));
                            else
                                $this->mattendance->deleteAttendanceData(array(
                                    'id_attendance_data' => $attendance_data_details[$_POST['student'][$r].'_'.$_POST['date'][$s]]['id_attendance_data']
                                ));
                        }
                        else{
                            if(isset($_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n']) && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']!=1 && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']!=-1)
                            $this->mattendance->addAttendanceData(array(
                                'attendance_id' => $attendance_details[0]['id_attendance'],
                                'student_id' => $_POST['student'][$r],
                                'date' => $_POST['date'][$s],
                                'attendance' => $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']
                            ));
                        }
                    }
                }
            }
            else
            {
                for($s=0;$s<count($_POST['date']);$s++){
                    for($r=0;$r<count($_POST['student']);$r++) {
                        if (isset($_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n']) && $_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n'] != 1 && $_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n'] != -1) {
                            $this->mattendance->addAttendanceData(array(
                                'attendance_id' => $attendance_id,
                                'student_id' => $_POST['student'][$r],
                                'date' => $_POST['date'][$s],
                                'attendance' => $_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n']
                            ));
                        }
                    }
                }
            }

        }
        //exit;


        //notification data for sending attendance
        if($_POST['notify_check']){
            $notifications = array();
            if(isset($_POST['notify'])){
                for($s=0;$s<count($_POST['notify']);$s++){
                    $student_id = explode('_',$_POST['notify'][0]);
                    $notifications[] = array(
                        'student_id' => $student_id[1],
                        'attendance' => $_POST[$_POST['notify'][0].'_n']
                    );
                }
            }
        }

        if($board_id!=0 && $course_id!=0 && $section_id!=0) {
            redirect($url.'?board_id=' . base64_encode($_POST['board_id']) . '&course_id=' . base64_encode($_POST['course_id']) . '&section_id=' . base64_encode($_POST['section_id']) . '&month=' . base64_encode($_POST['month']));
        }
        else{
            redirect($url.'?staff_id=' . base64_encode($_POST['staff_id']) . '&month=' . base64_encode($_POST['month']));
        }

    }

    function getUserAttendance()
    {
        $user_id = $_POST['user_id'];
        $month = $_POST['month'];
        if($month<10){ $month = '0'.$month; }
        $user_details = $this->mattendance->getUser(array('user_id' => $user_id));
        $attendance_data = $this->mattendance->getAttendanceData(array('student_id' => $user_id,'month' => $month));
        //echo "<pre>";print_r($attendance_data); exit;
        $week_days = $this->mattendance->getWeekdays(array('status' => 1));
        $week_days = array_map(function($i){ return $i['day']; },$week_days);
        $html = '';
        $html .= '<tr class="atten-grid">';

        for ($sr = -1, $r = 0; $sr < count($attendance_data); $sr++, $r++) {
            if ($r == 0) {
                $html .= '<td>' . $user_details[0]['username'] . '</td>';
            }
            if (isset($attendance_data[$sr]))
            if (isset($attendance_data[$sr])) {
                if (!in_array((date('N', strtotime($attendance_data[$sr]['date']))), $week_days))
                    $html .= '<td><span title="holiday"><i class="fa fa-bell-o" aria-hidden="true"></i></span></td>';
                else if ($attendance_data[$sr]['attendance'] == -1) {
                    $html .= '<td><span title="holiday"><i class="fa fa-bell-o" aria-hidden="true"></i></span></td>';
                }else if ($attendance_data[$sr]['attendance'] == 0) {
                    $html .= '<td><span><i class="fa fa-times" aria-hidden="true"></i></span></td>';
                } else if ($attendance_data[$sr]['attendance'] == 1) {
                    $html .= '<td><span title="present"><i class="fa fa-check" aria-hidden="true"></i></span></td>';
                } else {
                    $html .= '<td><span title="half-day"><i class="fa fa-check" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></i></span></td>';
                }
            } else {
                $html .= '<td><span title="present"><i class="fa fa-check" aria-hidden="true"></i></span></td>';
            }
        }

        $html .= '</tr>';

        $header = '<tr>';
        $days = get_days_in_month($month,date('Y'));
        for($s=0;$s<$days;$s++){ $day = ($s+1).'-'.$month.'-'.date('Y');
            $header.='<td>'.date('D',strtotime($day)).'</td>';
        }

        $header.='</tr>';

        echo json_encode(array('response' => 1,'data' => $html,'header' => $header));
    }

    function getWorkingDays()
    {
        $month = $_POST['month'];
        $week_days = $this->mattendance->getWeekdays(array('status' => 0));
        $week_days = array_map(function($i){ return $i['day']==7 ? 0 : $i['day']; },$week_days);
        //$week_days = join(',',$week_days);
        //echo "<pre>";print_r($week_days); exit;
        //$days = cal_days_in_month(CAL_GREGORIAN,$month,date('Y'));
        $days = $this->workingDays(date('Y'),$month,$week_days);
        echo json_encode(array('days' => $days,'response' => 1));
    }

    function workingDays($year, $month, $ignore) {
        $count = 0;
        $counter = mktime(0, 0, 0, $month, 1, $year);
        while (date("n", $counter) == $month) {
            if (in_array(date("w", $counter), $ignore) == false) {
                $count++;
            }
            $counter = strtotime("+1 day", $counter);
        }
        return $count;
    }

    function getStaffAttendance()
    {
        $month = $_POST['month'];
        if($month<10){ $month = '0'.$month; }
        $year = date('Y');
        $first_date = date('01-'.$month.'-'.$year);
        $hfirst_date = date('Y-m-d',strtotime($first_date));
        $first_date = date('Y-m-d',strtotime($first_date . "-1 days"));
        
        //echo $first_date; exit;
        $days = get_days_in_month($month,date('Y'));


        $week_days = $this->mattendance->getWeekdays(array('status' => 1));
        
        $week_days = array_map(function($i){ return $i['day']; },$week_days);
        $result = $result_array = array();
        $html='';
        $total_attendance = 0;

        $staff = $this->mwelcome->getStaff(array('staff_status' => 1));

        for ($s = 0; $s < count($staff); $s++) {
            $total_attendance = 0;
            $attendance = $this->mattendance->getAttendance(array('staff_id' => $staff[$s]['id_staff']));

            /*if(empty($attendance)){
                $html .= '<tr class="atten-grid">';
                for ($r = 0; $r <= $days; $r++) {
                    if ($r == 0) {
                        $html .= '<td>' . $result[$s][$r] = $staff[$s]['name'] . '<input type="hidden" name="student[]" value="' . $staff[$s]['id_staff'] . '"></td>';
                    } else {
                        if(strtotime($first_date . "+" . $r . " days")>strtotime(date('d-m-Y'))){
                            $html .= '<td><span>---</span></td><input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                            <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                            </td>';
                        }
                        else if (in_array((date('N', strtotime($first_date . "+" . $r . " days"))), $week_days))
                            $html .= '<td><span title="absent" onclick="changeAttendance(this,1)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                <input type="hidden" value="0" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                </td>';
                        else
                            $html .= '<td><span title="holiday"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
                            <input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                            <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                            </td>';
                    }

                }
                $html .='<td><span>'.$total_attendance.'</span></td>';
                $html .= '</tr>';
            }
            else {
                $attendance_data = $this->mattendance->getAttendanceData(array('attendance_id' => $attendance[0]['id_attendance'],'month' => $month));
                //echo "<pre>";print_r($attendance_data); exit;

                if(empty($attendance_data)){
                    $html.= '<tr class="atten-grid">';
                    for ($r = 0; $r <= $days; $r++) {
                        if ($r == 0) {
                            $html .= '<td>' . $result[$s][$r] = $staff[$s]['name'] . '<input type="hidden" name="student[]" value="' . $staff[$s]['id_staff'] . '"></td>';
                        } else {
                            if(strtotime($first_date . "+" . $r . " days")>strtotime(date('d-m-Y'))){
                                $html .= '<td><span>---</span></td><input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    </td>';
                            }
                            else if (in_array((date('N', strtotime($first_date . "+" . $r . " days"))), $week_days))
                                $html .= '<td><span title="absent" onclick="changeAttendance(this,1)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                        <input type="hidden" value="0" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                            else
                                $html .= '<td><span title="holiday"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
                                    <input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    </td>';
                        }
                    }
                    $html .='<td><span>'.$total_attendance.'</span></td>';
                    $html .= '</tr>';
                }
                else
                {
                    $html.= '<tr class="atten-grid">';
                    for ($sr = -1, $r = 0; $sr < count($attendance_data); $sr++, $r++) {
                        //$html.= '<tr class="atten-grid">';
                        if ($r == 0) {
                            $html .= '<td>' . $result[$s][$r] = $staff[$s]['name'] . '<input type="hidden" name="student[]" value="' . $staff[$s]['id_staff'] . '"></td>';
                        }
                        else {
                            if (isset($attendance_data[$sr])) {
                                if(strtotime($first_date . "+" . $r . " days")>strtotime(date('d-m-Y'))){
                                    $html .= '<td><span>---</span></td><input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '"></td>';
                                }
                                else if (!in_array((date('N', strtotime($attendance_data[$sr]['date']))), $week_days))
                                    $html .= '<td><span title="holiday"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
                                            <input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                            <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '"></td>';
                                else if ($attendance_data[$sr]['attendance'] == -1) {
                                    $html .= '<td><span title="holiday" onclick="changeAttendance(this,1)"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
                                            <input type="hidden" value="' . $attendance_data[$sr]['attendance'] . '" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                            <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '"></td>';
                                }else if ($attendance_data[$sr]['attendance'] == 0) {
                                    $html .= '<td><span title="absent" onclick="changeAttendance(this,1)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                            <input type="hidden" value="' . $attendance_data[$sr]['attendance'] . '" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                            <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '"></td>';
                                } else if ($attendance_data[$sr]['attendance'] == 1) {
                                    $total_attendance = $total_attendance + 1;
                                    $html .= '<td><span title="present" onclick="changeAttendance(this,2)"><i class="fa fa-check" aria-hidden="true"></i></span>
                                            <input type="hidden" value="' . $attendance_data[$sr]['attendance'] . '" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                            <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '"></td>';
                                } else {
                                    $total_attendance = $total_attendance + 0.5;
                                    $html .= '<td><span title="half-day" onclick="changeAttendance(this,0)"><i class="fa fa-check" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i></i></span>
                                            <input type="hidden" value="' . $attendance_data[$sr]['attendance'] . '" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                            <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '"></td>';
                                }

                            }
                            else{
                                if(strtotime($first_date . "+" . $r . " days")>strtotime(date('d-m-Y'))){
                                    $html .= '<td><span>---</span></td><input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    </td>';
                                }
                                else if (in_array((date('N', strtotime($first_date . "+" . $r . " days"))), $week_days))
                                    $html .= '<td><span title="absent" onclick="changeAttendance(this,1)"><i class="fa fa-times" aria-hidden="true"></i></span>
                                        <input type="hidden" value="0" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                                else
                                    $html .= '<td><span title="holiday"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
                                    <input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    </td>';
                            }
                        }

                    }
                    $html .='<td><span>'.$total_attendance.'</span></td>';
                    $html .= '</tr>';
                }

            }*/
            //echo "<pre>";print_r($staff); exit;
            if(empty($attendance))
            {

                    $html.= '<tr class="atten-grid">';
                    for ($r = 0; $r <= $days; $r++) {
                        if ($r == 0) {
                            $html .= '<td>' . $result[$s][$r] = $staff[$s]['first_name'] . ' ' . $staff[$s]['last_name'] . '<input type="hidden" name="student[]" value="' . $staff[$s]['id_staff'] . '"></td>';
                        } else {
                            if(strtotime($first_date . "+" . $r . " days")>strtotime(date('d-m-Y'))){
                                $html .= '<td><span>---</span><input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '"></td>';
                            }
                            else if (in_array((date('N', strtotime($hfirst_date . "+" . $r . " days"))), $week_days)) {
                                $html .= '<td><span title="Present" onclick="changeAttendance(this,2)" class="present_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                    <input type="hidden" value="1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    </td>';
                                $total_attendance = $total_attendance + 1;
                            }
                            else
                                $html .= '<td><span title="holiday" class="holiday_icon"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
                                <input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                </td>';
                        }
                    }
                    $html .='<td><span>'.$total_attendance.'</span></td>';
                    $html .= '</tr>';
                    //echo $html; exit;

            }
            else
            {
                $attendance_data_day = array();
                $attendance_data = $this->mattendance->getAttendanceData(array('attendance_id' => $attendance[0]['id_attendance'],'month' => $month));
                //echo "<pre>";print_r($attendance_data); exit;
                for($sr=0;$sr<count($attendance_data);$sr++)
                {
                    $attendance_data_day[$attendance_data[$sr]['student_id']][$attendance_data[$sr]['date']] = $attendance_data[$sr];
                }

                if(empty($attendance_data))
                {
                    //for ($s = 0; $s < count($staff); $s++) {
                        $total_attendance = 0;
                        $html .= '<tr class="atten-grid">';
                        for ($r = 0; $r <= $days; $r++) {
                            //echo $r;
                            if ($r == 0) {
                                $html .= '<td>' . $result[$s][$r] = $staff[$s]['first_name'] . ' ' . $staff[$s]['last_name'] . '<input type="hidden" name="student[]" value="' . $staff[$s]['id_staff'] . '"></td>';
                            } else {

                                if(strtotime($first_date . "+" . $r . " days")>strtotime(date('d-m-Y'))){
                                    $html .= '<td><span>---</span><input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                </td>';
                                }
                                else{
                                    if (in_array((date('N', strtotime($hfirst_date . "+" . $r . " days"))), $week_days)) {
                                        $html .= '<td><span title="Present" onclick="changeAttendance(this,2)" class="present_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                    <input type="hidden" value="1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                    </td>';
                                        $total_attendance = $total_attendance+1;
                                    }
                                    else {
                                        $html .= '<td><span title="holiday" class="holiday_icon"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
                                <input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                </td>';
                                    }
                                }

                            }
                        }
                        $html .='<td><span>'.$total_attendance.'</span></td>';
                        $html .= '</tr>';
                    //}
                }
                else
                {
                    $m = 0;
                    //for ($s = 0; $s < count($staff); $s++){
                        $total_attendance = 0;
                        $html .= '<tr class="atten-grid">';
                        for($r=0;$r<=$days;$r++){
                        	if($r<10) $r = '0'.$r;
                            //echo date('N', strtotime($year.'-'.$month.'-'.$r)).'--'.$year.'-'.$month.'-'.$r.'<br>';
                            if ($r == 0) {
                                $html .= '<td>' . $result[$s][$r] = $staff[$s]['first_name'] . ' ' . $staff[$s]['last_name'] . '<input type="hidden" name="student[]" value="' . $staff[$s]['id_staff'] . '"></td>';
                            }
                            else if(strtotime($first_date . "+" . $r . " days")>strtotime(date('d-m-Y'))){
                                $html .= '<td><span>---</span><input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                                  <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '"></td>';
                            }
                            else if(!in_array((date('N', strtotime($hfirst_date . "+" . $r . " days"))), $week_days)) {
                                $html .= '<td><span title="holiday" class="holiday_icon"><i class="fa fa-bell-o" aria-hidden="true"></i></span>
                                        <input type="hidden" value="-1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                            }
                            else if (isset($attendance_data_day[$staff[$s]['id_staff']][$year.'-'.$month.'-'.$r]))
                            {
                                //print_r($attendance_data_day[$staff[$s]['id_staff']][$year.'-'.$month.'-'.$r]); exit;
                                //echo date('N', strtotime($attendance_data_day[$staff[$s]['id_staff']][$year.'-'.$month.'-'.$r]['date']));

                                if ($attendance_data_day[$staff[$s]['id_staff']][$year.'-'.$month.'-'.$r]['attendance'] == 0) {
                                    $html .= '<td><span title="absent" onclick="changeAttendance(this,1)" class="absent_icon"><i class="fa fa-times" aria-hidden="true"></i></span>
                                        <input type="hidden" value="' . $attendance_data_day[$staff[$s]['id_staff']][$year.'-'.$month.'-'.$r]['attendance'] . '" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                                } else if ($attendance_data_day[$staff[$s]['id_staff']][$year.'-'.$month.'-'.$r]['attendance'] == 2) {
                                    $total_attendance = $total_attendance + 0.5;
                                    $html .= '<td><span title="half-day" onclick="changeAttendance(this,0)"><i class="fa fa-check present_icon" aria-hidden="true"></i><i class="fa fa-times absent_icon" aria-hidden="true"></i></span>
                                        <input type="hidden" value="' . $attendance_data_day[$staff[$s]['id_staff']][$year.'-'.$month.'-'.$r]['attendance'] . '" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                                } else {
                                    $total_attendance = $total_attendance + 1;
                                    $html .= '<td><span title="prasent" onclick="changeAttendance(this,2)" class="present_icon"><i class="fa fa-check" aria-hidden="true"></i></span>
                                        <input type="hidden" value="1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                                }
                            }
                            else {
                                $total_attendance = $total_attendance + 1;
                                $html .= '<td>
                                        <span title="present" onclick="changeAttendance(this,2)" class="present_icon">
                                        <i class="fa fa-check" aria-hidden="true"></i></span>
                                        <input type="hidden" value="1" name="val_' . $staff[$s]['id_staff'] . '_' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        <input type="hidden" name="date[]" value="' . date('Y-m-d', strtotime($first_date . "+" . $r . " days")) . '">
                                        </td>';
                            }
                        }
                        $html .='<td><span>'.$total_attendance.'</span></td>';
                        $html .= '</tr>';
                    //}
                }
            }

            /*$header = '<tr><td>Name</td>';
            $days = get_days_in_month($month,date('Y'));
            for($s=0;$s<$days;$s++){
                $header.='<td>'.date('D',strtotime(($s+1).'-'.$month.'-'.$year)).'</td>';
            }
            $header.='<td>Total</td>';
            $header.='</tr>';

            echo json_encode(array('response' => 1,'data' => $html,'header' => $header));*/

        } //exit;

        $header = '<tr><td>Name</td>';
        $days = get_days_in_month($month,date('Y'));
        for($s=0;$s<$days;$s++){
        	$day_of_month=$s+1;
            $header.='<td>'.date('D',strtotime(($s+1).'-'.$month.'-'.date('Y'))).'<br>'.$day_of_month.'</td>';
        }
        $header.='<td>Total</td>';
        $header.='</tr>';

        echo json_encode(array('response' => 1,'data' => $html,'header' => $header));
    }

    function addStaffAttendance()
    {
        ini_set('post_max_size', '500M');
        //echo "<pre>";print_r($_POST); exit;
        $academic_year = $this->mattendance->getAcademicYear(array('status' => 1));
        $month = $_POST['month'];
        if($_POST['month']<10){ $_POST['month'] = '0'.$month; }
        $url = BASE_URL . 'index.php/attendance/';
        //echo "<pre>";print_r($_POST); exit;
        /*if(isset($_POST['student']))
        {
            for($s=0;$s<count($_POST['student']);$s++)
            {
                $attendance_details = $this->mattendance->getAttendance(array(
                    'academic_year_id' => $academic_year[0]['id_academic_year'],
                    'board_id' => 0,
                    'course_id' => 0,
                    'section_id' => 0,
                    'staff_id' => $_POST['student'][$s]
                ));

                if(empty($attendance_details)){

                    $attendance_id = $this->mattendance->addAttendance(
                        array(
                            'academic_year_id' => $academic_year[0]['id_academic_year'],
                            'staff_id' => $_POST['student'][$s],
                            'created_by' => $this->session->userdata('user_id')
                        )
                    );
                    for($sr=0;$sr<count($_POST['date']);$sr++){
                        $this->mattendance->addAttendanceData(array(
                            'attendance_id' => $attendance_id,
                            'student_id' => $_POST['student'][$s],
                            'date' => $_POST['date'][$sr],
                            'attendance' => $_POST['val_'.$_POST['student'][$s].'_'.$_POST['date'][$sr]]
                        ));
                    }
                }
                else
                {
                    //echo "<pre>";print_r($_POST); exit;
                    $attendance_id = $attendance_details[0]['id_attendance'];
                    $attendance_data_details = $this->mattendance->getAttendanceData(array('attendance_id' => $attendance_details[0]['id_attendance'],'month' => $_POST['month']));
                    //echo "<pre>";print_r($attendance_data_details); exit;

                    if(!empty($attendance_data_details))
                    {//echo "<pre>";print_r($attendance_data_details); exit;
                        for($sr=0;$sr<count($attendance_data_details);$sr++){
                            if(isset($attendance_data_details[$sr]))
                                $attendance_data_details[$attendance_data_details[$sr]['student_id'].'_'.$attendance_data_details[$sr]['date']] = $attendance_data_details[$sr];
                        }
                        //echo "<pre>";print_r($attendance_data_details); exit;
                        //$db_dates = array_map(function($i){ return $i['date']; },$attendance_data_details);
                        //echo "<pre>";print_r($db_dates); exit;
                        for($sr=0;$sr<count($_POST['date']);$sr++){
                            if(isset($attendance_data_details[$_POST['student'][$s].'_'.$_POST['date'][$sr]])){
                                //echo "<pre>";print_r($_POST['val_'.$_POST['student'][$s].'_'.$_POST['date'][$sr]]); exit;
                                $this->mattendance->updateAttendanceData(array(
                                    'id_attendance_data' => $attendance_data_details[$_POST['student'][$s].'_'.$_POST['date'][$sr]]['id_attendance_data'],
                                    'attendance' => $_POST['val_'.$_POST['student'][$s].'_'.$_POST['date'][$sr]]
                                ));
                                //echo $_POST['val_'.$_POST['student'][$s].'_'.$_POST['date'][$sr]]; exit;
                            }
                            else{
                                $this->mattendance->addAttendanceData(array(
                                    'attendance_id' => $attendance_details[0]['id_attendance'],
                                    'student_id' => $_POST['student'][$s],
                                    'date' => $_POST['date'][$sr],
                                    'attendance' => $_POST['val_'.$_POST['student'][$s].'_'.$_POST['date'][$sr]]
                                ));
                            }
                        }
                    }
                    else
                    {
                        for($sr=0;$sr<count($_POST['date']);$sr++){
                            $this->mattendance->addAttendanceData(array(
                                'attendance_id' => $attendance_id,
                                'student_id' => $_POST['student'][$s],
                                'date' => $_POST['date'][$sr],
                                'attendance' => $_POST['val_'.$_POST['student'][$s].'_'.$_POST['date'][$sr]]
                            ));
                        }
                    }
                }
            }
        }*/
        if(!isset($_POST['notify'])){
            redirect($url.'?&month=' . base64_encode($_POST['month']));
        }
        for($s=0;$s<count($_POST['notify']);$s++)
        {
            $exp = explode('_',$_POST['notify'][$s]);
            $_POST['date'][] = $exp[2];
        }

        $_POST['date'] = array_unique($_POST['date']);
        $month = $_POST['month'];
        //if($_POST['month']<10){ $_POST['month'] = '0'.$month; }

        $academic_year = $this->mattendance->getAcademicYear(array('status' => 1));
        for($r=0;$r<count($_POST['student']);$r++)
        {
            $attendance_details = $this->mattendance->getAttendance(array(
                'academic_year_id' => $academic_year[0]['id_academic_year'],
                'board_id' => 0,
                'course_id' => 0,
                'section_id' => 0,
                'staff_id' => $_POST['student'][$r]
            ));


            if(empty($attendance_details)){
                $attendance_id = $this->mattendance->addAttendance(
                    array(
                        'academic_year_id' => $academic_year[0]['id_academic_year'],
                        'staff_id' => $_POST['student'][$r],
                        'created_by' => $this->session->userdata('user_id')
                    )
                );


                for($s=0;$s<count($_POST['date']);$s++){

                    if(isset($_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n']) && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s]]!=1 && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s]]!=-1)
                        $this->mattendance->addAttendanceData(array(
                            'attendance_id' => $attendance_id,
                            'student_id' => $_POST['student'][$r],
                            'date' => $_POST['date'][$s],
                            'attendance' => $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']
                        ));

                }
            }
            else
            {
                //echo "<pre>";print_r($_POST); exit;
                $attendance_id = $attendance_details[0]['id_attendance'];
                //echo $_POST['month'].'--'.$attendance_details[0]['id_attendance'];
                $attendance_data_details = $this->mattendance->getAttendanceData(array('attendance_id' => $attendance_details[0]['id_attendance'],'month' => $_POST['month']));

                if(!empty($attendance_data_details))
                {
                    for($s=0;$s<count($attendance_data_details);$s++){
                        if(isset($attendance_data_details[$s]))
                            $attendance_data_details[$attendance_data_details[$s]['student_id'].'_'.$attendance_data_details[$s]['date']] = $attendance_data_details[$s];
                    }
                    //echo "<pre>";print_r($attendance_data_details); exit;
                    //$db_dates = array_map(function($i){ return $i['date']; },$attendance_data_details);
                    for($s=0;$s<count($_POST['date']);$s++){ //echo $_POST['student'][$r].'--'.$_POST['date'][$s].'**';
                        //echo $attendance_data_details[$_POST['student'][$r].'_'.$_POST['date'][$s]],'-<br>';
                        if(isset($attendance_data_details[$_POST['student'][$r].'_'.$_POST['date'][$s]]) && isset($_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n'])){
                            //echo $_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n'].'<br>';
                            if(isset($_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n']) && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']!=1 && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']!=-1)
                                $this->mattendance->updateAttendanceData(array(
                                    'id_attendance_data' => $attendance_data_details[$_POST['student'][$r].'_'.$_POST['date'][$s]]['id_attendance_data'],
                                    'attendance' => $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']
                                ));
                            else
                                $this->mattendance->deleteAttendanceData(array(
                                    'id_attendance_data' => $attendance_data_details[$_POST['student'][$r].'_'.$_POST['date'][$s]]['id_attendance_data']
                                ));
                        }
                        else{
                            if(isset($_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n']) && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']!=1 && $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']!=-1)
                                $this->mattendance->addAttendanceData(array(
                                    'attendance_id' => $attendance_details[0]['id_attendance'],
                                    'student_id' => $_POST['student'][$r],
                                    'date' => $_POST['date'][$s],
                                    'attendance' => $_POST['val_'.$_POST['student'][$r].'_'.$_POST['date'][$s].'_n']
                                ));
                        }
                    }
                }
                else
                {
                    for($s=0;$s<count($_POST['date']);$s++){

                        if (isset($_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n']) && $_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n'] != 1 && $_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n'] != -1) {
                            $this->mattendance->addAttendanceData(array(
                                'attendance_id' => $attendance_id,
                                'student_id' => $_POST['student'][$r],
                                'date' => $_POST['date'][$s],
                                'attendance' => $_POST['val_' . $_POST['student'][$r] . '_' . $_POST['date'][$s].'_n']
                            ));
                        }
                    }
                }

            }
        }
//exit;
        //notification data for sending attendance
        if($_POST['notify_check']){
            $notifications = array();
            if(isset($_POST['notify'])){
                for($s=0;$s<count($_POST['notify']);$s++){
                    $student_id = explode('_',$_POST['notify'][0]);
                    $notifications[] = array(
                        'student_id' => $student_id[1],
                        'attendance' => $_POST[$_POST['notify'][0].'_n']
                    );
                }
            }
        }

        redirect($url.'?&month=' . base64_encode($_POST['month']));

    }

}

