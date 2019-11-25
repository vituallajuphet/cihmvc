<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

	public function __construct(){
		$route = $this->router->fetch_class();
		if($route == 'login' || $route == 'register' || $route == 'forgotpassword'  ){
			if($this->session->has_userdata('user_id')){
				if($this->session->userdata("user_type") == 1){
					redirect(base_url("admin/dashboard"));
				}
				else if($this->session->userdata("user_type") == 2){
					redirect(base_url("students/dashboard"));
				}
			}
		} else {
			if(!$this->session->has_userdata('user_id')){
				if($route == "forgotpassword"){
					redirect(base_url('forgotpassword'));					
				}else if($route == "register"){
					redirect(base_url('register'));
				}else{
					redirect(base_url('login'));
				}
				
			}
			else{
				if($route == "admin" && $this->session->userdata("user_type") == 2){
					redirect(base_url("students/dashboard"));
				}
				else if($route == "Student" && $this->session->userdata("user_type") == 1){
					redirect(base_url("admin/dashboard"));


				}
			}
	
		}	
	}

	public function load_page($page, $data = array()){
      	$this->load->view('includes/head',$data);
      	$this->load->view($page,$data);
      	$this->load->view('includes/footer',$data);
	 }
	 
	public function load_login_page($page, $data = array()){
      	$this->load->view('includes/login_head',$data);
      	$this->load->view($page,$data);
      	$this->load->view('includes/login_footer',$data);
     }

}
