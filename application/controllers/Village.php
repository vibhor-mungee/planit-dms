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
                $data['page_title'] = 'Village';
		$data['village_id'] = $this->input->POST('villageid');
                //$data['state_names'] = $this->get_states();
                //$this->template->addJS(base_url('assets/js/dd_script.js'));
                $this->template->show('','village',$data,false);
        }
}
