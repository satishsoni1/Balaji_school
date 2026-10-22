<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Bankaccount extends Admin_Controller
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
    function __construct()
    {
        parent::__construct();
        $this->load->model("bankaccount_m");
        $this->load->model("bankaccountconf_m");

        $this->load->model("income_m");
        $this->load->model("expense_m");
        
        $language = $this->session->userdata('lang');
        $this->lang->load('bankaccount', $language);
        $this->lang->load('bankaccountreport', $language);
    }

    public function index()
    {
        $schoolyearID = $this->session->userdata('defaultschoolyearID');
        $this->data['suppliers'] = $this->income_m->get_account_2(array("schoolyearID"=>$schoolyearID));
        $this->data["subview"] = "bankaccount/index";
        $this->load->view('_layout_main', $this->data);
    }

    protected function rules()
    {
        $rules = array(
            array(
                'field' => 'bankaccountbankname',
                'label' => $this->lang->line("bankaccount_bankname"),
                'rules' => 'trim|required|xss_clean|max_length[128]|callback_unique_bankname'
            ),
            array(
                'field' => 'bankaccountno',
                'label' => $this->lang->line("bankaccount_accountno"),
                'rules' => 'trim|required|xss_clean|max_length[40]'
            ),
            array(
                'field' => 'bankaccountopeningbalance',
                'label' => $this->lang->line("bankaccountopeningbalance"),
                'rules' => 'trim|xss_clean|max_length[40]'
            ),
            array(
                'field' => 'bankaccountphone',
                'label' => $this->lang->line("bankaccount_phone"),
                'rules' => 'trim|xss_clean|max_length[25]|min_length[5]'
            ),
            array(
                'field' => 'bankaccountaddress',
                'label' => $this->lang->line("bankaccount_address"),
                'rules' => 'trim|xss_clean|max_length[128]'
            )
        );
        return $rules;
    }

    public function add()
    {

        if ($_POST) {
            $rules = $this->rules();
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->data["subview"] = "bankaccount/add";
                $this->load->view('_layout_main', $this->data);
            } else {
                $array = array(
                    "bankaccountbankname" => $this->input->post("bankaccountbankname"),
                    "bankaccountno" => $this->input->post("bankaccountno"),
                    "bankaccountphone" => $this->input->post("bankaccountphone"),
                    "bankaccountaddress" => $this->input->post("bankaccountaddress"),
                    "create_date" => date("Y-m-d H:i:s"),
                    "modify_date" => date("Y-m-d H:i:s"),
                    "create_userID" => $this->session->userdata('loginuserID'),
                    "create_usertypeID" => $this->session->userdata('usertypeID')
                );

                $this->bankaccount_m->insert_bankaccount($array);
                $account_id = $this->db->insert_id();
                $confarray = array(
                    "account_id" => $account_id,
                    "schoolyearID" => $this->session->userdata('defaultschoolyearID'),
                    "bankaccountopeningbalance" => $this->input->post("bankaccountopeningbalance"),
                );

                $this->bankaccountconf_m->insert_bankaccountconf($confarray);
                $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                redirect(base_url("bankaccount/index"));
            }
        } else {
            $this->data["subview"] = "bankaccount/add";
            $this->load->view('_layout_main', $this->data);
        }
    }

    public function edit()
    {
        $id = htmlentities(escapeString($this->uri->segment(3)));
        if ((int)$id) {
            $this->data['bankaccount'] = $this->bankaccount_m->get_single_bankaccount(array('bankaccountID' => $id));
            if ($this->data['bankaccount']) {
                if ($_POST) {
                    $rules = $this->rules();
                    $this->form_validation->set_rules($rules);
                    if ($this->form_validation->run() == FALSE) {
                        $this->data["subview"] = "bankaccount/edit";
                        $this->load->view('_layout_main', $this->data);
                    } else {
                        $array = array(
                            "bankaccountbankname" => $this->input->post("bankaccountbankname"),
                            "bankaccountno" => $this->input->post("bankaccountno"),
                            "bankaccountopeningbalance" => $this->input->post("bankaccountopeningbalance"),
                            "bankaccountphone" => $this->input->post("bankaccountphone"),
                            "bankaccountaddress" => $this->input->post("bankaccountaddress"),
                            "modify_date" => date("Y-m-d H:i:s"),
                        );

                        $this->bankaccount_m->update_bankaccount($array, $id);

                         $confarray = array(
                            "bankaccountopeningbalance" => $this->input->post("bankaccountopeningbalance"),
                        );
                        $this->bankaccountconf_m->update_bankaccountconf($confarray,array("account_id" => $id, "schoolyearID" => $this->session->userdata('defaultschoolyearID')));
                        $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                        redirect(base_url("bankaccount/index"));
                    }
                } else {
                    $this->data["subview"] = "bankaccount/edit";
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
    public function view()
    {

        $accountID = htmlentities(escapeString($this->uri->segment(3)));
        $this->data['bankaccount'] = $this->bankaccount_m->get_single_bankaccount(array('bankaccountID' => $accountID));
        
        $array['bankaccountID'] = $accountID;

        $totalincome        = $this->income_m->get_income_order_by_with_date_schoolyear($array);
        $totalexpense       = $this->expense_m->get_expense_order_with_date_schoolyear($array);



        $income_expense       = $this->income_m->get_income_expense_order_by_date($array);
        

        $this->data['totalincome']   = $totalincome->amount;
        $this->data['totalexpense']  = $totalexpense->amount;

        $this->data['income_expenses']   = $income_expense;

        $this->reportPDF('bankaccountreport.css', $this->data, 'bankaccount/ReportPDF');
    }
    public function delete()
    {
        $id = htmlentities(escapeString($this->uri->segment(3)));
        if ((int)$id) {
            $this->data['bankaccount'] = $this->bankaccount_m->get_single_bankaccount(array('bankaccountID' => $id));
            if ($this->data['bankaccount']) {
                $this->bankaccount_m->delete_bankaccount($id);
                $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                redirect(base_url("bankaccount/index"));
            } else {
                redirect(base_url("bankaccount/index"));
            }
        } else {
            redirect(base_url("bankaccount/index"));
        }
    }

    public function unique_bankname()
    {
        $id = htmlentities(escapeString($this->uri->segment(3)));
        if ((int)$id) {
            $bankaccount = $this->bankaccount_m->get_order_by_bankaccount(array("bankaccountbankname" => $this->input->post("bankaccountbankname"), "bankaccountID !=" => $id));
            if (customCompute($bankaccount)) {
                $this->form_validation->set_message("unique_bankname", "The %s is already exists.");
                return FALSE;
            }
            return TRUE;
        } else {
            $bankaccount = $this->bankaccount_m->get_order_by_bankaccount(array("bankaccountbankname" => $this->input->post("bankaccountbankname")));
            if (customCompute($bankaccount)) {
                $this->form_validation->set_message("unique_bankname", "The %s is already exists.");
                return FALSE;
            }
            return TRUE;
        }
    }
}
