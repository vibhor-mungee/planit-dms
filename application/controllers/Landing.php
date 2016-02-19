<?php

class landing extends MY_Controller {



	function __construct()
	{
		parent::__construct();

		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->load->model('Village_data_model');
		$this->load->library('template');

	}
	
	public function index(){
		$data['page_title'] = 'Select Village';
		//$data['state_names'] = $this->get_states();
		$this->template->addJS(base_url('assets/js/dd_script.js'));
		$this->template->show('','village_selection',$data,false);
	}
}
