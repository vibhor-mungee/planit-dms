<?php

class signup extends CI_Controller {

	public function index(){
		$this->newuser();
	}

	public function newuser(){
		$this->load->view('header');
	    $this->load->view('signup_form');
	    $this->load->view('footer');	
	}
}