<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends MY_Controller {
	public function index(){
		$data["title"] = "forgot Password";
		$this->load_login_page('index', $data);
	}

	public function request_new_password(){
		$email = $this->input->post("email");

		
		if($email){

			if($this->isEmailExist($email)){
				$res = array('msg'=>'Already sent an confirmation code in this email!', 'err' => true);
				$this->session->set_flashdata('results', $res );
				redirect(base_url("forgotpassword"));
			}else{
				$options ["where"] = array('email' => $email);
				$options ["select"] = '*';

				$res =  $this->MY_Model->getRows('tbl_user_details',$options);

				if(count($res) > 0){
					$email = $res[0]["email"];
					$user_id = $res[0]["user_id"];
					echo $email;
					$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					$strkey = substr(str_shuffle($permitted_chars),0 ,30);
					$from_email = "email@example.com";
					$to_email = $email;
					$this->load->library('email');
					$config = array();
					$config['protocol'] = 'smtp';
					$config['smtp_host'] = 'secure.emailsrvr.com';
					$config['smtp_user'] = 'onlineform20@proweaver.net';
					$config['smtp_pass'] = 'Pr0_tR4C1ntY_tY19';
					$config['smtp_port'] = 587;
					$this->email->initialize($config);
					$this->email->set_newline("\r\n");
					$this->email->from($from_email, 'Identification');
					$this->email->to($to_email);
					$this->email->subject('Sample App');
					$msglink = base_url('confirmpassword'). "/".$strkey;
					$msg = "Please confirm your password by clicking the link below:  ".  $msglink;
					$this->email->message($msg);
					//Send mail
					if($this->email->send()){
						$data = array( 'value' => $strkey, 'status' => 1, 'user_id' =>$user_id, 'email' => $email );
						if($this->MY_Model->insert('tbl_forgotpassord_keys',$data)){
							$res = array('msg'=>'please check your email to verify your password!', 'err' => false);
							$this->session->set_flashdata('results', $res );
							redirect(base_url("email-sent"));
						}
					}
					else{
						$res = array('msg'=>'Sending email failed', 'err' => true);
						$this->session->set_flashdata('results', $res );
						redirect(base_url("forgotpassword"));
					}
				}else{
					$res = array('msg'=>'This email is not registered!', 'err' => true);
					$this->session->set_flashdata('results', $res );
					redirect(base_url("forgotpassword"));
				}
			}	
		}
		else{
			$res = array('msg'=>'Invalid Email', 'err' => true);
				$this->session->set_flashdata('results', $res );
		}
	}

	public function confirm_password ($key){
		if($key){
			$options["select"] ='*';
			$options["where"] = array('value' => $key);
			$res =  $this->MY_Model->getRows('tbl_forgotpassord_keys',$options);
			if(count($res) > 0){
				$data["title"] = "Recovery Password";
				$data["data"] = $res[0];
				$_SESSION["temp_user_data"] = $data["data"];
				$this->load_login_page('recoverypassword', $data);
			}
			else{
				redirect(base_url("login"));
			}
		}
		else{
			redirect(base_url("login"));
		}
	}

	public function recover_password (){
		$data["title"] = "Recover Password";
		
	}
	public function email_sent (){
		$data["title"] = "Recover email";
		$this->load_login_page('mailsent', $data);
	}

	public function update_password (){
		$post = $this->input->post();
		if($post){
			if(($post["password"] == $post["password2"] && !empty($post["password"]))){
				$userdata =  $_SESSION["temp_user_data"];
				$where = array("user_id" => $userdata["user_id"]);
				$set = array("password" => $post["password"]);
				if($this->MY_Model->update("tbl_users",$set, $where )){ 
					$key_id = $_SESSION["temp_user_data"]["key_id"];
					if( $this->MY_Model->delete("tbl_forgotpassord_keys", array('key_id' => $key_id) )){
						$res = array('msg'=>'Updated Password!', 'err' => false);
						$this->session->set_flashdata('success', $res );
						redirect(base_url("login"));
						unset($_SESSION["temp_user_data"]);
						$this->session->unset_userdata("temp_user_data");
						}	 
				}else{
					
				}
			}
			else{
				$res = array('msg'=>'Password doesn`t match!', 'err' => true);
				$this->session->set_flashdata('results', $res );
				redirect($_SERVER["HTTP_REFERER"]);
			}

		}else{

		}
		
	}


	// private function
	private function isEmailExist ($email){
		
		$options["select"] ='email';
		$options["where"] = array('email' => $email);
		$res =  $this->MY_Model->getRows('tbl_forgotpassord_keys',$options);
		if(count($res) > 0){
			return true;
		}
		return false;
	}
}