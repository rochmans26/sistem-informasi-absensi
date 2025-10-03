<?php
class Penggajian_model extends CI_Model
{
    public function get_rekap_gaji($start_date, $end_date, $id_karyawan = null, $limit = null, $start = null, $search = null)
    {
        $this->db->select('k.id as id_karyawan, k.nm_karyawan, j.nama_jabatan, j.gaji_jabatan as gaji_per_hari');
        $this->db->select('COUNT(a.id) as total_hari_kerja');
        $this->db->select('SUM(
            CASE 
                WHEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 > 10 
                THEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 - 10 
                ELSE 0 
            END
        ) as total_jam_lembur');
        $this->db->select('SUM(
            CASE 
                WHEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 <= 5 
                THEN 1 
                ELSE 0 
            END
        ) as total_hari_kurang_50');
        $this->db->select('SUM(
            CASE 
                WHEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 > 5 
                AND TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 < 10 
                THEN 1 
                ELSE 0 
            END
        ) as total_hari_kurang_proporsional');
        $this->db->select('SUM(
            CASE 
                WHEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 > 5 
                AND TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 < 10 
                THEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 
                ELSE 0 
            END
        ) as total_jam_kurang_proporsional');
        $this->db->from('tb_karyawan k');
        $this->db->join('tb_jabatan j', 'j.id = k.id_jabatan', 'left');
        $this->db->join('tb_absensi a', "a.id_karyawan = k.id AND a.tgl_absensi BETWEEN '$start_date' AND '$end_date' AND a.status = 'hadir'", 'left');

        // Filter karyawan
        if (!empty($id_karyawan)) {
            $this->db->where('k.id', $id_karyawan);
        }

        // Pencarian nama karyawan
        if (!empty($search)) {
            $this->db->like('k.nm_karyawan', $search);
        }

        $this->db->group_by('k.id, k.nm_karyawan, j.nama_jabatan, j.gaji_jabatan');
        $this->db->order_by('k.nm_karyawan', 'ASC');

        if ($limit !== null && $start !== null) {
            $this->db->limit($limit, $start);
        }

        $result = $this->db->get()->result();

        // Hitung gaji untuk setiap karyawan dengan algoritma baru
        foreach ($result as $row) {
            $row->total_jam_lembur = $row->total_jam_lembur ? round($row->total_jam_lembur, 2) : 0;
            $row->total_hari_kerja = $row->total_hari_kerja ?: 0;
            $row->total_hari_kurang_50 = $row->total_hari_kurang_50 ?: 0;
            $row->total_hari_kurang_proporsional = $row->total_hari_kurang_proporsional ?: 0;
            $row->total_jam_kurang_proporsional = $row->total_jam_kurang_proporsional ? round($row->total_jam_kurang_proporsional, 2) : 0;
            $row->total_hari_penuh = $row->total_hari_kerja - $row->total_hari_kurang_50 - $row->total_hari_kurang_proporsional;

            // Hitung gaji dengan algoritma baru
            $gaji_hari_penuh = $row->total_hari_penuh * $row->gaji_per_hari;
            $gaji_hari_kurang_50 = $row->total_hari_kurang_50 * ($row->gaji_per_hari * 0.5); // 50% dari gaji harian
            $gaji_hari_kurang_proporsional = ($row->total_jam_kurang_proporsional / 10) * $row->gaji_per_hari; // Proporsional berdasarkan jam
            $row->gaji_pokok = $gaji_hari_penuh + $gaji_hari_kurang_50 + $gaji_hari_kurang_proporsional;
            $row->uang_lembur = $row->total_jam_lembur * 5000;
            $row->total_gaji = $row->gaji_pokok + $row->uang_lembur;

            // Simpan detail perhitungan
            $row->detail_perhitungan = [
                'hari_penuh' => $row->total_hari_penuh,
                'hari_kurang_50' => $row->total_hari_kurang_50,
                'hari_kurang_proporsional' => $row->total_hari_kurang_proporsional,
                'jam_kurang_proporsional' => $row->total_jam_kurang_proporsional,
                'gaji_hari_penuh' => $gaji_hari_penuh,
                'gaji_hari_kurang_50' => $gaji_hari_kurang_50,
                'gaji_hari_kurang_proporsional' => $gaji_hari_kurang_proporsional
            ];
        }

        return $result;
    }
    public function get_rekap_gaji_alternative($start_date, $end_date, $id_karyawan = null, $limit = null, $start = null, $search = null)
    {
        $sql = "SELECT 
                    k.id as id_karyawan, 
                    k.nm_karyawan, 
                    j.nama_jabatan, 
                    j.gaji_jabatan as gaji_per_hari,
                    COUNT(a.id) as total_hari_kerja,
                    COALESCE(SUM(
                        CASE 
                            WHEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 > 10 
                            THEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 - 10 
                            ELSE 0 
                        END
                    ), 0) as total_jam_lembur,
                    COALESCE(SUM(
                        CASE 
                            WHEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 <= 5 
                            THEN 1 
                            ELSE 0 
                        END
                    ), 0) as total_hari_kurang_50,
                    COALESCE(SUM(
                        CASE 
                            WHEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 > 5 
                            AND TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 < 10 
                            THEN 1 
                            ELSE 0 
                        END
                    ), 0) as total_hari_kurang_proporsional,
                    COALESCE(SUM(
                        CASE 
                            WHEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 > 5 
                            AND TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 < 10 
                            THEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 
                            ELSE 0 
                        END
                    ), 0) as total_jam_kurang_proporsional
                FROM tb_karyawan k
                LEFT JOIN tb_jabatan j ON j.id = k.id_jabatan
                LEFT JOIN tb_absensi a ON a.id_karyawan = k.id 
                    AND a.tgl_absensi BETWEEN ? AND ? 
                    AND a.status = 'hadir'
                WHERE 1=1";

        $params = [$start_date, $end_date];

        // Filter karyawan
        if (!empty($id_karyawan)) {
            $sql .= " AND k.id = ?";
            $params[] = $id_karyawan;
        }

        // Pencarian nama karyawan
        if (!empty($search)) {
            $sql .= " AND k.nm_karyawan LIKE ?";
            $params[] = "%$search%";
        }

        $sql .= " GROUP BY k.id, k.nm_karyawan, j.nama_jabatan, j.gaji_jabatan
                  ORDER BY k.nm_karyawan ASC";

        // Limit untuk pagination
        if ($limit !== null && $start !== null) {
            $sql .= " LIMIT ?, ?";
            $params[] = (int) $start;
            $params[] = (int) $limit;
        }

        $result = $this->db->query($sql, $params)->result();

        // Hitung gaji untuk setiap karyawan dengan algoritma baru
        foreach ($result as $row) {
            $row->total_jam_lembur = round($row->total_jam_lembur, 2);
            $row->total_jam_kurang_proporsional = round($row->total_jam_kurang_proporsional, 2);
            $row->total_hari_penuh = $row->total_hari_kerja - $row->total_hari_kurang_50 - $row->total_hari_kurang_proporsional;

            // Hitung gaji dengan algoritma baru
            $gaji_hari_penuh = $row->total_hari_penuh * $row->gaji_per_hari;
            $gaji_hari_kurang_50 = $row->total_hari_kurang_50 * ($row->gaji_per_hari * 0.5); // 50% dari gaji harian
            $gaji_hari_kurang_proporsional = ($row->total_jam_kurang_proporsional / 10) * $row->gaji_per_hari; // Proporsional berdasarkan jam
            $row->gaji_pokok = $gaji_hari_penuh + $gaji_hari_kurang_50 + $gaji_hari_kurang_proporsional;
            $row->uang_lembur = $row->total_jam_lembur * 5000;
            $row->total_gaji = $row->gaji_pokok + $row->uang_lembur;

            // Simpan detail perhitungan
            $row->detail_perhitungan = [
                'hari_penuh' => $row->total_hari_penuh,
                'hari_kurang_50' => $row->total_hari_kurang_50,
                'hari_kurang_proporsional' => $row->total_hari_kurang_proporsional,
                'jam_kurang_proporsional' => $row->total_jam_kurang_proporsional,
                'gaji_hari_penuh' => $gaji_hari_penuh,
                'gaji_hari_kurang_50' => $gaji_hari_kurang_50,
                'gaji_hari_kurang_proporsional' => $gaji_hari_kurang_proporsional
            ];
        }

        return $result;
    }

