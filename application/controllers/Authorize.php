<?php

/*
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

/**
 * Description of Authorize
 *
 * @author jobinrjohnson
 */
class Authorize extends CI_Controller {

    public function index() {
        if ($this->usermanager->is_admin_in()) {
            redirect(base_url());
            die();
        }
        $redir_url = $this->session->flashdata('redir_url') ?
                $this->session->flashdata('redir_url') : base_url();
        $this->session->set_flashdata('redir_url', $redir_url);
        $errors = NULL;
        if ($this->input->post()) {
            $this->load->library('form_validation');
            $this->form_validation->set_rules('email', 'Username'
                    , 'trim|xss_clean|strip_tags|required');
            $this->form_validation->set_rules('password', 'Password'
                    , 'trim|xss_clean|strip_tags|required', array(
                'required' => 'You must provide a %s.')
            );
            if ($this->form_validation->run() == TRUE) {
                if ($this->usermanager->log_admin_in(
                                $this->input->post('email', TRUE)
                                , $this->input->post('password', TRUE))
                ) {
                    redirect($redir_url);
                    return;
                } else {
                    $errors = "Invalid email and password combination";
                }
            } else {
                $errors = validation_errors();
            }
        }
        $this->load->view('login', array(
            'error' => $errors
        ));
    }

    public function logout() {
        $this->usermanager->logout_admin();
        redirect(base_url());
    }

}
