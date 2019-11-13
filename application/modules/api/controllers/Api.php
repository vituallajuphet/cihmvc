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

	// private functions
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
	

}