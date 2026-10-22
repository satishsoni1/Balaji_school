<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feeamounts extends Admin_Controller {
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
	function __construct() {
		parent::__construct();
		$this->load->model("feeamounts_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('feeamounts', $language);	
		//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
	}

	public function index() {
		$this->data['feeamounts'] = $this->feeamounts_m->get_feeamounts();
		$this->data['feetypes'] = 
		$this->data["subview"] = "feeamounts/index";
		$this->load->view('_layout_main', $this->data);
	}

	protected function rules() {
		$rules = array(
				array(
					'field' => 'packageID', 
					'label' => $this->lang->line("feeamounts_packageID"), 
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'feetypes', 
					'label' => $this->lang->line("feeamounts_feetype"), 
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'classesID[]', 
					'label' => $this->lang->line("feeamounts_classes"), 
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'amount', 
					'label' => $this->lang->line("feeamounts_amount"), 
					'rules' => 'trim|required|xss_clean'
				),
			);
		return $rules;
	}

	public function add() {
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
		if($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "feeamounts/add";
				$this->load->view('_layout_main', $this->data);			
			} else {
				$classes = $this->input->post("classesID");
				foreach($classes as $class){
					$array = [
                        "feetypesID" => $this->input->post("feetypes"),
                        "classesID" => $class,
						"amount" => $this->input->post("amount"),
						"packageID" => $this->input->post("packageID")
                    ];

                $this->feeamounts_m->insert_feeamounts($array);
				}
				
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("feeamounts/index"));
			}
		} else {
			$this->data["packageIDs"]=$this->feeamounts_m->get_packages();
			$this->data["classesIDs"]=$this->feeamounts_m->get_classes();
			$this->data["feetypes"]=$this->feeamounts_m->get_feetypes();
			$this->data["subview"] = "feeamounts/add";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
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
		$id = htmlentities(escapeString($this->uri->segment(3)));
		
		if((int)$id) {
			$this->data['feeamount'] = $this->feeamounts_m->get_feeamounts_by_id($id);
			$this->data["packageIDs"]=$this->feeamounts_m->get_packages();
			$this->data["classesIDs"]=$this->feeamounts_m->get_classes();
			$this->data["feetypes"]=$this->feeamounts_m->get_feetypes();
			if($this->data['feeamount']) {
				if($_POST) {
					$rules = $this->rules();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) {
						$this->data["subview"] = "feeamounts/edit";
						$this->load->view('_layout_main', $this->data);			
					} else {
						$array = array(
							"feetypesID" => $this->input->post("feetypes"),
                        "classesID" => $this->input->post("classesID"),
						"amount" => $this->input->post("amount"),
						"packageID" => $this->input->post("packageID")
						);

						$this->feeamounts_m->update_feeamounts($array, $id);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("feeamounts/index"));
					}
				} else {
					$this->data["subview"] = "feeamounts/edit";
					$this->load->view('_layout_main', $this->data);
				}
			} else {
				$this->data["subview"] = "error";
				$this->load->view('_layout_main', $this->data);
			}
		} else {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
		}	
	}

	public function delete() {
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$this->feeamounts_m->delete_feeamounts($id);
			$this->session->set_flashdata('success', $this->lang->line('menu_success'));
			redirect(base_url("feeamounts/index"));
		} else {
			redirect(base_url("feeamounts/index"));
		}
	}

	public function unique_feeamounts() {
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$feeamounts = $this->feeamounts_m->get_order_by_feeamounts(array("feeamounts" => $this->input->post("feeamounts"), "feeamountsID !=" => $id));
			if(customCompute($feeamounts)) {
				$this->form_validation->set_message("unique_feeamounts", "%s already exists");
				return FALSE;
			}
			return TRUE;
		} else {
			$monthly = $this->input->post('monthly');
			if($monthly) {
				for($i = 1; $i<=12; $i++) {
                    $month = date('M', mktime(0, 0, 0, $i));
                    $array = [
                        'feeamounts' => $this->input->post('feeamounts'). ' ['.$month.']'
                    ];
					$feeamounts = $this->feeamounts_m->get_order_by_feeamounts($array);

					if(customCompute($feeamounts)) {
						$this->form_validation->set_message("unique_feeamounts", "The ".$this->input->post('feeamounts'). ' ['.$month.']' ." already exists");
						return FALSE;
					}
                }
				return TRUE;
			} else {
				$feeamounts = $this->feeamounts_m->get_order_by_feeamounts(array("feeamounts" => $this->input->post("feeamounts")));
				if(customCompute($feeamounts)) {
					$this->form_validation->set_message("unique_feeamounts", "%s already exists");
					return FALSE;
				}
				return TRUE;
			}
		}	
	}
}
