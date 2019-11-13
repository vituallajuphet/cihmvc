<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {
	public function index(){
		$data["title"] = "Register";
		$this->load_login_page('register', $data);
	}

	public function save_account(){
		if($this->input->post()){
			$fname = $this->input->post("fullname");
			$age =$this->input->post("age");
			$email =$this->input->post("email");
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$user_type = 2;
			$user_status = 0;
			$dataInputs = array(  "fullname" => $fname, "username" => $username, "password" => $password, "user_type" => 2, "user_status" => 1, 'approved' => 0 );

			if($this->isUserExist($username, $password)){
				$msg = array(
					'err' => true,
					'message' => "Username & Password is already taken!"
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
						'message' => "Created Successfully!, please wait for approval from admin!"
					);
					$this->session->set_flashdata('flashdata', $msg);
					
				}
			}
			redirect(base_url("user/register"));

		}
	}

	// private function
	private function isUserExist($username, $password){

		$options = array(
			'select'=>'*',
			'where' => array(
				'username' => $username,
				'password' => $password,
			)
		);
		
		$data =  $this->MY_Model->getRows('tbl_users',$options);
		if(count($data) > 0){
			return true;
		}
		return false;
		
	}

	


}