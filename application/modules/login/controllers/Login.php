<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {
	public function index(){
		$this->load_login_page('index');
	}

	public function verify_account (){
		$username = $this->input->post("username");
		$password = $this->input->post("password");
		if($username != "" || $password != "" ){
			$options = array(
				'select'=>'*',
				'where' => array(
					'tbl_users.username' => $username,
					'tbl_users.password' => $password,
				),
				'join' => array('tbl_user_details'=> 'tbl_users.user_id = tbl_user_details.user_id')
			);
			
		
			$data["users"] =  $this->MY_Model->getRows('tbl_users',$options, "obj");

		    if(count($data["users"]) > 0){
				$user_data = array(
					'username'  => $data["users"][0]->username,
					'user_id'  => $data["users"][0]->user_id,
					'age'  => $data["users"][0]->age,
					'email'  => $data["users"][0]->email,
					'fullname' => $data["users"][0]->fullname,
					'user_type' => $data["users"][0]->user_type,
					'user_status' => $data["users"][0]->user_status,
				);
				
				if($data["users"][0]->user_type == 1 && $data["users"][0]->approved == 1 && $data["users"][0]->user_status == 1){
					$this->session->set_userdata($user_data);
					redirect(base_url("admin/dashboard"));	
				}
				else if($data["users"][0]->user_type == 2 && $data["users"][0]->approved == 1 && $data["users"][0]->user_status == 1){
					$this->session->set_userdata($user_data);
					redirect(base_url("students/dashboard"));	
				}
				else if($data["users"][0]->approved == 0){
					$this->session->set_flashdata('err', "Your account has not verified yet!");
					redirect(base_url("login"));
				}
				else{
					$this->session->set_flashdata('err', "Incorrect Username / Password!");
					redirect(base_url("login"));
				}
			}
			else{
				$this->session->set_flashdata('err', "Incorrect Username / Password!");
				redirect(base_url("login"));
			}
			
		}
		else{
			$this->session->set_flashdata('err', "Please input the required field!");
			redirect(base_url("login"));
		}

	}
}