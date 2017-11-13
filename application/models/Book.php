<?php

/*
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

/**
 * Description of Book
 *
 * @author jobinrjohnson
 */
class Book extends CI_Model {

    public function add_book($param) {

        $q = 'INSERT INTO books (' . implode(',', array_keys($param)) . ') VALUES (';
        for ($i = 0; $i < count($param); $i++) {
            if ($i == 0) {
                $q .= '?';
                continue;
            }
            $q .= ',?';
        }
        $q.= ')';
        return $this->db->query($q,array_values($param));
    }

}
