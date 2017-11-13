<?php

/*
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

/**
 * Description of Welcome
 *
 * @author jobinrjohnson
 */
class Welcome extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->usermanager->is_admin_in()) {
            $this->session->set_flashdata('redir_url', current_url());
            redirect(base_url('authorize'));
            die();
        }
    }

    public function index() {
        $this->load->view('home', array(
            'status' => $this->db->query("SELECT "
                    . "(SELECT COUNT(*) FROM `books`) AS book_count"
                    . ",(SELECT COUNT(*) FROM users) AS user_count")->first_row()
        ));
    }

}
