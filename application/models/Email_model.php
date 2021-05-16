<?php

class Email_model extends CI_Model
{

    protected $config = [
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_user' => 'rizkyweb121@gmail.com',
        'smtp_pass' => 'hackgulink121',
        'smtp_port' => 465,
        'mailtype' =>  'html',
        'charset' => 'utf-8',
        'newline' => "\r\n"
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->library('email', $this->config);
        $this->email->initialize($this->config);
        $this->email->from('rizkyweb121@gmail.com', 'Muhamad Rizki');
    }


    public function send_email_verification($token, $data, $nis)
    {
        $this->email->to($data['email']);
        $this->email->subject('Verifikasi Akun');
        $message = 'Klik link ini untuk verifikasi akun anda : <a href="' . base_url('auth/verify_account?') . 'email=' . $data['email'] . '&token=' . urlencode($token) . '&nis=' . $nis . '">Aktifasi</a>';
        $this->email->message($message);

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function send_email_forgot_password($token, $email)
    {
        $this->email->to($email);
        $this->email->subject('Reset Password');
        $message = 'Klik link ini untuk reset password : <a href="' . base_url('auth/verify_forgot_password?email=') . $email . '&token=' . urlencode($token) . '">Reset Password</a>';
        $this->email->message($message);

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }
}
