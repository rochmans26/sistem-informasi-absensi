<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SendEmail extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('email');
    }

    private function configureEmail()
    {
        $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'shylouproject.official@gmail.com',
            'smtp_pass' => 'fijw tkrt otrr mgnw',
            'smtp_port' => 587,
            'smtp_crypto' => 'tls',
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            'newline' => "\r\n"
        ];
        return $config;
    }

    public function sendMessage($subject, $message, $receipt)
    {

        $this->email->initialize($this->configureEmail());

        // Set pengirim, penerima, dan isi email
        $this->email->from('shylouproject.official@gmail.com', 'Crepes Susu Lembang Factory');
        $this->email->to($receipt);
        $this->email->subject($subject);
        $this->email->message($message);

        // Kirim email
        if ($this->email->send()) {
            return json_encode('Email berhasil dikirim.');
        } else {
            return json_encode('Email gagal dikirim.');
            // echo $this->email->print_debugger(); // Untuk debugging
        }
    }

    private function templateMessage($messagetype)
    {
        $message = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .email-header {
            background-color: #007BFF;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }
        .email-body {
            padding: 20px;
            color: #333333;
            line-height: 1.6;
        }
        .email-footer {
            background-color: #f4f4f4;
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #888888;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            background-color: #007BFF;
            color: #ffffff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    ' . $messagetype . '
</body>
</html>
';
        return $message;

    }

    public function typeMessage($type, $email = "", $name = "", $data = [])
    {
        switch ($type) {
            case 1: // Type konfirmasi
                $this->type_confirmation($email, $name, $data);
                break;

            case 2: // Type ubah password
                $this->type_change_password();
                break;

            case 3: // Type reporting
                $this->type_reporting();
                break;
            case 5: // Type reporting
                $this->type_sendpw($email, $name, $data);
                break;
            case 4: // Type reporting
                $this->type_sendpwUser($email, $name, $data);
                break;

            default:
                show_404(); // Jika type tidak dikenal
                break;
        }
    }

    private function type_sendpw($email, $name, $data)
    {
        $confMessage = '
        <div class="email-container" style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
            <div class="email-header" style="background: #f4f4f4; padding: 20px; text-align: center;">
                <h1 style="color: #555;">Halo, ' . htmlspecialchars($name) . '!</h1>
            </div>
            <div class="email-body" style="padding: 20px;">
                <p>Terima kasih telah bergabung dengan kami. Kami sangat senang bisa menyambut Anda di perusahaan kami.</p>
                <p>Berikut Kode Karyawan Anda:</p>
                <p style="text-align: center;">
                    <a href="#" style="display: inline-block; padding: 10px 20px; background: #28a745; color: #fff; text-decoration: none; border-radius: 5px;">' . htmlspecialchars($data['kode']) . '</a>
                </p>
                <p>Silahkan hubungi Technical Support, jika butuh bantuan!</p>
                <p>Salam hangat,</p>
                <p><strong>Crepes Semprong Susu Lembang Factory</strong></p>
            </div>
            <div class="email-footer" style="background: #f4f4f4; padding: 10px; text-align: center;">
                <p>&copy; 2025 Crepes Semprong Susu Lembang Factory. All rights reserved.</p>
            </div>
        </div>';
        $message = $this->templateMessage($confMessage);
        return $this->sendMessage('Crepes Semprong Susu Lembang Factory | no-reply', $message, $email);
    }
    private function type_sendpwUser($email, $name, $data)
    {
        $confMessage = '
        <div class="email-container" style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
            <div class="email-header" style="background: #f4f4f4; padding: 20px; text-align: center;">
                <h1 style="color: #555;">Halo, ' . htmlspecialchars($name) . '!</h1>
            </div>
            <div class="email-body" style="padding: 20px;">
                <p>Terima kasih telah bergabung dengan kami. Kami sangat senang bisa menyambut Anda di perusahaan kami.</p>
                <p>Berikut Password Administrator Anda:</p>
                <p style="text-align: center;">
                    <a href="#" style="display: inline-block; padding: 10px 20px; background: #28a745; color: #fff; text-decoration: none; border-radius: 5px;">' . htmlspecialchars($data['password']) . '</a>
                </p>
                <p>Silahkan hubungi Technical Support, jika butuh bantuan!</p>
                <p>Salam hangat,</p>
                <p><strong>Crepes Semprong Susu Lembang Factory</strong></p>
            </div>
            <div class="email-footer" style="background: #f4f4f4; padding: 10px; text-align: center;">
                <p>&copy; 2025 Crepes Semprong Susu Lembang Factory. All rights reserved.</p>
            </div>
        </div>';
        $message = $this->templateMessage($confMessage);
        return $this->sendMessage('Crepes Semprong Susu Lembang Factory | no-reply', $message, $email);
    }

    // Method untuk konfirmasi
    private function type_confirmation($email, $username, $link)
    {

        $confMessage = '
        <div class="email-container" style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
            <div class="email-header" style="background: #f4f4f4; padding: 20px; text-align: center;">
                <h1 style="color: #555;">Halo, ' . htmlspecialchars($username) . '!</h1>
            </div>
            <div class="email-body" style="padding: 20px;">
                <p>Terima kasih telah bergabung dengan kami. Kami sangat senang bisa menyambut Anda di komunitas kami.</p>
                <p>Silakan klik tombol di bawah ini untuk mengonfirmasi akun Anda:</p>
                <p style="text-align: center;">
                    <a href="' . htmlspecialchars($link) . '" style="display: inline-block; padding: 10px 20px; background: #28a745; color: #fff; text-decoration: none; border-radius: 5px;">Konfirmasi Akun</a>
                </p>
                <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami. Kami siap membantu!</p>
                <p>Salam hangat,</p>
                <p><strong>Boehajj-Tools</strong></p>
            </div>
            <div class="email-footer" style="background: #f4f4f4; padding: 10px; text-align: center;">
                <p>&copy; 2024 Boehajj-Tools. All rights reserved.</p>
            </div>
        </div>';

        // Proses template
        $message = $this->templateMessage($confMessage);

        // Kirim email
        return $this->sendMessage('Boehajj-Tools | Konfirmasi Akun', $message, $email);
    }


    // Method untuk ubah password
    private function type_change_password()
    {
        // Logika untuk ubah password
        echo "Proses ubah password dilakukan.";
        // Contoh: validasi password baru dan update ke database
    }

    // Method untuk reporting
    private function type_reporting()
    {
        // Logika untuk reporting
        echo "Proses pelaporan dilakukan.";
        // Contoh: ambil data dari database dan tampilkan laporan
    }

    private function type_history_checkup($email, $name, $data)
    {
        $confMessage = '
        <div class="email-container" style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
            <div class="email-header" style="background: #f4f4f4; padding: 20px; text-align: center;">
                <h1 style="color: #555;">Halo, ' . htmlspecialchars($name) . '!</h1>
            </div>
            <div class="email-body" style="padding: 20px;">
                <p>Terima kasih telah menggunakan aplikasi kami. Kami sangat senang bisa menyambut Anda di komunitas kami.</p>
                <p>Kami akan menginformasikan hasil Checkup Anda melalui aplikasi kami Obscu-App.</p>
                <ul>
                <li>Tanggal Check Up : ' . $data['data']['tanggal_checkup'] . '</li>
                <li>Nama Anda : ' . $name . '</li>
                <li>Usia Anda : ' . $data['data']['usia'] . '</li>
                <li>Hasil Check Up : ' . $data['data']['hasil'] . '</li>
                </ul>
                <p>Silakan klik tombol di bawah ini untuk melihat detail check up:</p>
                <p style="text-align: center;">
                    <a href="' . htmlspecialchars($data['data']['link']) . '" style="display: inline-block; padding: 10px 20px; background: #28a745; color: #fff; text-decoration: none; border-radius: 5px;" target="_blank">Buka Hasil</a>
                </p>
                <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami. Kami siap membantu!</p>
                <p>Salam hangat,</p>
                <p><strong>Obscu-App</strong></p>
            </div>
            <div class="email-footer" style="background: #f4f4f4; padding: 10px; text-align: center;">
                <p>&copy; 2024 Obscu-App. All rights reserved.</p>
            </div>
        </div>';

        // Proses template
        $message = $this->templateMessage($confMessage);

        // Kirim email
        return $this->sendMessage('Obscu-App | Hasil Check Up', $message, $email);
    }

    public function test()
    {
        return "Test";
    }
}
