<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uniformsize_m extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function get_uniformsize($id = NULL) {
		if($id) {
			return $this->db->get_where('uniformsize', array('uniformsizeID' => $id))->row();
		}
		return $this->db->order_by('size_no', 'ASC')->get('uniformsize')->result();
	}

	public function general_get_order_by_uniformsize($where) {
		return $this->db->where($where)->order_by('size_no', 'ASC')->get('uniformsize')->result();
	}

	public function insert_uniformsize($data) {
		$this->db->insert('uniformsize', $data);
		return $this->db->insert_id();
	}

	public function update_uniformsize($data, $id) {
		return $this->db->update('uniformsize', $data, array('uniformsizeID' => $id));
	}

	public function delete_uniformsize($id) {
		return $this->db->update('uniformsize', array('active' => 0), array('uniformsizeID' => $id));
	}

	// Compatibility helper: return a single size by where clause or id
	public function get_single_uniformsize($where = array()) {
		if($where && is_array($where)) {
			$this->db->where($where);
		}
		return $this->db->get('uniformsize')->row();
	}
}
