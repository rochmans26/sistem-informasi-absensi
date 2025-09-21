<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->model('Absensi_model');
        $this->load->model('Karyawan_model');
    }
    public function index()
    {
        $data['karyawan'] = $this->Karyawan_model->getKaryawan();
        $this->load->view('index', $data);
    }
    public function proses()
    {
        $id_karyawan = $this->input->post('id_karyawan');
        $kode_karyawan = $this->input->post('kode_karyawan');
        $foto = $this->input->post('foto');

        // Jika request hanya untuk load data (tanpa submit)
        $action = $this->input->post('action');
        if ($action === 'load_data') {
            $this->load_absensi_data();
            return;
        }

        // Validasi input
        if (empty($id_karyawan) || empty($kode_karyawan) || empty($foto)) {
            echo "ERROR: Data tidak lengkap!";
            return;
        }

        // Verifikasi kode karyawan
        if (!$this->Absensi_model->verify_password($id_karyawan, $kode_karyawan)) {
            echo "ERROR: Kode Karyawan salah! Absensi gagal.";
            return;
        }

        // Proses foto
        $image_parts = explode(";base64,", $foto);
        if (count($image_parts) < 2) {
            echo "ERROR: Format foto tidak valid!";
            return;
        }

        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        $filePath = FCPATH . 'uploads/' . $fileName;

        // Pastikan folder uploads ada
        if (!is_dir(FCPATH . 'uploads/')) {
            mkdir(FCPATH . 'uploads/', 0777, true);
        }

        if (file_put_contents($filePath, $image_base64) === false) {
            echo "ERROR: Gagal menyimpan foto!";
            return;
        }

        // Proses absensi
        $absensi_today = $this->Absensi_model->get_absensi_today($id_karyawan);

        if ($absensi_today) {
            if (empty($absensi_today->jam_keluar)) {
                $this->Absensi_model->absen_keluar($absensi_today->id, $fileName);
                $status = "KELUAR";
            } else {
                echo "ERROR: Anda sudah melakukan absensi masuk dan keluar hari ini.";
                return;
            }
        } else {
            $this->Absensi_model->absen_masuk($id_karyawan, $fileName);
            $status = "MASUK";
        }

        // Berikan respons sukses dengan status
        echo "SUCCESS:" . $status . "|";
        $this->load_absensi_data();
    }

    // Fungsi terpisah untuk memuat data absensi
    private function load_absensi_data()
    {
        // Ambil data absen today
        $absen = $this->Absensi_model->get_today_absensi();

        // Generate tampilan tabel
        $output = "<table class=\"table table-striped\">
        <thead>
            <tr>
                <th scope=\"col\">#</th>
                <th scope=\"col\">Tanggal</th>
                <th scope=\"col\">ID Karyawan</th>
                <th scope=\"col\">Nama</th>
                <th scope=\"col\">Jam Masuk</th>
                <th scope=\"col\">Jam Keluar</th>
                <th scope=\"col\">Status</th>
            </tr>
        </thead>
        <tbody>";

        if (!empty($absen)) {
            $no = 1;
            foreach ($absen as $u) {
                $status = (!empty($u->jam_masuk) && !empty($u->jam_keluar)) ?
                    '<span class="badge bg-success">Lengkap</span>' :
                    '<span class="badge bg-warning">Masuk</span>';

                $output .= "<tr>
                <td>{$no}</td>
                <td>" . htmlspecialchars($u->tgl_absensi) . "</td>
                <td>" . htmlspecialchars($u->uuid) . "</td>
                <td>" . htmlspecialchars($u->nm_karyawan) . "</td>
                <td>" . htmlspecialchars($u->jam_masuk) . "</td>
                <td>" . ($u->jam_keluar ?: '-') . "</td>
                <td>{$status}</td>
            </tr>";
                $no++;
            }
        } else {
            $output .= "<tr><td colspan='7' class='text-center'>Belum ada data absensi hari ini</td></tr>";
        }

        $output .= "</tbody></table>";
        echo $output;
    }
    public function save_capture()
    {
        // Mendapatkan data gambar base64 dari input
        $image_data = $this->input->post('image_data');

        // Menghapus "data:image/png;base64," dari string
        $image_data = str_replace('data:image/png;base64,', '', $image_data);
        $image_data = str_replace(' ', '+', $image_data);

        // Dekode data base64 menjadi binary
        $image_binary = base64_decode($image_data);

        // Menyimpan file gambar
        $file_name = 'capture_' . time() . '.png';
        $file_path = 'assets/img/absensi' . $file_name;

        // Simpan file gambar ke server
        file_put_contents($file_path, $image_binary);

        // Beri respons
        if (file_exists($file_path)) {
            echo "Gambar berhasil disimpan sebagai: " . $file_name;
        } else {
            echo "Gagal menyimpan gambar.";
        }
    }
}
