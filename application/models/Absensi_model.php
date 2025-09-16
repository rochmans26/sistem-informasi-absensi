<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_model extends CI_Model
{

    public function get_karyawan()
    {
        return $this->db->get('tb_karyawan')->result();
    }

    public function verify_password($id_karyawan, $kode_karyawan)
    {
        $karyawan = $this->db->get_where('tb_karyawan', ['id' => $id_karyawan])->row();
        if ($karyawan->kode_karyawan == $kode_karyawan) {
            // jika password disimpan dalam bentuk hash
            return true;
        }
        return false;
    }

    public function get_absensi_today($id_karyawan)
    {
        $today = date('Y-m-d');
        return $this->db->get_where('tb_absensi', [
            'id_karyawan' => $id_karyawan,
            'tgl_absensi' => $today
        ])->row();
    }

    public function absen_masuk($id_karyawan, $foto)
    {
        $current_time = $this->get_database_time();
        $this->db->insert('tb_absensi', [
            'id_karyawan' => $id_karyawan,
            'jam_masuk' => $current_time->time,
            'tgl_absensi' => $current_time->date,
            'foto_masuk' => $foto
        ]);
    }

    public function absen_keluar($id_absensi, $foto)
    {
        $this->db->where('id', $id_absensi);
        $this->db->update('tb_absensi', [
            'jam_keluar' => date('H:i:s'),
            'foto_keluar' => $foto
        ]);
    }

    public function get_all_absensi()
    {
        $this->db->select('tb_absensi.*, tb_karyawan.nm_karyawan');
        $this->db->join('tb_karyawan', 'tb_karyawan.id = tb_absensi.id_karyawan', 'left');
        $this->db->order_by('tgl_absensi', 'DESC');
        $this->db->order_by('jam_masuk', 'DESC');
        return $this->db->get('tb_absensi')->result();
    }

    public function get_today_absensi()
    {
        $today = date('Y-m-d');
        $this->db->select('tb_absensi.*, tb_karyawan.nm_karyawan, tb_karyawan.uuid');
        $this->db->from('tb_absensi');
        $this->db->join('tb_karyawan', 'tb_karyawan.id = tb_absensi.id_karyawan', 'left');
        $this->db->where('tb_absensi.tgl_absensi', $today);
        $this->db->order_by('tb_absensi.jam_masuk', 'DESC');
        return $this->db->get()->result();
    }
    private function get_database_time()
    {
        // Query untuk mendapatkan waktu sekarang dari database
        $query = $this->db->query('SELECT NOW() as datetime, CURTIME() as time, CURDATE() as date');
        return $query->row();
    }
}
