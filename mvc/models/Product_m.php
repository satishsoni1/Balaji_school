<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_m extends MY_Model {

    protected $_table_name = 'product';
    protected $_primary_key = 'productID';
    protected $_primary_filter = 'intval';
    protected $_order_by = "productID asc";

    function __construct() {
        parent::__construct();
    }

    function get_product($array=NULL, $signal=FALSE) {
        $query = parent::get($array, $signal);
        return $query;
    }

    function get_single_product($array) {
        $query = parent::get_single($array);
        return $query;
    }

    function get_order_by_product($array=NULL) {
        $query = parent::get_order_by($array);
        return $query;
    }

    function insert_product($array) {
        $id = parent::insert($array);
        return $id;
    }

    function update_product($data, $id = NULL) {
        parent::update($data, $id);
        return $id;
    }

    public function delete_product($id){
        parent::delete($id);
    }
    public function get_product_stock($id){
        $this->db->select('productcategoryname,productname,sum(ifnull(productsaleitem.productsalequantity,0)) as sales_qty,sum(ifnull(productpurchaseitem.productpurchasequantity,0)) as purchase_qty,(sum(ifnull(productpurchaseitem.productpurchasequantity,0))-sum(ifnull(productsaleitem.productsalequantity,0))) as stock');
        $this->db->from('product');
        $this->db->join('productcategory','productcategory.productcategoryID=product.productcategoryID');
        $this->db->join('productsaleitem','productsaleitem.productID=product.productID','left');
        $this->db->join('productpurchaseitem','productpurchaseitem.productID=product.productID','left');
        $this->db->where('product.productID',$id);
        //$this->db->group_by('product.productID');
        $query = $this->db->get();
        return $query->row();
    }
}
