<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bankaccount_m extends MY_Model {

    protected $_table_name = 'bankaccount';
    protected $_primary_key = 'bankaccountID';
    protected $_primary_filter = 'intval';
    protected $_order_by = "bankaccountID asc";

    function __construct() {
        parent::__construct();
    }

    function get_bankaccount($array=NULL, $signal=FALSE) {
        $query = parent::get_order_by($array, $signal);
        return $query;
    }

    function get_single_bankaccount($array) {
        $query = parent::get_single($array);
        return $query;
    }

    function get_order_by_bankaccount($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function insert_bankaccount($array) {
        $id = parent::insert($array);
        return $id;
    }

    function update_bankaccount($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    public function delete_bankaccount($id){
        parent::delete($id);
    }
}
