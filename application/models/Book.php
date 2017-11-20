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

        $q = 'INSERT INTO books (' . implode(',', array_keys($param))
                . ') VALUES (';
        for ($i = 0; $i < count($param); $i++) {
            if ($i == 0) {
                $q .= '?';
                continue;
            }
            $q .= ',?';
        }
        $q .= ')';
        return $this->db->query($q, array_values($param));
    }

    public function get_all_books() {
        return $this->db->query("SELECT books.id,books.name AS name, books.rfid, author.name AS author, category.name AS category FROM `books` INNER JOIN category ON books.category = category.id INNER JOIN author ON books.author = author.id")->result();
    }

    public function get_stocks() {
        return $this->db->query("SELECT SUM(qty) AS total, SUM(qty)-0 AS remaining, books.name,books.id AS bookid FROM `stocks` INNER JOIN books ON stocks.book = books.id WHERE books.status=1 GROUP BY books.id")->result();
    }

    public function edit($data, $id) {
        return $this->db->where('id', $id)->update('books', $data);
    }

    public function add_stock($param) {
        return $this->db->insert('stocks', $param);
    }

}
