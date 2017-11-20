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
class Support  extends CI_Model {

    public function get_all_authors() {

        return array();
    }

    public function get_all_books() {
        return $this->db->query("SELECT * FROM `books` WHERE 1")->result();
    }

}
