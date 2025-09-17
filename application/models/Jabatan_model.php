<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan_model extends CI_Model
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
            ->get('tb_jabatan')
            ->result();
    }
    public function get_data_jabatan($id)
    {
        $this->db->where('id', $id);
        return $this->db->get('tb_jabatan')->row();
    }

    public function insert($data)
    {
        $this->db->insert('tb_jabatan', $data);

        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('tb_jabatan', $data);
    }
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('tb_jabatan');
    }

    public function count_all()
    {
        return $this->db->count_all('tb_jabatan');
    }
    public function is_kodeJabatan_exist($kode)
    {
        $this->db->where('kode_jabatan', $kode);
        $query = $this->db->get('tb_jabatan');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function is_namaJabatan_exist($nama)
    {
        $this->db->where('nama_jabatan', $nama);
        $query = $this->db->get('tb_jabatan');

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
