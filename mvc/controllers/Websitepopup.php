<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Popups (e.g. "Admissions open") shown on the public website in /web.
 * The website shows the newest active popup whose date range includes today.
 */
class Websitepopup extends Admin_Controller {

	public $upload_data = array('file' => NULL);
	private $_frequencies = array('daily', 'session', 'always');
	private $_showOn = array('home', 'all');

	public function __construct() {
		parent::__construct();
		$this->load->model("websitepopup_m");
		$language = $this->session->userdata('lang');
		$this->lang->load('websitepopup', file_exists(APPPATH.'language/'.$language.'/websitepopup_lang.php') ? $language : 'english');
	}

	public function index() {
		$this->data['websitepopups'] = $this->websitepopup_m->get_order_by_websitepopup();
		$this->data['livepopup'] = $this->websitepopup_m->get_live_websitepopup();
		$this->data["subview"] = "websitepopup/index";
		$this->load->view('_layout_main', $this->data);
	}

	protected function rules() {
		return array(
			array(
				'field' => 'title',
				'label' => $this->lang->line("websitepopup_title"),
				'rules' => 'trim|required|xss_clean|max_length[150]'
			),
			array(
				'field' => 'badge',
				'label' => $this->lang->line("websitepopup_badge"),
				'rules' => 'trim|xss_clean|max_length[60]'
			),
			array(
				'field' => 'message',
				'label' => $this->lang->line("websitepopup_message"),
				'rules' => 'trim|xss_clean|max_length[2000]'
			),
			array(
				'field' => 'button_text',
				'label' => $this->lang->line("websitepopup_button_text"),
				'rules' => 'trim|xss_clean|max_length[60]'
			),
			array(
				'field' => 'button_link',
				'label' => $this->lang->line("websitepopup_button_link"),
				'rules' => 'trim|xss_clean|max_length[500]|callback_valid_link'
			),
			array(
				'field' => 'start_date',
				'label' => $this->lang->line("websitepopup_start_date"),
				'rules' => 'trim|xss_clean|callback_valid_date'
			),
			array(
				'field' => 'end_date',
				'label' => $this->lang->line("websitepopup_end_date"),
				'rules' => 'trim|xss_clean|callback_valid_date|callback_end_after_start'
			),
			array(
				'field' => 'frequency',
				'label' => $this->lang->line("websitepopup_frequency"),
				'rules' => 'trim|required|in_list['.implode(',', $this->_frequencies).']'
			),
			array(
				'field' => 'show_on',
				'label' => $this->lang->line("websitepopup_show_on"),
				'rules' => 'trim|required|in_list['.implode(',', $this->_showOn).']'
			),
			array(
				'field' => 'image',
				'label' => $this->lang->line("websitepopup_image"),
				'rules' => 'callback_imageupload'
			),
		);
	}

	public function valid_date($date) {
		if ($date == '') {
			return TRUE;
		}
		$d = DateTime::createFromFormat('Y-m-d', $date);
		if ($d && $d->format('Y-m-d') === $date) {
			return TRUE;
		}
		$this->form_validation->set_message('valid_date', 'The %s field must be a valid date.');
		return FALSE;
	}

	public function end_after_start($end) {
		$start = $this->input->post('start_date');
		if ($end != '' && $start != '' && $end < $start) {
			$this->form_validation->set_message('end_after_start', $this->lang->line('websitepopup_end_before_start'));
			return FALSE;
		}
		return TRUE;
	}

	// Allow a website page (contact-us.php, index.php#about), a /path, tel:/mailto:, or an http(s) URL.
	public function valid_link($link) {
		if ($link == '' || preg_match('#^(https?://|/|tel:|mailto:|[a-z0-9_\-]+\.(php|html|pdf)(\#[\w\-]*)?$|\#[\w\-]+$)#i', $link)) {
			return TRUE;
		}
		$this->form_validation->set_message('valid_link', $this->lang->line('websitepopup_invalid_link'));
		return FALSE;
	}

