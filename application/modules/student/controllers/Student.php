<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends MY_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('pagination');

	} 

	public function index(){
		$data["user"] =  $this->session->userdata();
		$id = $this->session->userdata("user_id");
		$data["todos"] =  $this->getTodoList($id);
		$data["title"] ="Student Dashboard";

		$config['base_url'] = 'http://localhost/todo/students/';
		$config['total_rows'] = count($data["todos"]);
		$config['per_page'] = 2;
		
		$config["uri_segment"] = 2;
		$this->pagination->initialize($config);

		$data["links"]  = $this->pagination->create_links();
		$data["links"]  = $this->pagination->create_links();

		$this->load_page('index', $data);
	}
	public function edit_todos($todo_id){
		$data["user"] =  $this->session->userdata();
		$id = $this->session->userdata("user_id");
		$data["todos"] =  $this->getTodoList( $id, $todo_id);
		$data["todo_details"] =  $this->getTodoAddInstruction($todo_id);
		$data["title"] = "Student Edit Todos";
		$this->load_page('edittodos', $data);
	}
	public function view_todos(){
		$data["user"] =  $this->session->userdata();
		$id = $this->session->userdata("user_id");
		$data["todos"] =  $this->getTodoList( );
		$data["title"] ="Student Edit Todos";
		$this->load_page('todos', $data);
	}
	public function view_todo_info($todo_id){
		$data["user"] =  $this->session->userdata();
		$id = $this->session->userdata("user_id");
		$data["todos"] =  $this->getTodoList(0, $todo_id);
		$data["todo_details"] =  $this->getTodoAddInstruction($todo_id);
		$data["title"] ="Student Todo";
		$this->load_page('viewtodo', $data);
	}
	public function student_profile(){
		$data["user"] =  $this->session->userdata();
		$id = $this->session->userdata("user_id");
		$data["title"] ="Student Profile";
		$this->load_page('profile', $data);
	}
	public function take_exam(){
		$data["user"] =  $this->session->userdata();
		$id = $this->session->userdata("user_id");
		$data["title"] ="Student Take Exam";
		$data["exams"] =$this->getExams();
		
		$this->load_page('TakeExam', $data);
	}
	public function answer_exam($exam_id){
		$data["user"] =  $this->session->userdata();
		$id = $this->session->userdata("user_id");
		$data["title"] ="Student Answer Exam";
		$data["exams"] =$this->getExams($exam_id);
		if(count($data["exams"])  ==0){
			redirect(base_url("students/"));
		}
		$this->load_page('AnswerExam', $data);
	}
	public function exam_history(){
		$data["user"] =  $this->session->userdata();
		$id = $this->session->userdata("user_id");
		$data["title"] ="Student Exam History";
		$data["results"] =$this->getExamsResults($id);
		$this->load_page('examhistory', $data);
	}

	public function view_exam_result($result_id)
	{
		if($result_id){
			$data["user"] =  $this->session->userdata();
			$id = $this->session->userdata("user_id");
			$data["title"] ="Student Examination Result";
			$data["results"] =$this->getExamsResults($id, $result_id);
			$this->load_page('ExamHistoryResult', $data);	
		}else{
			redirect(base_url("students/takeexam"));
		}		
	}

	public function exam_results(){
		$posts = $this->input->post();
		if($posts){
			$data["user"] =  $this->session->userdata();
			$data["title"] ="Student Exam Results";
			
			$ans  = [];
			foreach ($posts as $key => $value) {
				if($key == "exam_id"){
					continue;
				}else{
					array_push($ans, $value);
				}
			}
			 $options = array(
				'select' => 'answer',
				'where' => array(
					'exam_id' => $posts["exam_id"]
				),
				'order_by' => 'question_id'
			 );

			 $tbldata =  $this->MY_Model->getRows('tbl_exam_questions',$options);
			 $correct = [];
			 foreach ($tbldata as $dta) {
				array_push($correct, $dta["answer"]);
			 }
			$data["answers"] =$correct;
			$data["youranswer"] =$ans;
			$data["exams"] =$this->getExams($posts["exam_id"]);
			if($this->save_exam_results($posts, $correct, $ans)){
				$this->load_page('ExamResults', $data);
			}
			else{
				redirect(base_url("students/"));
			}			
		}else{
			redirect(base_url("students/"));
		}
	}
	
	public function update_todo(){
		$post = $this->input->post();
		if($post){
			$set = array(
				"completed" => $post["completed"],
			);
			
			$where = array(
				'todo_id'=> $post["todo_id"]
			);

			if($post["completed"] == "In-Progress"){
				$user_id =  $this->session->userdata("user_id");
				if($this->UpdateInProgressTask($user_id)){
					if($this->MY_Model->update("todo_list", $set, $where)){
						redirect(base_url("students/dashboard"));
					}		
				}
			}else{
				if($this->MY_Model->update("todo_list", $set, $where)){
					redirect(base_url("students/dashboard"));
				}	
			}
		}
	}

	// private functions
	private function getTodoList($user_id= 0, $todo_id = 0){
	
		if($user_id == 0 &&  $todo_id == 0){
			$options = array(
				'select'=>'*',
				'where' => array(
					'todo_status' => 1,
					'created_date' => date("Y-m-d"),
				),
				'join' => array('tbl_users'=> 'tbl_users.user_id = todo_list.user_id')

			);
		}
		else if($user_id != 0 &&  $todo_id == 0){
			$options = array(
				'select'=>'*',
				'where' => array(
					'tbl_users.user_id' => $user_id,
					'todo_status' => 1,
					'created_date' => date("Y-m-d"),
				),
				'join' => array('tbl_users'=> 'tbl_users.user_id = todo_list.user_id')
			);
		}else{
			$options = array(
				'select'=>'*',
				'where' => array(
					// 'tbl_users.user_id' => $user_id,
					'todo_list.todo_id' => $todo_id,
					'todo_status' => 1,
				),
				'join' => array('tbl_users'=> 'tbl_users.user_id = todo_list.user_id')
			);
		}
		
		$data =  $this->MY_Model->getRows('todo_list',$options);

	//	echo $this->db->last_query();

		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
	
		return $data; 
	}

	private function getTodoAddInstruction($todo_id){
		$data = [];
		if($todo_id)
		{
			$options = array(
				'select'=>'*',
				'where' => array(
					'todo_id' => $todo_id,
				)
			);
			$data =  $this->MY_Model->getRows('tbl_todolist_details', $options);
		}
		return $data;
	}

	private function UpdateInProgressTask($user_id){

		$set = array(
			"completed" => "Break",	
		);
		
		$where = array(
			"completed" => "In-Progress",
			"user_id" => $user_id,
			"todo_status" => 1
		);
		return	$this->MY_Model->update("todo_list", $set, $where);
	
	}
	private function getExams($exam_id=0, $user_id=0){
		$options = [];
		if($exam_id == 0 && $user_id==0){
			$options = array(
				'select'=>'*',
				'join' => array('tbl_exam_questions'=> 'tbl_exams.exam_id = tbl_exam_questions.exam_id'),
				'group'=> array( 'tbl_exams.exam_id' )
			);
		}
		else if($exam_id != 0 && $user_id==0){
			$options = array(
				'select'=>'*',
				'where' => array(
					'tbl_exams.exam_id' => $exam_id
				),
				'join' => array('tbl_exam_questions'=> 'tbl_exams.exam_id = tbl_exam_questions.exam_id')
			);
		}

		$data =  $this->MY_Model->getRows('tbl_exams',$options);

		$options = array(
			'select' => 'exam_id, result_id',
			'where' => array( 
				'student_id' => $this->session->userdata("user_id")
			)
		);
		$status["status"] = 0;
		$results = $this->MY_Model->getRows('tbl_exam_results', $options);
		
		$index =0;
		foreach ($data as $dta){
			foreach($results as $result ){
				if($dta["exam_id"] == $result["exam_id"]){
					$status["status"] =1;		
					 $status["result_id"] = $result["result_id"];	
					break;			
				}
				else{
					$status["status"] =0;
				
				}
			}
			$data[$index] += $status;
			$index++;
		}

		// echo '<pre>';
		// print_r($data);
		// echo '</pre>';
		return $data;
	}


	private function save_exam_results($post, $answers, $studentsAnswer){

		$index= 0;
		$cor =0;
		foreach($studentsAnswer as $sanswer){
			if(strtolower($studentsAnswer[$index]) == strtolower($answers[$index])){
				$cor++;
			}
			$index++;	
		}

		$total = count($studentsAnswer);
		$rate = ($cor / $total) * 100;
		$isPassed ="Passed";
		if($rate < 75){
			$isPassed = "Failed";
		}else if($rate > 75 && $rate < 100){
			$isPassed ="Passed";
		}else{
			$isPassed = "Perfect";
		}

		$insertData = array(
			'exam_id' => $post["exam_id"],
			'student_id' => $this->session->userdata('user_id'),
			'score' => $cor,
			'passed' => $isPassed,
			'answers' => json_encode($studentsAnswer),
			'created_date' => date("Y-m-d"),
			'updated_date' => "0000-00-00"
		);

		if($this->MY_Model->insert('tbl_exam_results', $insertData)){
			return true;
		}
		return false;
	}

	public function getExamsResults($user_id, $result_id = 0){
		$options = [];
		if($user_id != 0 && $result_id == 0){
			$options = array(
				'select'=>'*',
				'where' => array(
					'student_id' => $user_id
				)
			);
		}else if ($user_id != 0 && $result_id != 0){
		
			$options = array(
				'select'=>'*',
				'where' => array(
					'student_id' => $user_id,
					'result_id' => $result_id
				),
				'join' => array('tbl_exams'=> 'tbl_exams.exam_id = tbl_exam_results.exam_id')
			);
		}
		$data = $this->MY_Model->getRows('tbl_exam_results', $options);
		if(count($data) > 0 && $result_id != 0){
			$options = array(
				'select' => '*',
				'where' => array(
					'exam_id' => $data[0]["exam_id"]
				)
			);
			$questions["questions"] = $this->MY_Model->getRows('tbl_exam_questions', $options);
			$data += $questions;
		}

		// echo "<pre>";
		// print_r($data);
		return $data;
	}
}
