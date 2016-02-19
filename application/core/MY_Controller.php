<?php
class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
	$this->load->library('Tank_auth');
        if (! $this->tank_auth->is_logged_in())
        {
            redirect('/auth/login/'); // the user is not logged in, redirect them!
        }
    }
}
