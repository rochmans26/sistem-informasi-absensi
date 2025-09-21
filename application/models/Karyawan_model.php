<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_Model
{

    // public function insert_user($nama)
    // {
    //     $this->db->insert('tb_karyawan', ['nama' => $nama]);
    // }

    public function get_all($limit, $start)
    {
        // $this->db->order_by('id', 'DESC'); // tampilkan terbaru dulu
        // return $this->db->get('tb_karyawan')->result();

        return $this->db->limit($limit, $start)
            ->order_by('id', 'DESC')
            ->get('tb_karyawan')
            ->result();
    }
    public function get_data_karyawan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tb_karyawan')->row();
    }

    public function insert($data)
    {
        $this->db->insert('tb_karyawan', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_karyawan', $data);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('tb_karyawan');
    }

    public function count_all()
    {
        return $this->db->count_all('tb_karyawan');
    }
    public function is_uuid_exist($uuid)
    {
        $this->db->where('uuid', $uuid);
        $query = $this->db->get('tb_karyawan');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function is_email_exist($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('tb_karyawan');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
