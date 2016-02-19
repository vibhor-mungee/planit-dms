<?php

class village extends CI_Controller {



        function __construct()
        {
                parent::__construct();

                $this->ci =& get_instance();
                $this->ci->load->database();
                $this->load->model('village_model');
                $this->load->library('template');

        }

        public function index(){
		$this->session->set_userdata('current_village_id',$this->input->POST('villageid'));
		$this->output->set_content_type("application/json")->set_output(json_encode(array('status'=>true, 'redirect'=>'/planit/village/load_village')));
		return true;
        }

	public function load_village(){
		$data['page_title'] = 'Village';
		$this->template->show('','village',$data,false);
	}
}
