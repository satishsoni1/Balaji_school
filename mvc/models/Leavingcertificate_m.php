<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leavingcertificate_m extends MY_Model {

	protected $_table_name = 'leaving_certificate';
	protected $_primary_key = 'certificate_id';
	protected $_primary_filter = 'intval';
	protected $_order_by = "created_at desc";
	

	public function __construct() {
		parent::__construct();
	}

	public function insert_certificate($array) {
		$error = parent::insert($array);
		return $error;
	}

	public function update_certificate($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_certificate($id){
		parent::delete($id);
	}
}

/* End of file invoice_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/invoice_m.php */