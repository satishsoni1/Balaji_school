<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Productsaletemplate_m extends MY_Model {

    protected $_table_name = 'sale_template_product';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = "id desc";

    function __construct() {
        parent::__construct();
    }

    function get_productsale($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_single_productsale($array) {
        $query = $this->db->select('sales_template.*')
                          ->from('sales_template')
                          ->where('id', $array['template_id']) 
                          ->get();
        return $query->row();
    }
    function get_order_by_productsaleitem($array=NULL) {
        $this->db->select('product.*, sale_template_product.*');
        $this->db->from('sale_template_product');
        $this->db->join('product', 'sale_template_product.product_id = product.productID');
        $this->db->where('sale_template_product.template_id', $array['template_id']);
        $query = $this->db->get();
        return $query->result();
    }
    function get_order_by_productsale($array=NULL) {
         $this->db->select('sales_template.*,group_concat(concat(product.productname," (",product.productsellingprice,")") SEPARATOR "<br/>") as productName,round((sum(product.productsellingprice)-((sum(product.productsellingprice)*sales_template.discount)/100))) as total_price');
        $this->db->from('sales_template');
        $this->db->join('sale_template_product', 'sale_template_product.template_id = sales_template.id');
        $this->db->join('product', 'sale_template_product.product_id = product.productID');
        $this->db->group_by('sales_template.id');
        $this->db->order_by('sales_template.id','DESC');
        $query = $this->db->get();
        return $query->result();
    }

    function insert_productsale($array) {
        $id = parent::insert_batch($array);
        return $id;
    }

    function update_productsale($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }
    function update_template($template_id, $discount) {
        $this->db->where('id', $template_id);
        return $this->db->update('sales_template', ['discount' => $discount]);
    }

    public function delete_productsale($id){
        parent::delete($id);
    }
    public function delete_productsale_by_templeteID($id){
        $this->db->where('template_id', $id);
        $this->db->delete($this->_table_name);
        return true;
    }

    public function get_all_productsale_for_report($queryArray) {

        $schoolyearID = $this->session->userdata('defaultschoolyearID');

        $this->db->select('productsale.*,productsaleitem.*');
        $this->db->from('productsale');
        $this->db->join('productsaleitem', 'productsale.productsaleID = productsaleitem.productsaleID');

        if(isset($queryArray['productsalecustomertypeID']) && $queryArray['productsalecustomertypeID'] != 0) {
            $this->db->where('productsale.productsalecustomertypeID', $queryArray['productsalecustomertypeID']);
        }

        if(isset($queryArray['productsalecustomerID']) && $queryArray['productsalecustomerID'] != 0) {
            $this->db->where('productsale.productsalecustomerID', $queryArray['productsalecustomerID']);
        }

        if(!empty($queryArray['reference_no']) && $queryArray['reference_no'] != '0') {
            $this->db->where('productsale.productsalereferenceno', $queryArray['reference_no']);
        }

        if(isset($queryArray['statusID']) && $queryArray['statusID'] != 0) {
            if($queryArray['statusID'] == '4') {
                $this->db->where('productsale.productsalerefund', 1);
            } else {
                $this->db->where('productsale.productsalestatus', $queryArray['statusID']);
                $this->db->where('productsale.productsalerefund !=', 1);
            }
        } else {
            $this->db->where('productsale.productsalerefund !=', 1);
        }

        if((isset($queryArray['fromdate']) && $queryArray['fromdate'] != 0) && (isset($queryArray['todate']) && $queryArray['todate'] != 0)) {
            $fromdate = date('Y-m-d', strtotime($queryArray['fromdate']));
            $todate = date('Y-m-d', strtotime($queryArray['todate']));
            $this->db->where('productsaledate >=', $fromdate);
            $this->db->where('productsaledate <=', $todate);
        }
        $this->db->where('productsale.schoolyearID',$schoolyearID);
        $this->db->order_by('productsale.productsaleID','DESC');
        $query = $this->db->get();
        return $query->result();
    }
}
