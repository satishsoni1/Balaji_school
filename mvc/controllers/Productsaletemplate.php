<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Productsaletemplate extends Admin_Controller
{
    /*
    | -----------------------------------------------------
    | PRODUCT NAME: 	INILABS SCHOOL MANAGEMENT SYSTEM
    | -----------------------------------------------------
    | AUTHOR:			INILABS TEAM
    | -----------------------------------------------------
    | EMAIL:			info@inilabs.net
    | -----------------------------------------------------
    | COPYRIGHT:		RESERVED BY INILABS IT
    | -----------------------------------------------------
    | WEBSITE:			http://inilabs.net
    | -----------------------------------------------------
    */

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('usertype_m');
        $this->load->model('classes_m');
        $this->load->model('systemadmin_m');
        $this->load->model('teacher_m');
        $this->load->model('student_m');
        $this->load->model("studentrelation_m");
        $this->load->model('parents_m');
        $this->load->model('user_m');
        $this->load->model("productcategory_m");
        $this->load->model("product_m");
        $this->load->model('productsale_m');
        $this->load->model('productsaletemplate_m');
        $this->load->model("productsaleitem_m");
        $this->load->model("productsalepaid_m");
        $this->load->model("productpurchaseitem_m");
        $this->load->model("saletemplate_m");

        $language = $this->session->userdata('lang');
        $this->lang->load('productsaletemplate', $language);
    }

    public function index()
    {
        $this->data['headerassets'] = array(
            'css' => array(
                'assets/datepicker/datepicker.css',
            ),
            'js' => array(
                'assets/datepicker/datepicker.js',
            )
        );

        $schoolyearID = $this->session->userdata('defaultschoolyearID');
        $this->data['productsales'] = $this->productsaletemplate_m->get_order_by_productsale(array('schoolyearID' => $schoolyearID));
        $this->data["subview"] = "productsaletemplate/index";
        $this->load->view('_layout_main', $this->data);
    }




    public function add()
    {
        if (($this->data['siteinfos']->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1) || ($this->session->userdata('defaultschoolyearID') == 5)) {
            $this->data['headerassets'] = array(
                'css' => array(
                    'assets/datepicker/datepicker.css',
                    'assets/select2/css/select2.css',
                    'assets/select2/css/select2-bootstrap.css'
                ),
                'js' => array(
                    'assets/datepicker/datepicker.js',
                    'assets/select2/select2.js'
                )
            );

            $this->data['usertypes'] = $this->usertype_m->get_usertype();
            $this->data['saletemplates'] = $this->saletemplate_m->get_saletemplate();
            $this->data['classes'] = $this->classes_m->general_get_classes();
            $this->data['productcategorys'] = $this->productcategory_m->get_productcategory();
            $this->data['productobj'] = json_encode(pluck($this->product_m->get_product(), 'obj', 'productID'));

            $this->data['productpurchasequintity'] = json_encode(pluck($this->productpurchaseitem_m->get_productpurchaseitem_quantity(), 'obj', 'productID'));

            $this->data['productsalequintity'] = json_encode(pluck($this->productsaleitem_m->get_productsaleitem_quantity(), 'obj', 'productID'));

            $this->data["subview"] = "productsaletemplate/add";
            $this->load->view('_layout_main', $this->data);
        } else {
            $this->data["subview"] = "error";
            $this->load->view('_layout_main', $this->data);
        }
    }

    public function edit()
    {
        if (($this->data['siteinfos']->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1) || ($this->session->userdata('defaultschoolyearID') == 5)) {
            $this->data['headerassets'] = array(
                'css' => array(
                    'assets/datepicker/datepicker.css',
                    'assets/select2/css/select2.css',
                    'assets/select2/css/select2-bootstrap.css'
                ),
                'js' => array(
                    'assets/datepicker/datepicker.js',
                    'assets/select2/select2.js'
                )
            );
            $id = htmlentities(escapeString($this->uri->segment(3)));
            $schoolyearID = $this->session->userdata('defaultschoolyearID');
            if ((int)$id) {
                $this->data['productsaleID'] = $id;
                $this->data['productsale'] = $this->productsaletemplate_m->get_single_productsale(array('template_id' => $id));
                $this->data['productobj'] = json_encode(pluck($this->product_m->get_product(), 'obj', 'productID'));
                $this->data['productcategorys'] = $this->productcategory_m->get_productcategory();
                $this->data['productpurchasequintity'] = json_encode(pluck($this->productpurchaseitem_m->get_productpurchaseitem_quantity(), 'obj', 'productID'));
                $this->data['productsalequintity'] = json_encode(pluck($this->productsaleitem_m->get_productsaleitem_quantity(), 'obj', 'productID'));
                if (customCompute($this->data['productsale'])) {
                    $this->data['productsalequintityforedit'] = json_encode(pluck($this->productsaleitem_m->get_productsaleitem_quantity($this->data['productsale']->productsaleID), 'obj', 'productID'));
                    $this->data['productsaleitems'] = $this->productsaletemplate_m->get_order_by_productsaleitem(array('template_id' => $id));
                }

                $this->data["subview"] = "productsaletemplate/edit";
                $this->load->view('_layout_main', $this->data);
            } else {
                $this->data["subview"] = "error";
                $this->load->view('_layout_main', $this->data);
            }
        } else {
            $this->data["subview"] = "error";
            $this->load->view('_layout_main', $this->data);
        }
    }
    public function totalvalue($productsaleitems)
    {
        $totalSubtotal = 0;
        foreach ($productsaleitems as $productsaleitem) {

            $subtotal = ($productsaleitem->productsaleunitprice * $productsaleitem->productsalequantity);
            $totalSubtotal += $subtotal;
        }
        return $totalSubtotal;
    }
    public function getuserlistbyrole($usertypeID, $classesID = 0, $obj = FALSE)
    {
        $userArray = [];
        $schoolyearID = $this->session->userdata('defaultschoolyearID');

        if ($usertypeID == 1) {
            $systemadmins = $this->systemadmin_m->get_systemadmin();
            if ($obj == FALSE) {
                $userArray = array(0 => $this->lang->line("productsale_select_user"));
                if (customCompute($systemadmins)) {
                    foreach ($systemadmins as $systemadmin) {
                        $userArray[$systemadmin->systemadminID] = $systemadmin->name;
                    }
                }
            } else {
                $userArray = $systemadmins;
            }
        } elseif ($usertypeID == 2) {
            $teachers = $this->teacher_m->get_teacher();
            if ($obj == FALSE) {
                $userArray = array(0 => $this->lang->line("productsale_select_user"));
                if (customCompute($teachers)) {
                    foreach ($teachers as $teacher) {
                        $userArray[$teacher->teacherID] = $teacher->name;
                    }
                }
            } else {
                $userArray = $teachers;
            }
        } elseif ($usertypeID == 3) {
            if ($classesID == 0) {
                $students = $this->studentrelation_m->get_order_by_studentrelation(array('srschoolyearID' => $schoolyearID));
            } else {
                $students = $this->studentrelation_m->get_order_by_studentrelation(array('srschoolyearID' => $schoolyearID, 'srclassesID' => $classesID));
            }

            if ($obj == FALSE) {
                $userArray = array(0 => $this->lang->line("productsale_select_user"));
                if (customCompute($students)) {
                    foreach ($students as $student) {
                        $userArray[$student->srstudentID] = $student->srname . ' - ' . $this->lang->line('productsale_roll') . ' - ' . $student->srroll;
                    }
                }
            } else {
                $userArray = $students;
            }
        } elseif ($usertypeID == 4) {
            $parents = $this->parents_m->get_parents();
            if ($obj == FALSE) {
                $userArray = array(0 => $this->lang->line("productsale_select_user"));
                if (customCompute($parents)) {
                    foreach ($parents as $parent) {
                        $userArray[$parent->parentsID] = $parent->name;
                    }
                }
            } else {
                $userArray = $parents;
            }
        } else {
            $users = $this->user_m->get_order_by_user(array('usertypeID' => $usertypeID));
            if ($obj == FALSE) {
                $userArray = array(0 => $this->lang->line("productsale_select_user"));
                if (customCompute($users)) {
                    foreach ($users as $user) {
                        $userArray[$user->userID] = $user->name;
                    }
                }
            } else {
                $userArray = $users;
            }
        }

        return $userArray;
    }

    public function getproductsale()
    {
        $productcategoryID = $this->input->post('productcategoryID');
        if ((int)$productcategoryID) {
            $products = $this->product_m->get_order_by_product(array('productcategoryID' => $productcategoryID));
            echo "<option value='0'>", $this->lang->line("productsale_select_product"), "</option>";
            foreach ($products as $product) {
                echo "<option value=\"$product->productID\">", $product->productname, "( Stock: ", $this->get_stock($product->productID)->stock, ")", "</option>";
            }
        }
    }

    public function getuser()
    {
        $productsalecustomertypeID = $this->input->post('productsalecustomertypeID');
        $schoolyearID = $this->session->userdata('defaultschoolyearID');


        echo "<option value=\"0\">", $this->lang->line('productsale_select_user'), "</option>";
        if ((int)$productsalecustomertypeID) {
            if ($productsalecustomertypeID == 1) {
                $systemadmins = $this->systemadmin_m->get_systemadmin();
                if (customCompute($systemadmins)) {
                    foreach ($systemadmins as $systemadmin) {
                        echo "<option value=\"$systemadmin->systemadminID\">", $systemadmin->name, "</option>";
                    }
                }
            } elseif ($productsalecustomertypeID == 2) {
                $teachers = $this->teacher_m->get_teacher();
                if (customCompute($teachers)) {
                    foreach ($teachers as $teacher) {
                        echo "<option value=\"$teacher->teacherID\">", $teacher->name, "</option>";
                    }
                }
            } elseif ($productsalecustomertypeID == 3) {
                $classesID = $this->input->post('productsaleclassesID');
                if ($this->input->post('productsaleusercalltype') == 'edit') {
                    $this->db->order_by('srroll', 'asc');
                    $students = $this->studentrelation_m->get_order_by_student(array('srschoolyearID' => $schoolyearID, 'srclassesID' => $classesID));
                    if (customCompute($students)) {
                        foreach ($students as $student) {
                            if (!empty($student->studentID)) {
                                echo "<option value=\"$student->srstudentID\">" . $student->srname . " - " . $this->lang->line('productsale_roll') . " - " . $student->srroll . "</option>";
                            }
                        }
                    }
                } else {
                    $students = $this->studentrelation_m->get_order_by_student(array('srschoolyearID' => $schoolyearID, 'srclassesID' => $classesID));
                    if (customCompute($students)) {
                        foreach ($students as $student) {
                            echo "<option value=\"$student->srstudentID\">" . $student->srname . " - " . $this->lang->line('productsale_roll') . " - " . $student->srroll . "</option>";
                        }
                    }
                }
            } elseif ($productsalecustomertypeID == 4) {
                $parentss = $this->parents_m->get_parents();
                if (customCompute($parentss)) {
                    foreach ($parentss as $parents) {
                        echo "<option value=\"$parents->parentsID\">", $parents->name, "</option>";
                    }
                }
            } else {
                $users = $this->user_m->get_order_by_user(array('usertypeID' => $productsalecustomertypeID));
                if (customCompute($users)) {
                    foreach ($users as $user) {
                        echo "<option value=\"$user->userID\">", $user->name, "</option>";
                    }
                }
            }
        }
    }

    protected function rules()
    {
        $rules = array(
            array(
                'field' => 'productitem',
                'label' => $this->lang->line("productsale_productitem"),
                'rules' => 'trim|xss_clean|callback_unique_productitem'
            ),
            array(
                'field' => 'editID',
                'label' => $this->lang->line("productsale_editid"),
                'rules' => 'trim|required|xss_clean|numeric'
            )
        );

        return $rules;
    }

    public function valid_data($data)
    {
        if ($data == 0) {
            $this->form_validation->set_message('valid_data', 'The %s field is required.');
            return FALSE;
        }
        return TRUE;
    }

    public function date_valid($date)
    {
        if ($date) {
            if (strlen($date) < 10) {
                $this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
                return FALSE;
            } else {
                $arr = explode("-", $date);
                $dd = $arr[0];
                $mm = $arr[1];
                $yyyy = $arr[2];
                if (checkdate($mm, $dd, $yyyy)) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message("date_valid", "%s is not valid dd-mm-yyyy");
                    return FALSE;
                }
            }
        }
        return TRUE;
    }

    public function unique_productitem()
    {
        $productitems = json_decode($this->input->post('productitem'));
        $status = FALSE;
        if (customCompute($productitems)) {
            foreach ($productitems as $productitem) {
                if ($productitem->unitprice != '' && $productitem->quantity != '') {
                    $status = TRUE;
                }
            }
        }

        if ($status) {
            return TRUE;
        } else {
            $this->form_validation->set_message("unique_productitem", "The product item is required.");
            return FALSE;
        }
    }

    public function unique_productitemadjust()
    {
        $productpurchasequintity = pluck($this->productpurchaseitem_m->get_productpurchaseitem_quantity(), 'obj', 'productID');

        $productsalequintity = pluck($this->productsaleitem_m->get_productsaleitem_quantity(), 'obj', 'productID');

        $editID = $this->input->post('editID');
        if ($editID > 0) {
            $productsalequintityforedit = pluck($this->productsaleitem_m->get_productsaleitem_quantity($editID), 'obj', 'productID');
        }

        $productobj = pluck($this->product_m->get_product(), 'obj', 'productID');
        $productitems = json_decode($this->input->post('productitem'));
        $productAmountArray = [];
        if (customCompute($productitems)) {
            foreach ($productitems as $productitem) {
                if ($productitem->unitprice != '' && $productitem->quantity != '') {
                    if (strlen($productitem->unitprice) <= 15 && strlen($productitem->quantity) <= 15) {
                        if (isset($productAmountArray[$productitem->productID])) {
                            $productAmountArray[$productitem->productID] = ($productAmountArray[$productitem->productID] + $productitem->quantity);
                        } else {
                            $productAmountArray[$productitem->productID] = $productitem->quantity;
                        }

                        if (isset($productAmountArray[$productitem->productID])) {
                            if (isset($productpurchasequintity[$productitem->productID])) {
                                $get_product_purchase_quintity = $productpurchasequintity[$productitem->productID]->quantity;
                            } else {
                                $get_product_purchase_quintity = 0;
                            }

                            if (isset($productsalequintity[$productitem->productID])) {
                                $get_product_sale_quintity = $productsalequintity[$productitem->productID]->quantity;
                            } else {
                                $get_product_sale_quintity = 0;
                            }

                            if ($editID > 0) {
                                if (isset($productsalequintityforedit[$productitem->productID])) {
                                    $get_product_sale_quintity_for_edit = $productsalequintityforedit[$productitem->productID]->quantity;
                                } else {
                                    $get_product_sale_quintity_for_edit = 0;
                                }
                            }

                            if ($editID > 0) {
                                $totalQuantity = ($get_product_purchase_quintity - $get_product_sale_quintity + $get_product_sale_quintity_for_edit);
                            } else {
                                $totalQuantity = ($get_product_purchase_quintity - $get_product_sale_quintity);
                            }

                            if ($productAmountArray[$productitem->productID] > $totalQuantity) {
                                if (isset($productobj[$productitem->productID])) {
                                    $this->form_validation->set_message("unique_productitemadjust", "The " . $productobj[$productitem->productID]->productname . " is stock out.");
                                } else {
                                    $this->form_validation->set_message("unique_productitemadjust", "The product is stock out.");
                                }
                                return FALSE;
                            }
                        } else {
                            $this->form_validation->set_message("unique_productitemadjust", "The product not found.");
                            return FALSE;
                        }
                    } else {
                        $this->form_validation->set_message("unique_productitemadjust", "Unit price and quantity ccannot exceed 15 characters in length.");
                        return FALSE;
                    }
                }
            }
        }

        return TRUE;
    }

    public function fileupload()
    {
        $id = $this->input->post('editID');
        $productsale = [];
        if ((int)$id && $id > 0) {
            $productsale = $this->productsale_m->get_productsale($id);
        }

        $new_file = "";
        $original_file_name = '';
        if ($_FILES["productsalefile"]['name'] != "") {
            $file_name = $_FILES["productsalefile"]['name'];
            $original_file_name = $file_name;
            $random = random19();
            $makeRandom = hash('sha512', $random . 'productsale' . config_item("encryption_key"));
            $file_name_rename = $makeRandom;
            $explode = explode('.', $file_name);
            if (customCompute($explode) >= 2) {
                $new_file = $file_name_rename . '.' . end($explode);
                $config['upload_path'] = "./uploads/images";
                $config['allowed_types'] = "gif|jpg|png|jpeg|pdf|doc|xml|docx|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx|txt|ppt|csv";
                $config['file_name'] = $new_file;
                $config['max_size'] = '2048';
                $config['max_width'] = '30000';
                $config['max_height'] = '30000';
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload("productsalefile")) {
                    $this->form_validation->set_message("fileupload", $this->upload->display_errors());
                    return FALSE;
                } else {
                    $this->upload_data['file'] =  $this->upload->data();
                    $this->upload_data['file']['original_file_name'] = $original_file_name;
                    return TRUE;
                }
            } else {
                $this->form_validation->set_message("fileupload", "Invalid file");
                return FALSE;
            }
        } else {
            if (customCompute($productsale)) {
                $this->upload_data['file'] = array('file_name' => $productsale->productsalefile);
                $this->upload_data['file']['original_file_name'] = $productsale->productsalefileorginalname;
                return TRUE;
            } else {
                $this->upload_data['file'] = array('file_name' => $new_file);
                $this->upload_data['file']['original_file_name'] = $original_file_name;
                return TRUE;
            }
        }
    }

    public function saveproductsale()
    {
        $productpurchaseID = 0;
        $retArray['status'] = FALSE;
        if (($this->data['siteinfos']->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1) || ($this->session->userdata('defaultschoolyearID') == 5)) {
            if (permissionChecker('productsale_add') || permissionChecker('productsale_edit')) {
                if ($_POST) {
                    $rules = $this->rules($this->input->post('productsalepaymentstatusID'));
                    $this->form_validation->set_rules($rules);
                    if ($this->form_validation->run() == FALSE) {
                        $retArray['error'] = $this->form_validation->error_array();
                        $retArray['status'] = FALSE;
                        echo json_encode($retArray);
                        exit;
                    } else {
                        $schoolyearID = $this->session->userdata('defaultschoolyearID');
                        $updateID = $this->input->post('editID');
                        $productsaleID = $updateID;
                        $productsaleitem = [];
                         $productitems = json_decode($this->input->post('productitem'));
                         foreach ($productitems as $productitem) {
                                if($productitem->quantity != '') {
                                    $productsaleitem[] = array(
                                        'template_id' => $productsaleID,
                                        'product_id' => $productitem->productID,
                                        'qty' => $productitem->quantity,
                                    );
                                }
                            }
                         //   var_dump($productsaleitem);die;
                        
                        $this->productsaletemplate_m->delete_productsale_by_templeteID($productsaleID);
                        $this->productsaletemplate_m->insert_productsale($productsaleitem);
                        $this->productsaletemplate_m->update_template($productsaleID,$this->input->post('discount'));
                        $this->session->set_flashdata('success', $this->lang->line('menu_update_producttemplatesuccess'));
                        $retArray['status'] = TRUE;
                        $retArray['message'] = 'Success';
                        echo json_encode($retArray);
                        exit;
                    }
                } else {
                    $retArray['error'] = array('permission' => 'Sale permission is required.');
                    echo json_encode($retArray);
                    exit;
                }
            } else {
                $retArray['error'] = array('permission' => 'Sale permission is required.');
                echo json_encode($retArray);
                exit;
            }
        } else {
            $retArray['error'] = array('permission' => 'Sale permission is required.');
            echo json_encode($retArray);
            exit;
        }
    }

    public function delete()
    {
        if (($this->data['siteinfos']->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1) || ($this->session->userdata('defaultschoolyearID') == 5)) {
            $id = htmlentities(escapeString($this->uri->segment(3)));
            if ((int)$id) {
                $schoolyearID = $this->session->userdata('defaultschoolyearID');
                $this->data['productsale'] = $this->productsale_m->get_single_productsale(array('productsaleID' => $id, 'schoolyearID' => $schoolyearID));
                $this->data['productsalepaid'] = $this->productsalepaid_m->get_productsalepaid_sum('productsalepaidamount', array('productsaleID' => $id));

                if (customCompute($this->data['productsale'])) {
                    if (($this->data['productsale']->productsalerefund == 0) && ($this->data['productsalepaid']->productsalepaidamount == NULL)) {
                        $this->productsale_m->delete_productsale($id);
                        $this->productsaleitem_m->delete_productsaleitem_by_productsaleID($id);
                        $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                        redirect(base_url("productsaletemplate/index"));
                    } else {
                        redirect(base_url("productsaletemplate/index"));
                    }
                } else {
                    redirect(base_url("productsaletemplate/index"));
                }
            } else {
                redirect(base_url("productsaletemplate/index"));
            }
        } else {
            $this->data["subview"] = "error";
            $this->load->view('_layout_main', $this->data);
        }
    }

    public function cancel()
    {
        if (($this->data['siteinfos']->school_year == $this->session->userdata('defaultschoolyearID')) || ($this->session->userdata('usertypeID') == 1) || ($this->session->userdata('defaultschoolyearID') == 5)) {
            if (permissionChecker('productsale_edit')) {
                $id = htmlentities(escapeString($this->uri->segment(3)));
                if ((int)$id) {
                    $schoolyearID = $this->session->userdata('defaultschoolyearID');
                    $this->data['productsale'] = $this->productsale_m->get_single_productsale(array('productsaleID' => $id, 'schoolyearID' => $schoolyearID));
                    if (customCompute($this->data['productsale'])) {
                        $this->productsale_m->update_productsale(array('productsalerefund' => 1), $id);
                        $this->session->set_flashdata('success', $this->lang->line('menu_success'));
                        redirect(base_url("productsaletemplate/index"));
                    } else {
                        redirect(base_url("productsaletemplate/index"));
                    }
                } else {
                    redirect(base_url("productsaletemplate/index"));
                }
            } else {
                redirect(base_url("productsaletemplate/index"));
            }
        } else {
            $this->data["subview"] = "error";
            $this->load->view('_layout_main', $this->data);
        }
    }
}
