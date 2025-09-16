<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{

    // public function insert_user($nama)
    // {
    //     $this->db->insert('tb_karyawan', ['nama' => $nama]);
    // }

    public function get_all()
    {
        // $this->db->order_by('id', 'DESC'); // tampilkan terbaru dulu
        return $this->db->get('tb_karyawan')->result();
    }
}
