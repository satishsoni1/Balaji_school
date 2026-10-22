<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feepackages extends Admin_Controller {
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
		$this->load->model("feepackages_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('feepackages', $language);	
		//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
	}

	public function index() {
		$this->data['feepackages'] = $this->feepackages_m->get_feepackages();
		$this->data['feetypes'] = 
		$this->data["subview"] = "feepackages/index";
		$this->load->view('_layout_main', $this->data);
	}

	protected function rules() {
		$rules = array(
				array(
					'field' => 'name', 
					'label' => $this->lang->line("name"), 
					'rules' => 'trim|required|xss_clean|callback_unique_feepackages'
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
				$this->data["subview"] = "feepackages/add";
				$this->load->view('_layout_main', $this->data);			
			} else {
				$array = [
						"name" => $this->input->post("name"),
                ];
				$this->feepackages_m->insert_feepackages($array);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("feepackages/index"));
			}
		} else {
			$this->data["subview"] = "feepackages/add";
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
			$this->data['feepackage'] = $this->feepackages_m->get_feepackages_by_id($id);
			if($this->data['feepackage']) {
				if($_POST) {
					$rules = $this->rules();
					$this->form_validation->set_rules($rules);
					if ($this->form_validation->run() == FALSE) {
						$this->data["subview"] = "feepackages/edit";
						$this->load->view('_layout_main', $this->data);			
					} else {
						$array = array(
                        "name" => $this->input->post("name"),
						);

						$this->feepackages_m->update_feepackages($array, $id);
						$this->session->set_flashdata('success', $this->lang->line('menu_success'));
						redirect(base_url("feepackages/index"));
					}
				} else {
					$this->data["subview"] = "feepackages/edit";
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
			$this->feepackages_m->delete_feepackages($id);
			$this->session->set_flashdata('success', $this->lang->line('menu_success'));
			redirect(base_url("feepackages/index"));
		} else {
			redirect(base_url("feepackages/index"));
		}
	}

	public function unique_feepackages() {
		$id = htmlentities(escapeString($this->uri->segment(3)));
		if((int)$id) {
			$feepackages = $this->feepackages_m->get_order_by_feepackages(array("name" => $this->input->post("name"), "id !=" => $id));
			if(customCompute($feepackages)) {
				$this->form_validation->set_message("unique_feepackages", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}else {
			$feepackages = $this->feepackages_m->get_order_by_feepackages(array("name" => $this->input->post("name")));
			if(customCompute($feepackages)) {
				$this->form_validation->set_message("unique_feepackages", "%s already exists");
				return FALSE;
			}
			return TRUE;
		}
	}
}
