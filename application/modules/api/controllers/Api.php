<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
class Api extends MY_Controller {

	protected $responseData = [];

	public function __construct(){
		parent::__construct();

	} 
	public function todos($date = null){
		$newDate = date('Y-m-d');
		if($date != null){
			$newDate = date('Y-m-d',(strtotime ( $date))  );
		}
		
		$data = $this->getTodoList($newDate);
		if($data){
			$this->responseData = array(
				'code' => 200,
				'message' => "success",
				'data' => $data 
			);
		}
		else{
			$this->responseData = array(
				'code' => 200,
				'message' => "success",
				'data' => [] 
			);
		}
		echo json_encode($this->responseData);
	}

	public function todo_add_instruction(){
		$post = $this->input->post();
		if($post){
			$inputs = array(
			  "todo_id" => $post["todo_id"],
			  "instruction" => $post["content"],
			  "created_date" => date("Y-m-d"),
			  "updated_date" => "0000-00-00",
			  "created_id" => $this->session->userdata("user_id")

			);	
			 
			 $this->MY_Model->insert("tbl_todolist_details", $inputs);
			 
			$data = $this->getTodoDetails( $post["todo_id"]);

			$msg  = array( 'code' => 200, 'data' => $data );
			echo json_encode($msg);
		}
	}

	public function get_todos_instruction($id){
		if($id){
			$data = $this->getTodoDetails( $id);

			$msg  = array( 'code' => 200, 'data' => $data );
			echo json_encode($msg);
		}
	}

	public function delete_todo(){
		$id = $this->input->post("id");
		if($id){
			$where = array(
				"id" => $id
			);
			$res =$this->MY_Model->delete("tbl_todolist_details", $where);
			if($res){
				$msg  = array( 'code' => 200, 'message' => "success" );
			}
			else{
				$msg  = array( 'code' => 204, 'message' => "failed" );
			}

		}else{
			$msg  = array( 'code' => 204, 'message' => "failed" );
		}
		echo json_encode($msg);
	}

	public function update_todo(){
		$id = $this->input->post("id");
		$content = $this->input->post("content");
		if($id && $content != ""){
			$where = array(
				"id" => $id
			);
			$set = array(
				'instruction' =>  $content,
				'updated_date' =>  date("Y-m-d"),
			);
			$res =$this->MY_Model->update("tbl_todolist_details", $set, $where);
			if($res){
				$msg  = array( 'code' => 200, 'message' => "success" );
			}
			else{
				$msg  = array( 'code' => 204, 'message' => "failed" );
			}

		}else{
			$msg  = array( 'code' => 204, 'message' => "failed" );
		}
		echo json_encode($msg);
	}

	public function check_question(){
		if($this->input->post()){
			$post = $this->input->post();

			$options = array(
				'select'=>'*',
				'where' => array(
					'exam_id' => $post["exam_id"],
					'question_id' => $post["questionid"],
				),
			);
			$data =  $this->MY_Model->getRows('tbl_exam_questions',$options);
			
			$msg = array(
				"code" => 200,
				"data"=> $data,
				"message" =>'success'
			);
			echo json_encode($msg);
		}
	}

	public function submit_exam_result(){
		$post = $this->input->post();
		if($post){
			echo '<pre>';
			print_r($post);
			echo '</pre>';
		}
	}

	public function save_category (){
		$post = $this->input->post();
		if($post){
			if(!$this->isCategoryExist($post["categoryname"])){
				$inputs = array(
					"category_name" => $post["categoryname"],
					"created_date" => date("Y-m-d"),
					"updated_date" => "0000-00-00",
					"category_status" => "1",
					"created_id" => $this->session->userdata("user_id"),
			    );	
			   if($this->MY_Model->insert("tbl_category", $inputs) > 0){
					$msg = array(
						'code' => 200,
						'message' => 'success',
						'data'=> $this->getCategories()
					);
			   }else{
				$msg = array(
					'code' => 202,
					'message' => 'insert failed',
				); 
			   }
			}else{
				$msg = array(
					'code' => 202,
					'message' => 'already exists',
				);
			}
		}
		else{
			$msg = array(
				'code' => 202,
				'message' => 'something wrong',
			);
		}
		echo json_encode($msg);
	}

