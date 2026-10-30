<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

class Sendbulksms extends Api_Controller
{

    public function __construct()
    {
        
        parent::customconstruct();
        $this->load->model('mailandsms_m');
        $this->load->model('studentrelation_m');
        $this->load->model('mailandsmstemplatetag_m');
        $this->load->library("clickatell");
        error_log("testrun");
    }

    public function index_get()
    {
        $countusers = '';
		$retval = 1;
        $usertypeID = 3;
        $getway = "clickatell";
        $message = "Dear [name] , on behalf of Shri Balaji Yuvak Krida Mandal, we wish you a very Happy Birthday. May God bless you with good health, happiness and prosperity. This greeting is being sent as part of our member communication.

Regards,
Shri Balaji Yuvak Krida Mandal";
        // Skip if birthday SMS were already sent today (cron re-run)
        $alreadySent = $this->db->where('type', 'sms')
            ->where('message', $message)
            ->where('DATE(create_date)', date('Y-m-d'))
            ->count_all_results('mailandsms');
        if ($alreadySent) {
            $this->response([
                'status'    => true,
                'message'   => 'Already sent today'
            ], REST_Controller::HTTP_OK);
        }

        $multiSchoolYearStudents = $this->studentrelation_m->general_get_student_birthday(TRUE);
        //var_dump($multiSchoolYearStudents);die;
        if (customCompute($multiSchoolYearStudents)) {
            $sentStudentIDs = [];
            foreach ($multiSchoolYearStudents as $key => $multiSchoolYearStudent) {
                // studentrelation has one row per school year, so send only once per student
                if (isset($sentStudentIDs[$multiSchoolYearStudent->srstudentID])) {
                    continue;
                }
                $sentStudentIDs[$multiSchoolYearStudent->srstudentID] = TRUE;

                $status = $this->userConfigSMS($message, $multiSchoolYearStudent, $usertypeID, $getway, $multiSchoolYearStudent->srschoolyearID);
                $countusers .= $multiSchoolYearStudent->srname . ' ,';
                if ($status['check'] == FALSE) {
                    $retval = 0;
                    $retmess = $status['message'];
                    break;
                }
            }
            if ($retval == 1) {
                $array = array(
                    'usertypeID' => $usertypeID,
                    'users' => $countusers,
                    'type' => 'sms',
                    'message' => $message,
                    'year' => date('Y'),
                    'senderusertypeID' => 1,
                    'senderID' => 1
                );
                $this->mailandsms_m->insert_mailandsms($array);
                $this->response([
                    'status'    => true,
                    'message'   => 'Success'
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status'    => false,
                    'message'   => 'Error'
                ], REST_Controller::HTTP_OK);
            }
        } else {
            $this->response([
                'status'    => false,
                'message'   => 'Error',
            ], REST_Controller::HTTP_OK);
        }
        $this->response([
            'status'    => true,
            'message'   => 'Success'
        ], REST_Controller::HTTP_OK);
    }
    private function userConfigSMS($message, $user, $usertypeID, $getway, $schoolyearID = 1) {
        
		if($user && $usertypeID) {
			$userTags = $this->mailandsmstemplatetag_m->get_order_by_mailandsmstemplatetag(array('usertypeID' => 3));
			
            
			$message = $this->tagConvertor($userTags, $user, $message, 'SMS', $schoolyearID);
            
			if($user->phone) {
				$send = $this->allgetway_send_message($getway, $user->phone, $message);
				return $send;
			} else {
				$send = array('check' => TRUE);
				return $send;
			}
		}
	}

	private function tagConvertor($userTags, $user, $message, $sendType, $schoolyearID) {
        
		if(customCompute($userTags)) {
			foreach ($userTags as $key => $userTag) {
					if($user->name) {
						$message = str_replace('[name]', $user->name, $message);
					} else {
						$message = str_replace('[name]', ' ', $message);
					} 
				}
                
			}
		return $message;
	}
    private function allgetway_send_message($getway, $to, $message) {
		$result = [];
			if($to) {
				$this->clickatell->send_message($to, $message);
				$result['check'] = TRUE;
				return $result;
			}
	}
}
