<?php

/*
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

/**
 * Description of Support
 *
 * @author jobinrjohnson
 */
class Support extends CI_Model {

    public function get_all_authors() {

        return array();
    }

    public function get_all_categories() {
        return $this->db->query("SELECT a.*, (SELECT COUNT(*) FROM books WHERE category = a.id) books FROM `category` a WHERE 1")->result();
    }

    public function add_cat($param) {
        return $this->db->insert('category', $param);
    }

    public function edit_cat($data, $id) {
        return $this->db->where('id', $id)->update('category', $data);
    }

}
