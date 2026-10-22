<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class accountcashbook extends Admin_Controller
{
	/*
| -----------------------------------------------------
| PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM
| -----------------------------------------------------
| AUTHOR:			INILABS TEAM
| -----------------------------------------------------
| EMAIL:			info@inilabs.net
| -----------------------------------------------------
| COPYRIGHT:		RESERVED BY INILABS IT
| -----------------------------------------------------
| WEBSITE:			http://inilabs.net
| -----------------------------------------------------
*/
	public function __construct()
	{
		parent::__construct();
		$this->load->model('income_m');
		$this->load->model('expense_m');
		$this->load->model('make_payment_m');
		$this->load->model('payment_m');
		$this->load->model('schoolyear_m');
		$this->load->model('bankaccount_m');
		$this->load->model("ledgers_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('accountcashbook', $language);
		$this->lang->load('income', $language);
		$this->lang->load('expense', $language);
	}
	protected function incomerules() {
		$rules = array(
			array(
				'field' => 'name',
				'label' => $this->lang->line("income_name"),
				'rules' => 'trim|required|xss_clean|max_length[128]'
			),
			array(
				'field' => 'date',
				'label' => $this->lang->line("income_date"),
				'rules' => 'trim|required|xss_clean|max_length[10]|callback_date_valid|callback_unique_date'
			),
			array(
				'field' => 'amount',
				'label' => $this->lang->line("income_amount"),
				'rules' => 'trim|required|xss_clean|numeric|max_length[10]|callback_valid_number'
			),
			array(
				'field' => 'file',
				'label' => $this->lang->line("income_file"),
				'rules' => 'trim|xss_clean|max_length[200]|callback_fileupload'
			),
			array(
				'field' => 'note',
				'label' => $this->lang->line("income_note"),
				'rules' => 'trim|xss_clean|max_length[128]'
			)
		);
		return $rules;
	}
	public function unique_date() {
		$date = strtotime($this->input->post('date'));
		$startdate = strtotime($this->data['schoolyearsessionobj']->startingdate);
		$endingdate = strtotime($this->data['schoolyearsessionobj']->endingdate);
		if($date != '') {
			if(($date < $startdate) || ($date > $endingdate)) {
				$this->form_validation->set_message('unique_date','The %s field is invalid.');
				return FALSE;
			}
			return TRUE;
		}
		return TRUE;
	}
	public function valid_number() {
		if($this->input->post('amount') && $this->input->post('amount') < 0) {
			$this->form_validation->set_message("valid_number", "%s is invalid number");
			return FALSE;
		}
		return TRUE;
	}
	public function date_valid($date) {
		if($date) {
			if(strlen($date) < 10) {
				$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
		     	return FALSE;
			} else {
		   		$arr = explode("-", $date);
		        $dd = $arr[0];
		        $mm = $arr[1];
		        $yyyy = $arr[2];
		      	if(checkdate($mm, $dd, $yyyy)) {
		      		return TRUE;
		      	} else {
		      		$this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
		     		return FALSE;
		      	}
		    }
		}
		return TRUE;
	}
	protected function expenserules() {
		$rules = array(
				 array(
					'field' => 'expense',
					'label' => $this->lang->line("expense_expense"),
					'rules' => 'trim|required|xss_clean|max_length[128]'
				),
				array(
					'field' => 'date',
					'label' => $this->lang->line("expense_date"),
					'rules' => 'trim|required|max_length[10]|xss_clean|callback_date_valid|callback_unique_date'
				),
				array(
					'field' => 'amount',
					'label' => $this->lang->line("expense_amount"),
					'rules' => 'trim|required|numeric|max_length[11]|xss_clean|callback_valid_number'
				),
				array(
					'field' => 'file',
					'label' => $this->lang->line("expense_file"),
					'rules' => 'trim|xss_clean|max_length[200]|callback_fileupload'
				),
				array(
					'field' => 'note',
					'label' => $this->lang->line("expense_note"),
					'rules' => 'trim|max_length[200]|xss_clean'
				)
			);
		return $rules;
	}
	public function fileupload() {
		$id = htmlentities(escapeString($this->uri->segment(3)));
		$income = array();
		if((int)$id) {
			$income = $this->income_m->get_income($id);
		}

		$new_file = "";

		if($_FILES["file"]['name'] !="") {
			$file_name = $_FILES["file"]['name'];
			$random = random19();
	    	$makeRandom = hash('sha512', $random.$this->input->post('name') . config_item("encryption_key"));
			$file_name_rename = $makeRandom;
            $explode = explode('.', $file_name);
            if(customCompute($explode) >= 2) {
	            $new_file = $file_name_rename.'.'.end($explode);
				$config['upload_path'] = "./uploads/images";
				$config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx|txt|ppt|csv";
				$config['file_name'] = $new_file;
				$config['max_size'] = '5120';
				$config['max_width'] = '3000';
				$config['max_height'] = '3000';
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload("file")) {
					$this->form_validation->set_message("fileupload", $this->upload->display_errors());
	     			return FALSE;
				} else {
					$this->upload_data['file'] =  $this->upload->data();
					return TRUE;
				}
			} else {
				$this->form_validation->set_message("fileupload", "Invalid file");
	     		return FALSE;
			}
		} else {
			if(customCompute($income)) {
				$this->upload_data['file'] = array('file_name' => $income->file);
				return TRUE;
			} else {
				$this->upload_data['file'] = array('file_name' => $new_file);
			return TRUE;
			}
		}
	}
	public function index()
	{
		$this->data['headerassets'] = array(
			'css' => array(
				'assets/datepicker/datepicker.css',
				'assets/select2/css/select2.css',
				'assets/select2/css/select2-bootstrap.css'
			),
			'js' => array(
				'assets/datepicker/datepicker.js',
				'assets/select2/select2.js'
			)
		);

		$this->data['schoolyears'] = $this->schoolyear_m->get_order_by_schoolyear();
		$this->data["subview"] = "report/accountcashbook/AccountcashbookView";
		$this->load->view('_layout_main', $this->data);
	}
	public function expenseadd() {
		if(($this->data['siteinfos']->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1) || ($this->session->userdata('usertypeID') == 5)) {
			$this->data['headerassets'] = array(
				'css' => array(
					'assets/datepicker/datepicker.css',
				),
				'js' => array(
					'assets/datepicker/datepicker.js',
				)
			);
			$this->data['bankaccounts'] = $this->bankaccount_m->get_bankaccount();
			$this->data['ledgers'] = $this->ledgers_m->get_ledgers();
			if($_POST) {
				$rules = $this->expenserules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "report/accountcashbook/expenseadd";
					$this->load->view('_layout_main', $this->data);
				} else {
					$array = array(
						"expense" 		=> $this->input->post("expense"),
						"amount" 		=> $this->input->post("amount"),
						"bankaccountID" 		=> $this->input->post("bankaccountID"),
						"file" 			=> $this->upload_data['file']['file_name'],
						"note" 			=> $this->input->post("note"),
						"ledgersID" 			=> $this->input->post("ledgersID"),
						"cheque" 			=> $this->input->post("cheque"),
						"create_date" 	=> date("Y-m-d"),
						"date" 			=> date("Y-m-d", strtotime($this->input->post("date"))),
						"expenseday" 	=> date("d", strtotime($this->input->post("date"))),
						"expensemonth" 	=> date("m", strtotime($this->input->post("date"))),
						"expenseyear" 	=> date("Y", strtotime($this->input->post("date"))),
						'usertypeID' 	=> $this->session->userdata('usertypeID'),
						'uname' 		=> $this->session->userdata('name'),
						'userID' 		=> $this->session->userdata('loginuserID'),
						'schoolyearID' 	=> $this->session->userdata('defaultschoolyearID')
					);
					$this->expense_m->insert_expense($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("accountcashbook"));
				}
			} else {
				$this->data["subview"] = "report/accountcashbook/expenseadd";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}
	}
	public function incomeadd() {
		$this->data['bankaccounts'] = $this->bankaccount_m->get_bankaccount();
		$this->data['ledgers'] = $this->ledgers_m->get_ledgers();
		if(($this->data['siteinfos']->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1) || ($this->session->userdata('usertypeID') == 5)) {
			$this->data['headerassets'] = array(
				'css' => array(
					'assets/datepicker/datepicker.css',
				),
				'js' => array(
					'assets/datepicker/datepicker.js',
				)
			);
			if($_POST) {
				$rules = $this->incomerules();
				$this->form_validation->set_rules($rules);
				if ($this->form_validation->run() == FALSE) {
					$this->data["subview"] = "report/accountcashbook/incomeadd";
					$this->load->view('_layout_main', $this->data);
				} else {
					$array['name'] 			= $this->input->post('name');
					$array['date'] 			= date("Y-m-d", strtotime($this->input->post("date")));
					$array['incomeday'] 	= date("d", strtotime($this->input->post("date")));
					$array['incomemonth'] 	= date("m", strtotime($this->input->post("date")));
					$array['incomeyear']	= date("Y", strtotime($this->input->post("date")));
					$array['amount'] 		= $this->input->post('amount');
					$array['bankaccountID'] = $this->input->post("bankaccountID");
					$array['file'] 			= $this->upload_data['file']['file_name'];
					$array['note'] 			= $this->input->post('note');
					$array["ledgersID"]  	= $this->input->post("ledgersID");
					$array["cheque"]  	= $this->input->post("cheque");
					$array['create_date'] 	= date('Y-m-d');
					$array['schoolyearID'] 	= $this->session->userdata('defaultschoolyearID');
					$array['userID'] 		= $this->session->userdata('loginuserID');
					$array['usertypeID'] 	= $this->session->userdata('usertypeID');
					
					$this->income_m->insert_income($array);
					$this->session->set_flashdata('success', $this->lang->line('menu_success'));
					redirect(base_url("accountcashbook"));
				}
			} else {
				$this->data["subview"] = "report/accountcashbook/incomeadd";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}

	}
	public function queryArray($array)
	{
		$retArray = [];
		if (!empty($array['fromdate']) && !empty($array['todate'])) {
			$retArray['fromdate']    = date('Y-m-d', strtotime($array['fromdate']));
			$retArray['todate']      = date('Y-m-d', strtotime($array['todate']));
		}else{
			$retArray['fromdate']    = "2024-01-01";
			$retArray['todate']      = "2024-10-01";
		}

		if (!empty($array['schoolyearID'])) {
			$retArray['schoolyearID'] = $array['schoolyearID'];
		}
		$schoolyear = $this->schoolyear_m->get_single_schoolyear(array('schoolyearID' => $array['schoolyearID']));
		$this->data['schoolyearName'] = customCompute($schoolyear) ? $schoolyear->schoolyear : $this->lang->line('accountcashbook_all_accademic_year');
		return $retArray;
	}
	public function getaccountcashbook()
	{
		$retArray['status'] = FALSE;
		$retArray['render'] = '';
			if ($_POST) {
					$schoolyearID = $this->session->userdata('defaultschoolyearID');
					$array = $this->queryArray($_POST);
					if(!isset($array['schoolyearID']))
						$array['schoolyearID'] = $schoolyearID;
					$incomes       = $this->income_m->income_group_by_account_2($array);
					
					$expenses       = $this->income_m->expense_group_by_account_2($array);
					$accounts = pluck($this->income_m->get_account_2($array), 'bankaccountopeningbalance', 'bankaccountID');
					$this->data['schoolyearID']   = $this->input->post('schoolyearID');
					
					$this->data['incomes'] = $incomes;
					$this->data['expenses'] = $expenses;
					$income_sum = [];
					foreach($incomes as $income){
						$income_sum[$income->bankaccountID] = isset($income_sum[$income->bankaccountID])?$income_sum[$income->bankaccountID]+$income->amount:$income->amount;
					}
					$expense_sum = [];
					foreach($expenses as $expense){
						$expense_sum[$expense->bankaccountID] = isset($expense_sum[$expense->bankaccountID])?$expense_sum[$expense->bankaccountID]+$expense->amount:$expense->amount;
					}

					$this->data['income_sum'] = $income_sum;
					$this->data['expense_sum'] = $expense_sum;
					$this->data['accounts'] = $accounts;
					$retArray['render'] = $this->load->view('report/accountcashbook/AccountcashbookReport', $this->data, true);
					$retArray['status'] = TRUE;
					echo json_encode($retArray);
					exit;
				
			} else {
				echo json_encode($retArray);
				exit;
			}
	}
	public function pdf() {

		$schoolyearID = htmlentities(escapeString($this->uri->segment(3)));
		$array['schoolyearID'] = $schoolyearID;
		$incomes       = $this->income_m->income_group_by_account_2($array);
		$expenses       = $this->income_m->expense_group_by_account_2($array);
		$accounts = pluck($this->income_m->get_account_2($array), 'bankaccountopeningbalance', 'bankaccountID');
		$this->data['schoolyearID']   = $schoolyearID;
		
		$this->data['incomes'] = $incomes;
		$this->data['expenses'] = $expenses;
		$income_sum = [];
		foreach($incomes as $income){
			$income_sum[$income->bankaccountID] = isset($income_sum[$income->bankaccountID])?$income_sum[$income->bankaccountID]+$income->amount:$income->amount;
		}
		$expense_sum = [];
		foreach($expenses as $expense){
			$expense_sum[$expense->bankaccountID] = isset($expense_sum[$expense->bankaccountID])?$expense_sum[$expense->bankaccountID]+$expense->amount:$expense->amount;
		}

		$this->data['income_sum'] = $income_sum;
		$this->data['expense_sum'] = $expense_sum;
		$this->data['accounts'] = $accounts;
		$schoolyear = $this->schoolyear_m->get_single_schoolyear(array('schoolyearID' => $array['schoolyearID']));
		$this->data['schoolyearName'] = customCompute($schoolyear) ? $schoolyear->schoolyear : $this->lang->line('accountcashbook_all_accademic_year');
		
		$this->reportPDF('balancefeesreport.css', $this->data, 'report/accountcashbook/AccountcashbookReportPDF');
	}
	public function getaccountledger()
	{
		$retArray['status'] = FALSE;
		$retArray['render'] = '';
			if ($_POST) {
					$schoolyearID = $this->session->userdata('defaultschoolyearID');
					$array = $this->queryArray($_POST);
					$array['schoolyearID'] = $schoolyearID;
					$transcations    = $this->income_m->income_expense($array);
					$incomes       = $this->income_m->income_group_by_account($array);
					$expenses       = $this->income_m->expense_group_by_account($array);
					$accounts = pluck($this->income_m->get_account(), 'bankaccountopeningbalance', 'bankaccountID');
					$this->data['schoolyearID']   = $this->input->post('schoolyearID');
					
					$this->data['transcations'] = $transcations;
					$this->data['incomes'] = $incomes;
					$this->data['expenses'] = $expenses;
					$income_sum = [];
					foreach($incomes as $income){
						$income_sum[$income->bankaccountID] = isset($income_sum[$income->bankaccountID])?$income_sum[$income->bankaccountID]+$income->amount:$income->amount;
					}
					$expense_sum = [];
					foreach($expenses as $expense){
						$expense_sum[$expense->bankaccountID] = isset($expense_sum[$expense->bankaccountID])?$expense_sum[$expense->bankaccountID]+$expense->amount:$expense->amount;
					}

					$this->data['income_sum'] = $income_sum;
					$this->data['expense_sum'] = $expense_sum;
					$this->data['accounts'] = $accounts;
					$retArray['render'] = $this->load->view('report/accountcashbook/AccountledgerReport', $this->data, true);
					$retArray['status'] = TRUE;
					echo json_encode($retArray);
					exit;
				
			} else {
				echo json_encode($retArray);
				exit;
			}
	}

}
