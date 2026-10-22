<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uniformcategory_m extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	// get_uniformcategory()    -> all active categories
	// get_uniformcategory($id) -> single category row
	public function get_uniformcategory($id = NULL) {
		if($id) {
			return $this->db->get_where('uniformcategory', array('uniformcategoryID' => $id))->row();
		}
		return $this->db->where('active', 1)->order_by('category_name', 'ASC')->get('uniformcategory')->result();
	}

	// Compatibility helper: return a single category by where clause or id
	public function get_single_uniformcategory($where = array()) {
		if($where && is_array($where)) {
			$this->db->where($where);
		}
		return $this->db->get('uniformcategory')->row();
	}

	public function insert_uniformcategory($data) {
		$this->db->insert('uniformcategory', $data);
		return $this->db->insert_id();
	}

	public function update_uniformcategory($data, $id) {
		return $this->db->update('uniformcategory', $data, array('uniformcategoryID' => $id));
	}

	public function delete_uniformcategory($id) {
		// soft delete, matches the active-flag pattern used elsewhere
		return $this->db->update('uniformcategory', array('active' => 0), array('uniformcategoryID' => $id));
	}
}
