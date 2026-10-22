<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Global_payment extends Admin_Controller
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

    function __construct() {
        parent::__construct();
        $this->load->model("student_m");
        $this->load->model("classes_m");
        $this->load->model("section_m");
        $this->load->model('studentgroup_m');
        $this->load->model('feetypes_m');
        $this->load->model('invoice_m');
        $this->load->model('payment_m');
        $this->load->model('globalpayment_m');
        $this->load->model('weaverandfine_m');
        $this->load->model('maininvoice_m');
        $this->load->model('studentrelation_m');
        $this->load->model('feepackages_m');
        $this->load->model('mailandsmstemplatetag_m');
        $this->load->model('grade_m');
        $this->load->model('mailandsms_m');
        $this->load->library("email");
		$this->load->library("clickatell");
		$this->load->library("twilio");
		$this->load->library("bulk");
		$this->load->library("msg91");
        $language = $this->session->userdata('lang');
        $this->lang->load('global_payment', $language);
    }

    protected function rules()
    {
        $rules = [
            [
                'field' => 'classesID',
                'label' => $this->lang->line("global_classes"),
                'rules' => 'trim|required|xss_clean|max_length[11]|callback_unique_classes',
            ],
            [
                'field' => 'sectionID',
                'label' => $this->lang->line("global_section"),
                'rules' => 'trim|xss_clean|max_length[11]',
            ],
            [
                'field' => 'studentID',
                'label' => $this->lang->line("global_student"),
                'rules' => 'trim|required|xss_clean|max_length[11]|callback_unique_student',
            ],
        ];

        return $rules;
    }  

    public function index() {
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

        $schoolyearID                   = $this->session->userdata('defaultschoolyearID');
        $this->data['feetypes'] = pluck($this->feetypes_m->get_feetypes(), 'feetypes', 'feetypesID');
        $this->data['classes']          = $this->classes_m->get_classes();
        $this->data['sections']         = 0;
        $this->data['students']         = [];
        $this->data['globalpayments']   = [];


        $this->data['set_classesID']    = 0;
        $this->data['set_sectionID']    = 0;
        $this->data['set_studentID']    = 0;
        $this->data['set_groupID']      = 0;

        if($this->input->post('classesID') > 0) {
            $this->data['sections'] = $this->section_m->get_order_by_section(array('classesID' => $this->input->post('classesID')));
            if($this->input->post('sectionID') > 0) {
                $this->data['students'] = $this->studentrelation_m->get_order_by_student(array('srclassesID' => $this->input->post('classesID'), 'srsectionID' => $this->input->post('sectionID'), 'srschoolyearID' => $schoolyearID));
            } else {
                $this->data['students'] = $this->studentrelation_m->get_order_by_student(array('srclassesID' => $this->input->post('classesID'), 'srschoolyearID' => $schoolyearID));
            }
        }


        $this->data['single_student'] = [];
        // ini_set('display_errors', 1);
        // ini_set('display_startup_errors', 1);
        // error_reporting(E_ALL);
        if ($_POST) {
            $rules = $this->rules();
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $this->data["subview"]  = "global_payment/index";
                $this->load->view('_layout_main', $this->data);
            } else {
                $classesID                      = $this->input->post('classesID');
                $sectionID                      = $this->input->post('sectionID');
                $studentID                      = $this->input->post('studentID');

                $this->data['set_classesID']    = $classesID; 
                $this->data['set_sectionID']    = $sectionID;
                $this->data['set_studentID']    = $studentID;

                $this->data['feetypes'] = pluck($this->feetypes_m->get_feetypes(), 'feetypes', 'feetypesID');
                //$this->data['schoolyears'] = pluck($this->schoolyear_m->get_schoolyears(), 'feetypes', 'feetypesID');
                $this->data['schoolyears'] = pluck($this->schoolyear_m->get_schoolyear(), 'schoolyear', 'schoolyearID');
                $this->data['single_student'] = $this->studentrelation_m->get_single_student(array('srstudentID' => $studentID, 'srschoolyearID' => $schoolyearID));
                //var_dump($this->data['single_student']);die;
                $this->payment_m->order_payment('paymentID asc');
                $allPaymentList = $this->payment_m->get_order_by_payment(array('payment.studentID' => $studentID));
                
                $allWeaverList = $this->weaverandfine_m->get_order_by_weaverandfine(array('studentID' => $studentID));

                $this->data['payments'] = $this->generateAllPaymentAmount($allPaymentList);
                
                $this->data['weavers'] = $this->generateAllWeaverAmount($allWeaverList);
                $this->data['paymenteds'] = $allPaymentList;
                $this->data['weavereds'] = $allWeaverList;

                $this->data['globalpayment_max'] = $this->globalpayment_m->get_max_globalpayment();

                if(customCompute($this->data['single_student'])) {
                    $single_student = $this->data['single_student'];

                    $this->data['single_classes'] = $this->classes_m->get_single_classes(array('classesID' => $single_student->srclassesID));
                    $this->data['single_section'] = $this->section_m->get_single_section(array('sectionID' => $single_student->srsectionID));
                    $this->data['single_group'] = $this->studentgroup_m->get_single_studentgroup(array('studentgroupID' => $single_student->srstudentgroupID));

                    $this->data['invoices'] = $this->invoice_m->get_order_by_invoice(array('studentID' => $single_student->srstudentID, 'deleted_at' => 1));
                    //var_dump($this->data['invoices']);die;

                    $this->data['invoicefeetype'] = pluck($this->data['invoices'], 'feetypeID', 'invoiceID');

                    $this->data['globalpayments'] = $this->globalpayment_m->get_order_by_globalpayment(array( 'studentID' => $single_student->srstudentID));

                    $this->data['paidpayments'] = $this->generateAllPaymentAmountWithGlobalID($allPaymentList);

                    $this->data['weaverandfines'] = pluck($this->weaverandfine_m->get_order_by_weaverandfine(array('studentID' => $single_student->srstudentID)), 'obj', 'paymentID');
                    $this->data['feepackages'] = pluck($this->feepackages_m->get_order_by_feepackages(), 'name', 'id');
                    
                    
                } else {
                    $this->data['single_classes'] = [];
                    $this->data['single_section'] = [];
                    $this->data['single_group'] = [];
                    $this->data['invoices'] = [];
                    $this->data['globalpayments'] = [];
                }

                $this->data["subview"] = "global_payment/index";
                $this->load->view('_layout_main', $this->data);
            }
        } else {
            $this->data["subview"] = "global_payment/index";
            $this->load->view('_layout_main', $this->data);
        }
    }

    private function generateAllPaymentAmount($payments) {
        $returnArray = [];
        if(customCompute($payments)) {
            foreach ($payments as $payment) {
                $returnArray[$payment->invoiceID] = isset($returnArray[$payment->invoiceID]) ?  $returnArray[$payment->invoiceID] + $payment->paymentamount :  $payment->paymentamount; 
            }
        }

        return $returnArray;
    }

    private function generateAllPaymentAmountWithGlobalID($payments) {
        $returnArray = [];
        $weaverandfine = pluck($this->weaverandfine_m->get_weaverandfine(), 'obj', 'paymentID');

        if(customCompute($payments)) {
            foreach ($payments as $payment) {
                $returnArray['paid'][$payment->globalpaymentID] = isset($returnArray['paid'][$payment->globalpaymentID]) ?  $returnArray['paid'][$payment->globalpaymentID] + $payment->paymentamount :  $payment->paymentamount;

                if(isset($returnArray['paid'][$payment->globalpaymentID])) {
                    if(isset($weaverandfine[$payment->paymentID])) {
                        if(isset($returnArray['weaver'][$payment->globalpaymentID])) {
                            $returnArray['weaver'][$payment->globalpaymentID] += $weaverandfine[$payment->paymentID]->weaver; 
                        } else {
                            $returnArray['weaver'][$payment->globalpaymentID] = $weaverandfine[$payment->paymentID]->weaver; 
                        }

                        if(isset($returnArray['fine'][$payment->globalpaymentID])) {
                            $returnArray['fine'][$payment->globalpaymentID] += $weaverandfine[$payment->paymentID]->fine; 
                        } else {
                            $returnArray['fine'][$payment->globalpaymentID] = $weaverandfine[$payment->paymentID]->fine; 
                        }
                    }

                    if(!isset($returnArray['paiddate'][$payment->globalpaymentID])) {
                        $returnArray['paiddate'][$payment->globalpaymentID] = $payment->paymentdate;
                    }
                }
            }
        }

        return $returnArray;
    }

    private function generateAllWeaverAmount($weaverandfines) {
        $returnArray = [];
        if(customCompute($weaverandfines)) {
            foreach ($weaverandfines as $weaverandfine) {
                $returnArray[$weaverandfine->invoiceID] = isset($returnArray[$weaverandfine->invoiceID]) ?  $returnArray[$weaverandfine->invoiceID] + $weaverandfine->weaver :  $weaverandfine->weaver; 
            }
        }
        return $returnArray;
    }

    public function unique_classes() {
        if ($this->input->post('classesID') == 0) {
            $this->form_validation->set_message("unique_classes", "The %s field is required");
            return FALSE;
        }
        return TRUE;
    }

    public function unique_student() {
        if($this->input->post('studentID') == 0) {
            $this->form_validation->set_message("unique_student", "The %s field is required");
            return false;
        }
        return true;
    }

    public function sectioncall() {
        $id = $this->input->post('id');
        if ((int) $id) {
            $allsection = $this->section_m->get_order_by_section([ "classesID" => $id ]);
            echo "<option value='0'>", $this->lang->line("global_select_section"), "</option>";
            foreach ($allsection as $value) {
                echo "<option value=\"$value->sectionID\">", $value->section, "</option>";
            }
        } else {
            echo "<option value='0'>", $this->lang->line("global_select_section"), "</option>";
        }
    }

    public function studentcall() {
        $classesID = $this->input->post('classesID');
        $sectionID = $this->input->post('sectionID');
        $schoolyearID = $this->session->userdata('defaultschoolyearID');

        if ((int) $classesID && (int) $sectionID) {
            if($sectionID == 0) {
                $allstudent = $this->studentrelation_m->get_order_by_student([ "srclassesID" => $classesID, 'srschoolyearID' => $schoolyearID ]);
            } else {
                $allstudent = $this->studentrelation_m->get_order_by_student([ "srclassesID" => $classesID, 'srsectionID' => $sectionID, 'srschoolyearID' => $schoolyearID ]);
            }

            echo "<option value='0'>", $this->lang->line("global_select_student"), "</option>";
            foreach ($allstudent as $value) {
                echo "<option value=\"$value->srstudentID\">", $value->srname.' - '.$this->lang->line('global_roll').' - '.$value->srroll, "</option>";
            }
        } elseif((int) $classesID) {
            $allstudent = $this->studentrelation_m->get_order_by_student([ "srclassesID" => $classesID, 'srschoolyearID' => $schoolyearID ]);
            echo "<option value='0'>", $this->lang->line("global_select_student"), "</option>";
            foreach ($allstudent as $value) {
                echo "<option value=\"$value->srstudentID\">", $value->srname.' - '.$this->lang->line('global_roll').' - '.$value->srroll, "</option>";
            }
        } else {
            echo "<option value='0'>", $this->lang->line("global_select_section"), "</option>";
        }
    }

    protected function paymentRules() {
        $rules = array(
            array(
                'field' => 'studentID',
                'label' => $this->lang->line("global_student"),
                'rules' => 'trim|required|xss_clean|numeric|max_length[11]'
            ),
            array(
                'field' => 'classesID',
                'label' => $this->lang->line("global_classes"),
                'rules' => 'trim|required|xss_clean|numeric|max_length[11]'
            ),
            array(
                'field' => 'invoicename',
                'label' => $this->lang->line("global_invoice_name"),
                'rules' => 'trim|required|xss_clean|max_length[127]'
            ),
            array(
                'field' => 'invoicedescription',
                'label' => $this->lang->line("global_description"),
                'rules' => 'trim|xss_clean|max_length[127]'
            ),
            array(
                'field' => 'invoicenumber',
                'label' => $this->lang->line("global_invoice_number"),
                'rules' => 'trim|required|xss_clean|min_length[6]'
            ),
            array(
                'field' => 'paymentyear',
                'label' => $this->lang->line("global_payment_year"),
                'rules' => 'trim|required|numeric|xss_clean|max_length[4]'
            ),
            array(
                'field' => 'payment_status',
                'label' => $this->lang->line("global_payment_status"),
                'rules' => 'trim|required|xss_clean|max_length[7]'
            ),
            array(
                'field' => 'payment_type',
                'label' => $this->lang->line("global_payment_type"),
                'rules' => 'trim|required|xss_clean|max_length[6]'
            ),
            array(
                'field' => 'paid',
                'label' => $this->lang->line("global_paid"),
                'rules' => 'trim|xss_clean|max_length[10]|callback_unique_paidweaverfine'
            )
        );
        return $rules;
    }

    public function unique_paidweaverfine() {
        $paids = $this->input->post('paid');
        $weavers = $this->input->post('weaver');
        $fines = $this->input->post('fine');

        $max_value = 10; 
        $paidRequiredStatus = FALSE;
        $weaverRequiredStatus = FALSE;
        $fineRequiredStatus = FALSE;
        
        if(customCompute($paids)) {
            foreach ($paids as $paid) {
                if($paid['value'] != '') {
                    if((float) $paid['value']) {
                        if(strlen($paid['value']) <= $max_value && strlen($paid['value']) >= 0) {
                            $paidRequiredStatus = TRUE;
                        } else {
                            $this->form_validation->set_message("unique_paidweaverfine", "%s cannot exceed ".$max_value." characters in length.");
                            return FALSE;
                        } 
                    } else {
                        $this->form_validation->set_message("unique_paidweaverfine", "%s must contain only numbers.");
                        return FALSE;
                    }
                }
            }
        }

        if(customCompute($weavers)) {
            foreach ($weavers as $weaver) {
                if($weaver['value'] != '') {
                    if((float) $weaver['value']) {
                        if(strlen($weaver['value']) <= $max_value && strlen($weaver['value']) >= 0) {
                            $weaverRequiredStatus = TRUE;
                        } else {
                            $this->form_validation->set_message("unique_paidweaverfine", "%s cannot exceed ".$max_value." characters in length.");
                            return FALSE;
                        } 
                    } else {
                        $this->form_validation->set_message("unique_paidweaverfine", "%s must contain only numbers.");
                        return FALSE;
                    }
                }
            }
        }

        if(customCompute($fines)) {
            foreach ($fines as $fine) {
                if($fine['value'] != '') {
                    if((float) $fine['value']) {
                        if(strlen($fine['value']) <= $max_value && strlen($fine['value']) >= 0) {
                            $fineRequiredStatus = TRUE;
                        } else {
                            $this->form_validation->set_message("unique_paidweaverfine", "%s cannot exceed ".$max_value." characters in length.");
                            return FALSE;
                        } 
                    } else {
                        $this->form_validation->set_message("unique_paidweaverfine", "%s must contain only numbers.");
                        return FALSE;
                    }
                }
            }
        }

        if($paidRequiredStatus || $weaverRequiredStatus || $fineRequiredStatus) {
            if($this->session->flashdata('paymentGenerateStatus')) {
                return FALSE;
                $this->form_validation->set_message("unique_paidweaverfine", "%s is required.");
            }

            return TRUE;
        } else {
            $this->form_validation->set_message("unique_paidweaverfine", "%s is required.");
            return FALSE;
        }
    }
    public function send_fee_msg($studentID,$schoolyearID,$fee_amount_paid,$date_of_fee_paid,$total_fee,$total_paid,$total_pending) {
        
        $usertypeID = 3;
        $getway = "clickatell";
        $type = "sms";
        
        $singlestudent = $this->studentrelation_m->general_get_single_student(array('srstudentID' => $studentID, 'srschoolyearID' => $schoolyearID), TRUE);
        $message = "Dear [name], Your fee amount ".number_format($fee_amount_paid, 2, '.', '')." has been received on ".$date_of_fee_paid." Total fee amount -".number_format($total_fee, 2, '.', '').", Total received ".number_format($total_paid, 2, '.', '').", Total pending amount - ".number_format($total_pending, 2, '.', '')." Regards, SBESCH";
		//var_dump($getway);die;
		if (customCompute($singlestudent)) {
			$status = $this->userConfigSMS($message, $singlestudent, $usertypeID, $getway, $schoolyearID);
			$array = array(
				'usertypeID' => $usertypeID,
				'users' =>  $singlestudent->srname,
				'type' => ucfirst($type),
				'message' => $this->input->post('sms_message'),
				'year' => date('Y'),
				'senderusertypeID' => $this->session->userdata('usertypeID'),
				'senderID' => $this->session->userdata('loginuserID')
			);
			//var_dump($array);die;
			$this->mailandsms_m->insert_mailandsms($array);
			$this->session->set_flashdata('success', "SMS send successfully");
		}
    }
    private function userConfigSMS($message, $user, $usertypeID, $getway, $schoolyearID = 1)
	{
		if ($user && $usertypeID) {
			$userTags = $this->mailandsmstemplatetag_m->get_order_by_mailandsmstemplatetag(array('usertypeID' => $usertypeID));

			if ($usertypeID == 2) {
				$userTags = $this->mailandsmstemplatetag_m->get_order_by_mailandsmstemplatetag(array('usertypeID' => 2));
			} elseif ($usertypeID == 3) {
				$userTags = $this->mailandsmstemplatetag_m->get_order_by_mailandsmstemplatetag(array('usertypeID' => 3));
			} elseif ($usertypeID == 4) {
				$userTags = $this->mailandsmstemplatetag_m->get_order_by_mailandsmstemplatetag(array('usertypeID' => 4));
			} else {
				$userTags = $this->mailandsmstemplatetag_m->get_order_by_mailandsmstemplatetag(array('usertypeID' => 1));
			}

			$message = $this->tagConvertor($userTags, $user, $message, 'SMS', $schoolyearID);
			if ($user->phone) {
				$send = $this->allgetway_send_message($getway, $user->phone, $message);
				return $send;
			} else {
				$send = array('check' => TRUE);
				return $send;
			}
		}
	}
    private function tagConvertor($userTags, $user, $message, $sendType, $schoolyearID)
	{
		if (customCompute($userTags)) {
			foreach ($userTags as $key => $userTag) {
				if ($userTag->tagname == '[name]') {
					if ($user->name) {
						$message = str_replace('[name]', $user->name, $message);
					} else {
						$message = str_replace('[name]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[designation]') {
					if ($user->designation) {
						$message = str_replace('[designation]', $user->designation, $message);
					} else {
						$message = str_replace('[designation]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[dob]') {
					if ($user->dob) {
						$dob =  date("d M Y", strtotime($user->dob));
						$message = str_replace('[dob]', $dob, $message);
					} else {
						$message = str_replace('[dob]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[gender]') {
					if ($user->sex) {
						$message = str_replace('[gender]', $user->sex, $message);
					} else {
						$message = str_replace('[gender]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[religion]') {
					if ($user->religion) {
						$message = str_replace('[religion]', $user->religion, $message);
					} else {
						$message = str_replace('[religion]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[email]') {
					if ($user->email) {
						$message = str_replace('[email]', $user->email, $message);
					} else {
						$message = str_replace('[email]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[phone]') {
					if ($user->phone) {
						$message = str_replace('[phone]', $user->phone, $message);
					} else {
						$message = str_replace('[phone]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[address]') {
					if ($user->address) {
						$message = str_replace('[address]', $user->address, $message);
					} else {
						$message = str_replace('[address]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[jod]') {
					if ($user->jod) {
						$jod =  date("d M Y", strtotime($user->jod));
						$message = str_replace('[jod]', $jod, $message);
					} else {
						$message = str_replace('[jod]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[username]') {
					if ($user->username) {
						$message = str_replace('[username]', $user->username, $message);
					} else {
						$message = str_replace('[username]', ' ', $message);
					}
				} elseif ($userTag->tagname == "[father's_name]") {
					if ($user->father_name) {
						$message = str_replace("[father's_name]", $user->father_name, $message);
					} else {
						$message = str_replace("[father's_name]", ' ', $message);
					}
				} elseif ($userTag->tagname == "[Parent_Name]") {
					if ($user->father_name) {
						$message = str_replace("[Parent_Name]", $user->father_name, $message);
					} else {
						$message = str_replace("[Parent_Name]", ' ', $message);
					}
				} elseif ($userTag->tagname == "[mother's_name]") {
					if ($user->mother_name) {
						$message = str_replace("[mother's_name]", $user->mother_name, $message);
					} else {
						$message = str_replace("[mother's_name]", ' ', $message);
					}
				} elseif ($userTag->tagname == "[father's_profession]") {
					if ($user->father_profession) {
						$message = str_replace("[father's_profession]", $user->father_profession, $message);
					} else {
						$message = str_replace("[father's_profession]", ' ', $message);
					}
				} elseif ($userTag->tagname == "[mother's_profession]") {
					if ($user->mother_profession) {
						$message = str_replace("[mother's_profession]", $user->mother_profession, $message);
					} else {
						$message = str_replace("[mother's_profession]", ' ', $message);
					}
				} elseif ($userTag->tagname == '[class]') {
					$classes = $this->classes_m->general_get_classes($user->srclassesID);
					if (customCompute($classes)) {
						$message = str_replace('[class]', $classes->classes, $message);
					} else {
						$message = str_replace('[class]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[roll]') {
					if ($user->srroll) {
						$message = str_replace("[roll]", $user->srroll, $message);
					} else {
						$message = str_replace("[roll]", ' ', $message);
					}
				} elseif ($userTag->tagname == '[country]') {
					if ($user->country) {
						if (isset($this->data['allcountry'][$user->country])) {
							$message = str_replace("[country]", $this->data['allcountry'][$user->country], $message);
						} else {
							$message = str_replace("[country]", ' ', $message);
						}
					} else {
						$message = str_replace("[country]", ' ', $message);
					}
				} elseif ($userTag->tagname == '[state]') {
					if ($user->state) {
						$message = str_replace("[state]", $user->state, $message);
					} else {
						$message = str_replace("[state]", ' ', $message);
					}
				} elseif ($userTag->tagname == '[register_no]') {
					if ($user->srregisterNO) {
						$message = str_replace("[register_no]", $user->srregisterNO, $message);
					} else {
						$message = str_replace("[register_no]", ' ', $message);
					}
				} elseif ($userTag->tagname == '[section]') {
					if ($user->srsectionID) {
						$section = $this->section_m->general_get_section($user->srsectionID);
						if (customCompute($section)) {
							$message = str_replace('[section]', $section->section, $message);
						} else {
							$message = str_replace('[section]', ' ', $message);
						}
					} else {
						$message = str_replace("[section]", ' ', $message);
					}
				} elseif ($userTag->tagname == '[blood_group]') {
					if ($user->bloodgroup && $user->bloodgroup != '0') {
						$message = str_replace("[blood_group]", $user->bloodgroup, $message);
					} else {
						$message = str_replace("[blood_group]", ' ', $message);
					}
				} elseif ($userTag->tagname == '[group]') {
					if ($user->srstudentgroupID && $user->srstudentgroupID != 0) {
						$group = $this->studentgroup_m->get_studentgroup($user->srstudentgroupID);
						if (customCompute($group)) {
							$message = str_replace('[group]', $group->group, $message);
						} else {
							$message = str_replace('[group]', ' ', $message);
						}
					} else {
						$message = str_replace('[group]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[optional_subject]') {
					if ($user->sroptionalsubjectID && $user->sroptionalsubjectID != 0) {
						$subject = $this->subject_m->general_get_single_subject(array('subjectID' => $user->sroptionalsubjectID));
						if (customCompute($subject)) {
							$message = str_replace('[optional_subject]', $subject->subject, $message);
						} else {
							$message = str_replace('[optional_subject]', ' ', $message);
						}
					} else {
						$message = str_replace('[optional_subject]', ' ', $message);
					}
				} elseif ($userTag->tagname == '[extra_curricular_activities]') {
					if ($user->extracurricularactivities) {
						$message = str_replace("[extra_curricular_activities]", $user->extracurricularactivities, $message);
					} else {
						$message = str_replace("[extra_curricular_activities]", ' ', $message);
					}
				} elseif ($userTag->tagname == '[remarks]') {
					if ($user->remarks) {
						$message = str_replace("[remarks]", $user->remarks, $message);
					} else {
						$message = str_replace("[remarks]", ' ', $message);
					}
				} elseif ($userTag->tagname == '[date]') {
					$message = str_replace("[date]", (date("d M Y")), $message);
				} elseif ($userTag->tagname == '[result_table]') {
					if ($sendType == 'email') {
						if ($user->usertypeID == 3) {
							$this->load->library('mark', ['studentID' => $user->srstudentID, 'classesID' => $user->srclassesID, 'schoolyearID' => $schoolyearID, 'data' => $this->data['siteinfos']]);
							$result = $this->mark->mail();
						} else {
							$result = '';
						}
						$message = str_replace("[result_table]", $result, $message);
					} elseif ($sendType == 'SMS') {
						if ($user->usertypeID == 3) {
							$this->load->library('mark', ['studentID' => $user->srstudentID, 'classesID' => $user->srclassesID, 'schoolyearID' => $schoolyearID, 'data' => $this->data['siteinfos']]);
							$result = $this->mark->sms();
						} else {
							$result = '';
						}
						$message = str_replace("[result_table]", $result, $message);
					}
				}
			}
		}
		return $message;
	}
    private function allgetway_send_message($getway, $to, $message)
	{
		$result = [];
		//$to = "7208613316";
		if ($getway == "clickatell") {
			if ($to) {
				$this->clickatell->send_message($to, $message);
				$result['check'] = TRUE;
				return $result;
			}
		} elseif ($getway == 'twilio') {
			$get = $this->twilio->get_twilio();
			$from = $get['number'];
			if ($to) {
				$response = $this->twilio->sms($from, $to, $message);
				if ($response->IsError) {
					$result['check'] = FALSE;
					$result['message'] = $response->ErrorMessage;
					return $result;
				} else {
					$result['check'] = TRUE;
					return $result;
				}
			}
		} elseif ($getway == 'bulk') {
			if ($to) {
				if ($this->bulk->send($to, $message) == TRUE) {
					$result['check'] = TRUE;
					return $result;
				} else {
					$result['check'] = FALSE;
					$result['message'] = "Check your bulk account";
					return $result;
				}
			}
		} elseif ($getway == 'msg91') {
			if ($to) {
				if ($this->msg91->send($to, $message) == TRUE) {
					$result['check'] = TRUE;
					return $result;
				} else {
					$result['check'] = FALSE;
					$result['message'] = "Check your msg91 account";
					return $result;
				}
			}
		}
	}
    public function paymentSend() {
        $retArray['status'] = FALSE;
        $retArray['message'] = '';

        if($_POST) {
            $rules = $this->paymentRules();
            $this->form_validation->set_rules($rules);
            if ($this->form_validation->run() == FALSE) {
                $retArray = $this->form_validation->error_array();
                $retArray['status'] = FALSE;
                echo json_encode($retArray);
                exit;
            } else {
                $schoolyearID       = $this->session->userdata('defaultschoolyearID');

                $paids              = $this->input->post('paid');
                $fee_amount_paid =0;
                $total_paid=0;
                $weavers            = $this->input->post('weaver');
                $fines              = $this->input->post('fine');
                
                $studentID          = $this->input->post('studentID');
                $classesID          = $this->input->post('classesID');
                $invoicename        = $this->input->post('invoicename');
                $invoicedescription = $this->input->post('invoicedescription');
                //var_dump($this->input->post('payment_date'));die;
                $rec_no = $this->input->post('rec_no');
                $payment_date = date('Y-m-d',strtotime($this->input->post('payment_date')));
                
                $invoicenumber      = $this->input->post('invoicenumber');
                $paymentyear        = $this->input->post('paymentyear');
                $payment_status     = $this->input->post('payment_status');
                $payment_type       = $this->input->post('payment_type');
                $sectionID          = 0;
                
                $globalpayment['classesID']         = $classesID;
                $globalpayment['studentID']         = $studentID;
                $globalpayment['clearancetype']     = $payment_status;
                $globalpayment['invoicename']       = $invoicename;
                $globalpayment['invoicedescription']= $invoicedescription;
                $globalpayment['rec_no']= $rec_no;
                $globalpayment['global_payment_date']= $payment_date;
                $globalpayment['paymentyear']       = $paymentyear;
                $globalpayment['schoolyearID']      = $schoolyearID;

                if($studentID) {
                    $student = $this->studentrelation_m->get_single_student(array('srstudentID' => $studentID, 'srschoolyearID' => $schoolyearID));
                    if(customCompute($student)) {
                        $sectionID = $student->srsectionID;
                    }
                }

                $globalpayment['sectionID'] = $sectionID;
                $this->globalpayment_m->insert_globalpayment($globalpayment);
                $globalLastID = $this->db->insert_id();

                if($globalLastID) { 
                    $payments = [];
                    $weaverandfines = [];
                    $j = (customCompute($paids) - 1);
                    
                    for($i = 0; $i <= $j; $i++) {
                        $expPaidField = explode('-', $paids[$i]['paidFieldID']);
                        $payments[$i] = array(
                            'schoolyearID' => $schoolyearID,
                            'invoiceID' => $expPaidField[1],                
                            'studentID' => $studentID,                
                            'paymentamount' => ($paids[$i]['value'] == '') ? NULL : $paids[$i]['value'],                
                            'paymenttype' => ucfirst($payment_type),                
                            'paymentdate' => date('Y-m-d'),                
                            'paymentday' => date('d'),                
                            'paymentmonth' => date('m'),                
                            'paymentyear' => date('Y'),
                            'userID' => $this->session->userdata('loginuserID'),
                            'usertypeID' => $this->session->userdata('usertypeID'),
                            'uname' => $this->session->userdata('name'),
                            'transactionID' => 'CASHANDCHEQUE'.random19(),      
                            'globalpaymentID' => $globalLastID,                
                        );
                        $fee_amount_paid+=($paids[$i]['value'] == '') ? 0 : $paids[$i]['value'];
                        if(isset($weavers[$i]['value']) || isset($fines[$i]['value'])) {
                            if($weavers[$i]['value'] > 0 && $fines[$i]['value'] > 0) {
                                $weaverandfines[$i] = array(
                                    'weaver' => $weavers[$i]['value'],
                                    'fine' => $fines[$i]['value'],
                                    'globalpaymentID' => $globalLastID,
                                    'invoiceID' => $expPaidField[1],
                                    'studentID' => $studentID,
                                    'schoolyearID' => $schoolyearID,
                                );
                            } elseif($weavers[$i]['value'] > 0) {
                                $weaverandfines[$i] = array(
                                    'weaver' => $weavers[$i]['value'],
                                    'fine' => 0,
                                    'globalpaymentID' => $globalLastID,
                                    'invoiceID' => $expPaidField[1],
                                    'studentID' => $studentID,
                                    'schoolyearID' => $schoolyearID,
                                );
                            } elseif($fines[$i]['value'] > 0) {
                                $weaverandfines[$i] = array(
                                    'weaver' => 0,
                                    'fine' => $fines[$i]['value'],
                                    'globalpaymentID' => $globalLastID,
                                    'invoiceID' => $expPaidField[1],
                                    'studentID' => $studentID,
                                    'schoolyearID' => $schoolyearID,
                                );
                            }
                        }
                    }

                    $insertPaymentIDS = [];
                    if(customCompute($payments)) {
                        foreach($payments as $payment) {
                            $this->payment_m->insert_payment($payment);
                            $paymentID = $this->db->insert_id();
                            $insertPaymentIDS[$payment['invoiceID']] = $paymentID;
                        }
                        $retArray['status'] = TRUE;
                    }

                    if(customCompute($weaverandfines)) {
                        foreach ($weaverandfines as $weaverandfine) {
                            if(isset($insertPaymentIDS[$weaverandfine['invoiceID']])) {
                                $weaverandfine['paymentID'] = $insertPaymentIDS[$weaverandfine['invoiceID']];
                                $this->weaverandfine_m->insert_weaverandfine($weaverandfine);
                            }
                        }
                        $retArray['status'] = TRUE;
                    }

                    $invoices = $this->invoice_m->get_order_by_invoice(array('studentID' => $studentID, 'schoolyearID' => $schoolyearID, 'deleted_at' => 1));

                    $allPaymentList = $this->payment_m->get_order_by_payment(array('studentID' => $studentID, 'schoolyearID' => $schoolyearID));

                    $allWeaverList = $this->weaverandfine_m->get_order_by_weaverandfine(array('studentID' => $studentID, 'schoolyearID' => $schoolyearID));

                    $payments = $this->generateAllPaymentAmount($allPaymentList);
                    $weavers = $this->generateAllWeaverAmount($allWeaverList);


                    for($i = 0; $i <= $j; $i++) {
                        $expPaidField = explode('-', $paids[$i]['paidFieldID']);
                        if(isset($expPaidField[1]) && isset($invoices[$i]) && customCompute($invoices[$i]) && ($expPaidField[1] == $invoices[$i]->invoiceID)) {
                            $invoiceID = $expPaidField[1];
                            $invoice = $invoices[$i]; 

                            $totalPaymentWeaver = 0;
                            $totalAmount = 0;
                            $status = 0;

                            if(isset($payments[$invoiceID])) {
                                $totalPaymentWeaver += $payments[$invoiceID];
                            }

                            if(isset($weavers[$invoiceID])) {
                                $totalPaymentWeaver += $weavers[$invoiceID];
                            }

                            if($invoice->discount > 0) {
                                $totalAmount = ($invoice->amount - (($invoice->amount/100)*$invoice->discount));
                            } else {
                                $totalAmount = $invoice->amount;
                            }

                            if(number_format($totalAmount, 2, '.', '') == number_format($totalPaymentWeaver, 2, '.', '')) {
                                $status = 2;
                            } elseif((number_format($totalAmount, 2, '.', '') > number_format($totalPaymentWeaver, 2, '.', '')) && (number_format($totalPaymentWeaver, 2, '.', '') != number_format(0, 2, '.', ''))) {
                                $status = 1;
                            }

                            $this->invoice_m->update_invoice(array('paidstatus' => $status), $invoiceID);
                        }
                    }

                    $maininvoices = $this->maininvoice_m->get_order_by_maininvoice(array('maininvoiceschoolyearID' => $schoolyearID, 'maininvoicestudentID' => $studentID, 'maininvoicedeleted_at' => 1));
                    
                    if(customCompute($maininvoices)) {
                        $invoices = $this->invoice_m->get_order_by_invoice(array('studentID' => $studentID, 'schoolyearID' => $schoolyearID, 'deleted_at' => 1));
                        
                        $invoices = pluck_multi_array($invoices, 'obj', 'maininvoiceID');
                        foreach ($maininvoices as $maininvoice) {
                            if(isset($invoices[$maininvoice->maininvoiceID])) {
                                $maininvoicecheckstatus = [];
                                $maininvoicecheckstatusfordueorpar = [];
                                foreach ($invoices[$maininvoice->maininvoiceID] as $invoice) {
                                    if($invoice->paidstatus == 2) {
                                        $maininvoicecheckstatus[] = TRUE; 
                                    } else {
                                        $maininvoicecheckstatus[] = FALSE; 
                                    }

                                    if($invoice->paidstatus == 1) {
                                        $maininvoicecheckstatusfordueorpar[] = TRUE;
                                    } else {
                                        $maininvoicecheckstatusfordueorpar[] = FALSE;
                                    }
                                }


                                if(in_array(FALSE, $maininvoicecheckstatus)) {
                                    if(in_array(TRUE, $maininvoicecheckstatusfordueorpar)) {
                                        $this->maininvoice_m->update_maininvoice(array('maininvoicestatus' => 1), $maininvoice->maininvoiceID);
                                    } else {
                                        $this->maininvoice_m->update_maininvoice(array('maininvoicestatus' => 0), $maininvoice->maininvoiceID);
                                    }
                                } else {
                                    $this->maininvoice_m->update_maininvoice(array('maininvoicestatus' => 2), $maininvoice->maininvoiceID);
                                }
                            }
                            
                            $this->session->set_flashdata('paymentmaininvoiceID',$maininvoice->maininvoiceID);
                            $retArray['maininvoiceID'] = $maininvoice->maininvoiceID;
                            $retArray['globalpaymentID'] = $globalLastID;
                        }
                    }
                }

                $this->session->set_flashdata('paymentGenerateStatus', TRUE);
                $this->session->set_flashdata('paymentGenerateGlobalLastID', $globalLastID);
                //$this->session->set_flashdata('maininvoiceID', $maininvoice->maininvoiceID);
                $this->session->set_flashdata('paymentGenerateLastStudentID', $studentID);
                $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                

                //sms send
                $maininvoice = $this->maininvoice_m->get_maininvoice_with_studentrelation_by_maininvoiceID($maininvoice->maininvoiceID);
                $invoices = $this->invoice_m->get_order_by_invoice(['maininvoiceID' => $maininvoice->maininvoiceID]);
                $grandtotalandpayment = $this->grandtotalandpaidsingle($maininvoice, $schoolyearID, $maininvoice->maininvoicestudentID);

                $payment_date = date('d-m-Y',strtotime($this->input->post('payment_date')));

                $subtotal = 0;
                $totalsubtotal = 0;
                foreach ($invoices as $invoice) {
                    $discount = 0;
                    if ($invoice->discount > 0) {
                        $discount = (($invoice->amount / 100) * $invoice->discount);
                    }
                    $subtotal = ($invoice->amount - $discount);
                    $totalsubtotal += $subtotal;
                }

                $totalPayment = $grandtotalandpayment['totalpayment'];
                $totalFeeAmount = $totalsubtotal;

                $this->send_fee_msg($studentID,$schoolyearID,$fee_amount_paid,$payment_date,$totalFeeAmount,$totalPayment,$totalFeeAmount-$totalPayment);
                echo json_encode($retArray);
                exit;
            }
        } else {
            $retArray['message'] = 'Something wrong';
            echo json_encode($retArray);
            exit;
        }
    }
    private function grandtotalandpaidsingle( $maininvoice, $schoolyearID, $studentID = NULL )
    {
        $retArray = [
            'grandtotal'    => 0,
            'totalamount'   => 0,
            'totaldiscount' => 0,
            'totalpayment'  => 0,
            'totalfine'     => 0,
            'totalweaver'   => 0,
            'payment_mode'=>'',
            'all_globalpaymentID'   => []
        ];
        if(customCompute($maininvoice)) {
            if((int)$studentID && $studentID != NULL) {
                $invoiceitems       = pluck_multi_array_key($this->invoice_m->get_order_by_invoice([
                    'studentID'     => $studentID,
                    'maininvoiceID' => $maininvoice->maininvoiceID,
                    
                ]), 'obj', 'maininvoiceID', 'invoiceID');
                $paymentitems       = pluck_multi_array($this->payment_m->get_where_by_payment([
                    
                    'paymentamount !=' => NULL
                ]), 'obj', 'invoiceID');
                $weaverandfineitems = pluck_multi_array($this->weaverandfine_m->get_order_by_weaverandfine(['schoolyearID' => $schoolyearID]), 'obj', 'invoiceID');
            } else {
                $invoiceitem        = [];
                $paymentitems       = [];
                $weaverandfineitems = [];
            }
            
            if(isset($invoiceitems[$maininvoice->maininvoiceID])) {
                if(customCompute($invoiceitems[$maininvoice->maininvoiceID])) {
                    foreach($invoiceitems[$maininvoice->maininvoiceID] as $invoiceitem) {
                        $amount = $invoiceitem->amount;
                        if($invoiceitem->discount > 0) {
                            $amount = ($invoiceitem->amount - (($invoiceitem->amount / 100) * $invoiceitem->discount));
                        }

                        if(isset($retArray['grandtotal'])) {
                            $retArray['grandtotal'] = ($retArray['grandtotal'] + $amount);
                        } else {
                            $retArray['grandtotal'] = $amount;
                        }

                        if(isset($retArray['totalamount'])) {
                            $retArray['totalamount'] = ($retArray['totalamount'] + $invoiceitem->amount);
                        } else {
                            $retArray['totalamount'] = $invoiceitem->amount;
                        }

                        if(isset($retArray['totaldiscount'])) {
                            $retArray['totaldiscount'] = ($retArray['totaldiscount'] + (($invoiceitem->amount / 100) * $invoiceitem->discount));
                        } else {
                            $retArray['totaldiscount'] = (($invoiceitem->amount / 100) * $invoiceitem->discount);
                        }

                        if(isset($paymentitems[$invoiceitem->invoiceID])) {
                            if(customCompute($paymentitems[$invoiceitem->invoiceID])) {
                                foreach($paymentitems[$invoiceitem->invoiceID] as $paymentitem) {
                                    if(isset($retArray['totalpayment'])) {
                                        $retArray['totalpayment'] = ($retArray['totalpayment'] + $paymentitem->paymentamount);
                                    } else {
                                        $retArray['totalpayment'] = $paymentitem->paymentamount;
                                    }
                                    $retArray['all_globalpaymentID'][] = $paymentitem->globalpaymentID;
                                    $retArray['payment_mode'] = $paymentitem->paymenttype;
                                }
                            }
                        }

                        if(isset($weaverandfineitems[$invoiceitem->invoiceID])) {
                            if(customCompute($weaverandfineitems[$invoiceitem->invoiceID])) {
                                foreach($weaverandfineitems[$invoiceitem->invoiceID] as $weaverandfineitem) {
                                    if(isset($retArray['totalweaver'])) {
                                        $retArray['totalweaver'] = ($retArray['totalweaver'] + $weaverandfineitem->weaver);
                                    } else {
                                        $retArray['totalweaver'] = $weaverandfineitem->weaver;
                                    }

                                    if(isset($retArray['totalfine'])) {
                                        $retArray['totalfine'] = ($retArray['totalfine'] + $weaverandfineitem->fine);
                                    } else {
                                        $retArray['totalfine'] = $weaverandfineitem->fine;
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $retArray;
    }
}

