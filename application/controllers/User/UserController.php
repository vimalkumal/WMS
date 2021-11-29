<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {

	public function __counstruct(){
		parent :: __counstruct();
		
	}

	public function index()
	{
		is_userLogin('User');
		$this->load->view('User/sitemap');
	}
	
}
