<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Village_data_model extends CI_Model
{

	function __construct()
	{
		parent::__construct();

		$ci =& get_instance();
	}

	function get_active_states(){
		$query = $this->db->query('SELECT * FROM STATE WHERE  active = 1;');	
		return $query->result();
	}

	function get_district_by_state($state_id){
		$query = $this->db->query('SELECT * FROM DISTRICT WHERE ST_ID=' . $state_id .';');
		return $query->result();
	}

	function get_taluk_by_district($district_id){
		$query = $this->db->query('SELECT * FROM TALUK WHERE DS_ID=' . $district_id);
		return $query->result();
	}
	function get_village_by_taluk($taluk_id){
                $query = $this->db->query('SELECT VI_ID, VI_NAME FROM VILLAGE WHERE TL_ID=' . $taluk_id);
                return $query->result();
        }


}

