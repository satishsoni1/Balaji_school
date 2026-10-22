<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class markattendance_m extends MY_Model {

    protected $_table_name = 'mark_attendance_student';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id asc";

    function __construct() {
        parent::__construct();
    }

    function change_order($column, $sort) {
        $this->_order_by    = $column.' '.$sort;
    }

    function get_markattendance($array=NULL, $signal=FALSE) {
        $this->db->where($array);
        $this->db->from($this->_table_name);
        $query = $this->db->get();
        return $query->result();
    }

    function insert_markattendance($array) {
        $error = parent::insert($array);
        return TRUE;
    }


    public function delete_markattenance($array){
        $this->db->where($array);
        $this->db->delete($this->_table_name);
    }
}

/* End of file markrelation_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/markrelation_m.php */
