<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

	public function __construct(){
		$route = $this->router->fetch_class();
		if($route == 'login' || $route == 'register' ){
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
				if($route == "register"){
					redirect(base_url('user/register'));					
				}else{
					redirect(base_url('user/login'));
				}
			}
			else{
				if($route == "admin" && $this->session->userdata("user_type") == 2){
					redirect(base_url("students/dashboard"));
					echo "1";
				}
				else if($route == "Student" && $this->session->userdata("user_type") == 1){
					redirect(base_url("admin/dashboard"));
					echo "2";

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
