<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class feetypes_m extends MY_Model {

	protected $_table_name = 'feetypes';
	protected $_primary_key = 'feetypesID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "feetypesID asc";

	function __construct() {
		parent::__construct();
	}

	function get_feetypes($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}
	function get_packages($array=NULL, $signal=FALSE) {
		$query = $this->db->query("SELECT * FROM fee_packages");
		return $query->result();
	}
	

	function get_order_by_feetypes($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_feetypes($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_feetypes($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_feetypes($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_feetypes($id){
		parent::delete($id);
	}

	function allfeetypes($feetypes) {
		$query = $this->db->query("SELECT * FROM feetypes WHERE feetypes LIKE '$feetypes%'");
		return $query->result();
	}
	function feetype_as_per_student($classesID,$packageID) {
		$query = $this->db->query("SELECT feetypes.feetypesID,feetypes.feetypes,amount FROM feetypes join class_fee on class_fee.feetypesID=feetypes.feetypesID WHERE classesID=".$classesID." and packageID=".$packageID);
		return $query->result();
	}
}

/* End of file feetypes_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/feetypes_m.php */