<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bonafiedcertificate_m extends MY_Model {

	protected $_table_name = 'bonafied_certificate';
	protected $_primary_key = 'id';


	function __construct() {
		parent::__construct();
	}
	private function prefixLoad($array) {
		if(is_array($array)) {
			if(customCompute($array)) {
				foreach ($array as $arkey =>  $ar) {
					unset($array[$arkey]);
						$array['bonafied_certificate.'.$arkey] = $ar;
				}
			}
		}

		return $array;
	}
	public function general_get_single_certificate($arrays = []) {
		$arrays = $this->prefixLoad($arrays);
        $this->db->select('*');
        $this->db->from('bonafied_certificate');

        if(customCompute($arrays)) {
            $this->db->where($arrays);
        }
        $this->db->where('bonafied_certificate.studentID !=', NULL);
        $query = $this->db->get();
        return $query->row();
    }

	
	public function update_certificate_with_multicondition($array, $multiCondition) {
		$this->db->update($this->_table_name, $array, $multiCondition);
	}

	public function get_certificate($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}

	public function get_order_by_certificate($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	public function get_single_certificate($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	public function insert_certificate($array) {
		$error = parent::insert($array);
		return $error;
	}

	public function update_certificate($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_certificate($id){
		parent::delete($id);
	}

    public function get_certificate_studentArray($array=NULL, $key=FALSE) {
        $query = parent::get_where_in($array, $key);
        return $query;
    }
}
