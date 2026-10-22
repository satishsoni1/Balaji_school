<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uniformsaledetail_m extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function general_get_order_by_uniformsaledetail($where) {
		$this->db->select('usd.*, cat.category_name, sz.size_no');
		$this->db->from('uniformsaledetail usd');
		$this->db->join('uniformcategory cat', 'cat.uniformcategoryID = usd.uniformcategoryID', 'left');
		$this->db->join('uniformsize sz',      'sz.uniformsizeID = usd.uniformsizeID',          'left');
		$this->db->where($where);
		return $this->db->get()->result();
	}

	public function insert_uniformsaledetail($data) {
		return $this->db->insert('uniformsaledetail', $data);
	}

	public function delete_by_uniformsale($uniformsaleID) {
		return $this->db->delete('uniformsaledetail', array('uniformsaleID' => $uniformsaleID));
	}

	public function get_report_item_summary($date_from, $date_to, $classesID = NULL, $payment_mode = NULL) {
		$this->db->select('cat.category_name, sz.size_no, SUM(usd.qty) as total_qty, SUM(usd.amount) as total_amount');
		$this->db->from('uniformsaledetail usd');
		$this->db->join('uniformsale us',       'us.uniformsaleID = usd.uniformsaleID');
		$this->db->join('uniformcategory cat',   'cat.uniformcategoryID = usd.uniformcategoryID', 'left');
		$this->db->join('uniformsize sz',        'sz.uniformsizeID = usd.uniformsizeID',          'left');
		$this->db->where('us.active', 1);
		$this->db->where('us.sale_date >=', $date_from);
		$this->db->where('us.sale_date <=', $date_to);
		if(!empty($classesID)) {
			$this->db->where('us.classesID', $classesID);
		}
		if(!empty($payment_mode)) {
			$this->db->where('us.payment_mode', $payment_mode);
		}
		$this->db->group_by('cat.uniformcategoryID, sz.uniformsizeID');
		$this->db->order_by('cat.category_name', 'ASC');
		$this->db->order_by('sz.size_no', 'ASC');
		return $this->db->get()->result();
	}
}
