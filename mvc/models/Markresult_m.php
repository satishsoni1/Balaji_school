<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class markresult_m extends MY_Model {

    protected $_table_name = 'markresult';
    protected $_primary_key = 'markresultID';
    protected $_primary_filter = 'intval';
    protected $_order_by = "markresultID asc";

    function __construct() {
        parent::__construct();
    }

    

    function insert_markrelation($array) {

        $error = parent::insert($array);
        return TRUE;
    }

        

    function update_markrelation($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }


    function update_mark_with_condition($array, $id) {
		$this->db->update($this->_table_name, $array, $id);
		return $this->db->affected_rows();
	}

    public function delete_markrelation($id){
        parent::delete($id);
    }
    public function delete_mark_with_condition($array){
        $this->db->where($array);
        $this->db->delete($this->_table_name);
    }

    public function get_all_mark_with_relation($array)
    {
        $this->db->select('*');
        $this->db->from('markresult');
        $this->db->where($array);
        $query = $this->db->get();
        return $query->row();

    }
}

/* End of file markrelation_m.php */
/* Location: .//D/xampp/htdocs/school/mvc/models/markrelation_m.php */
