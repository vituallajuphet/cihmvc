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
		$data["title"] ="Student Take Exam";
		$data["exams"] =$this->getExams($exam_id);
		$this->load_page('AnswerExam', $data);
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
		return $data;
	}
}
