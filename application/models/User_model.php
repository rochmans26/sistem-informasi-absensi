<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function insert($data)
    {
        $this->db->insert('users', $data);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all_users()
    {
        $this->db->order_by('id', 'DESC'); // tampilkan terbaru dulu
        return $this->db->get('users')->result();
    }

    public function get_dataUser($username)
    {
        $this->db->where('username', $username);
        return $this->db->get('users')->row();
    }

    public function login($username, $password)
    {
        $this->db->where('username', $username);
        $admin = $this->db->get('users')->row();

        if ($admin && password_verify($password, $admin->password)) {
            return $admin;
        }
        return false;
    }
}
