<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Uniformsale_m extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	public function get_uniformsale($id = NULL) {
		if($id) {
			return $this->db->get_where('uniformsale', array('uniformsaleID' => $id))->row();
		}
		return $this->db->order_by('sale_date', 'DESC')->get('uniformsale')->result();
	}

	// Joined view for receipt/invoice screen
	public function get_single_uniformsale($where) {
		$this->db->select('us.*, s.name as student_name, s.roll, s.registerNO, c.classes, sec.section');
		$this->db->from('uniformsale us');
		$this->db->join('student s',  's.studentID = us.studentID',    'left');
		$this->db->join('classes c',  'c.classesID = us.classesID',    'left');
		$this->db->join('section sec','sec.sectionID = us.sectionID',  'left');
		$this->db->where($where);
		return $this->db->get()->row();
	}

	// Joined + filterable list for index() and report()
	public function general_get_order_by_uniformsale($filters = array()) {
		$this->db->select('us.uniformsaleID, us.receipt_no, us.sale_date, us.total_amount,
		                    us.payment_mode, us.active,
		                    s.name as student_name, s.roll, c.classes, sec.section');
		$this->db->from('uniformsale us');
		$this->db->join('student s',  's.studentID = us.studentID',    'left');
		$this->db->join('classes c',  'c.classesID = us.classesID',    'left');
		$this->db->join('section sec','sec.sectionID = us.sectionID',  'left');

		if(!empty($filters['classesID'])) {
			$this->db->where('us.classesID', $filters['classesID']);
		}
		if(!empty($filters['date_from'])) {
			$this->db->where('us.sale_date >=', $filters['date_from']);
		}
		if(!empty($filters['date_to'])) {
			$this->db->where('us.sale_date <=', $filters['date_to']);
		}
		if(!empty($filters['payment_mode'])) {
			$this->db->where('us.payment_mode', $filters['payment_mode']);
		}
		if(isset($filters['active'])) {
			$this->db->where('us.active', $filters['active']);
		}

		$this->db->order_by('us.sale_date', 'DESC');
		$this->db->order_by('us.uniformsaleID', 'DESC');
		return $this->db->get()->result();
	}

	public function generate_receipt_no() {
		$year   = date('Y');
		$prefix = 'UNF/' . $year . '/';

		$this->db->select('receipt_no');
		$this->db->like('receipt_no', $prefix, 'after');
		$this->db->order_by('uniformsaleID', 'DESC');
		$this->db->limit(1);
		$row = $this->db->get('uniformsale')->row();

		$next = 1;
		if($row) {
			$parts = explode('/', $row->receipt_no);
			$next  = ((int) end($parts)) + 1;
		}
		return $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
	}

	public function insert_uniformsale($data) {
		$this->db->insert('uniformsale', $data);
		return $this->db->insert_id();
	}

	public function update_uniformsale($data, $id) {
		return $this->db->update('uniformsale', $data, array('uniformsaleID' => $id));
	}

	// Summary totals (optionally filtered by payment_mode)
	public function get_report_totals($date_from, $date_to, $classesID = NULL, $payment_mode = NULL) {
		$this->db->select('COUNT(DISTINCT us.uniformsaleID) as total_bills,
		                    SUM(usd.qty) as total_qty,
		                    SUM(usd.amount) as total_amount');
		$this->db->from('uniformsale us');
		$this->db->join('uniformsaledetail usd', 'usd.uniformsaleID = us.uniformsaleID');
		$this->db->where('us.active', 1);
		$this->db->where('us.sale_date >=', $date_from);
		$this->db->where('us.sale_date <=', $date_to);
		if(!empty($classesID)) {
			$this->db->where('us.classesID', $classesID);
		}
		if(!empty($payment_mode)) {
			$this->db->where('us.payment_mode', $payment_mode);
		}
		return $this->db->get()->row();
	}

	// Single payment-mode total for ledger summary cards
	public function get_payment_mode_total($date_from, $date_to, $classesID = NULL, $payment_mode) {
		$this->db->select('SUM(total_amount) as amount, COUNT(uniformsaleID) as bills');
		$this->db->from('uniformsale');
		$this->db->where('active', 1);
		$this->db->where('sale_date >=', $date_from);
		$this->db->where('sale_date <=', $date_to);
		$this->db->where('payment_mode', $payment_mode);
		if(!empty($classesID)) {
			$this->db->where('classesID', $classesID);
		}
		return $this->db->get()->row();
	}

	// Day-wise ledger: date | cash bills | cash amount | online bills | online amount | total
	public function get_daily_ledger($date_from, $date_to, $classesID = NULL, $payment_mode = NULL) {
		$this->db->select("us.sale_date,
		    SUM(CASE WHEN us.payment_mode = 'cash'   THEN 1 ELSE 0 END) as cash_bills,
		    SUM(CASE WHEN us.payment_mode = 'cash'   THEN us.total_amount ELSE 0 END) as cash_amount,
		    SUM(CASE WHEN us.payment_mode = 'online' THEN 1 ELSE 0 END) as online_bills,
		    SUM(CASE WHEN us.payment_mode = 'online' THEN us.total_amount ELSE 0 END) as online_amount,
		    COUNT(us.uniformsaleID) as total_bills,
		    SUM(us.total_amount) as total_amount");
		$this->db->from('uniformsale us');
		$this->db->where('us.active', 1);
		$this->db->where('us.sale_date >=', $date_from);
		$this->db->where('us.sale_date <=', $date_to);
		if(!empty($classesID)) {
			$this->db->where('us.classesID', $classesID);
		}
		if(!empty($payment_mode)) {
			$this->db->where('us.payment_mode', $payment_mode);
		}
		$this->db->group_by('us.sale_date');
		$this->db->order_by('us.sale_date', 'ASC');
		return $this->db->get()->result();
	}
}
