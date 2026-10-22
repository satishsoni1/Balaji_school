<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class feepackages_m extends MY_Model {

	protected $_table_name = 'fee_packages';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = "id asc";

	function __construct() {
		parent::__construct();
	}

	function get_feepackages($array=NULL, $signal=FALSE) {
		$query = $this->db->query("SELECT * FROM fee_packages");
		return $query->result();
	}
	function get_feepackages_by_id($id=NULL) {
		$query = $this->db->query("SELECT * FROM fee_packages where id=".$id);
		return $query->row();
	}
	
	function get_packages($array=NULL, $signal=FALSE) {
		$query = $this->db->query("SELECT * FROM fee_packages");
		return $query->result();
	}
	function get_feetypes($array=NULL, $signal=FALSE) {
		$query = $this->db->query("SELECT * FROM feetypes");
		return $query->result();
	}
	function get_classes($array=NULL, $signal=FALSE) {
		$query = $this->db->query("SELECT * FROM classes");
		return $query->result();
	}

	function get_order_by_feepackages($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_feepackages($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_feepackages($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_feepackages($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_feepackages($id){
		parent::delete($id);
	}

	function allfeepackages($feepackages) {
		$query = $this->db->query("SELECT * FROM class_fee WHERE class_fee LIKE '$feepackages%'");
		return $query->result();
	}
	function feetype_as_per_student($classesID,$packageID) {
		$query = $this->db->query("SELECT feetypes.feetypesID,feetypes.feetypes,amount FROM feetypes join class_fee on class_fee.feetypesID=feetypes.feetypesID WHERE classesID=".$classesID." and packageID=".$packageID);
		return $query->result();
	}
}

/* End of file feetypes_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/feetypes_m.php */