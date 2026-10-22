<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Term_attendance extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("classes_m");
        $this->load->model("section_m");
        $this->load->model("studentrelation_m");
        $this->load->model("term_attendance_m");
        $language = $this->session->userdata('lang');
        $this->lang->load('student', $language); // Reusing student lang for UI labels
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

        $this->data['classes'] = $this->classes_m->get_classes();
        $this->data['set_classesID'] = 0;
        $this->data['set_sectionID'] = 0;
        $this->data['students'] = [];
        $this->data['existing_attendance'] = [];

        // Check if class and section are selected via POST
        if($_POST && $this->input->post('classesID') && $this->input->post('sectionID') && !$this->input->post('save_attendance')) {
            $classesID = $this->input->post('classesID');
            $sectionID = $this->input->post('sectionID');
            $schoolyearID = $this->session->userdata('defaultschoolyearID');

            $this->data['set_classesID'] = $classesID;
            $this->data['set_sectionID'] = $sectionID;
            $this->data['sections'] = $this->section_m->general_get_order_by_section(array('classesID' => $classesID));

            // Fetch Students
            $this->data['students'] = $this->studentrelation_m->get_order_by_student(array(
                'srclassesID' => $classesID, 
                'srsectionID' => $sectionID, 
                'srschoolyearID' => $schoolyearID,
                'sris_active' => 1
            ));

            // Fetch existing attendance records to prepopulate the form
            $db_attendance = $this->term_attendance_m->get_order_by_term_attendance(array(
                'classesID' => $classesID,
                'sectionID' => $sectionID,
                'schoolyearID' => $schoolyearID
            ));

            $attendance_map = [];
            foreach($db_attendance as $att) {
                $attendance_map[$att->studentID] = $att;
            }
            $this->data['existing_attendance'] = $attendance_map;
        }

        $this->data["subview"] = "term_attendance/index";
        $this->load->view('_layout_main', $this->data);
    }

    public function save() {
        if($_POST && $this->input->post('save_attendance')) {
            $schoolyearID = $this->session->userdata('defaultschoolyearID');
            $classesID = $this->input->post('classesID');
            $sectionID = $this->input->post('sectionID');
            
            // Global Days for the terms
            $term1_total_days = $this->input->post('term1_total_days');
            $term2_total_days = $this->input->post('term2_total_days');

            // Arrays from the table
            $studentIDs = $this->input->post('studentID');
            $term1_present = $this->input->post('term1_present');
            $term2_present = $this->input->post('term2_present');

            if(customCompute($studentIDs)) {
                foreach ($studentIDs as $key => $studentID) {
                    
                    // Check if record exists
                    $check = $this->term_attendance_m->get_single_term_attendance(array(
                        'schoolyearID' => $schoolyearID,
                        'classesID' => $classesID,
                        'sectionID' => $sectionID,
                        'studentID' => $studentID
                    ));

                    $dataArray = array(
                        'schoolyearID' => $schoolyearID,
                        'classesID' => $classesID,
                        'sectionID' => $sectionID,
                        'studentID' => $studentID,
                        'term1_total_days' => $term1_total_days,
                        'term1_present_days' => isset($term1_present[$key]) ? $term1_present[$key] : 0,
                        'term2_total_days' => $term2_total_days,
                        'term2_present_days' => isset($term2_present[$key]) ? $term2_present[$key] : 0,
                    );

                    if(customCompute($check)) {
                        // Update existing
                        $this->term_attendance_m->update_term_attendance($dataArray, $check->term_attendanceID);
                    } else {
                        // Insert new
                        $this->term_attendance_m->insert_term_attendance($dataArray);
                    }
                }
                $this->session->set_flashdata('success', 'Attendance Saved Successfully');
            }
        }
        redirect(base_url("term_attendance/index"));
    }

    public function sectioncall() {
        $classesID = $this->input->post('id');
        if((int)$classesID) {
            $allsection = $this->section_m->general_get_order_by_section(array('classesID' => $classesID));
            echo "<option value='0'>Select Section</option>";
            foreach ($allsection as $value) {
                echo "<option value=\"$value->sectionID\">",$value->section,"</option>";
            }
        }
    }
}