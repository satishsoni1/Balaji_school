<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Websitepopup_m extends MY_Model {

	protected $_table_name = 'websitepopup';
	protected $_primary_key = 'websitepopupID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "websitepopupID desc";

	function __construct() {
		parent::__construct();
	}

	function get_websitepopup($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	function get_order_by_websitepopup($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_websitepopup($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function insert_websitepopup($array) {
		parent::insert($array);
		return $this->db->insert_id();
	}

	function update_websitepopup($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_websitepopup($id){
		parent::delete($id);
	}

	/* The popup the website shows today: newest active one whose dates include today. */
	public function get_live_websitepopup() {
		$today = date('Y-m-d');
		$this->db->from($this->_table_name);
		$this->db->where('status', 1);
		$this->db->group_start()->where('start_date IS NULL')->or_where('start_date <=', $today)->group_end();
		$this->db->group_start()->where('end_date IS NULL')->or_where('end_date >=', $today)->group_end();
		$this->db->order_by('websitepopupID', 'desc');
		$this->db->limit(1);
		return $this->db->get()->row();
	}
}
