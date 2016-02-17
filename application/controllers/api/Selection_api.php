<?php

require APPPATH.'/libraries/REST_Controller.php';

class selection_api extends REST_Controller {
	
	function __construct(){
		parent::__construct();

		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->load->model('Village_data_model');
	}

	function states_get(){
		$states = $this->Village_data_model->get_active_states();
		if($states){
			$this->response($states, 200);	
		}
		else {
			$this->response(null, 404);
		}
		
	}

	function districts_get(){
		$state_id = $this->input->GET('state_id');
		if (intval($state_id)>0) {
			$districts = $this->Village_data_model->get_district_by_state($state_id);	
			$this->response($districts,200);
		}
		else {
			$districts = "Invalid state id";
			$this->response(null,404);
		}
	}

	function taluks_get(){
		$district_id = $this->input->GET('district_id');
		if (intval($district_id)>0) {
			$taluks = $this->Village_data_model->get_taluk_by_district($district_id);
			$this->response($taluks,200);
		}
		else {
			$taluks = "Invalid district id";
			$this->response(null,404);
		}
	}
	     
  	function villages_get(){
                $taluk_id = $this->input->GET('taluk_id');
                if (intval($taluk_id)>0) {
                        $villages = $this->Village_data_model->get_village_by_taluk($taluk_id);
                        $this->response($villages,200);
                }
                else {
                        $taluks = "Invalid taluk id";
                        $this->response(null,404);
                }
        }  
}
