<?php

/*
 * This file is subject to the terms and conditions defined in
 * file 'LICENSE.txt', which is part of this source code package.
 */

/**
 * Description of Usermanage
 *
 * @author jobinrjohnson
 */
class Usermanager extends CI_Model {

    public $SESSION_ID = 'ADMIN_ID';
    public $SESSION_STATUS = 'ADMIN_IN';

    public function __construct() {
        parent::__construct();
    }

    public function add_nave_user($param) {

        $q = 'INSERT INTO users (' . implode(',', array_keys($param))
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

    public function edit($data, $id) {
        return $this->db->where('id', $id)->update('users', $data);
    }

    public function get_nave_users() {
        return $this->db->query("SELECT * FROM `users` WHERE 1")->result();
    }

    public function is_admin_in() {
        return $this->session->userdata($this->SESSION_STATUS) == TRUE &&
                $this->session->userdata($this->SESSION_ID) > 0;
    }

    public function get_me() {
        return $this->get_admin($this->session->userdata($this->SESSION_ID));
    }

    public function get_admin($userid) {
        $q = $this->db->query("SELECT id, name, email FROM user_admin WHERE"
                . " status=1 AND id = ? ", array((int) $userid));
        return $q->num_rows() > 0 ? $q->first_row() : NULL;
    }

    public function get_admin_by_cred($email, $password = NULL) {
        $conditions = array($email);
        if ($password != NULL) {
            array_push($conditions, sha1($password));
        }
        $q = $this->db->query("SELECT id, name, email FROM user_admin WHERE"
                . " status=1 AND email = ? "
                . ($password != NULL ? "AND password=?" : ''), $conditions);
        return $q->num_rows() > 0 ? $q->first_row() : NULL;
    }

    public function log_admin_in($email, $password) {
        $user = $this->get_admin_by_cred($email, $password);
        if ($user == NULL) {
            return FALSE;
        } else {
            $this->session->set_userdata(array(
                $this->SESSION_STATUS => TRUE,
                $this->SESSION_ID => $user->id
            ));
            return TRUE;
        }
    }

    public function logout_admin() {
        $this->session->unset_userdata(array(
            $this->SESSION_ID, $this->SESSION_STATUS
        ));
        return TRUE;
    }

}
