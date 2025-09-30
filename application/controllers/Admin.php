<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('error', 'You must login first');
            redirect('auth/login');
        }

        $this->load->model('Karyawan_model');
        $this->load->model('Jabatan_model');
        $this->load->model('Absensi_model');
        $this->load->model('SendEmail');
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
        // if ($this->session->userdata('logged_in')) {
        //     redirect('admin');
        // }
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
            case 'kode_karyawan': // Jika case kosong, tidak menggunakan prefix
                $prefix = '25';
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
            'pagination' => $this->pagination->create_links(),
            'jabatan' => $this->Jabatan_model->get_jabatan()
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
        log_message('debug', 'Data POST: ' . print_r($this->input->post(), true));
        $this->load->library('form_validation');

        // Set rules validasi untuk semua field
        $this->form_validation->set_rules('nm_karyawan', 'Nama Karyawan', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('alamat_ktp', 'Alamat KTP', 'required');
        $this->form_validation->set_rules('alamat_domisili', 'Alamat Domisili', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[L,P]');
        $this->form_validation->set_rules('kewarganegaraan', 'Kewarganegaraan', 'required|in_list[WNI,WNA]');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'required');
        $this->form_validation->set_rules('id_jabatan', 'id_jabatan', 'required');
        $this->form_validation->set_rules('telp', 'telp', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Kirim error per input field
            $errors = [
                'nm_karyawan' => form_error('nm_karyawan', '', ''),
                'email' => form_error('email', '', ''),
                'alamat_ktp' => form_error('alamat_ktp', '', ''),
                'alamat_domisili' => form_error('alamat_domisili', '', ''),
                'tempat_lahir' => form_error('tempat_lahir', '', ''),
                'tanggal_lahir' => form_error('tanggal_lahir', '', ''),
                'jenis_kelamin' => form_error('jenis_kelamin', '', ''),
                'kewarganegaraan' => form_error('kewarganegaraan', '', ''),
                'agama' => form_error('agama', '', ''),
                'pendidikan_terakhir' => form_error('pendidikan_terakhir', '', ''),
                'id_jabatan' => form_error('id_jabatan', '', ''),
                'telp' => form_error('telp', '', '')
            ];
            log_message('debug', 'Validation Errors: ' . print_r($errors, true));
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode(['status' => 'error', 'errors' => $errors]));
            return;
        }

        // Cek apakah email sudah digunakan
        $email = $this->input->post('email', true);
        if ($this->Karyawan_model->is_email_exist($email)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'errors' => ['email' => 'Email sudah digunakan.']
                ]));
            return;
        }

        // Generate UUID jika tidak disediakan
        $uuid = $this->input->post('uuid', true);
        if (empty($uuid)) {
            $uuid = $this->generate_uuid();
        } else if ($this->Karyawan_model->is_uuid_exist($uuid)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'errors' => ['uuid' => 'UUID sudah digunakan.']
                ]));
            return;
        }
        $kode_karyawan = $this->generate_kode_unik(5, 'kode_karyawan', 'tb_karyawan', 'kode_karyawan');

        // Siapkan data untuk disimpan
        $data = [
            'uuid' => $uuid,
            'nm_karyawan' => $this->input->post('nm_karyawan', true),
            'email' => $email,
            'kode_karyawan' => password_hash($kode_karyawan, PASSWORD_DEFAULT),
            'alamat_ktp' => $this->input->post('alamat_ktp', true),
            'alamat_domisili' => $this->input->post('alamat_domisili', true),
            'tempat_lahir' => $this->input->post('tempat_lahir', true),
            'tanggal_lahir' => $this->input->post('tanggal_lahir', true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
            'kewarganegaraan' => $this->input->post('kewarganegaraan', true),
            'agama' => $this->input->post('agama', true),
            'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir', true),
            'id_jabatan' => $this->input->post('id_jabatan', true),
            'telp' => $this->input->post('telp', true),
        ];

        if ($this->Karyawan_model->insert($data)) {
            $this->SendEmail->typeMessage(5, $email, $data['nm_karyawan'], ['kode' => $kode_karyawan]);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data ke database.']);
        }
    }

    // Fungsi untuk generate UUID
    private function generate_uuid()
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }

    public function edit_karyawan()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'required');
        $this->form_validation->set_rules('uuid', 'UUID', 'required');
        $this->form_validation->set_rules('nm_karyawan', 'Nama Karyawan', 'required|max_length[100]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|max_length[100]');
        $this->form_validation->set_rules('alamat_ktp', 'Alamat KTP', 'required|max_length[255]');
        $this->form_validation->set_rules('alamat_domisili', 'Alamat Domisili', 'required|max_length[255]');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|max_length[50]');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|in_list[L,P]');
        $this->form_validation->set_rules('kewarganegaraan', 'Kewarganegaraan', 'required|in_list[WNI,WNA]');
        $this->form_validation->set_rules('agama', 'Agama', 'required|in_list[Islam,Kristen,Katolik,Hindu,Buddha,Konghucu]');
        $this->form_validation->set_rules('pendidikan_terakhir', 'Pendidikan Terakhir', 'required|in_list[SD,SMP,SMA,SMK,S1,S2]');
        $this->form_validation->set_rules('id_jabatan', 'Jabatan', 'required|numeric');
        $this->form_validation->set_rules('telp', 'No. Telp', 'required|max_length[15]');

        if ($this->form_validation->run() === FALSE) {
            $errors = [];
            $fields = [
                'uuid',
                'nm_karyawan',
                'email',
                'alamat_ktp',
                'alamat_domisili',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'kewarganegaraan',
                'agama',
                'pendidikan_terakhir',
                'id_jabatan',
                'telp'
            ];

            foreach ($fields as $field) {
                if (form_error($field)) {
                    $errors[$field] = form_error($field, '', '');
                }
            }

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => 'error',
                    'errors' => $errors,
                    'message' => 'Validasi gagal'
                ]));
            return;
        }

        $id = $this->input->post('id', true);

        $data = [
            'uuid' => $this->input->post('uuid', true),
            'nm_karyawan' => $this->input->post('nm_karyawan', true),
            'email' => $this->input->post('email', true),
            'alamat_ktp' => $this->input->post('alamat_ktp', true),
            'alamat_domisili' => $this->input->post('alamat_domisili', true),
            'tempat_lahir' => $this->input->post('tempat_lahir', true),
            'tanggal_lahir' => $this->input->post('tanggal_lahir', true),
            'jenis_kelamin' => $this->input->post('jenis_kelamin', true),
            'kewarganegaraan' => $this->input->post('kewarganegaraan', true),
            'agama' => $this->input->post('agama', true),
            'pendidikan_terakhir' => $this->input->post('pendidikan_terakhir', true),
            'id_jabatan' => $this->input->post('id_jabatan', true),
            'telp' => $this->input->post('telp', true)
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


    public function data_absensi()
    {
        // Ambil parameter filter dari GET
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $karyawan_id = $this->input->get('karyawan');
        $status = $this->input->get('status');
        $search = $this->input->get('search');

        // Konfigurasi pagination
        $config['base_url'] = site_url('admin/data-absensi');
        $config['total_rows'] = $this->Absensi_model->count_all($start_date, $end_date, $karyawan_id, $status, $search);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['reuse_query_string'] = TRUE; // Penting untuk mempertahankan parameter GET

        // Styling Bootstrap 4
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

        // Ambil data sesuai halaman dan filter
        $start = $this->uri->segment(3) ?? 0;
        $title = "Data Absensi";
        $page = 'admin/pages/data_absensi_page';

        $page_data = [
            'data' => $this->Absensi_model->get_all(
                $config['per_page'],
                $start,
                $start_date,
                $end_date,
                $karyawan_id,
                $status,
                $search
            ),
            'karyawan_list' => $this->Karyawan_model->getKaryawan(),
            'pagination' => $this->pagination->create_links()
        ];

        $custom_js = $this->load->view('admin/template/scripts/dataAbsensiScripts', [], TRUE);
        return $this->render_view($title, $page, $page_data, $custom_js);
    }

}
