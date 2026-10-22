<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manage_salary extends Admin_Controller {
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
        $this->load->model("manage_salary_m");
        $this->load->model("teacher_m");
        $this->load->model("user_m");
        $this->load->model("systemadmin_m");
        $this->load->model("salary_template_m");
        $this->load->model("hourly_template_m");
        $this->load->model("salaryoption_m");
        $language = $this->session->userdata('lang');
        $this->lang->load('manage_salary', $language);
    }

    public function send_mail_rules() {
        $rules = array(
            array(
                'field' => 'to',
                'label' => $this->lang->line("manage_salary_to"),
                'rules' => 'trim|required|max_length[60]|valid_email|xss_clean'
            ),
            array(
                'field' => 'subject',
                'label' => $this->lang->line("manage_salary_subject"),
                'rules' => 'trim|required|xss_clean'
            ),
            array(
                'field' => 'message',
                'label' => $this->lang->line("manage_salary_message"),
                'rules' => 'trim|xss_clean'
            ),
            array(
                'field' => 'userID',
                'label' => $this->lang->line("manage_salary_userID"),
                'rules' => 'trim|required|max_length[10]|xss_clean|callback_unique_data'
            ),
            array(
                'field' => 'usertypeID',
                'label' => $this->lang->line("manage_salary_usertypeID"),
                'rules' => 'trim|required|max_length[10]|xss_clean|callback_unique_data'
            )
        );
        return $rules;
    }

    public function unique_data($data) {
        if($data != '') {
            if($data == '0') {
                $this->form_validation->set_message('unique_data', 'The %s field is required.');
                return FALSE;
            }
            return TRUE;
        }
        return TRUE;
    }

    public function index() {
        $this->data['headerassets'] = array(
            'css' => array(
                'assets/select2/css/select2.css',
                'assets/select2/css/select2-bootstrap.css'
            ),
            'js' => array(
                'assets/select2/select2.js'
            )
        );

        $this->data['roles'] = $this->usertype_m->get_usertype();
        $setrole = htmlentities(escapeString($this->uri->segment(3)));
        
        if(!isset($setrole)) {
            $setrole = 0;
            $this->data['setrole'] = $setrole;
        } else {
            $this->data['setrole'] = $setrole;
        }

        if($setrole == 1) {
            $this->data['users'] = $this->systemadmin_m->get_systemadmin();
            $this->data['managesalary'] = pluck($this->manage_salary_m->get_order_by_manage_salary(array('usertypeID' => 1)), 'userID');
         } elseif($setrole == 2) {
            $this->data['users'] = $this->teacher_m->get_teacher();
            $this->data['managesalary'] = pluck($this->manage_salary_m->get_order_by_manage_salary(array('usertypeID' => 2)), 'userID');
        } else {
            $this->data['users'] = $this->user_m->get_order_by_user(array('usertypeID' => $setrole));
            $this->data['managesalary'] = pluck($this->manage_salary_m->get_order_by_manage_salary(array('usertypeID' => $setrole)), 'userID');
        }

        $this->data["subview"] = "manage_salary/index";
        $this->load->view('_layout_main', $this->data);
    }

    // protected function rules() {
    //     $rules = array(
    //         array(
    //             'field' => 'salary',
    //             'label' => $this->lang->line("manage_salary_salary"),
    //             'rules' => 'trim|required|xss_clean|max_length[11]|callback_unique_salary'
    //         ),
    //         array(
    //             'field' => 'template',
    //             'label' => $this->lang->line("manage_salary_template"),
    //             'rules' => 'trim|required|xss_clean|max_length[11]|callback_unique_template'
    //         )
    //     );
    //     return $rules;
    // }
    protected function rules() {
        $rules = array(
            array(
                'field' => 'basic_salary',
                'label' => $this->lang->line("salary_template_basic_salary"),
                'rules' => 'trim|required|xss_clean|max_length[11]'
            ),
            array(
                'field' => 'EPFO',
                'label' => $this->lang->line("salary_template_EPFO"),
                'rules' => 'trim|required|xss_clean|max_length[11]'
            )
        );
        return $rules;
    }

    public function add() {
        $userID     = htmlentities(escapeString($this->uri->segment(3)));
        $usertypeID = htmlentities(escapeString($this->uri->segment(4)));
        $this->data['usertypeID'] = $usertypeID;
        $this->data['userID'] = $userID;
        if((int)$userID && (int) $usertypeID) {
            
            if($usertypeID == 1) {
                $user = $this->systemadmin_m->get_single_systemadmin(array('usertypeID' => $usertypeID, 'systemadminID' => $userID));
            } elseif($usertypeID == 2) {
                $user = $this->teacher_m->get_single_teacher(array('usertypeID' => $usertypeID, 'teacherID' => $userID));
            } else {
                $user = $this->user_m->get_single_user(array('usertypeID' => $usertypeID, 'userID' => $userID));
            }

            if(customCompute($user)) {
                $manageSalary = $this->manage_salary_m->get_single_manage_salary(array('usertypeID' => $usertypeID, 'userID' => $userID));
                if(!customCompute($manageSalary)) {

                    $this->data['usertypeID'] = $usertypeID;

                    if($this->input->post('salary')) {
                        $salary = $this->input->post('salary');
                        $this->data['salaryID'] = $salary;
                        if($salary == 1) {
                            $this->data['alltemplate'] = $this->salary_template_m->get_salary_template();
                        } elseif($salary == 2) {
                            $this->data['alltemplate'] = $this->hourly_template_m->get_hourly_template();
                        }
                    } else {
                        $this->data['alltemplate'] = array();
                        $this->data['salaryID'] = 0;
                    }
                    
                    if($_POST) {
                        $rules = $this->rules();
                        $this->form_validation->set_rules($rules);
                        if ($this->form_validation->run() == FALSE) {
                            $this->session->set_flashdata('error', $this->lang->line('menu_error'));
                            $json = array("status" => 'error', 'errors' => $this->form_validation->error_array());
                            header("Content-Type: application/json", true);
                            echo json_encode($json);
                            exit;
                        } else {

                            $array = array(
                                "basic_salary"      => $this->input->post("basic_salary"),
                                "EPFO"     => $this->input->post("EPFO"),
                            );
            
                            $this->salary_template_m->insert_salary_template($array);
                            $salary_templateID = $this->db->insert_id();
                            $allowances_number = $this->input->post('allowances_number');
                            if(customCompute($allowances_number)) {
                                for ($i=1; $i <= $allowances_number; $i++) { 
                                    if($this->input->post('allowanceslabel'.$i) !='' && $this->input->post('allowancesamount'.$i) !='') {
                                        $allowancesArray = array(
                                            'salary_templateID' => $salary_templateID,
                                            'option_type'       => 1,
                                            'label_name'        => $this->input->post('allowanceslabel'.$i),
                                            'label_amount'      => $this->input->post('allowancesamount'.$i)
                                        );
                                        $this->salaryoption_m->insert_salaryoption($allowancesArray);
                                    }
                                }
                            }
            
                            $deductions_number = $this->input->post('deductions_number');
                            if(customCompute($deductions_number)) {
                                for ($i=1; $i <= $deductions_number; $i++) { 
                                    if($this->input->post('deductionslabel'.$i) !='' && $this->input->post('deductionsamount'.$i) !='') {
                                        $deductionsArray = array(
                                            'salary_templateID' => $salary_templateID,
                                            'option_type'       => 2,
                                            'label_name'        => $this->input->post('deductionslabel'.$i),
                                            'label_amount'      => $this->input->post('deductionsamount'.$i)
                                        );
                                        $this->salaryoption_m->insert_salaryoption($deductionsArray);
                                    }
                                }
                            }
                            $array = array(
                                'userID'            => $userID,
                                'usertypeID'        => $usertypeID,
                                'salary'            => 1,
                                'template'          => $salary_templateID,
                                'create_date'       => date("Y-m-d H:i:s"),
                                'modify_date'       => date("Y-m-d H:i:s"),
                                'create_userID'     => $this->session->userdata('loginuserID'),
                                'create_username'   => $this->session->userdata('username'),
                                'create_usertype'   => $this->session->userdata('usertype')
                            );
                            $this->manage_salary_m->insert_manage_salary($array);
                            $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                            
                            $json = array("status" => 'success');
                            header("Content-Type: application/json", true);
                            echo json_encode($json);

                            $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                        }
                    } else {
                        $this->data["subview"] = "manage_salary/add";
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
        } else {
            $this->data["subview"] = "error";
            $this->load->view('_layout_main', $this->data);
        }
    }

    public function edit() {
        $userID     = htmlentities(escapeString($this->uri->segment(3)));
        $usertypeID = htmlentities(escapeString($this->uri->segment(4)));
        $this->data['usertypeID'] = $usertypeID;
        $this->data['userID'] = $userID;
        if((int)$userID && (int) $usertypeID) {
            
            if($usertypeID == 1) {
                $user = $this->systemadmin_m->get_single_systemadmin(array('usertypeID' => $usertypeID, 'systemadminID' => $userID));
            } elseif($usertypeID == 2) {
                $user = $this->teacher_m->get_single_teacher(array('usertypeID' => $usertypeID, 'teacherID' => $userID));
            } else {
                $user = $this->user_m->get_single_user(array('usertypeID' => $usertypeID, 'userID' => $userID));
            }

            if(customCompute($user)) {
                $this->data['usertypeID'] = $usertypeID;

                    $manageSalary = $this->manage_salary_m->get_single_manage_salary(array('usertypeID' => $usertypeID, 'userID' => $userID));
                    if(customCompute($manageSalary)) {
                        $this->data['manage_salary'] = $manageSalary;
                        if($this->input->post('salary') || $manageSalary->salary) {
                            if($manageSalary->salary) {
                                $salary = $manageSalary->salary;
                            } else {
                                $salary = $this->input->post('salary');
                            }
                            $this->data['salaryID'] = $salary;
                            if($salary == 1) {
                                $this->data['alltemplate'] = $this->salary_template_m->get_salary_template();
                            } elseif($salary == 2) {
                                $this->data['alltemplate'] = $this->hourly_template_m->get_hourly_template();
                            }
                        } else {
                            $this->data['alltemplate'] = array();
                            $this->data['salaryID'] = 0;
                        }
                        $id = $manageSalary->template;
                        $this->data['salary_template'] = $this->salary_template_m->get_single_salary_template(array('salary_templateID' => $id));
                
                    $this->db->order_by("salary_optionID", "asc");
                    $this->data['salaryoptions'] = $this->salaryoption_m->get_order_by_salaryoption(array('salary_templateID' => $id));
                    $this->data['setid'] = $id;

                    $grosssalary = 0;
                    $totaldeduction = 0;
                    $netsalary = $this->data['salary_template']->basic_salary-$this->data['salary_template']->EPFO;
                    $orginalNetsalary = $this->data['salary_template']->basic_salary-$this->data['salary_template']->EPFO;
                    $grosssalarylist = array();
                    $totaldeductionlist = array();

                    if(customCompute($this->data['salaryoptions'])) {
                        foreach ($this->data['salaryoptions'] as $salaryOptionKey => $salaryOption) {
                            if($salaryOption->option_type == 1) {
                                $netsalary += $salaryOption->label_amount;
                                $grosssalary += $salaryOption->label_amount;
                                $grosssalarylist[$salaryOption->label_name] = $salaryOption->label_amount;
                            } elseif($salaryOption->option_type == 2) {
                                $netsalary -= $salaryOption->label_amount;
                                $totaldeduction += $salaryOption->label_amount;
                                $totaldeductionlist[$salaryOption->label_name] = $salaryOption->label_amount;
                            }
                        }
                    }
                    
                    $this->data['grosssalary'] = $grosssalary+$orginalNetsalary;
                    $this->data['totaldeduction'] = $totaldeduction;
                    $this->data['netsalary'] = $netsalary;
                    $this->data['grosssalarylist'] = $grosssalarylist;
                    $this->data['totaldeductionlist'] = $totaldeductionlist;
                    if($_POST) {
                        $rules = $this->rules();
                        $this->form_validation->set_rules($rules);
                        if ($this->form_validation->run() == FALSE) {
                            $this->session->set_flashdata('error', $this->lang->line('menu_error'));
                            $json = array("status" => 'error', 'errors' => $this->form_validation->error_array());
                            header("Content-Type: application/json", true);
                            echo json_encode($json);
                            exit;
                        } else {
                            $array = array(
                                
                                "basic_salary"      => $this->input->post("basic_salary"),
                                "EPFO"     => $this->input->post("EPFO"),
                            );
                            $id = htmlentities($this->input->post('id')); 
                            $this->salary_template_m->update_salary_template($array, $id);

                            $allowances_number = $this->input->post('allowances_number');
                            $this->salaryoption_m->delete_salaryoption_by_salary_templateID($id);

                            if(customCompute($allowances_number)) {
                                for ($i=1; $i <= $allowances_number; $i++) { 
                                    if($this->input->post('allowanceslabel'.$i) !='' && $this->input->post('allowancesamount'.$i) !='') {
                                        $allowancesArray = array(
                                            'salary_templateID' => $id,
                                            'option_type'       => 1,
                                            'label_name'        => $this->input->post('allowanceslabel'.$i),
                                            'label_amount'      => $this->input->post('allowancesamount'.$i)
                                        );
                                        $this->salaryoption_m->insert_salaryoption($allowancesArray);
                                    }
                                }
                            }

                            $deductions_number = $this->input->post('deductions_number');
                            if(customCompute($deductions_number)) {
                                for ($i=1; $i <= $deductions_number; $i++) { 
                                    if($this->input->post('deductionslabel'.$i) !='' && $this->input->post('deductionsamount'.$i) !='') {
                                        $deductionsArray = array(
                                            'salary_templateID' => $id,
                                            'option_type'       => 2,
                                            'label_name'        => $this->input->post('deductionslabel'.$i),
                                            'label_amount'      => $this->input->post('deductionsamount'.$i)
                                        );
                                        $this->salaryoption_m->insert_salaryoption($deductionsArray);
                                    }
                                }
                            }

                            $json = array("status" => 'success');
                            header("Content-Type: application/json", true);
                            echo json_encode($json);

                            $this->session->set_flashdata('success', $this->lang->line('menu_success'));

                        }
                    } else {
                        $this->data["subview"] = "manage_salary/edit";
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
        } else {
            $this->data["subview"] = "error";
            $this->load->view('_layout_main', $this->data);
        }
    }

    public function view() {
        $userID = htmlentities(escapeString($this->uri->segment(3)));
        $usertypeID = htmlentities(escapeString($this->uri->segment(4)));

        if((int)$userID && (int) $usertypeID) {
            
            $this->data['usertypeID'] = $usertypeID;
            $this->data['userID'] = $userID;

            if($usertypeID == 1) {
                $user = $this->systemadmin_m->get_single_systemadmin(array('usertypeID' => $usertypeID, 'systemadminID' => $userID));
            } elseif($usertypeID == 2) {
                $user = $this->teacher_m->get_single_teacher(array('usertypeID' => $usertypeID, 'teacherID' => $userID));
            } else {
                $user = $this->user_m->get_single_user(array('usertypeID' => $usertypeID, 'userID' => $userID));
            }

            if(customCompute($user)) {
                $this->data['usertype'] = $this->usertype_m->get_usertype($user->usertypeID);
                $this->data['user'] = $user;
                $manageSalary = $this->manage_salary_m->get_single_manage_salary(array('usertypeID' => $usertypeID, 'userID' => $userID));
                if(customCompute($manageSalary)) {
                    $this->data['manage_salary'] = $manageSalary;
                    if($manageSalary->salary == 1) {

                        $this->data['salary_template'] = $this->salary_template_m->get_single_salary_template(array('salary_templateID' => $manageSalary->template));
                        if($this->data['salary_template']) {

                            $this->db->order_by("salary_optionID", "asc");
                            $this->data['salaryoptions'] = $this->salaryoption_m->get_order_by_salaryoption(array('salary_templateID' => $manageSalary->template));

                            $grosssalary = 0;
                            $totaldeduction = 0;
                            $netsalary = $this->data['salary_template']->basic_salary;
                            $orginalNetsalary = $this->data['salary_template']->basic_salary;
                            $grosssalarylist = array();
                            $totaldeductionlist = array();

                            if(customCompute($this->data['salaryoptions'])) {
                                foreach ($this->data['salaryoptions'] as $salaryOptionKey => $salaryOption) {
                                    if($salaryOption->option_type == 1) {
                                        $netsalary += $salaryOption->label_amount;
                                        $grosssalary += $salaryOption->label_amount;
                                        $grosssalarylist[$salaryOption->label_name] = $salaryOption->label_amount;
                                    } elseif($salaryOption->option_type == 2) {
                                        $netsalary -= $salaryOption->label_amount;
                                        $totaldeduction += $salaryOption->label_amount;
                                        $totaldeductionlist[$salaryOption->label_name] = $salaryOption->label_amount;
                                    }
                                }
                            }

                            $this->data['grosssalary'] = ($orginalNetsalary+$grosssalary);
                            $this->data['totaldeduction'] = $totaldeduction;
                            $this->data['netsalary'] = $netsalary;

                            $this->data["subview"] = "manage_salary/view";
                            $this->load->view('_layout_main', $this->data);
                        } else {
                            $this->data["subview"] = "error";
                            $this->load->view('_layout_main', $this->data);
                        }
                    } elseif($manageSalary->salary == 2) {
                        $this->data['hourly_salary'] = $this->hourly_template_m->get_single_hourly_template(array('hourly_templateID'=> $manageSalary->template));
                        if(customCompute($this->data['hourly_salary'])) {

                            $this->data['grosssalary'] = 0;
                            $this->data['totaldeduction'] = 0;
                            $this->data['netsalary'] = $this->data['hourly_salary']->hourly_rate;

                            $this->data["subview"] = "manage_salary/view";
                            $this->load->view('_layout_main', $this->data);
                        } else {
                            $this->data["subview"] = "error";
                            $this->load->view('_layout_main', $this->data);
                        }
                    }
                } else {
                     $this->data["subview"] = "error";
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

    public function print_preview() {
        $userID = htmlentities(escapeString($this->uri->segment(3)));
        $usertypeID = htmlentities(escapeString($this->uri->segment(4)));
        if(permissionChecker('manage_salary_view')) {
            if((int)$userID && (int) $usertypeID) {
                $this->data['usertypeID'] = $usertypeID;
                $this->data['userID'] = $userID;

                if($usertypeID == 1) {
                    $user = $this->systemadmin_m->get_single_systemadmin(array('usertypeID' => $usertypeID, 'systemadminID' => $userID));
                } elseif($usertypeID == 2) {
                    $user = $this->teacher_m->get_single_teacher(array('usertypeID' => $usertypeID, 'teacherID' => $userID));
                } else {
                    $user = $this->user_m->get_single_user(array('usertypeID' => $usertypeID, 'userID' => $userID));
                }

                if(customCompute($user)) {
                    $this->data['usertype'] = $this->usertype_m->get_usertype($user->usertypeID);
                    $this->data['user'] = $user;
                    $manageSalary = $this->manage_salary_m->get_single_manage_salary(array('usertypeID' => $usertypeID, 'userID' => $userID));
                    if(customCompute($manageSalary)) {
                        $this->data['manage_salary'] = $manageSalary;
                        if($manageSalary->salary == 1) {

                            $this->data['salary_template'] = $this->salary_template_m->get_single_salary_template(array('salary_templateID' => $manageSalary->template));
                            if($this->data['salary_template']) {

                                $this->db->order_by("salary_optionID", "asc");
                                $this->data['salaryoptions'] = $this->salaryoption_m->get_order_by_salaryoption(array('salary_templateID' => $manageSalary->template));

                                $grosssalary = 0;
                                $totaldeduction = 0;
                                $netsalary = $this->data['salary_template']->basic_salary;
                                $orginalNetsalary = $this->data['salary_template']->basic_salary;
                                $grosssalarylist = array();
                                $totaldeductionlist = array();

                                if(customCompute($this->data['salaryoptions'])) {
                                    foreach ($this->data['salaryoptions'] as $salaryOptionKey => $salaryOption) {
                                        if($salaryOption->option_type == 1) {
                                            $netsalary += $salaryOption->label_amount;
                                            $grosssalary += $salaryOption->label_amount;
                                            $grosssalarylist[$salaryOption->label_name] = $salaryOption->label_amount;
                                        } elseif($salaryOption->option_type == 2) {
                                            $netsalary -= $salaryOption->label_amount;
                                            $totaldeduction += $salaryOption->label_amount;
                                            $totaldeductionlist[$salaryOption->label_name] = $salaryOption->label_amount;
                                        }
                                    }
                                }

                                $this->data['grosssalary'] = ($orginalNetsalary+$grosssalary);
                                $this->data['totaldeduction'] = $totaldeduction;
                                $this->data['netsalary'] = $netsalary;

                                $this->reportPDF('managesalarymodule.css',$this->data, 'manage_salary/print_preview');
                            } else {
                                $this->data["subview"] = "error";
                                $this->load->view('_layout_main', $this->data);
                            }
                        } elseif($manageSalary->salary == 2) {
                            $this->data['hourly_salary'] = $this->hourly_template_m->get_single_hourly_template(array('hourly_templateID'=> $manageSalary->template));
                            if(customCompute($this->data['hourly_salary'])) {
                                $this->data['grosssalary'] = 0;
                                $this->data['totaldeduction'] = 0;
                                $this->data['netsalary'] = $this->data['hourly_salary']->hourly_rate;
                                $this->reportPDF('managesalarymodule.css',$this->data, 'manage_salary/print_preview');
                            } else {
                                $this->data["subview"] = "error";
                                $this->load->view('_layout_main', $this->data);
                            }
                        }
                    } else {
                         $this->data["subview"] = "error";
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
        } else {
            $this->data["subview"] = "error";
            $this->load->view('_layout_main', $this->data);
        }

    }

    public function send_mail() {
        $retArray['status'] = FALSE;
        $retArray['message'] = '';
        if(permissionChecker('manage_salary_view')) {
            if($_POST) {
                $rules = $this->send_mail_rules();
                $this->form_validation->set_rules($rules);
                if ($this->form_validation->run() == FALSE) {
                    $retArray = $this->form_validation->error_array();
                    $retArray['status'] = FALSE;
                    echo json_encode($retArray);
                    exit;
                } else {
                    $userID = $this->input->post('userID');
                    $usertypeID = $this->input->post('usertypeID');
                    if((int)$userID && (int) $usertypeID) {
                        $this->data['usertypeID'] = $usertypeID;
                        $this->data['userID'] = $userID;

                        if($usertypeID == 1) {
                            $user = $this->systemadmin_m->get_single_systemadmin(array('usertypeID' => $usertypeID, 'systemadminID' => $userID));
                        } elseif($usertypeID == 2) {
                            $user = $this->teacher_m->get_single_teacher(array('usertypeID' => $usertypeID, 'teacherID' => $userID));
                        } else {
                            $user = $this->user_m->get_single_user(array('usertypeID' => $usertypeID, 'userID' => $userID));
                        }

                        if(customCompute($user)) {
                            $this->data['usertype'] = $this->usertype_m->get_usertype($user->usertypeID);
                            $this->data['user'] = $user;
                            $manageSalary = $this->manage_salary_m->get_single_manage_salary(array('usertypeID' => $usertypeID, 'userID' => $userID));
                            if(customCompute($manageSalary)) {
                                $this->data['manage_salary'] = $manageSalary;
                                if($manageSalary->salary == 1) {

                                    $this->data['salary_template'] = $this->salary_template_m->get_single_salary_template(array('salary_templateID' => $manageSalary->template));
                                    if($this->data['salary_template']) {

                                        $this->db->order_by("salary_optionID", "asc");
                                        $this->data['salaryoptions'] = $this->salaryoption_m->get_order_by_salaryoption(array('salary_templateID' => $manageSalary->template));

                                        $grosssalary = 0;
                                        $totaldeduction = 0;
                                        $netsalary = $this->data['salary_template']->basic_salary;
                                        $orginalNetsalary = $this->data['salary_template']->basic_salary;
                                        $grosssalarylist = array();
                                        $totaldeductionlist = array();

                                        if(customCompute($this->data['salaryoptions'])) {
                                            foreach ($this->data['salaryoptions'] as $salaryOptionKey => $salaryOption) {
                                                if($salaryOption->option_type == 1) {
                                                    $netsalary += $salaryOption->label_amount;
                                                    $grosssalary += $salaryOption->label_amount;
                                                    $grosssalarylist[$salaryOption->label_name] = $salaryOption->label_amount;
                                                } elseif($salaryOption->option_type == 2) {
                                                    $netsalary -= $salaryOption->label_amount;
                                                    $totaldeduction += $salaryOption->label_amount;
                                                    $totaldeductionlist[$salaryOption->label_name] = $salaryOption->label_amount;
                                                }
                                            }
                                        }

                                        $this->data['grosssalary'] = ($orginalNetsalary+$grosssalary);
                                        $this->data['totaldeduction'] = $totaldeduction;
                                        $this->data['netsalary'] = $netsalary;

                                        $email = $this->input->post('to');
                                        $subject = $this->input->post('subject');
                                        $message = $this->input->post('message');
                                        $this->reportSendToMail('managesalarymodule.css',$this->data, 'manage_salary/print_preview', $email, $subject, $message);
                                        $retArray['message'] = "Message";
                                        $retArray['status'] = TRUE;
                                        echo json_encode($retArray);
                                        exit;
                                    } else {
                                        $retArray['message'] = $this->lang->line('manage_salary_data_not_found');
                                        echo json_encode($retArray);
                                        exit;
                                    }
                                } elseif($manageSalary->salary == 2) {
                                    $this->data['hourly_salary'] = $this->hourly_template_m->get_single_hourly_template(array('hourly_templateID'=> $manageSalary->template));
                                    if(customCompute($this->data['hourly_salary'])) {

                                        $this->data['grosssalary'] = 0;
                                        $this->data['totaldeduction'] = 0;
                                        $this->data['netsalary'] = $this->data['hourly_salary']->hourly_rate;

                                        $email = $this->input->post('to');
                                        $subject = $this->input->post('subject');
                                        $message = $this->input->post('message');

                                        $this->reportSendToMail('managesalarymodule.css',$this->data, 'manage_salary/print_preview', $email, $subject, $message);
                                        $retArray['message'] = "Message";
                                        $retArray['status'] = TRUE;
                                        echo json_encode($retArray);
                                        exit;
                                    } else {
                                        $retArray['message'] = $this->lang->line('manage_salary_data_not_found');
                                        echo json_encode($retArray);
                                        exit;
                                    }
                                }
                            } else {
                                $retArray['message'] = $this->lang->line('manage_salary_data_not_found');
                                echo json_encode($retArray);
                                exit;
                            }
                        } else {
                            $retArray['message'] = $this->lang->line('manage_salary_data_not_found');
                            echo json_encode($retArray);
                            exit;
                        }
                    } else {
                        $retArray['message'] = $this->lang->line('manage_salary_data_not_found');
                        echo json_encode($retArray);
                        exit;
                    }
                }
            } else {
                $retArray['message'] = $this->lang->line('manage_salary_permissionmethod');
                echo json_encode($retArray);
                exit;
            }
        } else {
            $retArray['message'] = $this->lang->line('manage_salary_permission');
            echo json_encode($retArray);
            exit;
        }
    }

    public function delete() {
        $userID = htmlentities(escapeString($this->uri->segment(3)));
        $usertypeID = htmlentities(escapeString($this->uri->segment(4)));
        if((int)$userID && (int)$usertypeID) {

            if($usertypeID == 1) {
                $user = $this->systemadmin_m->get_single_systemadmin(array('usertypeID' => $usertypeID, 'systemadminID' => $userID));
            } elseif($usertypeID == 2) {
                $user = $this->teacher_m->get_single_teacher(array('usertypeID' => $usertypeID, 'teacherID' => $userID));
            } else {
                $user = $this->user_m->get_single_user(array('usertypeID' => $usertypeID, 'userID' => $userID));
            }

            if(customCompute($user)) {
                $this->data['manage_salary'] = $this->manage_salary_m->get_single_manage_salary(array('usertypeID' => $usertypeID, 'userID' => $userID));
                if($this->data['manage_salary']) {
                    $this->manage_salary_m->delete_manage_salary($this->data['manage_salary']->manage_salaryID);
                    $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                    redirect(base_url("manage_salary/index/$usertypeID"));
                } else {
                    redirect(base_url("manage_salary/index"));
                }
            } else {
                redirect(base_url("manage_salary/index"));
            }
        } else {
            redirect(base_url("manage_salary/index"));
        }
    }

    public function role_list() {
        $role = $this->input->post('id');
        if((int)$role) {
            $string = base_url("manage_salary/index/$role");
            echo $string;
        } else {
            echo base_url("manage_salary/index");
        }
    }

    public function templatecall() {
        $salary = $this->input->post('salary');

        if($salary == 1) {
            $salaryTemplates = $this->salary_template_m->get_salary_template();
            if(customCompute($salaryTemplates)) {
                echo '<option value="0">'.$this->lang->line('manage_salary_select_template').'</option>';
                foreach ($salaryTemplates as $salaryTemplateKey => $salaryTemplate) { 
                    echo '<option value="'.$salaryTemplate->salary_templateID.'">'.$salaryTemplate->salary_grades.'</option>';
                }
            } else {
                echo '<option value="0">'.$this->lang->line('manage_salary_select_template').'</option>';
            }
        } elseif($salary == 2) {
            $salaryTemplates = $this->hourly_template_m->get_hourly_template();
            if(customCompute($salaryTemplates)) {
                echo '<option value="0">'.$this->lang->line('manage_salary_select_template').'</option>';
                foreach ($salaryTemplates as $salaryTemplateKey => $salaryTemplate) { 
                    echo '<option value="'.$salaryTemplate->hourly_templateID.'">'.$salaryTemplate->hourly_grades.'</option>';
                }
            } else {
                echo '<option value="0">'.$this->lang->line('manage_salary_select_template').'</option>';
            }
        }
    }

    public function unique_salary() {
        if($this->input->post('salary') == 0) {
            $this->form_validation->set_message("unique_salary", "The %s field is required");
            return FALSE;
        }
        return TRUE;
    }

    public function unique_template() {
        if($this->input->post('template') == 0) {
            $this->form_validation->set_message("unique_template", "The %s field is required");
            return FALSE;
        }
        return TRUE;
    }

}
