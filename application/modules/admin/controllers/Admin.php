<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	public function __construct(){
		parent::__construct();

	} 

	public function index(){
		$data["user"] =  $this->session->userdata();
		$data["todos"] = $this->getTodoList();
		$data["title"] ="Admin Dashboard";
		$this->load_page('index', $data);
	}
	

	public function create_todo(){
		$data["user"] =  $this->session->userdata();
		$data["title"] ="Admin Create Todo";
		$data["students"] = $this->getStudents();
		$this->load_page('AddTodo', $data);
	}
	public function students(){
		$data["title"] ="Admin Student List";
		$data["students"] = $this->getStudents();
		$data["user"] =  $this->session->userdata();
		$this->load_page('Student', $data);
	}

	public function pending_student(){
		$data["title"] ="Admin Pending Student List";
		$data["students"] = $this->getStudents(0, true);
		$data["user"] =  $this->session->userdata();
		$this->load_page('PendingStudent', $data);
	}
	public function add_student(){
		$data["title"] ="Admin Add new Student";
		$data["user"] =  $this->session->userdata();
		$this->load_page('AddStudent', $data);
	}

	public function edit_student($id){
		$data["title"] ="Admin Edit Student";
		$data["user"] =  $this->session->userdata();
		$data["students"] = $this->getStudents($id);
		$this->load_page('EditStudent', $data);
	}

	public function view_student_todos($user_id){
		$data["title"] ="Admin Student Todo";
		$data["user"] =  $this->session->userdata();
		$data["students"] = $this->getStudents($user_id);
		$data["todos"] = $this->getTodoList(0, $user_id);
		$this->load_page('ViewStudentTodos', $data);
	}

	public function edit_todo($id){
		$data["title"] ="Admin Edit Todo";
		$data["todos"] = $this->getTodoList($id);
		$data["user"] =  $this->session->userdata();
		$data["students"] = $this->getStudents();
		$this->load_page('EditTodo', $data);
	}

	// exam
	public function exams(){
		$data["title"] ="Admin Exam";
		$data["user"] =  $this->session->userdata();
		$data["exams"] =  $this->getExams();
		$this->load_page('exams', $data);
	}
	public function create_exam(){
		$data["title"] ="Admin Add Exam";
		$data["user"] =  $this->session->userdata();
		$this->load_page('CreateExam', $data);
	}

	public function view_exam($exam_id){
		$data["title"] ="Admin view Exam";
		$data["user"] =  $this->session->userdata();
		$data["exams"] =  $this->getExams($exam_id, 0);
	
		$this->load_page('ViewExam', $data);
	}
	

	public function save_student(){
		if($this->input->post()){
			$email = $this->input->post("email");
	
			$fname = $this->input->post("fullname");
			$age =$this->input->post("age");
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$user_type = 2;
			$user_status = 1;
			$dataInputs = array(  "fullname" => $fname, "username" => $username, "password" => $password, "user_type" => 2, "user_status" => 1, 'approved' =>1 );

			if($this->isUserExist($username, $password)){
				$msg = array(
					'err' => true,
					'message' => "This account is already exists!"
				);
				$this->session->set_flashdata('flashdata', $msg);
			}
			else{
				$id =  $this->MY_Model->insert("tbl_users", $dataInputs);
				if($id){
					$fdata = array(
						'user_id' => $id,
						'email' => $email,
						'age' => $age
					);
					$this->MY_Model->insert("tbl_user_details", $fdata);
					$msg = array(
						'err' => false,
						'message' => "Added Successfully!"
					);
					$this->session->set_flashdata('flashdata', $msg);

				}
			}	
			redirect(base_url("admin/addstudent"));
		}
	}

	public function update_student(){
		if($this->input->post()){
			$email = $this->input->post("email");
			$user_id = $this->input->post("user_id");
			
			$fname = $this->input->post("fullname");
			$age =$this->input->post("age");
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$user_type = 2;
			$user_status = 1;

			$setdata = array(  "fullname" => $fname, "username" => $username, "password" => $password);

			$where = array(
				"user_id" => $user_id
			);

			if($this->isUserExist($username, $password, $user_id)){
				$msg = array(
					'err' => true,
					'message' => "This account is already exists!"
				);
				$this->session->set_flashdata('flashdata', $msg);
			}
			else{
				$res =  $this->MY_Model->update("tbl_users", $setdata, $where);
				if($res){
					$setdata = array(
						'email' => $email,
						'age' => $age
					);

					$this->MY_Model->update("tbl_user_details", $setdata, $where);
					$msg = array(
						'err' => false,
						'message' => "Updated Successfully!"
					);
					$this->session->set_flashdata('flashdata', $msg);
					
				}
			}
			redirect(base_url("admin/editstudent/".$user_id));

		}
	}

	public function approved_user($id){
		if($id != 0){
			$where = array(
				"user_id" => $id
			);
			$set = array(
				"approved" => 1,
				"user_status" => 1,
			);
			$this->MY_Model->update("tbl_users",$set, $where);
			redirect(base_url("admin/students"));
		}
	}

	public function reject_user($id){
		if($id != 0){
			$where = array(
				"user_id" => $id
			);
			$set = array(
				"approved" => 1,
				"user_status" => 0,
			);
			$this->MY_Model->update("tbl_users",$set, $where);
			redirect(base_url("admin/students"));
		}
	}
	
	public function destroy_user($id){
		if($id){
			$where = array(
				"user_id" => $id
			);
			$set = array(
				"user_status" => 0,
			);
			$this->MY_Model->update("tbl_users",$set, $where);
		}
		redirect(base_url("admin/students"));
	}






	// update
	public function update_todo(){
		if($this->input->post()){
			$content = $this->input->post("content");
			$user_id = $this->input->post("user_id");
			$created_id = $this->session->userdata("user_id");
			$completed = $this->input->post("completed");
			$todo_id = $this->input->post("todo_id");

			$dataInputs = array(
				"user_id" => $user_id,
				"content" => $content,
				"created_id" => $created_id,
				"todo_status" => "1",
				"created_date" => date("Y-m-d"),
				"completed" => $completed
			);
			$where = array(
				'todo_id'=> $todo_id
			);

			$id =  $this->MY_Model->update("todo_list", $dataInputs, $where);
			redirect(base_url("admin/dashboard"));

		
		}
	}

	public function destroy_todo($id){
		if($id){
			$where = array(
				"todo_id" => $id
			);
			$set = array(
				"todo_status" => 0,
			);
			$this->MY_Model->update("todo_list",$set, $where);
		}
		redirect(base_url("admin/dashboard"));

	}
	

	public function save_todo(){
		if($this->input->post()){
			$content = $this->input->post("content");
			$user_id = $this->input->post("user_id");
			$created_id = $this->session->userdata("user_id");
			$completed = $this->input->post("completed");

			$dataInputs = array(
				"user_id" => $user_id,
				"content" => $content,
				"created_id" => $created_id,
				"todo_status" => 1,
				"created_date" => date("Y-m-d"),
				"completed" => $completed
			);

			$id =  $this->MY_Model->insert("todo_list", $dataInputs);
		

			$msg = array(
				'err' => false,
				'message' => "Added Successfully!"
			);
			$this->session->set_flashdata('flashdata', $msg);

			redirect(base_url("admin/createtodo"));
			
		}
	}


	// private functions

	private function getTodoList($todo_id = 0, $user_id = 0){
		if($todo_id == 0 && $user_id == 0){
			$options = array(
				'select'=>'*',
				'where' => array(
					'todo_status' => 1,
					'created_date' => date("Y-m-d"),
				),
				'join' => array('tbl_users'=> 'tbl_users.user_id = todo_list.user_id')
			);
		}
		else if($todo_id != 0){
			$options = array(
				'select'=>'*',
				'where' => array(
					'todo_id' => $todo_id,
					'todo_status' => 1,
					'created_date' => date("Y-m-d"),
				),
				'join' => array('tbl_users'=> 'tbl_users.user_id = todo_list.user_id')
			);
		}
		else if($user_id != 0){
			$options = array(
				'select'=>'*',
				'where' => array(
					'tbl_users.user_id' => $user_id,
					'todo_status' => 1,
					'created_date' => date("Y-m-d"),
				),
				'join' => array('tbl_users'=> 'tbl_users.user_id = todo_list.user_id')
			);
		}
		
		$data =  $this->MY_Model->getRows('todo_list',$options);
		return $data; 
	}
	private function getStudents($id = 0, $pending = false){
		if($id == 0 && !$pending){
			$options = array(
				'select'=>'*',
				'where' => array(
					'tbl_users.user_type' => 2,
					'tbl_users.approved' => 1,
					'tbl_users.user_status' => 1
				),
				'join' => array('tbl_user_details'=> 'tbl_users.user_id = tbl_user_details.user_id')
			);
		}
		else if($id == 0 && $pending){
			$options = array(
				'select'=>'*',
				'where' => array(
					'tbl_users.user_type' => 2,
					'tbl_users.approved' => 0,
					'tbl_users.user_status' => 1
				),
				'join' => array('tbl_user_details'=> 'tbl_users.user_id = tbl_user_details.user_id')
			);
		}
		else{
			$options = array(
				'select'=>'*',
				'where' => array(
					'tbl_users.user_type' => 2,
					'tbl_users.user_status' => 1,
					'tbl_users.approved' => 1,
					'tbl_users.user_id' => $id
				),
				'join' => array('tbl_user_details'=> 'tbl_users.user_id = tbl_user_details.user_id')
			);
		}
		
		$data =  $this->MY_Model->getRows('tbl_users',$options);
		return $data; 	
	}

	private function isUserExist($username, $password, $id= 0){
		if($id ==0){
			$options = array(
				'select'=>'*',
				'where' => array(
					'username' => $username,
					'password' => $password,
				)
			);
		}else{
			$options = array(
				'select'=>'*',
				'where' => array(
					'username' => $username,
					'user_id !=' => $id,
					'password' => $password,
				)
			);
		}
		$data =  $this->MY_Model->getRows('tbl_users',$options);
		if(count($data) > 0){
			return true;
		}
		return false;
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