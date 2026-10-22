<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class feeamounts_m extends MY_Model {

	protected $_table_name = 'class_fee';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = "id asc";

	function __construct() {
		parent::__construct();
	}

	function get_feeamounts($array=NULL, $signal=FALSE) {
		$query = $this->db->query("SELECT class_fee.id,fee_packages.name,classes.classes,feetypes.feetypes,class_fee.amount FROM fee_packages join class_fee on class_fee.packageID=fee_packages.id join classes on classes.classesID=class_fee.classesID join feetypes on feetypes.feetypesID=class_fee.feetypesID");
		return $query->result();
	}
	function get_feeamounts_by_id($id=NULL) {
		$query = $this->db->query("SELECT class_fee.*,fee_packages.name,classes.classes,feetypes.feetypes,class_fee.amount FROM fee_packages join class_fee on class_fee.packageID=fee_packages.id join classes on classes.classesID=class_fee.classesID join feetypes on feetypes.feetypesID=class_fee.feetypesID where class_fee.id=".$id);
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

	function get_order_by_feeamounts($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_feeamounts($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_feeamounts($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_feeamounts($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_feeamounts($id){
		parent::delete($id);
	}

	function allfeeamounts($feeamounts) {
		$query = $this->db->query("SELECT * FROM class_fee WHERE class_fee LIKE '$feeamounts%'");
		return $query->result();
	}
	function feetype_as_per_student($classesID,$packageID) {
		$query = $this->db->query("SELECT feetypes.feetypesID,feetypes.feetypes,amount FROM feetypes join class_fee on class_fee.feetypesID=feetypes.feetypesID WHERE classesID=".$classesID." and packageID=".$packageID);
		return $query->result();
	}
}

/* End of file feetypes_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/feetypes_m.php */