<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FormController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        $this->load->view('form_view');
    }

    public function proses()
    {
        $nama = $this->input->post('nama');

        if (!empty($nama)) {
            // Simpan data ke DB
            $this->User_model->insert_user($nama);
        }

        // Ambil semua data user
        $users = $this->User_model->get_all_users();

        // Generate tampilan tabel
        $output = "<table border='1' cellpadding='5' cellspacing='0'>
                    <tr><th>ID</th><th>Nama</th><th>Waktu</th></tr>";

        if (!empty($users)) {
            foreach ($users as $u) {
                $output .= "<tr>
                    <td>{$u->id}</td>
                    <td>" . htmlspecialchars($u->nama) . "</td>
                    <td>{$u->created_at}</td>
                </tr>";
            }
        } else {
            $output .= "<tr><td colspan='3'>Belum ada data</td></tr>";
        }

        $output .= "</table>";

        echo $output;
    }
}