	public function delete_category (){
		$post = $this->input->post();
		if($post){
			$where = array(
				"category_id" => $post["category_id"]
			);
			if($this->MY_Model->delete("tbl_category", $where)){
				$msg = array('code'=>200, 'message'=> "success", 'data' => $this->getCategories() );
			}else{
				$msg = array(
					'code' => 202,
					'message' => 'failed',
				);
			}	
		}else{
			$msg = array(
				'code' => 202,
				'message' => 'something wrong',
			);
		}
		echo json_encode($msg);
	}

	public function update_category (){
		$post = $this->input->post();
		if($post){
			$where = array(
				"category_id" => $post["category_id"]
			);
			$set = array(
				"category_name" => $post["category_name"]
			);
			if($this->MY_Model->update("tbl_category",$set, $where)){
				$msg = array('code'=>200, 'message'=> "success", 'data' => $this->getCategories() );
			}else{
				$msg = array(
					'code' => 202,
					'message' => 'already exists',
				);
			}	
		}else{
			$msg = array(
				'code' => 202,
				'message' => 'something wrong',
			);
		}
		echo json_encode($msg);
	}

	public function save_exam(){
		if($this->input->post()){
			$post = $this->input->post();
			$category = $this->input->post("category");
			$questions = json_decode($this->input->post("question"));
			$inputs = array(
				"category" => $category,
				"created_date" => date("Y-m-d"),
				"updated_date" => "0000-00-00",
				"created_id" => $this->session->userdata("user_id"),
				"type" => "1",
			  );	

			$id =  $this->MY_Model->insert("tbl_exams", $inputs);
			$msg = array();
			if($id){
				$parseQuestion = json_decode(json_encode($questions), true);
			
				for ($i = 0; $i < count($parseQuestion); $i++){
					$arr = array(
						"exam_id" => $id 
						
					);
					$parseQuestion[$i] += $arr;	
					if($parseQuestion[$i]["qtype"] != "Choices"){
						$arr2 = array(
							"choiceA" => "",
							"choiceB" => "",
							"choiceC" => "",
						);
						$parseQuestion[$i] += $arr2;	
					}
					$this->MY_Model->insert("tbl_exam_questions", $parseQuestion[$i]);
					$msg = array( 'code' => 200, 'message' => "success" );
				}
			}else{
				$msg = array( 'code' => 202, 'message' => "failed");

			}
			echo json_encode($msg);
		}
	}

	public function delete_exam (){
		$post = $this->input->post();
		if($post){
			$where = array(
				"exam_id" => $post["exam_id"]
			);
			$set = array(
				"type" => "0"
			);
			if($this->MY_Model->update("tbl_exams",$set, $where)){
				$msg = array('code'=>200, 'message'=> "success");
			}else{
				$msg = array( 'code' => 202, 'message' => "failed");
			}
		}else{
			$msg = array( 'code' => 202, 'message' => "failed");
		}
		echo json_encode($msg);
	}

	// private functions

	private function isCategoryExist ($category){
		$options = array(
			'select' => 'category_name',
			'where' => array('category_name' => $category)
		);
		$data =  $this->MY_Model->getRows('tbl_category',$options);

		if(count($data) > 0){
			return true;
		}
		return false;
		
	}


	private function getTodoList($date){
		if($date){
			$options = array(
				'select'=>'*',
				'where' => array(
					'todo_list.created_date' => $date,
					'todo_status' => 1,
				),
				'join' => array('tbl_users'=> 'tbl_users.user_id = todo_list.user_id')
			);
			$data =  $this->MY_Model->getRows('todo_list',$options);
			return $data; 
		}
	}

	private function getTodoDetails($todo_id){
		$options = array(
			'select'=>'*',
			'where' => array(
				'todo_id' => $todo_id,
			)
		);
		$data = [];
		$data =  $this->MY_Model->getRows('tbl_todolist_details',$options);
		return $data;
	}

	private function getCategories (){
		$options = array(
			'select'=>'*',
			'order_by' => 'category_name'
		);

		$data =  $this->MY_Model->getRows('tbl_category',$options);
		return $data;
	}
	

}