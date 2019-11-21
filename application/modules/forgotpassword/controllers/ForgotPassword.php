<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends MY_Controller {
	public function index(){
		$data["title"] = "forgot Password";
		$this->load_login_page('index', $data);
	}

	public function request_new_password(){
		$email = $this->input->post('email');
		if($email){
			$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$strkey = substr(str_shuffle($permitted_chars),0 ,30);
			$from_email = "email@example.com";
			$to_email = $email;
			$this->load->library('email');
			$config = array();
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'secure.emailsrvr.com';
			$config['smtp_user'] = 'onlineform18@proweaver.net';
			$config['smtp_pass'] = 'boH0L0N7Yf0R13';
			$config['smtp_port'] = 587;
			$this->email->initialize($config);
			$this->email->set_newline("\r\n");
			$this->email->from($from_email, 'Identification');
			$this->email->to($to_email);
			$this->email->subject('Sample App');
			$msglink = base_url('confirmpassword'). "/".$strkey;
			$msg = "Please confirm your password by clicking the link below: ". 

			$msglink;
			
			$this->email->message($msg);
			//Send mail
			if($this->email->send()){
				$data = array( 'value' => $strkey, 'status' => 1 );
			    if($this->MY_Model->insert('tbl_forgotpassord_keys',$data)){
					$res = array('msg'=>'please check your email to verify your password!', 'err' => false);
					$this->session->set_flashdata('results', $res );
					redirect(base_url("recoverpassword"));
				}
			}
			else{
				$res = array('msg'=>'Sending email failed', 'err' => true);
				$this->session->set_flashdata('results', $res );
				redirect(base_url("forgotpassword"));
			}
				
		}
	}

	public function confirm_password ($key){
		if($key){
			echo $key; 
		}
	}

	public function recover_password (){
		$data["title"] = "Recover Password";
		$this->load_login_page('recoverpassword', $data);
	}

}