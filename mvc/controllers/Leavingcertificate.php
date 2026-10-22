<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Leavingcertificate extends Admin_Controller {
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
		//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); 
		parent::__construct();
		$this->load->model('section_m');
		$this->load->model("classes_m");
		$this->load->model("invoice_m");
		$this->load->model("payment_m");
		
		$this->load->model("certificate_template_m");
		$this->load->model("schoolyear_m");
		$this->load->model("studentrelation_m");
		$this->load->model("studentgroup_m");
		$this->load->model("parents_m");
		$this->load->model("student_m");
		$this->load->model("subject_m");
		$this->load->model("mailandsmstemplatetag_m");
		$this->load->model("bonafiedcertificate_m");
		$this->load->model("leavingcertificate_m");
		
		
		$language = $this->session->userdata('lang');
		$this->lang->load('certificatereport', $language);
		
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

		$this->data['classes']   = $this->classes_m->general_get_classes();
		$this->data['templates'] = $this->certificate_template_m->get_certificate_template();
		$this->data["subview"] = "leavingcertificate/CertificateReportView";
		$this->load->view('_layout_main', $this->data);
	}

	protected function rules() {
		$rules = array(
			array(
				'field' => 'classesID',
				'label' => $this->lang->line('certificatereport_classname'),
				'rules' => 'trim|required|xss_clean|callback_unique_data'
			),
			array(
				'field' => 'sectionID',
				'label' => $this->lang->line('certificatereport_sectionname'),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'templateID',
				'label' => $this->lang->line('certificatereport_templatename'),
				'rules' => 'trim|required|xss_clean|callback_unique_data'
			)
		);

		return $rules;
	}
	protected function rules_certificate() {
		$rules = array(
			array(
				'field' => 'lc_no',
				'label' => $this->lang->line('lc_no'),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'progress',
				'label' => $this->lang->line('progress'),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'conduct',
				'label' => $this->lang->line('conduct'),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'date_of_leaving_school',
				'label' => $this->lang->line('date_of_leaving_school'),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'reason_of_leaving',
				'label' => $this->lang->line('reason_of_leaving'),
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'remarks',
				'label' => $this->lang->line('remarks'),
				'rules' => 'trim|required|xss_clean'
			)
		);

		return $rules;
	}
	public function getStudentInfo() {
		$retArray['status'] = FALSE;
		$retArray['render'] = '';

		if(permissionChecker('certificatereport')) {
			if($_POST) {
					$id = $this->input->post("id");
					//$arr['schoolyearID'] = 5;
					$arr["studentID"]    = $this->input->post('id'); 
					$getDueFees = $this->invoice_m->get_all_balancefees_for_report_for_all_year($arr);
					$totalfee = $this->totalAmountAndDiscustomCompute($getDueFees);
					$totalPayment = $this->totalPaymentAndWeaver($this->payment_m->get_order_by_payment($arr));
					$Balance = 0;
					$Balance = $totalfee - $totalPayment;
					
					$retArray['due'] = $Balance;
					$retArray['status'] = TRUE;
					echo json_encode($retArray);
				    exit;
				} else {
					echo json_encode($retArray);
					exit;
				}			
		} else {
			echo json_encode($retArray);
			exit;
		}
	}
	private function totalAmountAndDiscustomCompute($arrays) {
		$totalAmountAndDiscount = 0;
		if(customCompute($arrays)) {
			foreach($arrays as $key => $array) {
				$totalAmountAndDiscount += $array->amount;
			}
		}
		return $totalAmountAndDiscount;
	}
	private function totalPaymentAndWeaver($arrays) {
		$totalPayment = 0;
		if(customCompute($arrays)) {
			foreach($arrays as $key => $array) {
				$totalPayment += $array->paymentamount;
			}
		}
		return $totalPayment;
	}
	public function generate_tc() {
		$retArray['status'] = FALSE;
		$retArray['render'] = '';

		if(permissionChecker('certificatereport')) {
			if($_POST) {
				$rules = $this->rules_certificate();
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run() == FALSE) {
					$retArray = $this->form_validation->error_array();
					$retArray['status'] = FALSE;
				    echo json_encode($retArray);
				    exit;
				} else {	
					$arr['lc_no'] = $this->input->post('lc_no');	
					$arr['progress'] = $this->input->post('progress');	
					$arr['conduct'] = $this->input->post('conduct');	
					$arr['date_of_leaving_school'] = $this->input->post('date_of_leaving_school');	
					$arr['standred_in_which_admission'] = $this->input->post('standred_in_which_admission');	
					$arr['date_of_admission'] = $this->input->post('date_of_admission');	
					$arr['standred_in_which_studing'] = $this->input->post('standred_in_which_studing');	
					$arr['since_when'] = $this->input->post('since_when');	
					$arr['reason_of_leaving'] = $this->input->post('reason_of_leaving');	
					$arr['certificate_remarks'] = $this->input->post('remarks');	
					$arr['schoolyearID'] = $this->session->userdata('defaultschoolyearID');	
					$arr['studentID'] = $this->input->post('studentID');	
					$arr['created_at'] = date('Y-m-d');	
					$arr['updated_at'] = date('Y-m-d');	
					
					$this->leavingcertificate_m->insert($arr);
					$student = $this->student_m->get_student($this->input->post('studentID'));
					$array = array();
					$array["active"] = 0;
					$this->student_m->update_student($array,$this->input->post('studentID'));
					$arrayStudentRelation = array(
						'sris_active' => 0
					);
					$this->studentrelation_m->update_studentrelation_with_multicondition($arrayStudentRelation, array('srstudentID' => $this->input->post('studentID')));
					$retArray['tc'] = base_url('leavingcertificate/generate_certificate/' . $student->studentID . '/' . $student->usertypeID . '/2/' . $student->classesID);
					$retArray['status'] = TRUE;
					echo json_encode($retArray);
				    exit;
				}
			}
		} else {
			echo json_encode($retArray);
			exit;
		}
	}
	public function unique_data($data) {
		if($data === "0") {
			$this->form_validation->set_message('unique_data', 'The %s field is required.');
			return FALSE;
		}
		return TRUE;
	}

	public function getStudentList() {
		$retArray['status'] = FALSE;
		$retArray['render'] = '';

		if(permissionChecker('certificatereport')) {
			if($_POST) {
				$rules = $this->rules();
				$this->form_validation->set_rules($rules);
				if($this->form_validation->run() == FALSE) {
					$retArray = $this->form_validation->error_array();
					$retArray['status'] = FALSE;
				    echo json_encode($retArray);
				    exit;
				} else {		
					$classID 		= $this->input->post('classesID');
					$sectionID 		= $this->input->post('sectionID');
					$templateID 	= $this->input->post('templateID');
					$schoolyearID 	= $this->session->userdata('defaultschoolyearID');
					
					$sections = pluck($this->section_m->general_get_section(), 'section', 'sectionID');
					$classes = pluck($this->classes_m->general_get_classes(), 'classes', 'classesID');

					$studentArray = [];
					$studentArray['srschoolyearID'] = $schoolyearID;
					if($classID > 0) {
						$studentArray['srclassesID'] = $classID;
					} 
					
					if($sectionID > 0) {
						$studentArray['srsectionID'] = $sectionID;
					}

					$students = $this->studentrelation_m->general_get_order_by_student($studentArray);
					$studentstc = $this->studentrelation_m->general_get_order_by_student_for_tc($studentArray);
					$this->data['students']		= $students;
					$this->data['studentstc']		= $studentstc;
					
					$this->data['classes'] 		= $classes;
					$this->data['sections'] 	= $sections;
					$this->data['classesID']	= $classID;
					$this->data['sectionID']	= $sectionID;
					$this->data['templateID'] 	= $templateID;
					$retArray['render'] = $this->load->view('leavingcertificate/CertificateReport', $this->data, true);
					$retArray['status'] = TRUE;
					echo json_encode($retArray);
				    exit;
				}
			}
		} else {
			echo json_encode($retArray);
			exit;
		}
	}

	public function generate_certificate() {
		$this->data['headerassets'] = array(
            'js' => array(
                'assets/CircleType/dist/circletype.min.js'
            )
        );

		$tagArray = array();
		$this->data['themeArray'] = array(
            '1' => 'theme1',
            '2' => 'theme2'
        );

		$userID 		= htmlentities(escapeString($this->uri->segment(3)));
		$usertypeID 	= htmlentities(escapeString($this->uri->segment(4)));
		$templateID 	= htmlentities(escapeString($this->uri->segment(5)));
		$classID 		= htmlentities(escapeString($this->uri->segment(6)));
		$schoolyearID 	= $this->session->userdata('defaultschoolyearID');

		if(permissionChecker('certificatereport')) {
			if((int)$userID && (int)$usertypeID && (int)$templateID && (int)$schoolyearID && (int)$classID) {
				$student = $this->studentrelation_m->general_get_single_student_for_tc(array('srstudentID' => $userID, 'srschoolyearID' => $schoolyearID), TRUE);

				$usertype = $this->usertype_m->get_single_usertype(array('usertypeID' => $usertypeID));
				$template = $this->certificate_template_m->get_single_certificate_template(array('certificate_templateID' => $templateID));
				$schoolyear = $this->schoolyear_m->get_single_schoolyear(array('schoolyearID' => $schoolyearID));


				if(customCompute($student) && customCompute($usertype) && customCompute($template) && customCompute($schoolyear)) {
					$this->data['certificate_template'] = $template;
					$tagClasses = $this->classes_m->general_get_single_classes(array('classesID' => $student->srclassesID));
					$tagSection = $this->section_m->general_get_single_section(array('sectionID' => $student->srsectionID));
					$tagGroup   = $this->studentgroup_m->get_single_studentgroup(array('studentgroupID' => $student->srstudentgroupID));
					$tagSubject = $this->subject_m->general_get_single_subject(array('subjectID' => $student->sroptionalsubjectID));


					$country = $this->getAllCountry();


					$tagArray['[name]'] 		= $student->srname;
					$tagArray['[dob]'] 			= isset($student->dob) ? date("d M Y", strtotime($student->dob)) : '';
					$tagArray['[gender]'] 		= $student->sex;
					$tagArray['[blood_group]'] 	= $student->bloodgroup;
					$tagArray['[religion]'] 	= $student->religion;
					$tagArray['[email]'] 		= $student->email;
					$tagArray['[phone]'] 		= $student->phone;
					$tagArray['[address]']  	= $student->address;
					$tagArray['[state]'] 		= $student->state;
					$tagArray['[country]'] 		= isset($country[$student->country]) ? $country[$student->country] : '';
					$tagArray['[class]'] 		= customCompute($tagClasses) ? $tagClasses->classes : '';
					$tagArray['[section]'] 		= customCompute($tagSection) ? $tagSection->section : '';
					$tagArray['[group]'] 		= customCompute($tagGroup) ? $tagGroup->group : '';
					$tagArray['[optional_subject]'] = customCompute($tagSubject) ? $tagSubject->subject : '';
					$tagArray['[register_no]'] 	= $student->srregisterNO;
					$tagArray['[roll]']	 		= $student->srroll;
					$tagArray['[extra_curricular_activities]'] 	= $student->extracurricularactivities;
					$tagArray['[remarks]'] 		= $student->remarks;
					$tagArray['[username]'] 	= $student->username;
					$tagArray['[date]'] 		= date('d M Y');


					$userTags = pluck($this->mailandsmstemplatetag_m->get_order_by_mailandsmstemplatetag(array('usertypeID' => 3)), 'tagname');

					$this->data['template'] = $this->tagConvertForTemplate($userTags, $template->template, 3, $tagArray);

					$this->data['top_heading_title'] = $this->tagConvertForTemplate($userTags, $template->top_heading_title, 3, $tagArray, FALSE);

					$this->data['top_heading_left'] = $this->tagConvertForTemplate($userTags, $template->top_heading_left, 3, $tagArray, FALSE);

					$this->data['top_heading_middle'] = $this->tagConvertForTemplate($userTags, $template->top_heading_middle, 3, $tagArray, FALSE);

					$this->data['top_heading_right'] = $this->tagConvertForTemplate($userTags, $template->top_heading_right, 3, $tagArray, FALSE);

					$this->data['main_middle_text'] = $this->tagConvertForTemplate($userTags, $template->main_middle_text, 3, $tagArray, FALSE);

					$this->data['footer_left_text'] = $this->tagConvertForTemplate($userTags, $template->footer_left_text, 3, $tagArray, FALSE);

					$this->data['footer_middle_text'] = $this->tagConvertForTemplate($userTags, $template->footer_middle_text, 3, $tagArray, FALSE);

					$this->data['footer_right_text'] = $this->tagConvertForTemplate($userTags, $template->footer_right_text, 3, $tagArray, FALSE);

					$this->data['theme'] = $this->data['themeArray'][$template->theme];
					$this->data['student'] = $student;
					if(customCompute($student)) {
						$this->data['parents'] = $this->parents_m->get_single_parents(array('parentsID' => $student->parentID));
					} else {
						$this->data['parents'] = [];
					}
					$this->data['class'] = $this->classes_m->get_single_classes(array('classesID' => $student->srclassesID));
					$this->data['admission_class'] = $this->classes_m->get_single_classes(array('classesID' => $student->admission_class));
					$this->data['schoolyears'] = $this->schoolyear_m->get_obj_schoolyear($student->schoolyearID);
					if($template->theme==1)
						$this->reportTCPDF('studentleavingmodule.css',$this->data, 'leavingcertificate/CertificateReportLayout');
					else if($template->theme==2){
						$certificate = $this->bonafiedcertificate_m->general_get_single_certificate(array('studentID' => $userID, 'schoolyearID' => $schoolyearID));
						if(isset($certificate->id))
							$this->data['certificate_no'] = $certificate->id;
						else{
							$arrayCertificate = array(
								'studentID' => $userID,
								'schoolyearID' => $schoolyearID,
								'created_at' => date("Y-m-d H:i:s"),
								'updated_at' => date("Y-m-d H:i:s")
							);
							$this->bonafiedcertificate_m->insert_certificate($arrayCertificate);
							$certificate = $this->bonafiedcertificate_m->general_get_single_certificate(array('studentID' => $userID, 'schoolyearID' => $schoolyearID));
							$this->data['certificate_no'] = $certificate->id;
						}
						$this->reportTCPDF('bonafidemodule.css',$this->data, 'leavingcertificate/CertificateReportLayout');
					}
					else
						$this->load->view('leavingcertificate/CertificateReportLayout', $this->data);		
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

	private function tagConvertForTemplate($userTags, $message, $usertypeID=1, $convertArray, $design = TRUE) {
        if($message) {
        	if($usertypeID == 3) {
	            if(customCompute($userTags)) {
	                foreach ($userTags as $key => $userTag) {
	                    if(array_key_exists($userTag, $convertArray)) {
	                        $length = strlen($convertArray[$userTag]);
	                        $width = (20*$length);
	                        if($design) {
	                        	$message = str_replace($userTag, '<span style="width:'.$width.'px;" class="dots widthcss" data-hover="'.$convertArray[$userTag].'"></span>' , $message);
	                        } else {
	                        	$message = str_replace($userTag, $convertArray[$userTag], $message);
	                        }

	                    }
	                }
	            }
        	}
        }
        return $message;
    }

	public function getSection() {
		$id = $this->input->post('id');
		if((int)$id) {
			$allSection = $this->section_m->get_order_by_section(array('classesID' => $id));
			echo "<option value='0'>", $this->lang->line("certificatereport_please_select"),"</option>";
			foreach ($allSection as $value) {
				echo "<option value=\"$value->sectionID\">",$value->section,"</option>";
			}
		}
	}
}
