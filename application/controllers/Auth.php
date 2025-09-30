<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); // Ini wajib dipanggil!


        $this->load->library('form_validation');
        // $this->load->model('Admin_model');
        $this->load->model('User_model');
        $this->load->model('SendEmail');
    }

    // public function index()
    // {
    //     $data['title'] = 'Login';
    //     $this->load->view('admin/auth/template/header', $data);
    //     $this->load->view('admin/auth/login');
    //     $this->load->view('admin/auth/template/footer');
    // }

    public function login()
    {
        // echo 'Test';
        // if ($this->session->userdata('logged_in')) {
        //     redirect('admin');
        // }

        $data['title'] = 'Login';

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/auth/template/header', $data);
            $this->load->view('admin/auth/login');
            $this->load->view('admin/auth/template/footer');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $admin = $this->User_model->login($username, $password);
            $dataAdmin = $this->User_model->get_dataUser($admin->username);

            if ($admin) {
                $user_data = array(
                    'admin_id' => $admin->id,
                    'username' => $admin->username,
                    'profil' => $dataAdmin,
                    'logged_in' => true
                );

                $this->session->set_userdata($user_data);
                $this->session->set_flashdata('success', 'Login successful!');
                redirect('admin');
            } else {
                $this->session->set_flashdata('error', 'Invalid username or password');
                redirect('auth/login');
            }
        }
    }

    // Register method
    public function register()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('admin/dashboard');
        }
        $data['title'] = 'Register';

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[tb_users.email]');
        $this->form_validation->set_rules('sex', 'Sex', 'required');
        $this->form_validation->set_rules('age', 'Age', 'required|numeric');
        $this->form_validation->set_rules('telp', 'Nomor Telepon', 'required|numeric|min_length[6]');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[6]|is_unique[tb_admin.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('password_confirm', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/auth/template/header', $data);
            $this->load->view('admin/auth/register');
            $this->load->view('admin/auth/template/footer');
        } else {
            $dataToUser = array(
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'sex' => $this->input->post('sex'),
                'age' => $this->input->post('age'),
                'telp' => $this->input->post('telp'),
                'is_admin' => 1
            );
            $dataToAdmin = array(
                'email_admin' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );


            if ($this->Admin_model->register($dataToAdmin) && $this->Users_model->addUser($dataToUser)) {
                $this->session->set_flashdata('success', 'Registration successful! Please login.');
                redirect('admin/login');
            } else {
                $this->session->set_flashdata('error', 'Registration failed. Please try again.');
                redirect('admin/register');
            }
        }
    }

    // Logout method
    public function logout()
    {
        $this->session->set_flashdata('success', 'You have been logged out.');
        $this->session->sess_destroy();

        redirect('auth/login');
    }

    public function add()
    {

        $username = 'admin';
        $password = 'admin$3mpr0ng';
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $email = 'achmadzacki11@gmail.com';
        $data = [
            'username' => $username,
            'password' => $password_hash,
            'email' => $email,
            'name' => 'Ahmad Zacki Alamsyah'
        ];

        $addUser = $this->User_model->insert($data);
        if ($addUser) {
            $this->SendEmail->typeMessage(4, $email, $data['name'], ['password' => $password]);
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data ke database.']);
        }
        redirect('auth/login');
    }
}