    public function count_rekap_gaji($start_date, $end_date, $id_karyawan = null, $search = null)
    {
        $this->db->select('COUNT(DISTINCT k.id) as total');
        $this->db->from('tb_karyawan k');
        $this->db->join('tb_jabatan j', 'j.id = k.id_jabatan', 'left');

        // Filter karyawan
        if (!empty($id_karyawan)) {
            $this->db->where('k.id', $id_karyawan);
        }

        // Pencarian nama karyawan
        if (!empty($search)) {
            $this->db->like('k.nm_karyawan', $search);
        }

        $result = $this->db->get()->row();
        return $result->total;
    }

    public function get_detail_absensi_karyawan($id_karyawan, $start_date, $end_date)
    {
        $this->db->select('a.*, 
            CASE 
                WHEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 > 10 
                THEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 - 10 
                ELSE 0 
            END as jam_lembur,
            CASE 
                WHEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 <= 5 
                THEN "kurang_50" 
                WHEN TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 > 5 
                     AND TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 < 10 
                THEN "kurang_proporsional"
                ELSE "penuh" 
            END as status_jam_kerja,
            TIME_TO_SEC(TIMEDIFF(a.jam_keluar, a.jam_masuk)) / 3600 as total_jam_kerja');
        $this->db->from('tb_absensi a');
        $this->db->where('a.id_karyawan', $id_karyawan);
        $this->db->where("a.tgl_absensi BETWEEN '$start_date' AND '$end_date'");
        $this->db->where('a.status', 'hadir');
        $this->db->order_by('a.tgl_absensi', 'ASC');

        return $this->db->get()->result();
    }

    public function get_all_karyawan()
    {
        $this->db->select('k.*, j.nama_jabatan, j.gaji_jabatan as gaji_per_hari');
        $this->db->from('tb_karyawan k');
        $this->db->join('tb_jabatan j', 'j.id = k.id_jabatan', 'left');
        $this->db->order_by('k.nm_karyawan', 'ASC');
        return $this->db->get()->result();
    }

    public function get_karyawan_by_id($id)
    {
        $this->db->select('k.*, j.nama_jabatan, j.gaji_jabatan as gaji_per_hari');
        $this->db->from('tb_karyawan k');
        $this->db->join('tb_jabatan j', 'j.id = k.id_jabatan', 'left');
        $this->db->where('k.id', $id);
        return $this->db->get()->row();
    }

    public function count_rekap_gaji_alternative($start_date, $end_date, $id_karyawan = null, $search = null)
    {
        $sql = "SELECT COUNT(DISTINCT k.id) as total
                FROM tb_karyawan k
                LEFT JOIN tb_jabatan j ON j.id = k.id_jabatan
                WHERE 1=1";

        $params = [];

        // Filter karyawan
        if (!empty($id_karyawan)) {
            $sql .= " AND k.id = ?";
            $params[] = $id_karyawan;
        }

        // Pencarian nama karyawan
        if (!empty($search)) {
            $sql .= " AND k.nm_karyawan LIKE ?";
            $params[] = "%$search%";
        }

        $result = $this->db->query($sql, $params)->row();
        return $result->total;
    }

    // Method untuk mendapatkan daftar jabatan (jika diperlukan)
    public function get_all_jabatan()
    {
        $this->db->select('*');
        $this->db->from('tb_jabatan');
        $this->db->order_by('nama_jabatan', 'ASC');
        return $this->db->get()->result();
    }

    public function hitung_rekap_individu($detail_absensi, $gaji_per_hari)
    {
        $total_hari_kerja = count($detail_absensi);
        $total_jam_lembur = 0;
        $total_hari_kurang_50 = 0;
        $total_hari_kurang_proporsional = 0;
        $total_jam_kurang_proporsional = 0;
        $total_hari_penuh = 0;

        foreach ($detail_absensi as $absensi) {
            $total_jam_lembur += $absensi->jam_lembur;

            // Kategorikan berdasarkan jam kerja
            if ($absensi->total_jam_kerja <= 5) {
                $total_hari_kurang_50++;
            } elseif ($absensi->total_jam_kerja > 5 && $absensi->total_jam_kerja < 10) {
                $total_hari_kurang_proporsional++;
                $total_jam_kurang_proporsional += $absensi->total_jam_kerja;
            } else {
                $total_hari_penuh++;
            }
        }

        // Hitung gaji dengan algoritma baru
        $gaji_hari_penuh = $total_hari_penuh * $gaji_per_hari;
        $gaji_hari_kurang_50 = $total_hari_kurang_50 * ($gaji_per_hari * 0.5); // 50% dari gaji harian
        $gaji_hari_kurang_proporsional = ($total_jam_kurang_proporsional / 10) * $gaji_per_hari; // Proporsional berdasarkan jam
        $gaji_pokok = $gaji_hari_penuh + $gaji_hari_kurang_50 + $gaji_hari_kurang_proporsional;
        $uang_lembur = $total_jam_lembur * 5000;
        $total_gaji = $gaji_pokok + $uang_lembur;

        return [
            'total_hari_kerja' => $total_hari_kerja,
            'total_hari_penuh' => $total_hari_penuh,
            'total_hari_kurang_50' => $total_hari_kurang_50,
            'total_hari_kurang_proporsional' => $total_hari_kurang_proporsional,
            'total_jam_kurang_proporsional' => round($total_jam_kurang_proporsional, 2),
            'total_jam_lembur' => round($total_jam_lembur, 2),
            'gaji_pokok' => $gaji_pokok,
            'gaji_hari_penuh' => $gaji_hari_penuh,
            'gaji_hari_kurang_50' => $gaji_hari_kurang_50,
            'gaji_hari_kurang_proporsional' => $gaji_hari_kurang_proporsional,
            'uang_lembur' => $uang_lembur,
            'total_gaji' => $total_gaji
        ];
    }
}