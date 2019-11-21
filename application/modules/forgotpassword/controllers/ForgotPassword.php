<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgotPassword extends MY_Controller {
	public function index(){
		$data["title"] = "forgot userpassword!";
		$this->load_login_page('index', $data);
	}
}