<?php
class Penggajian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Penggajian_model');
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
        // Ambil parameter filter dengan nilai default
        $start_date = $this->input->get('start_date') ?: date('Y-m-01');
        $end_date = $this->input->get('end_date') ?: date('Y-m-t');
        $id_karyawan = $this->input->get('karyawan') ?: '';
        $search = $this->input->get('search') ?: '';

        // Konfigurasi pagination
        $config['base_url'] = site_url('admin/penggajian');
        $config['total_rows'] = $this->Penggajian_model->count_rekap_gaji_alternative($start_date, $end_date, $id_karyawan, $search);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['reuse_query_string'] = TRUE;

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

        $title = "Rekap Penggajian Karyawan";
        $page = 'admin/pages/penggajian_page';

        // Dapatkan data karyawan untuk dropdown
        $karyawan_list = $this->Penggajian_model->get_all_karyawan();

        // Dapatkan data rekap gaji dengan algoritma baru
        $data_rekap = $this->Penggajian_model->get_rekap_gaji_alternative(
            $start_date,
            $end_date,
            $id_karyawan,
            $config['per_page'],
            $start,
            $search
        );

        // Hitung total keseluruhan dengan algoritma baru
        $total_keseluruhan = $this->hitung_total_keseluruhan($data_rekap);

        $page_data = [
            'start_date' => $start_date,
            'end_date' => $end_date,
            'id_karyawan' => $id_karyawan,
            'search' => $search,
            'karyawan_list' => $karyawan_list,
            'data_rekap' => $data_rekap,
            'pagination' => $this->pagination->create_links(),
            'total_keseluruhan' => $total_keseluruhan
        ];

        $custom_js = $this->load->view('admin/template/scripts/penggajianScripts', [], TRUE);
        return $this->render_view($title, $page, $page_data, $custom_js);
    }

    private function hitung_total_keseluruhan($data_rekap)
    {
        $total = [
            'total_gaji_pokok' => 0,
            'total_uang_lembur' => 0,
            'total_keseluruhan' => 0,
            'total_hari_penuh' => 0,
            'total_hari_kurang' => 0
        ];

        if (!empty($data_rekap)) {
            foreach ($data_rekap as $rekap) {
                $total['total_gaji_pokok'] += $rekap->gaji_pokok;
                $total['total_uang_lembur'] += $rekap->uang_lembur;
                $total['total_keseluruhan'] += $rekap->total_gaji;
                $total['total_hari_penuh'] += $rekap->total_hari_penuh;
                $total['total_hari_kurang'] += $rekap->total_hari_kurang;
            }
        }

        return $total;
    }

    public function detail_karyawan($id_karyawan)
    {
        // Ambil parameter dengan nilai default
        $start_date = $this->input->get('start_date') ?: date('Y-m-01');
        $end_date = $this->input->get('end_date') ?: date('Y-m-t');

        $karyawan = $this->Penggajian_model->get_karyawan_by_id($id_karyawan);

        if (!$karyawan) {
            show_404();
        }

        $detail_absensi = $this->Penggajian_model->get_detail_absensi_karyawan($id_karyawan, $start_date, $end_date);

        $title = "Detail Gaji - " . $karyawan->nm_karyawan;
        $page = 'admin/pages/detail_gaji_page';

        // Gunakan method hitung_rekap_individu dari Model yang sudah diperbarui
        $page_data = [
            'karyawan' => $karyawan,
            'detail_absensi' => $detail_absensi,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'rekap' => $this->Penggajian_model->hitung_rekap_individu($detail_absensi, $karyawan->gaji_per_hari)
        ];

        return $this->render_view($title, $page, $page_data, null);
    }

    public function cetak_slip($id_karyawan)
    {
        $start_date = $this->input->get('start_date') ?: date('Y-m-01');
        $end_date = $this->input->get('end_date') ?: date('Y-m-t');

        $karyawan = $this->Penggajian_model->get_karyawan_by_id($id_karyawan);

        if (!$karyawan) {
            show_404();
        }

        $detail_absensi = $this->Penggajian_model->get_detail_absensi_karyawan($id_karyawan, $start_date, $end_date);

        // Gunakan method hitung_rekap_individu dari Model yang sudah diperbarui
        $rekap = $this->Penggajian_model->hitung_rekap_individu($detail_absensi, $karyawan->gaji_per_hari);

        $data = [
            'karyawan' => $karyawan,
            'rekap' => $rekap,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'detail_absensi' => $detail_absensi
        ];

        $this->load->view('admin/pages/cetak_slip_gaji', $data);
    }

    public function cetak_rekap_all()
    {
        $start_date = $this->input->get('start_date') ?: date('Y-m-01');
        $end_date = $this->input->get('end_date') ?: date('Y-m-t');
        $id_karyawan = $this->input->get('karyawan') ?: '';
        $search = $this->input->get('search') ?: '';

        $data_rekap = $this->Penggajian_model->get_rekap_gaji_alternative($start_date, $end_date, $id_karyawan, null, null, $search);
        $total_keseluruhan = $this->hitung_total_keseluruhan($data_rekap);

        $data = [
            'data_rekap' => $data_rekap,
            'total_keseluruhan' => $total_keseluruhan,
            'start_date' => $start_date,
            'end_date' => $end_date
        ];

        $this->load->view('admin/pages/cetak_rekap_all', $data);
    }
}