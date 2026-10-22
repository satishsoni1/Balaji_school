<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Uniformsale_model
 *
 * Handles uniform master data (categories/sizes), saving a uniform sale
 * to a student, listing sales with class/date filters, and date-range
 * reporting.
 *
 * Assumes existing tables: student(studentID, name, roll, registerNO,
 * classesID, sectionID, active), classes(classesID, classes,
 * classes_numeric), section(sectionID, section, classesID).
 */
class Uniformsale_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /* =====================================================
     * MASTER DATA
     * ===================================================== */

    public function get_categories($active_only = TRUE)
    {
        $this->db->from('uniformcategory');
        if ($active_only) {
            $this->db->where('active', 1);
        }
        $this->db->order_by('category_name', 'ASC');
        return $this->db->get()->result();
    }

    public function get_sizes_by_category($uniformcategoryID, $active_only = TRUE)
    {
        $this->db->from('uniformsize');
        $this->db->where('uniformcategoryID', $uniformcategoryID);
        if ($active_only) {
            $this->db->where('active', 1);
        }
        $this->db->order_by('size_no', 'ASC');
        return $this->db->get()->result();
    }

    public function get_size($uniformsizeID)
    {
        return $this->db->get_where('uniformsize', array('uniformsizeID' => $uniformsizeID))->row();
    }

    public function get_classes()
    {
        return $this->db->order_by('classes_numeric', 'ASC')->get('classes')->result();
    }

    public function get_sections($classesID)
    {
        return $this->db->where('classesID', $classesID)
                         ->order_by('section', 'ASC')
                         ->get('section')->result();
    }

    /**
     * Students for the sell-form dropdown, filtered by class
     * (and optionally section). This is the "class filter" requirement.
     */
    public function get_students($classesID, $sectionID = NULL)
    {
        $this->db->select('studentID, name, roll, registerNO, photo');
        $this->db->from('student');
        $this->db->where('classesID', $classesID);
        if (!empty($sectionID)) {
            $this->db->where('sectionID', $sectionID);
        }
        $this->db->where('active', 1);
        $this->db->order_by('roll', 'ASC');
        return $this->db->get()->result();
    }

    /* =====================================================
     * SALE TRANSACTION
     * ===================================================== */

    public function generate_receipt_no()
    {
        $year = date('Y');
        $prefix = 'UNF/' . $year . '/';

        $this->db->select('receipt_no');
        $this->db->from('uniformsale');
        $this->db->like('receipt_no', $prefix, 'after');
        $this->db->order_by('uniformsaleID', 'DESC');
        $this->db->limit(1);
        $row = $this->db->get()->row();

        $next = 1;
        if ($row) {
            $parts = explode('/', $row->receipt_no);
            $next  = ((int) end($parts)) + 1;
        }
        return $prefix . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Saves the sale header + line items inside a transaction.
     * @param array $sale  uniformsale row data
     * @param array $items array of uniformsaledetail row data (without uniformsaleID)
     * @return int|FALSE   inserted uniformsaleID, or FALSE on failure
     */
    public function save_sale($sale, $items)
    {
        $this->db->trans_start();

        $this->db->insert('uniformsale', $sale);
        $uniformsaleID = $this->db->insert_id();

        foreach ($items as $item) {
            $item['uniformsaleID'] = $uniformsaleID;
            $this->db->insert('uniformsaledetail', $item);
        }

        $this->db->trans_complete();

        return ($this->db->trans_status() === FALSE) ? FALSE : $uniformsaleID;
    }

    public function get_sale($uniformsaleID)
    {
        $this->db->select('us.*, st.name as student_name, st.roll, st.registerNO, c.classes, sec.section');
        $this->db->from('uniformsale us');
        $this->db->join('student st', 'st.studentID = us.studentID', 'left');
        $this->db->join('classes c', 'c.classesID = us.classesID', 'left');
        $this->db->join('section sec', 'sec.sectionID = us.sectionID', 'left');
        $this->db->where('us.uniformsaleID', $uniformsaleID);
        return $this->db->get()->row();
    }

    public function get_sale_details($uniformsaleID)
    {
        $this->db->select('usd.*, cat.category_name, sz.size_no');
        $this->db->from('uniformsaledetail usd');
        $this->db->join('uniformcategory cat', 'cat.uniformcategoryID = usd.uniformcategoryID', 'left');
        $this->db->join('uniformsize sz', 'sz.uniformsizeID = usd.uniformsizeID', 'left');
        $this->db->where('usd.uniformsaleID', $uniformsaleID);
        return $this->db->get()->result();
    }

    /**
     * Void a sale instead of hard-deleting it (keeps it out of reports
     * but preserves the audit trail), matching the `active` flag pattern
     * already used on the student table.
     */
    public function cancel_sale($uniformsaleID)
    {
        return $this->db->update(
            'uniformsale',
            array('active' => 0, 'modify_date' => date('Y-m-d H:i:s')),
            array('uniformsaleID' => $uniformsaleID)
        );
    }

    /* =====================================================
     * LISTING (with class filter)
     * ===================================================== */

    public function get_sales_list($filters = array())
    {
        $this->db->select('us.uniformsaleID, us.receipt_no, us.sale_date, us.total_amount, us.active,
                            st.name as student_name, st.roll, c.classes, sec.section');
        $this->db->from('uniformsale us');
        $this->db->join('student st', 'st.studentID = us.studentID', 'left');
        $this->db->join('classes c', 'c.classesID = us.classesID', 'left');
        $this->db->join('section sec', 'sec.sectionID = us.sectionID', 'left');

        if (!empty($filters['classesID'])) {
            $this->db->where('us.classesID', $filters['classesID']);
        }
        if (!empty($filters['sectionID'])) {
            $this->db->where('us.sectionID', $filters['sectionID']);
        }
        if (!empty($filters['date_from'])) {
            $this->db->where('us.sale_date >=', $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $this->db->where('us.sale_date <=', $filters['date_to']);
        }
        if (isset($filters['active'])) {
            $this->db->where('us.active', $filters['active']);
        }

        $this->db->order_by('us.sale_date', 'DESC');
        $this->db->order_by('us.uniformsaleID', 'DESC');

        return $this->db->get()->result();
    }

    /* =====================================================
     * REPORT (date range, optional class filter)
     * ===================================================== */

    public function get_report_totals($date_from, $date_to, $classesID = NULL)
    {
        $this->db->select('COUNT(DISTINCT us.uniformsaleID) as total_bills, SUM(usd.qty) as total_qty, SUM(usd.amount) as total_amount');
        $this->db->from('uniformsale us');
        $this->db->join('uniformsaledetail usd', 'usd.uniformsaleID = us.uniformsaleID');
        $this->db->where('us.active', 1);
        $this->db->where('us.sale_date >=', $date_from);
        $this->db->where('us.sale_date <=', $date_to);
        if (!empty($classesID)) {
            $this->db->where('us.classesID', $classesID);
        }
        return $this->db->get()->row();
    }

    public function get_report_item_summary($date_from, $date_to, $classesID = NULL)
    {
        $this->db->select('cat.category_name, sz.size_no, SUM(usd.qty) as total_qty, SUM(usd.amount) as total_amount');
        $this->db->from('uniformsaledetail usd');
        $this->db->join('uniformsale us', 'us.uniformsaleID = usd.uniformsaleID');
        $this->db->join('uniformcategory cat', 'cat.uniformcategoryID = usd.uniformcategoryID', 'left');
        $this->db->join('uniformsize sz', 'sz.uniformsizeID = usd.uniformsizeID', 'left');
        $this->db->where('us.active', 1);
        $this->db->where('us.sale_date >=', $date_from);
        $this->db->where('us.sale_date <=', $date_to);
        if (!empty($classesID)) {
            $this->db->where('us.classesID', $classesID);
        }
        $this->db->group_by('cat.uniformcategoryID, sz.uniformsizeID');
        $this->db->order_by('cat.category_name', 'ASC');
        $this->db->order_by('sz.size_no', 'ASC');
        return $this->db->get()->result();
    }

    public function get_report_bills($date_from, $date_to, $classesID = NULL)
    {
        return $this->get_sales_list(array(
            'date_from' => $date_from,
            'date_to'   => $date_to,
            'classesID' => $classesID,
            'active'    => 1,
        ));
    }
}