	public function imageupload() {
		$this->upload_data['file'] = NULL;
		if (empty($_FILES['image']['name'])) {
			return TRUE;
		}
		$explode = explode('.', $_FILES['image']['name']);
		if (customCompute($explode) < 2) {
			$this->form_validation->set_message('imageupload', 'Invalid file');
			return FALSE;
		}

		$config['upload_path']   = './uploads/images';
		$config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
		$config['file_name']     = 'popup-'.hash('sha256', random19().config_item('encryption_key')).'.'.strtolower(end($explode));
		$config['max_size']      = '2048';
		$config['max_width']     = '4000';
		$config['max_height']    = '4000';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('image')) {
			$this->form_validation->set_message('imageupload', $this->upload->display_errors('', ''));
			return FALSE;
		}
		$this->upload_data['file'] = $this->upload->data();
		return TRUE;
	}

	private function _formData() {
		return array(
			'title'       => $this->input->post('title'),
			'badge'       => $this->input->post('badge'),
			'message'     => $this->input->post('message'),
			'button_text' => $this->input->post('button_text'),
			'button_link' => $this->input->post('button_link'),
			'start_date'  => $this->input->post('start_date') ? $this->input->post('start_date') : NULL,
			'end_date'    => $this->input->post('end_date') ? $this->input->post('end_date') : NULL,
			'frequency'   => $this->input->post('frequency'),
			'show_on'     => $this->input->post('show_on'),
			'status'      => $this->input->post('status') ? 1 : 0,
			'modify_date' => date('Y-m-d H:i:s'),
		);
	}

	private function _deleteImage($file) {
		if ($file && config_item('demo') == FALSE && strpos($file, 'popup-') === 0 && file_exists(FCPATH.'uploads/images/'.$file)) {
			unlink(FCPATH.'uploads/images/'.$file);
		}
	}

	public function add() {
		if ($_POST) {
			$this->form_validation->set_rules($this->rules());
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "websitepopup/add";
				$this->load->view('_layout_main', $this->data);
			} else {
				$array = $this->_formData();
				$array['image'] = $this->upload_data['file'] ? $this->upload_data['file']['file_name'] : NULL;
				$array['create_date'] = date('Y-m-d H:i:s');
				$array['create_userID'] = $this->session->userdata('loginuserID');
				$array['create_usertypeID'] = $this->session->userdata('usertypeID');
				$this->websitepopup_m->insert_websitepopup($array);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("websitepopup/index"));
			}
		} else {
			$this->data["subview"] = "websitepopup/add";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function edit() {
		$id = htmlentities(escapeString($this->uri->segment(3)));
		$popup = (int) $id ? $this->websitepopup_m->get_single_websitepopup(array('websitepopupID' => $id)) : NULL;
		if (!customCompute($popup)) {
			$this->data["subview"] = "error";
			$this->load->view('_layout_main', $this->data);
			return;
		}

		$this->data['websitepopup'] = $popup;
		if ($_POST) {
			$this->form_validation->set_rules($this->rules());
			if ($this->form_validation->run() == FALSE) {
				$this->data["subview"] = "websitepopup/edit";
				$this->load->view('_layout_main', $this->data);
			} else {
				$array = $this->_formData();
				if ($this->upload_data['file']) {
					$this->_deleteImage($popup->image);
					$array['image'] = $this->upload_data['file']['file_name'];
				} elseif ($this->input->post('remove_image')) {
					$this->_deleteImage($popup->image);
					$array['image'] = NULL;
				}
				$this->websitepopup_m->update_websitepopup($array, $id);
				$this->session->set_flashdata('success', $this->lang->line('menu_success'));
				redirect(base_url("websitepopup/index"));
			}
		} else {
			$this->data["subview"] = "websitepopup/edit";
			$this->load->view('_layout_main', $this->data);
		}
	}

	public function delete() {
		$id = htmlentities(escapeString($this->uri->segment(3)));
		$popup = (int) $id ? $this->websitepopup_m->get_single_websitepopup(array('websitepopupID' => $id)) : NULL;
		if (customCompute($popup)) {
			$this->_deleteImage($popup->image);
			$this->websitepopup_m->delete_websitepopup($id);
			$this->session->set_flashdata('success', $this->lang->line('menu_success'));
		}
		redirect(base_url("websitepopup/index"));
	}

	// Quick on/off switch from the list page (uses the edit permission).
	public function status() {
		if (!permissionChecker('websitepopup_edit')) {
			redirect(base_url('exceptionpage/error'));
		}
		$id = htmlentities(escapeString($this->uri->segment(3)));
		$popup = (int) $id ? $this->websitepopup_m->get_single_websitepopup(array('websitepopupID' => $id)) : NULL;
		if (customCompute($popup)) {
			$this->websitepopup_m->update_websitepopup(array('status' => $popup->status ? 0 : 1, 'modify_date' => date('Y-m-d H:i:s')), $id);
			$this->session->set_flashdata('success', $this->lang->line('menu_success'));
		}
		redirect(base_url("websitepopup/index"));
	}
}
