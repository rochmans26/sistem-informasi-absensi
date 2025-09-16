<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function insert_user($nama)
    {
        $this->db->insert('users', ['nama' => $nama]);
    }

    public function get_all_users()
    {
        $this->db->order_by('id', 'DESC'); // tampilkan terbaru dulu
        return $this->db->get('users')->result();
    }
}
