<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Karyawan_model');
        $this->load->model('Jabatan_model');
        $this->load->model('Absensi_model');
        $this->load->library('form_validation');
    }
    public function render_view($title, $page, $page_data = [], $custom_js = [])
    {
        $partials = [
            'header' => $this->load->view('admin/template/header', ['title' => $title], TRUE),
            'footer' => $this->load->view('admin/template/footer', [], TRUE),
            'content_pages' => $this->load->view($page, ['data' => $page_data], TRUE),
            'sidebar' => $this->load->view('admin/template/sidebar', [], TRUE),
            'navbar' => $this->load->view('admin/template/navbar', [], TRUE),
            'custom_js' => $custom_js,
            'title' => $title
        ];
        $this->load->view('admin/main', $partials);
    }
    public function index()
    {
        $title = "Dashboard";
        $page = 'admin/pages/blank';
        $page_data = [];
        $custom_js = $this->load->view('admin/template/scripts/dashboardScripts', [], TRUE);
        return $this->render_view($title, $page, $page_data, $custom_js);
    }

    private function generate_kode_unik($panjang = 8, $case = '', $table = '', $column = '')
    {
        // Validasi parameter wajib
        if (empty($table) || empty($column)) {
            throw new Exception('Parameter table dan column wajib diisi');
        }

        $prefix = '';
        switch ($case) {
            case 'jabatan':
                $prefix = 'JB';
                break;
            case 'uuid':
                $prefix = 'KCSL-';
                break;
            case '': // Jika case kosong, tidak menggunakan prefix
                $prefix = '';
                break;
            default:
                throw new Exception('Case tidak dikenali: ' . $case);
        }

        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $maxAttempts = 100;
        $attempts = 0;

        do {
            $randomBytes = random_bytes($panjang);
            $kode = $prefix;

            for ($i = 0; $i < $panjang; $i++) {
                $kode .= $characters[ord($randomBytes[$i]) % $charactersLength];
            }

            // Cek di database
            $this->db->where($column, $kode);
            $query = $this->db->get($table);

            $attempts++;

            if ($attempts > $maxAttempts) {
                throw new Exception('Gagal menghasilkan kode unik setelah ' . $maxAttempts . ' percobaan');
            }

        } while ($query->num_rows() > 0);

        return $kode;
    }

    public function data_karyawan()
    {
        // Konfigurasi pagination
        $config['base_url'] = site_url('admin/data-karyawan'); // URL untuk halaman
        $config['total_rows'] = $this->Karyawan_model->count_all(); // Total data
        $config['per_page'] = 10; // Data per halaman
        $config['uri_segment'] = 3;

        // Tambahan styling Bootstrap 4 (SB Admin 2)
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = ['class' => 'page-link'];

        $this->pagination->initialize($config);

        // Ambil data sesuai halaman
        $start = $this->uri->segment(3) ?? 0;
        $title = "Data Karyawan";
        $page = 'admin/pages/data_karyawan_page';
        $page_data = [
            'data' => $this->Karyawan_model->get_all($config['per_page'], $start),
            'pagination' => $this->pagination->create_links()
        ];
        $custom_js = $this->load->view('admin/template/scripts/dataKaryawanScripts', [], TRUE);
        return $this->render_view($title, $page, $page_data, $custom_js);

        // $title = "Data Karyawan";
        // $page = 'admin/pages/data_karyawan_page';
        // $page_data = $this->Karyawan_model->get_all();
        // $custom_js = $this->load->view('admin/template/scripts/dataKaryawanScripts', [], TRUE);
        // return $this->render_view($title, $page, $page_data, $custom_js);
    }
    public function tambah_karyawan()
    {
        $this->load->library('form_validation');

        // Set rules validasi
        $this->form_validation->set_rules('uuid', 'UUID', 'required');
        $this->form_validation->set_rules('nm_karyawan', 'Nama Karyawan', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Kirim error per input field
            $errors = [
                'uuid' => form_error('uuid', '', ''),
                'nm_karyawan' => form_error('nm_karyawan', '', '')
            ];

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'errors' => $errors]));
            return;
        }

        // Cek apakah UUID sudah digunakan
        $uuid = $this->input->post('uuid', true);
        if ($this->Karyawan_model->is_uuid_exist($uuid)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'errors' => ['uuid' => 'UUID sudah digunakan.']
                ]));
            return;
        }

        $nama = $this->input->post('nm_karyawan', true);

        // Siapkan data
        $data = [
            'uuid' => $uuid,
            'nm_karyawan' => $nama
        ];

        if ($this->Karyawan_model->insert($data) == true) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data ke database.']);
        }

        // Simpan ke database
        // if ($this->Karyawan_model->insert($data)) {
        //     $this->output
        //         ->set_content_type('application/json')
        //         ->set_output(json_encode([
        //             'status' => 'success',
        //             'message' => 'Data karyawan berhasil disimpan.'
        //         ]));
        //     // Menjadi:
        //     // header('Content-Type: application/json');
        //     // echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan.']);
        //     // exit;
        // } else {
        //     $this->output
        //         ->set_content_type('application/json')
        //         ->set_output(json_encode([
        //             'status' => 'error',
        //             'message' => 'Gagal menyimpan data ke database.'
        //         ]));
        // }
    }

    public function edit_karyawan()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('uuid', 'UUID', 'required');
        $this->form_validation->set_rules('nm_karyawan', 'Nama Karyawan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $errors = [
                'uuid' => form_error('uuid', '', ''),
                'nm_karyawan' => form_error('nm_karyawan', '', '')
            ];

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'errors' => $errors]));
            return;
        }

        $id = $this->input->post('id', true);
        $uuid = $this->input->post('uuid', true);
        $nama = $this->input->post('nm_karyawan', true);

        $data = [
            'uuid' => $uuid,
            'nm_karyawan' => $nama
        ];

        if ($this->Karyawan_model->update($id, $data)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'success',
                    'message' => 'Data karyawan berhasil diupdate.'
                ]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Gagal mengupdate data.'
                ]));
        }
    }
    // public function edit_karyawan()
    // {
    //     $id = $this->input->post('id');
    //     // Set rules validasi
    //     $this->form_validation->set_rules('uuid', 'UUID', 'required');
    //     $this->form_validation->set_rules('nm_karyawan', 'Nama Karyawan', 'required');

    //     if ($this->form_validation->run() == FALSE) {
    //         echo json_encode([
    //             'status' => 'error',
    //             'errors' => $this->form_validation->error_array()
    //         ]);
    //         return;
    //     }

    //     $nama = $this->input->post('nm_karyawan', true);

    //     // Siapkan data
    //     $data = [
    //         'uuid' => $this->input->post('uuid', true),
    //         'nm_karyawan' => $nama
    //     ];

    //     // Simpan ke database
    //     if ($this->Karyawan_model->update($id, $data)) {
    //         echo json_encode(['status' => 'success']);
    //     } else {
    //         echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data ke database.']);
    //     }
    // }

    public function hapus_karyawan()
    {
        $id = $this->input->post('id');

        if (!$id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID tidak ditemukan.'
            ]);
            return;
        }

        // Contoh: gunakan model untuk hapus
        $deleted = $this->Karyawan_model->delete($id);

        if ($deleted) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil dihapus.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menghapus data.'
            ]);
        }
    }
    public function data_absensi()
    {
        $title = "Data Absensi";
        $page = 'admin/pages/blank';
        $page_data = [];
        $custom_js = $this->load->view('admin/template/scripts/dashboardScripts', [], TRUE);
        return $this->render_view($title, $page, $page_data, $custom_js);
    }


    // Kelola Jabatan
    public function data_jabatan()
    {
        $config['base_url'] = site_url('admin/data-jabatan'); // URL untuk halaman
        $config['total_rows'] = $this->Jabatan_model->count_all(); // Total data
        $config['per_page'] = 10; // Data per halaman
        $config['uri_segment'] = 3;

        // Tambahan styling Bootstrap 4 (SB Admin 2)
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-end">';
        $config['full_tag_close'] = '</ul></nav>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '</span></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = ['class' => 'page-link'];

        $this->pagination->initialize($config);

        // Ambil data sesuai halaman
        $start = $this->uri->segment(3) ?? 0;
        $title = "Data Jabatan";
        $page = 'admin/pages/data_jabatan_page';
        $page_data = [
            'data' => $this->Jabatan_model->get_all($config['per_page'], $start),
            'pagination' => $this->pagination->create_links()
        ];
        $custom_js = $this->load->view('admin/template/scripts/dataJabatanScripts', [], TRUE);
        return $this->render_view($title, $page, $page_data, $custom_js);
    }

    public function tambah_jabatan()
    {
        $this->load->library('form_validation');

        // Set rules validasi
        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');
        $this->form_validation->set_rules('gaji_jabatan', 'Gaji Jabatan', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Kirim error per input field
            $errors = [
                'nama_jabatan' => form_error('nama_jabatan', '', ''),
                'gaji_jabatan' => form_error('gaji_jabatan', '', '')
            ];

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'errors' => $errors]));
            return;
        }

        // Cek apakah UUID sudah digunakan
        $kode_jabatan = $this->generate_kode_unik(8, 'jabatan', 'tb_jabatan', 'kode_jabatan');

        $nama_jabatan = $this->input->post('nama_jabatan', true);
        $gaji_jabatan = $this->input->post('gaji_jabatan', true);

        // Siapkan data
        $data = [
            'kode_jabatan' => $kode_jabatan,
            'nama_jabatan' => $nama_jabatan,
            'gaji_jabatan' => $gaji_jabatan
        ];

        if ($this->Jabatan_model->insert($data) == true) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data ke database.']);
        }


    }

    public function edit_jabatan()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->load->library('form_validation');

        // Set rules validasi
        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');
        $this->form_validation->set_rules('gaji_jabatan', 'Gaji Jabatan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $errors = [
                'nama_jabatan' => form_error('Nama Jabatan', '', ''),
                'gaji_jabatan' => form_error('Gaji Jabatan', '', '')
            ];

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'errors' => $errors]));
            return;
        }

        $id = $this->input->post('id', true);
        $nama_jabatan = $this->input->post('nama_jabatan', true);
        $gaji_jabatan = $this->input->post('gaji_jabatan', true);

        $data = [
            'nama_jabatan' => $nama_jabatan,
            'gaji_jabatan' => $gaji_jabatan
        ];

        if ($this->Jabatan_model->update($id, $data)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'success',
                    'message' => 'Data Jabatan berhasil diupdate.'
                ]));
        } else {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'message' => 'Gagal mengupdate data.'
                ]));
        }
    }

    public function hapus_jabatan()
    {
        $id = $this->input->post('id');

        if (!$id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'ID tidak ditemukan.'
            ]);
            return;
        }

        // Contoh: gunakan model untuk hapus
        $deleted = $this->Jabatan_model->delete($id);

        if ($deleted) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil dihapus.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Gagal menghapus data.'
            ]);
        }
    }
}
