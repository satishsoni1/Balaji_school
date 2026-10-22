<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uniform_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    // -------------------------------------------------------------------------
    // REAL-TIME TRANSFER
    // Call this after every productpurchaseitem INSERT
    // - Checks is_uniform flag on product
    // - Creates uniformcategory if not exists (category_name = productname)
    // - Creates uniformsize if not exists (size_no = productname, rate = sellingprice)
    // - Updates stock = stock + productpurchasequantity
    // -------------------------------------------------------------------------
    public function transfer_purchase_to_uniform($productID, $quantity)
    {
        $now      = date('Y-m-d H:i:s');
        $userID   = $this->session->userdata('userID')   ?? 0;
        $username = $this->session->userdata('username') ?? '';
        $usertype = $this->session->userdata('usertype') ?? '';

        // 1. Fetch product — only proceed if is_uniform = 1
        $product = $this->db
            ->select('productID, productname, productsellingprice')
            ->where('productID', $productID)
            ->where('is_uniform', 1)
            ->get('product')
            ->row();

        if ( ! $product) {
            return FALSE; // Not a uniform product — skip silently
        }

        // 2. Get or create uniformcategory (match by category_name = productname)
        $cat = $this->db
            ->where('category_name', $product->productname)
            ->where('active', 1)
            ->get('uniformcategory')
            ->row();

        if ( ! $cat)
        {
            $this->db->insert('uniformcategory', [
                'uniformcategoryID' => null,
                'category_name'     => $product->productname,
                'active'            => 1,
                'create_date'       => $now,
                'modify_date'       => $now,
                'create_userID'     => $userID,
                'create_username'   => $username,
                'create_usertype'   => $usertype,
            ]);

            $cat_id = $this->db->insert_id();
            log_message('info', "transfer_purchase_to_uniform: uniformcategory created [{$cat_id}] {$product->productname}");
        }
        else
        {
            $cat_id = $cat->uniformcategoryID;
        }

        // 3. Get or create uniformsize (size_no = productname)
        $size = $this->db
            ->where('uniformcategoryID', $cat_id)
            ->where('size_no', $product->productname)
            ->where('active', 1)
            ->get('uniformsize')
            ->row();

        if ( ! $size)
        {
            // First purchase — INSERT with quantity as initial stock
            $this->db->insert('uniformsize', [
                'uniformcategoryID' => $cat_id,
                'size_no'           => $product->productname,
                'rate'              => (float)$product->productsellingprice,
                'stock'             => (float)$quantity,
                'active'            => 1,
                'create_date'       => $now,
                'modify_date'       => $now,
                'create_userID'     => $userID,
                'create_username'   => $username,
                'create_usertype'   => $usertype,
            ]);

            log_message('info', "transfer_purchase_to_uniform: uniformsize created [{$cat_id}] {$product->productname} stock={$quantity}");
        }
        else
        {
            // Already exists — add quantity to existing stock
            $this->db
                ->set('stock', 'stock + ' . (float)$quantity, FALSE)
                ->set('modify_date', $now)
                ->where('uniformsizeID', $size->uniformsizeID)
                ->update('uniformsize');

            log_message('info', "transfer_purchase_to_uniform: stock updated [{$size->uniformsizeID}] {$product->productname} +{$quantity}");
        }

        return TRUE;
    }

}