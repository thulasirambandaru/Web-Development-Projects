 <?php
/**Time Table Module - Create, Update, Read, Delete Operations.
 **/
class Timetable extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Datatables');
        $this->load->model("mwelcome");
        $this->load->model("mtimetable");
        $this->load->model('mcommonfuncs');
        if ($this->session->userdata('user_id') && $this->session->userdata('user_type_id') > 0) {
        } else {
            redirect(BASE_URL);
        }
    }
	
    function index()
    {
        $data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'timetable/time_table';
        $data['footer']         = 'footer';
        $data['menu']           = 'timetable';
        $this->load->view('landing', $data);
    }
	
    
    function getClassTimeTableDataTable()
    {					
		$input_arr = '';
		$user_type_id = $this->session->userdata('user_type_id');
		$user_id = $this->session->userdata('user_id');
		if($user_type_id == TEACHER) {
			$teacher_id = $this->mcommonfuncs->getStaffIdByUserID($user_id);
			$class_timetable_arr = $this->mtimetable->getTimetableByTeacherID($teacher_id);
			
			$class_timetable_ids = '';
			for ($c=0;$c<count($class_timetable_arr);$c++) {
				$class_timetable_ids.= $class_timetable_arr[$c]['class_time_table_id'].",";
			}
			$class_timetable_ids = explode(",",substr(trim($class_timetable_ids), 0, -1));
			$input_arr = $class_timetable_ids;			
		}
		else if($user_type_id == PARENT_ID || $user_type_id == STUDENT) {
			$course_id_arr = $this->mcommonfuncs->getCourseByParentorStudent($user_id, $user_type_id);
			
			$course_ids = '';
			for ($c=0;$c<count($course_id_arr);$c++) {
				$course_ids.= $course_id_arr[$c]['course_id'].",";
			}
			$course_ids = explode(",",substr(trim($course_ids), 0, -1));
			$input_arr = $course_ids;
		}
		
        $results = json_decode($this->mtimetable->getClassTimeTableDataTable($_POST, $user_type_id, $input_arr));
        for ($s = 0; $s < count($results->data); $s++) {			
			$results->data[$s][3] = date('d-M-Y',strtotime($results->data[$s][3]));
			$results->data[$s][4] = date('d-M-Y',strtotime($results->data[$s][4]));
            $results->data[$s][6] = encode($results->data[$s][6]);
        }
        echo json_encode($results);
    }
	
	
    function addTimetable($class_time_table=0, $prv=0)
    {
        if ($class_time_table === 0) {
			$data['board'] = $this->mwelcome->getBoard(array('status' => 1));
			$data['course'] = $this->mwelcome->getCourse(array('status' => 1));
			$data['section'] = $this->mwelcome->getSection(array('status' => 1));
        } 
		else 
		{
            $data['class_timing'] = $this->mtimetable->getClassTimeTable(array(
                'id_class_time_table' => decode($class_time_table)
            ));
			//echo '<pre>';print_r($data);die;
            $days = $this->mwelcome->getWeekDay(array(                
                'status' => 1
            ));
            $timings = $this->mwelcome->getClassTiming();
			
            if (empty($timings)) {
                $html = '<p>There are no class timings <a href="' . BASE_URL . 'index.php/admin/addClassTiming">Create Class Timing</a></p>';
            } else {   
				
				if($prv>0)
					$data['preview'] = 1;
				else
					$data['edit'] = 1;
				
                $html = '<table class="commonTBL"><tr><th>Day</th>';
                for ($s = 0; $s < count($timings); $s++) {
                    $html .= '<th>'.$timings[$s]['name'].'<br><span>'.date('h:i', strtotime($timings[$s]['start_time'])). '-' .date('h:i', strtotime($timings[$s]['end_time'])) . '</span><br><a href="javascript:void(0);" onclick="resetPeriodTimetable('.$timings[$s]['id_class_timing'].');">Reset</a></th>';
                }
                $html .= '</tr><tbody>';
                for ($s = 0; $s < count($days); $s++) {
					$html.= '<input type="hidden" name="days_arr[]" value="'. $days[$s]['day'] .'">';
                    $html .= '<tr><td><b>'.substr(week_days($days[$s]['day']-1),0,3).'</b></td>';
                    for ($r = 0; $r < count($timings); $r++) {
                        if ($timings[$r]['is_break'] == 1) {
							
							$html .= '<td><div><span><i aria-hidden="true" class="fa fa-bell-o"></i></span></div></td>';
							$html .= '<input type="hidden" name="time_id_day_id[]" value="' . $days[$s]['day'] . '@@@' . $timings[$r]['id_class_timing'] . '">';
														
                            /*$html .= '<td><div>Break</div><input type="hidden" name="time_id_day_id[]" value="' . $timings[$r]['id_class_timing'] . '@@@' . $days[$s]['day'] . '"></td>';
                            $html .= '<input type="hidden" name="time_id_day_id[]" value="' . $timings[$r]['id_class_timing'] . '@@@' . $days[$s]['day'] . '">';*/
							
                        } else {
                            $sub_tea = $this->mtimetable->getTimeTableData(array(
                                'class_time_table_id' => $data['class_timing'][0]['id_class_time_table'],
                                'class_timing_id' => $timings[$r]['id_class_timing'],
                                'day_id' => $days[$s]['day']
                            ));
                            if ($sub_tea[0]['id_staff'] == '' && $sub_tea[0]['id_subject'] == '') {
								
								$html .= '<td id="cell_'.$days[$s]['day'].'_'.$timings[$r]['id_class_timing'].'"><div><a href="javascript:;" onclick="getAssign(this,\'' . $days[$s]['day'] . '_' . $timings[$r]['id_class_timing'] . '\');" >Assign</a></div></td>';
								$html .= '<input type="hidden" name="time_id_day_id[]" value="' . $days[$s]['day'] . '@@@' . $timings[$r]['id_class_timing'] . '">';
								
                                /*$html .= '<td><div><a href="javascript:;" onclick="getAssign(this,\'' . $timings[$r]['id_class_timing'] . '_' . $days[$s]['day'] . '\');" >Assign</a></div></td>';
								$html .= '<input type="hidden" name="time_id_day_id[]" value="' . $timings[$r]['id_class_timing'] . '@@@' . $days[$s]['day'] . '">';*/
                            } else {
                                $html .= '<td id="cell_'.$days[$s]['day'].'_'.$timings[$r]['id_class_timing'].'"><div><div><span style="color:#FF8C00;"><b>' . $sub_tea[0]["first_name"] . ' '. $sub_tea[0]["last_name"] .' </b></span><br><span style="color:#006400;"><b> ' . $sub_tea[0]["subject_name"] . '</span><br><span style="cursor: pointer;" onclick="reAssign(this,\'' . $days[$s]['day'].'_'.$timings[$r]['id_class_timing'] . '\')"><i aria-hidden="true" class="fa fa-times"></i></span> <input type="hidden" value="' . $sub_tea[0]['id_staff'] . '-' . $sub_tea[0]['id_subject'] . '" name="t_' . $days[$s]['day'] . '_' . $timings[$r]['id_class_timing'] . '"></div></div></td>';
								$html .= '<input type="hidden" name="time_id_day_id[]" value="' . $days[$s]['day'] . '@@@' . $timings[$r]['id_class_timing'] . '">';
                            }
                        }
                    }
                    $html .= '</tr>';
                }
                $html .= '</table>';
            }
            $data['html'] = $html;
			$data['board'] = $this->mwelcome->getBoard(array('status' => 1));
			$data['course'] = $this->mwelcome->getCourse(array('board_id' => $data['class_timing'][0]['board_id']/*, 'status' => 1*/));
			$data['section'] = $this->mwelcome->getSection(array('course_id' => $data['class_timing'][0]['course_id']/*, 'status' => 1*/));
        }
		                        		
        $data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'timetable/add_time_table';
        $data['footer']         = 'footer';
        $data['menu']           = 'timetable';
        $this->load->view('landing', $data);
    }
	
    function getTimeTable()
    {	
        if (isset($_POST)) {
            $days = $this->mwelcome->getWeekDay(array('status' => 1));			
            $timings = $this->mwelcome->getClassTiming(array('status' => 1));
			#$time_table = $this->mwelcome->getClassTimeTable(array('course_id' => $_POST['class_id'], 'status' => 1));			
            if (empty($days)) {
                echo json_encode(array(
                    'response' => 2,
                    'data' => ''
                ));
                exit;
			} else if(empty($timings)) {
				echo json_encode(array(
                    'response' => 3,
                    'data' => ''
                ));
                exit;		
            } /*else if(!empty($time_table)) {
				echo json_encode(array(
                    'response' => 4,
                    'data' => encode($time_table[0]['id_class_time_table'])
                ));
                exit;		
            }*/ else {
                $html = '<table class="commonTBL"><tr><th>Day</th>';
                for ($s = 0; $s < count($timings); $s++) {
                    $html .= '<th>'.$timings[$s]['name'].'<br><span>'.date('h:i', strtotime($timings[$s]['start_time'])). '-' .date('h:i', strtotime($timings[$s]['end_time'])) . '</span><br><a href="javascript:void(0);" onclick="resetPeriodTimetable('.$timings[$s]['id_class_timing'].');">Reset</a></th>';
                }
                $html .= '</tr><tbody>';				
                for ($s = 0; $s < count($days); $s++) {
					$html.= '<input type="hidden" name="days_arr[]" value="'. $days[$s]['day'] .'">';
                    $html .= '<tr><td><b>'.substr(week_days($days[$s]['day']-1),0,3).'</b></td>';
                    for ($r = 0; $r < count($timings); $r++) {
                        if ($timings[$r]['is_break'] == 0) {
                            $html .= '<td id="cell_'.$days[$s]['day'].'_'.$timings[$r]['id_class_timing'].'"><div><a href="javascript:;" onclick="getAssign(this,\'' . $days[$s]['day'] . '_' . $timings[$r]['id_class_timing'] . '\');" >Assign</a></div></td>';
							$html .= '<input type="hidden" name="time_id_day_id[]" value="' . $days[$s]['day'] . '@@@' . $timings[$r]['id_class_timing'] . '">';
                        } else {
                            $html .= '<td><div><span><i aria-hidden="true" class="fa fa-bell-o"></i></span></div></td>';
							$html .= '<input type="hidden" name="time_id_day_id[]" value="' . $days[$s]['day'] . '@@@' . $timings[$r]['id_class_timing'] . '">';
						}
                    }
                    $html .= '</tr>';
                }
                $html .= '</table>';
                echo json_encode(array(
                    'response' => 1,
                    'data' => $html
                ));
                exit;
            }
        }
    }
	
    function getStaffSubject()
    {
        if (isset($_POST)) {
            $staff   = $this->mwelcome->getStaff( /*array('school_id' => $this->session->userdata('school_id'))*/ );
            $subject = $this->mwelcome->getSubject(array(
                'course_id' => $_POST['course_id'],
                'status' => 1
            ));
            echo json_encode(array(
                'response' => 1,
                'staff' => $staff,
                'subject' => $subject
            ));
        }
    }
    function createTimeTable()
    {//die;
		//echo '<pre>';print_r($_POST);
        if (!$_POST['id_class_time_table']) {
			                
			$section_id = '';
			if(isset($_POST['course_section_id'])) {
				$section_id = $_POST['course_section_id'];
				$input_arr = array('course_id' => $_POST['student_course_id'], 'section_id' => $_POST['course_section_id']);				
			}
			else {
				$input_arr = array('course_id' => $_POST['student_course_id']);				
			}
			
			// Check if timetable already exists for course_id in case yes, inactive record and create new one.
			$this->mtimetable->disableExistingTimetable($input_arr);
			
            $data = array();
            $class_time_table_id = $this->mtimetable->addClassTimeTable(array(
                'course_id' => $_POST['student_course_id'],
				'section_id' => $section_id,
                'start_date' => date('Y-m-d', strtotime($_POST['start_date'])),
                'end_date' => date('Y-m-d', strtotime($_POST['end_date'])),
                'fk_id_academic_year' => $this->session->userdata('academic_year')
            ));
			
            for ($s = 0; $s < count($_POST['time_id_day_id']); $s++) {
                $t_s = explode('@@@', $_POST['time_id_day_id'][$s]);
                if (isset($_POST['t_' . $t_s[0] . '_' . $t_s[1]])) {
                    $s_t = explode('-', $_POST['t_' . $t_s[0] . '_' . $t_s[1]]);
                } else {
                    $s_t[0] = '';
                    $s_t[1] = '';
                }
                $data[] = array(
                    'class_time_table_id' => $class_time_table_id,
                    'class_timing_id' => $t_s[1],
                    'day_id' => $t_s[0],
                    'subject_id' => $s_t[1],
                    'teacher_id' => $s_t[0]
                );
            }
			
            $this->mtimetable->addTimeTable($data);
            redirect(BASE_URL . 'index.php/Timetable/index');
        } else {
            $class_time_table_id = decode($_POST['id_class_time_table']);
            $this->mtimetable->updateClassTimeTable(array(
                'id_class_time_table' => $class_time_table_id,
                //'course_id' => $_POST['student_course_id'],
                'start_date' => date('Y-m-d', strtotime($_POST['start_date'])),
                'end_date' => date('Y-m-d', strtotime($_POST['end_date']))
            ));
            for ($s = 0; $s < count($_POST['time_id_day_id']); $s++) {
                $t_s = explode('@@@', $_POST['time_id_day_id'][$s]);
                if (isset($_POST['t_' . $t_s[0] . '_' . $t_s[1]])) {
                    $s_t = explode('-', $_POST['t_' . $t_s[0] . '_' . $t_s[1]]);
                } else {
                    $s_t[0] = '';
                    $s_t[1] = '';
                }
				
                $exe_time_table = $this->mtimetable->getTimeTableData(array(
                    'class_time_table_id' => $class_time_table_id,
                    'class_timing_id' => $t_s[1],
                    'day_id' => $t_s[0]
                ));
				if(isset($exe_time_table[0]['id_time_table'])) {
					//echo $class_time_table_id."==".$t_s[0]."=====".$t_s[1]."======".$s_t[0]."======".$s_t[1]."<br>";
					$data[] = array(
						'id_time_table' => $exe_time_table[0]['id_time_table'],
						'subject_id' => $s_t[1],
						'teacher_id' => $s_t[0]
					);					
				}                
            }
			
            $this->mtimetable->updateTimeTable($data);
            redirect(BASE_URL . 'index.php/Timetable/index');
        }
    }
    function deleteClassTimeTable($id)
    {
        $this->mtimetable->deleteTimeTable(decode($id));
        $this->mtimetable->deleteClassTimeTable(decode($id));
        echo json_encode(array(
            'response' => 1,
            'data' => ''
        ));
    }
} 