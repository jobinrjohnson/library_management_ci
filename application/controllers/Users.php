<?php

/*
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

/**
 * Description of Users
 *
 * @author jobinrjohnson
 */
class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->usermanager->is_admin_in()) {
            $this->session->set_flashdata('redir_url', current_url());
            redirect(base_url('authorize'));
            die();
        }
        $this->load->model('book');
    }

    public function index() {
        $this->load->view('user_s', array(
            'users' => $this->usermanager->get_nave_users()
        ));
    }

    public function add() {
        $this->load->library('formlib', array('form_name' => 'library_user'));
        $this->load->view('common_add', array(
            'redirurl' => base_url('users'),
            'suburl' => base_url('users/do_add')
        ));
    }

    public function edit($param = 0) {
        $this->load->library('formlib', array('form_name' => 'library_user'));
        $this->load->view('common_edit', array(
            'item' => (int) $param,
            'redirurl' => base_url('users'),
            'suburl' => base_url('users/do_edit')
        ));
    }

    public function do_add() {
        $this->load->library('formlib', array('form_name' => 'library_user'));
        $this->output->set_content_type('application/json');
        $data = array('status' => 0, 'msg' => "Unable to add");
        $v = $this->formlib->validate();
        if ($v === TRUE) {
            if ($this->usermanager->add_nave_user($this->formlib->get_db_add_data())) {
                $data['msg'] = 'Success User Added';
                $data['status'] = 1;
            }
        } else {
            $data['msg'] = $v;
        }
        $this->output->set_output(json_encode($data));
    }

    public function do_edit() {
        $this->load->library('formlib', array('form_name' => 'library_user'));
        $this->output->set_content_type('application/json');
        $data = array('status' => 0, 'msg' => "Unable to update");
        $v = $this->formlib->validate_for_edit();
        if ($v === TRUE) {
            if ($this->usermanager->edit($this->formlib->get_db_edit_data(), (int) $this->formlib->get_edit_primary_key())) {
                $data['msg'] = 'Success user updated';
                $data['status'] = 1;
            }
        } else {
            $data['msg'] = $v;
        }
        $this->output->set_output(json_encode($data));
    }

}
