<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Income_m extends MY_Model
{

	protected $_table_name = 'income';
	protected $_primary_key = 'incomeID';
	protected $_primary_filter = 'intval';
	protected $_order_by = "incomeID desc";

	public function __construct()
	{
		parent::__construct();
	}

	public function get_income($array = NULL, $signal = FALSE)
	{
		$query = parent::get($array, $signal);
		return $query;
	}

	public function get_order_by_income($array = NULL)
	{
		$query = parent::get_order_by($array);
		return $query;
	}

	public function get_single_income($array = NULL)
	{
		$query = parent::get_single($array);
		return $query;
	}

	public function insert_income($array)
	{
		$error = parent::insert($array);
		return TRUE;
	}

	public function update_income($data, $id = NULL)
	{
		parent::update($data, $id);
		return $id;
	}
	public function get_list_order_with_date_schoolyear($array)
	{
		$this->db->select('date, name, note, amount');
		$this->db->from('income');
		if (isset($array['fromdate']) && isset($array['todate'])) {
			$this->db->where('date >=', $array['fromdate']);
			$this->db->where('date <=', $array['todate']);
		}
		if (isset($array['schoolyearID'])) {
			$this->db->where('schoolyearID', $array['schoolyearID']);
		}

		$subQuery1 = $this->db->get_compiled_select();
		$this->db->reset_query();


		$this->db->select('ifnull(globalpayment.global_payment_date,paymentdate) as date, "fee collection" as name, "" as note, sum(paymentamount) as amount', false);
		
		if (isset($array['fromdate']) && isset($array['todate'])) {
			
			$this->db->where('DATE(globalpayment.global_payment_date) >=',$array['fromdate']);
			$this->db->where('DATE(globalpayment.global_payment_date) <=',$array['todate']);
			$this->db->where('globalpayment.global_payment_date IS NOT NULL');
			
			$this->db->or_group_start();
			$this->db->where('paymentdate >=', $array['fromdate']);
			$this->db->where('paymentdate <=', $array['todate']);
			$this->db->where('globalpayment.global_payment_date IS NULL');
			$this->db->group_end();
			
		}
		if (isset($array['schoolyearID'])) {
			$this->db->where('payment.schoolyearID', $array['schoolyearID']);
		}
		$this->db->from('payment');
		$this->db->join('globalpayment','globalpayment.globalpaymentID = payment.globalpaymentID');
		$this->db->group_by('date');
		$subQuery2 = $this->db->get_compiled_select();
		$this->db->reset_query();

		// $this->db->select('paymentdate as date, "fee collection" as name, "" as note, sum(paymentamount) as amount', false);
		
		// if (isset($array['fromdate']) && isset($array['todate'])) {
			
		// 	$this->db->where('paymentdate >=', $array['fromdate']);
		// 	$this->db->where('paymentdate <=', $array['todate']);
		// 	$this->db->where('globalpayment.global_payment_date IS NULL');
		// }
		// if (isset($array['schoolyearID'])) {
		// 	$this->db->where('schoolyearID', $array['schoolyearID']);
		// }
		// $this->db->from('payment');
		// $this->db->join('globalpayment','globalpayment.globalpaymentID = payment.globalpaymentID');
		// $this->db->group_by('paymentdate');
		// $subQuery3 = $this->db->get_compiled_select();
		// $this->db->reset_query();

		//$query = $this->db->query("($subQuery1 UNION $subQuery2 UNION $subQuery3 order by date)");
		$query = $this->db->query("($subQuery1 UNION $subQuery2 order by date)");
		//$query = $this->db->get();
		// var_dump($this->db->error());die;
		return $query->result();
	}
	public function delete_income($id)
	{
		parent::delete($id);
	}

	public function get_income_order_by_date($array)
	{
		$this->db->select('*');
		$this->db->from($this->_table_name);
		$this->db->where('date >=', $array['fromdate']);
		$this->db->where('date <=', $array['todate']);
		$this->db->where('schoolyearID', $array['schoolyearID']);
		$query = $this->db->get();
		return $query->result();
	}

	public function income_group_by_account($array)
	{
		$this->db->select('*');
		$this->db->from($this->_table_name);
		//$this->db->where('schoolyearID', $array['schoolyearID']);
		$this->db->order_by('date');
		$query = $this->db->get();
		return $query->result();
	}
	public function expense_group_by_account($array)
	{
		$this->db->select('*');
		$this->db->from("expense");
		//$this->db->where('schoolyearID', $array['schoolyearID']);
		$this->db->order_by('date');
		$query = $this->db->get();
		return $query->result();
	}
	public function income_group_by_account_2($array)
	{
		$this->db->select('*');
		$this->db->from($this->_table_name);
		$this->db->where('schoolyearID', $array['schoolyearID']);
		$this->db->order_by('date');
		$query = $this->db->get();
		return $query->result();
	}
	public function expense_group_by_account_2($array)
	{
		$this->db->select('*');
		$this->db->from("expense");
		$this->db->where('schoolyearID', $array['schoolyearID']);
		$this->db->order_by('date');
		$query = $this->db->get();
		return $query->result();
	}
	public function income_expense($array)
	{
if($array['ledgersID'] != 0){
	$query = $this->db->query("
    SELECT bankaccountID,ledgers as ledger,name as name,date, amount, 'income' AS transaction_type
    FROM income
	join ledgers on ledgers.ledgersID=income.ledgersID
	where bankaccountID=".$array['accountID']."
	and income.ledgersID=".$array['ledgersID']."
	and income.schoolyearID=".$array['schoolyearID']."
    UNION ALL
    SELECT bankaccountID,ledgers as ledger,expense as name,date,amount, 'expense' AS transaction_type
    FROM expense
	join ledgers on ledgers.ledgersID=expense.ledgersID
	where bankaccountID=".$array['accountID']."
	and expense.ledgersID=".$array['ledgersID']."
	and expense.schoolyearID=".$array['schoolyearID']."
    ORDER BY date
");
}else{
	$query = $this->db->query("
    SELECT bankaccountID,ledgers as ledger,name as name,date,amount, 'income' AS transaction_type
    FROM income
	join ledgers on ledgers.ledgersID=income.ledgersID
	where bankaccountID=".$array['accountID']."
		AND income.schoolyearID=".$array['schoolyearID']."
    UNION ALL
    SELECT bankaccountID,ledgers as ledger,expense as name,date,amount, 'expense' AS transaction_type
    FROM expense
	join ledgers on ledgers.ledgersID=expense.ledgersID
	where bankaccountID=".$array['accountID']."
	 and expense.schoolyearID=".$array['schoolyearID']."
    ORDER BY date
");
}
		return $query->result();
	}
	public function get_account()
	{
		$this->db->select('*');
		$this->db->from("bankaccount");
		$query = $this->db->get();
		return $query->result();
	}
	public function get_account_2($array)
	{
		$this->db->select('bankaccount.*,bank_account_conf.bankaccountopeningbalance');
		$this->db->from("bankaccount");
		$this->db->join('bank_account_conf', 'bank_account_conf.account_id = bankaccount.bankaccountID and bank_account_conf.schoolyearID = '. $array['schoolyearID']);
		$query = $this->db->get();
		return $query->result();
	}
	public function get_single_account($array)
	{
		$this->db->select('bankaccount.*,bank_account_conf.bankaccountopeningbalance');
		$this->db->from("bankaccount");
		$this->db->where('bankaccountID', $array['accountID']);
		$this->db->join('bank_account_conf', 'bank_account_conf.account_id = bankaccount.bankaccountID and bank_account_conf.schoolyearID = '. $array['schoolyearID']);
		$query = $this->db->get();
		return $query->row();
	}
	

	public function get_income_order_by_with_date_schoolyear($array)
	{
		$this->db->select_sum('amount');
		$this->db->from($this->_table_name);
		if (isset($array['fromdate']) && isset($array['todate'])) {
			$this->db->where('date >=', $array['fromdate']);
			$this->db->where('date <=', $array['todate']);
		}
		if (isset($array['schoolyearID'])) {
			$this->db->where('schoolyearID', $array['schoolyearID']);
		}
		if (isset($array['bankaccountID'])) {
			$this->db->where('bankaccountID', $array['bankaccountID']);
		}
		$query = $this->db->get();
		return $query->row();
	}
	public function get_income_expense_order_by_date($array)
	{
		$this->db->select('date, name, note, amount as credit_amount,"null" as debit_amount');
		$this->db->from('income');
		if (isset($array['fromdate']) && isset($array['todate'])) {
			$this->db->where('date >=', $array['fromdate']);
			$this->db->where('date <=', $array['todate']);
		}
		if (isset($array['schoolyearID'])) {
			$this->db->where('schoolyearID', $array['schoolyearID']);
		}
		if (isset($array['bankaccountID'])) {
			$this->db->where('bankaccountID', $array['bankaccountID']);
		}
		$subQuery1 = $this->db->get_compiled_select();
		$this->db->reset_query();


		$this->db->select('date, expense as name, note,"null" as credit_amount,amount as debit_amount');
		$this->db->from('expense');
		if (isset($array['fromdate']) && isset($array['todate'])) {
			$this->db->where('date >=', $array['fromdate']);
			$this->db->where('date <=', $array['todate']);
		}
		if (isset($array['schoolyearID'])) {
			$this->db->where('schoolyearID', $array['schoolyearID']);
		}
		if (isset($array['bankaccountID'])) {
			$this->db->where('bankaccountID', $array['bankaccountID']);
		}

		$subQuery2 = $this->db->get_compiled_select();
		$this->db->reset_query();

		$query = $this->db->query("($subQuery1 UNION $subQuery2 order by date)");
		//$query = $this->db->get();
		//var_dump($this->db->last_query());die;
		
		return $query->result();
	}

	/* define for 4.4 */
	public function get_income_with_user($array = ['income.schoolyearID' => 1])
	{
		$this->db->select('income.*, systemadmin.name as aname, teacher.name as tname, student.name as sname, parents.name as pname, user.name as uname');
		$this->db->from('income');
		$this->db->join('systemadmin', 'systemadmin.usertypeID = income.usertypeID AND systemadmin.systemadminID = income.userID', 'LEFT');
		$this->db->join('teacher', 'teacher.usertypeID = income.usertypeID AND teacher.teacherID = income.userID', 'LEFT');
		$this->db->join('student', 'student.usertypeID = income.usertypeID AND student.studentID = income.userID', 'LEFT');
		$this->db->join('parents', 'parents.usertypeID = income.usertypeID AND parents.parentsID = income.userID', 'LEFT');
		$this->db->join('user', 'user.usertypeID = income.usertypeID AND user.userID = income.userID', 'LEFT');
		$this->db->where($array);
		$this->db->order_by($this->_order_by);
		$query = $this->db->get();
		return $query->result();
	}
}
