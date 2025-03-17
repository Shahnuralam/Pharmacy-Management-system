<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Accountant_model extends CI_model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertAccountant($data) {
        $this->db->insert('accountant', $data);
    }

    function getAccountant() {
        $query = $this->db->get('accountant');
        return $query->result();
    }

    function getAccountantById($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('accountant');
        return $query->row();
    }

    function updateAccountant($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('accountant', $data);
    }

    function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('accountant');
    }

    function updateIonUser($username, $email, $password, $ion_user_id) {
        $uptade_ion_user = array(
            'username' => $username,
            'email' => $email,
            'password' => $password
        );
        $this->db->where('id', $ion_user_id);
        $this->db->update('users', $uptade_ion_user);
    }

}
