<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uniform_migration extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Uniform_model');
        $this->load->library('session');

        // Restrict all methods to admin only
        if ($this->session->userdata('create_usertypeID') != 1) {
            show_error('Unauthorized access.', 403);
        }
    }

    // -------------------------------------------------------------------------
    // PREVIEW — show what will be migrated, no writes
    // URL: yoursite.com/uniform_migration/preview
    // -------------------------------------------------------------------------
    public function preview()
    {
        $data['preview'] = $this->Uniform_model->preview_bulk_transfer();
        $this->load->view('uniform_migration/preview', $data);
    }

    // -------------------------------------------------------------------------
    // RUN MIGRATION — one-time bulk transfer
    // URL: yoursite.com/uniform_migration/run
    // -------------------------------------------------------------------------
    public function run()
    {
        // Safety: only allow POST to prevent accidental browser re-runs
        if ($this->input->server('REQUEST_METHOD') !== 'POST') {
            show_error('Use the preview page to confirm and run the migration.', 405);
        }

        $result = $this->Uniform_model->bulk_transfer_existing_purchases_to_uniform();

        $data['result'] = $result;
        $this->load->view('uniform_migration/result', $data);
    }
}