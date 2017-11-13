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
        if ($this->input->post()) {
            $data = $this->add_user();
            if ($data['status'] == 1) {
                $this->session->set_flashdata('msg', 'User added successfully');
                redirect(base_url('users'));
            }
            $this->load->view('user_add', $data);
            return;
        }
        $this->load->view('user_add');
    }

    public function add_user() {

        $data = array('status' => 0
            , 'msg' => "Unable to complete registration. Please try again.");
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name'
                , 'trim|xss_clean|strip_tags|required|min_length[5]');
        $this->form_validation->set_rules('email', 'Email'
                , 'valid_email|required|is_unique[users.email]');
        $this->form_validation->set_rules('address', 'Address'
                , 'trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('dob', 'Date of birth'
                , 'trim|xss_clean|strip_tags');


        if ($this->form_validation->run() == TRUE) {

            $data_insert = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'dob' => $this->input->post('dob')
            );

            if ($this->usermanager->add_nave_user($data_insert)) {

                $data['msg'] = 'Success';
                $data['status'] = 1;
                $data['id'] = $this->db->insert_id();
            } else {
                $data['msg'] = 'Some error occured';
            }
        } else {
            $data['msg'] = validation_errors();
        }


        return $data;
    }

}
