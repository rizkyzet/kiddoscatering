<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        is_logged_in();
    }

    // login
    public function index()
    {

        $this->form_validation->set_rules('id', 'ID', 'required', ['required' => 'id harus diisi!']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Password harus diisi!']);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_stisla/header');
            $this->load->view('auth/form_login');
            $this->load->view('templates_stisla/footer');
        } else {
            $id = $this->input->post('id');
            $password = $this->input->post('password');
            $employee = $this->db->get_where('user', ['email' => $id])->row_array();
            $siswa = $this->db->get_where('siswa', ['nis' => $id])->row_array();

            if ($siswa) {
                // siswa
                if (password_verify($password, $siswa['password'])) {
                    $data_session = [
                        'nis' => $siswa['nis'],
                        'role_id' => 2,
                    ];

                    $this->session->set_userdata($data_session);
                    redirect('pelanggan/dashboard');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password salah!
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>');
                    redirect('auth');
                }
            } elseif ($employee) {
                if (password_verify($password, $employee['password'])) {
                    // admin
                    if ($employee['role_id'] == 1) {
                        $data_session = [
                            'email' => $employee['email'],
                            'role_id' => $employee['role_id']
                        ];

                        $this->session->set_userdata($data_session);
                        redirect('admin/dashboard');
                    } elseif ($employee['role_id'] == 7) {
                        $data_session = [
                            'email' => $employee['email'],
                            'role_id' => $employee['role_id']
                        ];
                        $this->session->set_userdata($data_session);
                        redirect('pemilik/dashboard');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password salah!
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Akun tidak ditemukan!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
                redirect('auth');
            }

            die;
            // salah
            $email = $this->input->post('id');
            $password = $this->input->post('password');
            $user = $this->Auth_model->cek_login($email);

            if ($user) {
                if ($user['aktif'] == 1) {
                    if (password_verify($password, $user['password'])) {
                        if ($user['role_id'] == 1) {
                            $data_session = [
                                'email' => $user['email'],
                                'role_id' => $user['role_id']

                            ];

                            $this->session->set_userdata($data_session);
                            redirect('admin/dashboard');
                        } elseif ($user['role_id'] == 2) {
                            $account_id = $user['id'];
                            $siswa_user = $this->Siswa_model->get_specific_siswa(['account_id' => $account_id]);

                            $data_session = [
                                'email' => $user['email'],
                                'role_id' => $user['role_id'],
                                'nis' => $siswa_user['nis']
                            ];

                            $this->session->set_userdata($data_session);
                            redirect('pelanggan/dashboard');
                        }
                    } else {
                        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Password salah!
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                         </button>
                       </div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Akun anda belum aktif!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Anda belum terdaftar!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
                redirect('auth');
            }
        }
    }

    // register
    public function register()
    {
        is_logged_in();
        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $no_hp = $this->input->post('no_hp');
        $nis = $this->input->post('nis');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', ['required' => 'Nama harus diisi!']);
        $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user.email]', ['required' => 'Email harus diisi!', 'is_unique' => 'Email sudah terdaftar!']);
        $this->form_validation->set_rules('no_hp', 'No. Handphone', 'required|trim', ['required' => 'No. handphone harus diisi!']);
        $this->form_validation->set_rules('nis', 'NIS', 'callback_register_nis_check');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', ['required' => 'Password harus diisi!', 'min_length' => 'Password terlalu pendek!']);
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password]', ['matches' => 'Konfirmasi Password tidak sama!', 'required' => 'Konfirmasi Password harus diisi!']);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates_stisla/header');
            $this->load->view('auth/form_register');
            $this->load->view('templates_stisla/footer');
        } else {

            $data = [
                'nama' => $nama,
                'email' => $email,
                'no_hp' => $no_hp,
                'image' => 'default.png',
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role_id' => 2,
                'aktif' => 0,
                'tgl_dibuat' => time()
            ];

            $token = base64_encode(random_bytes(32));
            $data_token = [
                'email' => $email,
                'token' => $token,
                'tgl_dibuat' => time()
            ];

            $this->Email_model->send_email_verification($token, $data, $nis);
            $this->Auth_model->register_user($data);
            $this->Token_model->insert_token($data_token);


            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Akun berhasil dibuat, silahkan cek email untuk aktivasi!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>');
            redirect('auth');
        }
    }

    // register
    public function register_nis_check($nis)
    {

        $check = $this->Auth_model->check_nis($nis);

        if ($nis) {

            if ($check->num_rows() >= 1) {
                $siswa = $check->row_array();
                if ($siswa['account_id'] == 0) {
                    return TRUE;
                } else {
                    $this->form_validation->set_message('register_nis_check', 'NIS sudah terdaftar!');
                    return FALSE;
                }
            } else {

                $this->form_validation->set_message('register_nis_check', 'NIS tidak ditemukan!');
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('register_nis_check', 'NIS harus diisi!');
            return FALSE;
        }
    }

    //register
    public function verify_account()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');
        $nis = $this->input->get('nis');

        $user = $this->User_model->get_spesific_user(['email' => $email]);

        if ($user) {
            $user_token = $this->Token_model->get_spesific_token(['token' => $token]);
            if ($user_token) {
                if (time() - $user_token['tgl_dibuat'] < (60 * 60 * 24)) {
                    $this->Auth_model->verify_user($email);
                    $this->Auth_model->verify_user_siswa($user['id'], $nis);
                    $this->Token_model->delete_token(['email' => $email]);

                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Aktifasi berhasil, silahkan login!
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>');
                    redirect('auth');
                } else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Aktifasi gagal, token expired!
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Aktifasi gagal, token tidak ditemukan!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Aktifasi gagal, akun tidak ditemukan!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>');
            redirect('auth');
        }
    }


    public function forgot_password()
    {

        $this->form_validation->set_rules('email', 'Email', 'required', ['required' => 'Email harus diisi!']);

        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla/header');
            $this->load->view('auth/form_forgot_password');
            $this->load->view('templates_stisla/footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->User_model->get_spesific_user(['email' => $email]);

            if ($user) {

                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'tgl_dibuat' => time()
                ];
                $this->Token_model->insert_token($user_token);
                $this->Email_model->send_email_forgot_password($token, $email);
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Silahkan cek email anda untuk reset password!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
                redirect('auth');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email belum terdaftar!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>');
                redirect('auth/forgot_password');
            }
        }
    }

    public function verify_forgot_password()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->User_model->get_spesific_user(['email' => $email, 'aktif' => 1]);

        if ($user) {
            $user_token = $this->Token_model->get_spesific_token(['token' => $token]);
            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                redirect('auth/reset_password');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Reset password gagal, token tidak cocok!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Reset password gagal, email belum terdaftar atau teraktifasi!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>');
            redirect('auth');
        }
    }

    public function reset_password()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        };
        $data['email'] = $this->session->userdata('reset_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', ['required' => 'Password harus diisi!', 'min_length' => 'Password terlalu pendek!']);
        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'required|trim|matches[password]', ['matches' => 'Konfirmasi Password tidak sama!', 'required' => 'Konfirmasi Password harus diisi!']);

        if ($this->form_validation->run() == false) {

            $this->load->view('templates_stisla/header');
            $this->load->view('auth/form_reset_password', $data);
            $this->load->view('templates_stisla/footer');
        } else {
            $password = $this->input->post('password');
            $email = $this->input->post('email');

            $where = ['email' => $email];
            $data = ['password' => password_hash($password, PASSWORD_DEFAULT)];

            $this->User_model->update_user($data, $where);
            $this->Token_model->delete_token(['email' => $email]);
            $this->session->unset_userdata('reset_email');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Reset password sukses, silahkan login!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>');
            redirect('auth');
        }
    }

    // logout
    public function logout()
    {

        $this->session->sess_destroy();
        redirect('home');
    }
}
