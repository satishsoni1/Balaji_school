<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bankaccountconf_m extends MY_Model {

    protected $_table_name = 'bank_account_conf';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id asc";

    function __construct() {
        parent::__construct();
    }

    function get_bankaccountconf($array=NULL, $signal=FALSE) {
        $query = parent::get_order_by($array, $signal);
        return $query;
    }
    function insert_bankaccountconf($array) {
        $id = parent::insert($array);
        return $id;
    }
    function update_bankaccountconf($data, $array = NULL) {
        parent::update_where($data, $array);
        return $id;
    }

}