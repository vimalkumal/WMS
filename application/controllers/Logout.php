<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		session_unset(); 
		redirect('Login');
		// $this->load->view('login');
	}

}
