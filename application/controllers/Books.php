<?php

/*
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

/**
 * Description of Books
 *
 * @author jobinrjohnson
 */
class Books extends CI_Controller {

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
        $this->load->view('book_s', array(
            'books' => $this->book->get_all_books()
        ));
    }

    public function add() {
        if ($this->input->post()) {
            $data = $this->add_book();
            if ($data['status'] == 1) {
                $this->session->set_flashdata('msg', 'Book added successfully');
                redirect(base_url('books'));
            }
            $this->load->view('book_add', $data);
            return;
        }
        $this->load->view('book_add');
    }

    public function add_book() {

        $data = array('status' => 0, 'msg' => "Unable to complete registration. Please try again.");
        $this->load->library('form_validation');

        $this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|strip_tags|required|min_length[5]');
        $this->form_validation->set_rules('rfid', 'RFID', 'alpha_numeric|required');
        $this->form_validation->set_rules('author', 'Atuhor', 'trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('published', 'Published on', 'trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('descr', 'Description', 'trim|xss_clean|strip_tags|min_length[50]|max_length[10000]');
        $this->form_validation->set_rules('category', 'Category', '');


        if ($this->form_validation->run() == TRUE) {

            $data_insert = array(
                'name' => $this->input->post('name'),
                'rfid' => $this->input->post('rfid'),
                'author' => $this->input->post('author'),
                'published' => $this->input->post('published'),
                'descr' => $this->input->post('descr'),
                'category' => $this->input->post('category')
            );

            if ($this->book->add_book($data_insert)) {

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
