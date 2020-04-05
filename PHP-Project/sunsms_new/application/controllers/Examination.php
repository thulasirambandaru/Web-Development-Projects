 <?php
/**Examination Module - Create, Update, Read, Delete Operations.
 **/
class Examination extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('Datatables');
        $this->load->model("mwelcome");        
        $this->load->model('mcommonfuncs');
        $this->load->model('mexamination');
        if ($this->session->userdata('user_id') && $this->session->userdata('user_type_id') > 0) {
        } else {
            redirect(BASE_URL);
        }
    }
	
    function index()
    {
        $data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'examination/examination';
        $data['footer']         = 'footer';
        $data['menu']           = 'examination';
        $this->load->view('landing', $data);
    }
	
	function getExamDataTable()
    {									
        $results = json_decode($this->mexamination->getExamDataTable($_POST));
        for ($s = 0; $s < count($results->data); $s++) {
			$results->data[$s][2] = date('d-M-Y',strtotime($results->data[$s][2]));			
            $results->data[$s][3] = encode($results->data[$s][3]);
        }
        echo json_encode($results);
    }
	
	function addExam($id_exam=0) {
		if ($id_exam === 0) {			
        } 
		else 
		{
            $data['exam'] = $this->mexamination->getExam(array(
				'id_exam' => decode($id_exam)
            ));
		}

		$data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'examination/add_exam';
        $data['footer']         = 'footer';
        $data['menu']           = 'examination';
        $this->load->view('landing', $data);
	}
	
	function createExam()
	{
		//echo "<pre>";print_r($_POST); exit;
		if(isset($_POST))
		{
			if(!isset($_POST['status'])){ $status=0; }
			else{ $status = $_POST['status']; }

			if(!$_POST['id_exam'])
			{
				$this->mexamination->addExam(array(					
					'exam_name' => $_POST['name'],					
					'status' => $status,
					'fk_id_academic_year' => $this->session->userdata('academic_year')
				));
			}
			else
			{
				$this->mexamination->updateExam(array(
					'id_exam' => decode($_POST['id_exam']),
					'exam_name' => $_POST['name'],					
					'status' => $status
				));
			}

			redirect(BASE_URL.'index.php/examination');
		}
	}
	
	function deleteExam($id)
    {
        $this->mexamination->deleteExam(decode($id));        
        echo json_encode(array(
            'response' => 1,
            'data' => ''
        ));
    }
	
	function addExamSchedule($id_exam_schedule=0, $prv=0) {
		if ($id_exam_schedule === 0) {				
        } 
		else 
		{
            $data['exam_schedule'] = $this->mexamination->getExamSchedule(array(
				'id_exam_schedule' => decode($id_exam_schedule)
            ));
			
			if($prv>0)
				$data['preview'] = 1;
			else
				$data['edit'] = 1;
			
			$data['subject'] = $this->mcommonfuncs->getCourseSubjects(array(
									'course_id' => $data['exam_schedule'][0]['course_id'],
									'status' => 1								
								));
		}
		//echo '<pre>';print_r($data['exam_schedule']);
		$data['allsubjects'] = $this->mcommonfuncs->getSubjectsCount(array('status' => 1));
		//echo '<pre>';print_r($data);die;
		$data['exams'] = $this->mexamination->getExam(array('status' => 1));
		$data['board'] = $this->mwelcome->getBoard(array('status' => 1));
		$data['course'] = $this->mwelcome->getCourse(array('status' => 1));
		$data['section'] = $this->mwelcome->getSection(array('status' => 1));
		$data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'examination/add_exam_schedule';
        $data['footer']         = 'footer';
        $data['menu']           = 'examination';
        $this->load->view('landing', $data);
	}
	
	function examScheduleList()
    {
        $data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'examination/exam_schedule';
        $data['footer']         = 'footer';
        $data['menu']           = 'examination';
        $this->load->view('landing', $data);
    }
	
	function getExamScheduleDataTable()
    {									
        $results = json_decode($this->mexamination->getExamScheduleDataTable($_POST));
		
        for ($s = 0; $s < count($results->data); $s++) {
			//$results->data[$s][2] = date('d-M-Y',strtotime($results->data[$s][2]));			
            $results->data[$s][4] = encode($results->data[$s][4]);
			/*if($results->data[$s][5]!=0 && $results->data[$s][6]!=0 && $results->data[$s][7]!=0 && $results->data[$s][8]!=0) {
				//echo "test";
				unset($results->data[$s]);
			}*/
        }
		//print_r($results);
        echo json_encode($results);
    }
	
	function createExamSchedule() 
	{		
		//echo '<pre>';print_r($_POST);die;
		if(isset($_POST))
		{			
			if(!$_POST['id_exam_schedule'])
			{
				$section_id = '';
				if(isset($_POST['course_section_id'])) {
					$section_id = $_POST['course_section_id'];							
				}
					
				$data = array();
				$exam_schedule_id = $this->mexamination->createExamSchedule(array(
					'exam_id' => $_POST['exam_id'],
					'course_id' => $_POST['student_course_id'],
					'section_id' => $section_id
				));
				
				for($n=0;$n<$_POST['subject_count'];$n++) {
					//if($_POST['course_subject_id'][$n] > 0) {
						$exam_date = null;
						if(!empty($_POST['exam_date'][$n])) {
							$exam_date = date('Y-m-d', strtotime($_POST['exam_date'][$n]));
						}
						$this->mexamination->createExamScheduleData(array(					
							'exam_schedule_id' => $exam_schedule_id,
							'subject_id' => $_POST['course_subject_id'][$n],
							'exam_date' => $exam_date,
							'start_time' => $_POST['start_time'][$n],
							'end_time' => $_POST['end_time'][$n]							
						));
					//}
				}				
			}
			else
			{	//echo '<pre>';print_r($_POST);die;
				for($n=0;$n<count($_POST['exam_schedule_data_id']);$n++) 
				{
					$exam_date = null;
					if(!empty($_POST['exam_date'][$n])) {
						$exam_date = date('Y-m-d', strtotime($_POST['exam_date'][$n]));
					}
					if(empty($_POST['exam_schedule_data_id'][$n])) {
						$this->mexamination->createExamScheduleData(array(					
							'exam_schedule_id' => decode($_POST['id_exam_schedule']),
							'subject_id' => $_POST['course_subject_id'][$n],
							'exam_date' => $exam_date,
							'start_time' => $_POST['start_time'][$n],
							'end_time' => $_POST['end_time'][$n]							
						));
					}
					else {
						$this->mexamination->updateExamScheduleData(array(					
							'id_exam_schedule_data' => $_POST['exam_schedule_data_id'][$n],
							'subject_id' => $_POST['course_subject_id'][$n],
							'exam_date' => $exam_date,
							'start_time' => $_POST['start_time'][$n],
							'end_time' => $_POST['end_time'][$n]							
						));	
					}
				}
				/*for($n=0;$n<count($_POST['course_subject_id']);$n++) {
					//if(!empty($_POST['course_subject_id'][$n])) {
						$record = $this->mexamination->checkForRecord(array(					
										'exam_schedule_id' => decode($_POST['id_exam_schedule']),
										'subject_id' => $_POST['course_subject_id'][$n]
									));
						echo decode($_POST['id_exam_schedule'])."====".$_POST['course_subject_id'][$n].'<br>';
						$exam_date = null;
						if(!empty($_POST['exam_date'][$n])) {
							$exam_date = date('Y-m-d', strtotime($_POST['exam_date'][$n]));
						}
						print_r($record);
						$this->mexamination->updateExamScheduleData(array(					
							'id_exam_schedule_data' => $record[0]['id_exam_schedule_data'],
							'subject_id' => $_POST['course_subject_id'][$n],
							'exam_date' => $exam_date,
							'start_time' => $_POST['start_time'][$n],
							'end_time' => $_POST['end_time'][$n]							
						));
					//}
				}*/
			}

			redirect(BASE_URL.'index.php/Examination/examScheduleList');
		}
	}
	
	function getExamSubjects()
    {	
        if (isset($_POST)) {			
            $course_subjects = $this->mcommonfuncs->getCourseSubjects(array(
				'course_id' => $_POST['class_id'],
				'status' => 1
			));				
			
            if (empty($course_subjects)) {
                echo json_encode(array(
                    'response' => 2,
                    'data' => ''
                ));
                exit;
			} else {                
                echo json_encode(array(
                    'response' => 1,
                    'data' => $course_subjects
                ));
                exit;
            }
        }
    }
	
	function getStudentMarks()
    {	
        if (isset($_POST)) {			
            $student_marks = $this->mexamination->getStudentMarks(array(
				'course_id' => $_POST['class_id'],
				'section_id' => $_POST['section_id'],
				'subject_id' => $_POST['subject_id'],
				'status' => 1
			));				
			
			$html = "";
			$html.="<table class='commonTBL'><tr><th><b>Admission No</b></th><th><b>Student Name</b></th><th><b>Subject Mark</b></th><th><b>Subject Point</b></th><th><b>Subject Grade</b></th></tr>";
            if (empty($student_marks)) {
				
				$html.="<tr><td colspan='5' align='center'> No Students Found</td></tr>";
				$html.="</table>";
                echo json_encode(array(
                    'response' => 2,
                    'data' => $html
                ));
                exit;
				
			} else {  
				//print_r($student_marks);
				for($i=0;$i<count($student_marks);$i++) {						
					$html.="<tr><td>".$student_marks[$i]['admission_number']."</td><td><b>".$student_marks[$i]['first_name']." ".$student_marks[$i]['last_name']."</b></td>";
					
					$subject_mark = '';
					if($student_marks[$i]['subject_mark'] > 0 || !empty($student_marks[$i]['subject_mark']))
						$subject_mark = $student_marks[$i]['subject_mark'];
					
					if($_POST['preview']==null) {
						$html.="<td><input type='text' name='subject_mark".$student_marks[$i]['id_student']."' id='subject_mark".$student_marks[$i]['id_student']."' class='inputSize' value='".$subject_mark."' onkeyup='calculateGrades(&quot;sc&quot;, this.value, null, ".$student_marks[$i]['id_student'].");'></td>";
					}
					else {
						$html.="<td>".$subject_mark."</td>";
					}
					
					$subject_point = '';
					if($student_marks[$i]['subject_point'] > 0 || !empty($student_marks[$i]['subject_point']))
						$subject_point = $student_marks[$i]['subject_point'];
					
					if($_POST['preview']==null) {
						$html.="<td><input type='text' name='subject_point".$student_marks[$i]['id_student']."' id='subject_point".$student_marks[$i]['id_student']."' class='inputSize' value='".$subject_point."' onkeyup='calculateGrades(&quot;pt&quot;, null, this.value, ".$student_marks[$i]['id_student'].");'></td>";
					}
					else {
						$html.="<td>".$subject_point."</td>";
					}
					
					$subject_grade = '';
					if($student_marks[$i]['subject_grade'] > 0 || !empty($student_marks[$i]['subject_grade']))
						$subject_grade = $student_marks[$i]['subject_grade'];
					
					if($_POST['preview']==null) {
						$html.="<td><input type='text' name='subject_grade".$student_marks[$i]['id_student']."' id='subject_grade".$student_marks[$i]['id_student']."' readonly class='inputSize' value='".$subject_grade."'></td></tr>";
					}
					else {
						$html.="<td>".$subject_grade."</td></tr>";
					}
					
					$html.="<input type='hidden' name='students[]' id='students' value='".$student_marks[$i]['id_student']."'>";
				}
				$html.="</table>";
                echo json_encode(array(
                    'response' => 1,
                    'data' => $html
                ));
                exit;
            }
        }
    }
	
	function createExamMarks() 
	{		
		//echo '<pre>';print_r($_POST);die;
		if(isset($_POST))
		{
			for($n=0;$n<count($_POST['students']);$n++) 
			{	
				$student_id = $_POST['students'][$n];				
				$data[] = array(						 	
					'exam_id' => $_POST['exam_id'],
					'student_id' => $student_id,
					'subject_id' => $_POST['course_subject_id'],						
					'subject_mark' => $_POST['subject_mark'.$student_id],
					'subject_point' => $_POST['subject_point'.$student_id],
					'subject_grade' => $_POST['subject_grade'.$student_id]							
				);					
			}
			
			$records = $this->mexamination->checkExamMarkEntries();			
			if($records >0) 
				$this->mexamination->updateExamMarks($data);				
			else
				$this->mexamination->createExamMarks($data);
			
			redirect(BASE_URL.'index.php/Examination/examMarksList');
		}
	}
	
	function getSubjectPoint()
    {	
        if (isset($_POST)) {			
            $results = $this->mexamination->getSubjectPoint(array(
				'score' => $_POST['score'],
				'point' => $_POST['point']
			));	
			echo json_encode(array(
                    'response' => 1,
                    'data' => $results
                ));
                exit;
		}
	}
		
	function deleteExamSchedule($id)
    {
        $this->mexamination->deleteExamSchedule(decode($id));        
        echo json_encode(array(
            'response' => 1,
            'data' => ''
        ));
    }
	
	function examMarksList() {
		$data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'examination/exam_marks';
        $data['footer']         = 'footer';
        $data['menu']           = 'examination';
        $this->load->view('landing', $data);
	}
	
	function getExamMarksDataTable()
    {									
        $results = json_decode($this->mexamination->getExamMarksDataTable($_POST));
		
        for ($s = 0; $s < count($results->data); $s++) {						
            $results->data[$s][5] = encode($results->data[$s][5]);			
        }		
        echo json_encode($results);
    }
	
	function addExamMarks($id_exam_marks=0, $prv=0) {		
		if ($id_exam_marks === 0) {				
        } 
		else 
		{
            $data['marks_record'] = $this->mexamination->getExamMarksRecord(array(
				'id_exam_marks' => decode($id_exam_marks)
            ));
			
			if($prv>0)
				$data['preview'] = 1;
			else
				$data['edit'] = 1;
			
			$data['subject'] = $this->mcommonfuncs->getCourseSubjects(array(
									'course_id' => $data['marks_record'][0]['course_id'],
									'status' => 1								
								));
						
		}
				
		$data['exams'] = $this->mexamination->getExam(array('status' => 1));
		$data['board'] = $this->mwelcome->getBoard(array('status' => 1));
		$data['course'] = $this->mwelcome->getCourse(array('status' => 1));
		$data['section'] = $this->mwelcome->getSection(array('status' => 1));
		$data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'examination/add_exam_marks';
        $data['footer']         = 'footer';
        $data['menu']           = 'examination';
        $this->load->view('landing', $data);
	}
	
	function deleteExamMarks($id)
    {
        $this->mexamination->deleteExamMarks(decode($id));        
        echo json_encode(array(
            'response' => 1,
            'data' => ''
        ));
    }
	
	function addReportCards($id_exam_marks=0, $prv=0) {		
		if ($id_exam_marks === 0) {				
        } 
		else 
		{
            $data['marks_record'] = $this->mexamination->getExamMarksRecord(array(
				'id_exam_marks' => decode($id_exam_marks)
            ));
			
			if($prv>0)
				$data['preview'] = 1;
			else
				$data['edit'] = 1;
			
			$data['subject'] = $this->mcommonfuncs->getCourseSubjects(array(
									'course_id' => $data['marks_record'][0]['course_id'],
									'status' => 1								
								));
						
		}
				
		$data['exams'] = $this->mexamination->getExam(array('status' => 1));
		$data['board'] = $this->mwelcome->getBoard(array('status' => 1));
		$data['course'] = $this->mwelcome->getCourse(array('status' => 1));
		$data['section'] = $this->mwelcome->getSection(array('status' => 1));
		$data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'examination/add_report_cards';
        $data['footer']         = 'footer';
        $data['menu']           = 'examination';
        $this->load->view('landing', $data);
	}
	
	function getExamMarksForReport() {
		if (isset($_POST)) {
			
			$html = "";
			$html.="<table class='commonTBL'><tr><th><b>Student Name</b></th>";
			$subjects = $this->mcommonfuncs->getCourseSubjects(array(
									'course_id' => $_POST['class_id'],
									'status' => 1								
								));
			for($s=0;$s<count($subjects);$s++) {
				$html.="<th><b>".$subjects[$s]['subject_name']."</b></th>";
			}			
			
						
            $student_marks = $this->mexamination->getExamMarksForReport(array(
				'exam_id' => $_POST['exam_id'],
				'course_id' => $_POST['class_id'],
				'section_id' => $_POST['section_id'],				
				'status' => 1
			));			
			
			if(count($student_marks) > 0) {
				$student_grades = array();	
				$total_mark = 0;
				$total_point = 0;
				for($i=0;$i<count($student_marks);$i++) {					
					$student_grades[$student_marks[$i]['id_student']]['student_name'] = $student_marks[$i]['first_name']. " ".$student_marks[$i]['last_name'];					
					$student_grades[$student_marks[$i]['id_student']][$student_marks[$i]['subject_id']] = $student_marks[$i]['subject_grade']."_".$student_marks[$i]['subject_mark']."_".$student_marks[$i]['subject_point']."_".$student_marks[$i]['id_student']; 												 
				}
				
				$response = 1;
				$total_mark = 0;
				$total_point = 0;
				$result_array = array();
				foreach($student_grades as $grades) {					
					$html.="<tr><td><b>".$grades['student_name']."</b></td>";
					for($j=0;$j<count($subjects);$j++) {
						if(isset($grades[$subjects[$j]['id_subject']])) {
							$report_data = explode('_', $grades[$subjects[$j]['id_subject']]);
							$html.="<td>".$report_data[0]."</td>";
							$total_mark+= $report_data[1];							
							$total_point+= $report_data[2];														
						} else {
							$html.="<td style='background-color:#F00;'>&nbsp;</td>";
							$response = 0;
						}
						if($j==count($subjects)-1) {
							$html.="</tr>";				
							$total_point_rounded = round($total_point/count($subjects));
							$total_point = number_format(($total_point/count($subjects)), 1, '.', '');																			
							$total_grade = $this->mexamination->getGradeByPoints($total_point_rounded);							
							$result_data = $report_data[3]."_".$total_mark."_".$total_point."_".$total_grade[0]['grade_name'];							 
							$html.="<input type='hidden' name='result[]' value='".$result_data."'>"; 							
							$total_mark = 0;
							$total_point = 0;
						}							
					}
				}
			}
			else {
				$response = 0;
				$html.="<tr><td colspan='8' align='center'>No Student Grades Found</td></tr>";
			}
			$html.="</tr></table>";			
			
			echo json_encode(array(
                    'response' => $response,
                    'data' => $html
                ));
                exit;
		}
	}
	
	function generateExamReport() {		
		if(isset($_POST)) {
			for($i=0;$i<count($_POST['result']);$i++) {
				$post_data = explode('_', $_POST['result'][$i]);				
				$data[] = array(						 	
					'exam_id' => $_POST['exam_id'],
					'student_id' => $post_data[0],
					'marks_total' => $post_data[1],						
					'points_total' => $post_data[2],
					'grade_total' => $post_data[3]							
				);
			}
		}
		$this->mexamination->generateExamReports($data);
		
		redirect(BASE_URL.'index.php/Examination/examReportsList');
		
	}
	
	function examReportsList() {
		$data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'examination/exam_reports';
        $data['footer']         = 'footer';
        $data['menu']           = 'examination';
        $this->load->view('landing', $data);
	}
	
	function getExamGradesDataTable()
    {									
        $results = json_decode($this->mexamination->getExamGradesDataTable($_POST));
		
        for ($s = 0; $s < count($results->data); $s++) {						
            $results->data[$s][4] = encode($results->data[$s][4]);			
        }		
        echo json_encode($results);
    }
	
	function examGradesList() {
		$data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'examination/exam_grades';
        $data['footer']         = 'footer';
        $data['menu']           = 'examination';
        $this->load->view('landing', $data);
	}
	
	function addExamGrades($id_exam_grades=0) {				
		if ($id_exam_grades === 0) {			
        } 
		else 
		{
            $data['exam_grade'] = $this->mexamination->getExamGrades(array(
				'id_exam_grades' => decode($id_exam_grades)
            ));
		}		
		$data['header']         = "header";
        $data['left_menu']      = "left_menu";
        $data['middle_content'] = 'examination/add_exam_grades';
        $data['footer']         = 'footer';
        $data['menu']           = 'examination';
        $this->load->view('landing', $data);
	}
	
	function createExamGrades() {	//echo '<pre>';print_r($_POST);die;			
		if(isset($_POST))
		{			
			if(!$_POST['id_exam_grades'])
			{									
				$this->mexamination->createExamGrades(array(
					'grade_name' => $_POST['grade_name'],
					'grade_value' => $_POST['grade_value'],
					'lower_mark' => $_POST['low_mark_range'],
					'upper_mark' => $_POST['upper_mark_range']
				));
			}
			else 
			{
				$this->mexamination->updateExamGrades(array(					
					'id_exam_grades' => decode($_POST['id_exam_grades']),
					'grade_name' => $_POST['grade_name'],
					'grade_value' => $_POST['grade_value'],
					'lower_mark' => $_POST['low_mark_range'],
					'upper_mark' => $_POST['upper_mark_range']							
				));
			}
		}
		redirect(BASE_URL.'index.php/Examination/examGradesList');
	}
	
	function deleteExamGrades($id)
    {
        $this->mexamination->deleteExamGrades(decode($id));        
        echo json_encode(array(
            'response' => 1,
            'data' => ''
        ));
    }
	
} 