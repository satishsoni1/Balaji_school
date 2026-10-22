<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class saletemplate_m extends MY_Model {

	protected $_table_name = 'sales_template';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = "id desc";

	function __construct() {
		parent::__construct();
	}

	function get_saletemplate($array=NULL, $signal=FALSE) {
		$query = parent::get($array, $signal);
		return $query;
	}
	function get_saletemplatebooks($templateID) {
		$this->db->select('*');
		$this->db->from('sale_template_product');
		$this->db->join('product', 'product.productID = sale_template_product.product_id');
		$this->db->where('template_id', $templateID);
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_order_by_saletemplate($array=NULL) {
		$query = parent::get_order_by($array);
		return $query;
	}

	function get_single_saletemplate($array=NULL) {
		$query = parent::get_single($array);
		return $query;
	}

	function get_saletemplate_for_overtime()
	{
		$this->db->select('*');
		$this->db->from('saletemplate');
		$this->db->where('saletemplateID!=', 3);
		$this->db->where('saletemplateID!=', 4);
		$query = $this->db->get();
		return $query->result();
	}

	function insert_saletemplate($array) {
		$error = parent::insert($array);
		return TRUE;
	}

	function update_saletemplate($data, $id = NULL) {
		parent::update($data, $id);
		return $id;
	}

	public function delete_saletemplate($id){
		parent::delete($id);
	}

	public function get_saletemplate_by_permission($featureName, $systemadminID = 0) {
		$this->db->select('*');
		$this->db->from('permission_relationships');
		$this->db->join('permissions', 'permissions.permissionID = permission_relationships.permission_id', 'LEFT');
		$this->db->join('saletemplate', 'saletemplate.saletemplateID = permission_relationships.saletemplate_id', 'LEFT');
		$this->db->where(array('permissions.name' => $featureName));
		$query = $this->db->get();

		if($systemadminID == 0) {
			return $query->result();
		} else {
			$datas = $query->result();

			$retArray = [];
			if(customCompute($datas)) {
				$this->db->where($this->_primary_key, 1);
				$systemadminQuery = $this->db->get($this->_table_name);
				$systemadmin = $systemadminQuery->row();
				
				if(customCompute($systemadmin)) {
					$retArray[] = (object) array(
						'saletemplateID' => $systemadmin->saletemplateID,
						'saletemplate' => $systemadmin->saletemplate,
					);
				}	

				foreach ($datas as $dataKey => $data) {
					$retArray[] = (object)$data;
				}
				return $retArray;
			} else {
				$this->db->where($this->_primary_key, 1);
				$systemadminQuery = $this->db->get($this->_table_name);
				$systemadmin = $systemadminQuery->row();
				
				if(customCompute($systemadmin)) {
					$retArray[] = (object) array(
						'saletemplateID' => $systemadmin->saletemplateID,
						'saletemplate' => $systemadmin->saletemplate,
					);
				}
				return $retArray;				
			}
		}
	}
}