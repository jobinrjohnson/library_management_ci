<?php

/*
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

/**
 * Description of Stocks
 *
 * @author jobinrjohnson
 */
class Stocks extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->usermanager->is_admin_in()) {
            $this->session->set_flashdata('redir_url', current_url());
            redirect(base_url('authorize'));
            die();
        }
        $this->load->model(array('book'));
    }

    public function index() {
        $this->load->view('stock_s', array(
            'books' => $this->book->get_stocks()
        ));
    }

    public function add() {
        $this->load->library('formlib', array('form_name' => 'stocks'));
        $this->load->view('common_add', array(
            'redirurl' => base_url('stocks'),
            'suburl' => base_url('stocks/do_add')
        ));
    }

    public function do_add() {
        $this->load->library('formlib', array('form_name' => 'stocks'));
        $this->output->set_content_type('application/json');
        $data = array('status' => 0, 'msg' => "Unable to add");
        $v = $this->formlib->validate();
        if ($v === TRUE) {
            if ($this->book->add_stock($this->formlib->get_db_add_data())) {
                $data['msg'] = 'Success stock Added';
                $data['status'] = 1;
            }
        } else {
            $data['msg'] = $v;
        }
        $this->output->set_output(json_encode($data));
    }

}
