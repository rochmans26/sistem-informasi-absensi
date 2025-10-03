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
        if (password_verify($kode_karyawan, $karyawan->kode_karyawan)) {
            // jika password disimpan dalam bentuk hash
            return true;
        }
        return false;
    }

    public function get_absensi_today($id_karyawan)
    {
        $current_time = $this->get_database_time();
        $today = $current_time->date;
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
        $current_time = $this->get_database_time();
        $this->db->where('id', $id_absensi);
        $this->db->update('tb_absensi', [
            'jam_keluar' => $current_time->time,
            'foto_keluar' => $foto,
            'status' => 'hadir'
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
        $current_time = $this->get_database_time();
        $today = $current_time->date;
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

    // Method untuk mengambil semua data absensi dengan filter
    public function get_all($limit = null, $start = null, $start_date = null, $end_date = null, $karyawan_id = null, $status = null, $search = null)
    {
        $this->db->select('tb_absensi.*, tb_karyawan.nm_karyawan');
        $this->db->join('tb_karyawan', 'tb_karyawan.id = tb_absensi.id_karyawan', 'left');

        // Filter tanggal
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('tb_absensi.tgl_absensi >=', $start_date);
            $this->db->where('tb_absensi.tgl_absensi <=', $end_date);
        } elseif (!empty($start_date)) {
            $this->db->where('tb_absensi.tgl_absensi', $start_date);
        }

        // Filter karyawan
        if (!empty($karyawan_id)) {
            $this->db->where('tb_absensi.id_karyawan', $karyawan_id);
        }

        // Filter status
        if (!empty($status)) {
            $this->db->where('tb_absensi.status', $status);
        }

        // Pencarian umum
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('tb_karyawan.nm_karyawan', $search);
            $this->db->or_like('tb_absensi.tgl_absensi', $search);
            $this->db->or_like('tb_absensi.status', $search);
            $this->db->or_like('tb_absensi.jam_masuk', $search);
            $this->db->or_like('tb_absensi.jam_keluar', $search);
            $this->db->group_end();
        }

        $this->db->order_by('tgl_absensi', 'DESC');
        $this->db->order_by('jam_masuk', 'DESC');
        $this->db->order_by('tb_absensi.id', 'DESC');

        if ($limit !== null && $start !== null) {
            $this->db->limit($limit, $start);
        }

        return $this->db->get('tb_absensi')->result();
    }

    // Method untuk menghitung total data dengan filter
    public function count_all($start_date = null, $end_date = null, $karyawan_id = null, $status = null, $search = null)
    {
        $this->db->from('tb_absensi');
        $this->db->join('tb_karyawan', 'tb_karyawan.id = tb_absensi.id_karyawan', 'left');

        // Filter tanggal
        if (!empty($start_date) && !empty($end_date)) {
            $this->db->where('tb_absensi.tgl_absensi >=', $start_date);
            $this->db->where('tb_absensi.tgl_absensi <=', $end_date);
        } elseif (!empty($start_date)) {
            $this->db->where('tb_absensi.tgl_absensi', $start_date);
        }

        // Filter karyawan
        if (!empty($karyawan_id)) {
            $this->db->where('tb_absensi.id_karyawan', $karyawan_id);
        }

        // Filter status
        if (!empty($status)) {
            $this->db->where('tb_absensi.status', $status);
        }

        // Pencarian umum
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('tb_karyawan.nm_karyawan', $search);
            $this->db->or_like('tb_absensi.tgl_absensi', $search);
            $this->db->or_like('tb_absensi.status', $search);
            $this->db->or_like('tb_absensi.jam_masuk', $search);
            $this->db->or_like('tb_absensi.jam_keluar', $search);
            $this->db->group_end();
        }

        return $this->db->count_all_results();
    }

    // Method untuk mendapatkan daftar karyawan (untuk dropdown)
    public function get_karyawan_list()
    {
        $this->db->select('id, nm_karyawan');
        $this->db->from('tb_karyawan');
        $this->db->order_by('nm_karyawan', 'ASC');
        return $this->db->get()->result();
    }

    // Method original tetap dipertahankan untuk kompatibilitas
    public function get_all_original($limit, $start)
    {
        $this->db->select('tb_absensi.*, tb_karyawan.nm_karyawan');
        $this->db->join('tb_karyawan', 'tb_karyawan.id = tb_absensi.id_karyawan', 'left');
        return $this->db->limit($limit, $start)
            ->order_by('tgl_absensi', 'DESC')
            ->order_by('jam_masuk', 'DESC')
            ->order_by('id', 'DESC')
            ->get('tb_absensi')
            ->result();
    }

    public function count_all_original()
    {
        return $this->db->count_all('tb_absensi');
    }

}
