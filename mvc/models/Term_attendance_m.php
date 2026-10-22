<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Term_attendance_m extends MY_Model {

    protected $_table_name = 'term_attendance';
    protected $_primary_key = 'term_attendanceID';
    protected $_primary_filter = 'intval';
    protected $_order_by = "term_attendanceID asc";

    function __construct() {
        parent::__construct();
    }

    public function get_term_attendance($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    public function get_single_term_attendance($array) {
        $query = parent::get_single($array);
        return $query;
    }

    public function get_order_by_term_attendance($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    public function insert_term_attendance($array) {
        $id = parent::insert($array);
        return $id;
    }

    public function update_term_attendance($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    public function delete_term_attendance($id){
        parent::delete($id);
    }
}