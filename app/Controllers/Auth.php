<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Email\Email;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->userModel = model(User::class);
    }

    public function index()
    {
        $data['title'] = 'Login';
        if ($this->request->getMethod() == 'post' and $this->validate([
            'email' => 'trim|required|valid_email',
            'password' => 'trim|required|alpha_numeric_space|min_length[6]|max_length[16]',
        ])) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            return $this->login($email, $password);
        }
        $data['validation'] = $this->validator;
        return view('login', $data);
    }

    public function login(string $email, string $password)
    {
        $data = $this->userModel->getSpesifikUser(['email' => $email]);
        if ($data && password_verify($password, $data['password'])) {
            if ($data['active'] != 1) {
                return redirect('login')->with('msg', '<div class="alert alert-primary" role="alert">
                Akun Belum Aktif, Silahkan Verifikasi Email anda menggunakan kode OTP yang telah dikirimkan!
                </div>');
            }
            $this->session->set([
                'id'    => $data['id_user'],
                'nama' => ($data['nama']) ?? $data['nama_user'],
                'email' => $data['email'],
                'level' => $data['level'],
                'foto' => $data['foto_profil']
            ]);
            $redirect_to = ($data['level'] == 'user') ? 'dktp' : 'main/dashboard';
            return redirect($redirect_to)->with('msg', '<div class="alert alert-primary" role="alert">
            Login berhasil!
            </div>');
        } else {
            return redirect('login')->with('msg', '<div class="alert alert-danger" role="alert">
                Username atau Password salah!
                </div>');
        }
    }

    public function test()
    {
        $kodeotp = $this->generateOTP();
        $config = new \Config\Email();
        $email = \Config\Services::email($config);
        // $email->fromEmail = 'contact@digital-ktp.my.id';
        $email->setTo('lksywlthzabhr@sinaite.net');
        $email->setSubject('Kode OTP Verifikasi Akun');
        $email->setMessage("Kode OTP verifikasi anda adalah $kodeotp \r\n Silahkan Masukkan Kode OTP pada halaman verifikasi akun berikut : " . site_url('verifikasi'));
        $email->setNewline("\r\n");
        
        try {
            return dd($email,$email->send());
            // return $this->response->setJSON([
            //     'message' => 'send email success',
            //     'recepient' => 'lksywlthzabhr',
            //     'data' => $email->printDebugger(['headers','body'])
            // ])->send();
        } catch (\Throwable $th) {
            return $this->response->setJSON([
                'message' => 'send email failed'. $th->getMessage(),
                'error' => [
                    'code' => $th->getCode (),
                    'trace' => $th->getTraceAsString(),
                ],
            ])->send();
        }
    }

    public function register()
    {
        $data['title'] = 'Register';
        if ($this->request->getMethod() == 'post' and $this->validate([
            'nik' => 'trim|required|is_natural|exact_length[15,16,17]|is_unique[penduduk.nik]',
            'nama' => 'trim|required|alpha_numeric_space',
            'email' => 'trim|required|valid_email|is_unique[user.email]',
            'password' => 'trim|required|alpha_numeric_space|min_length[6]|max_length[15]',
        ])) {
            $nik = $this->request->getPost('nik');
            $nama = $this->request->getPost('nama');
            $email = $this->request->getPost('email');
            $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $pendudukModel = model(Penduduk::class);
            $kodeotp = $this->generateOTP();
            $is_email_sended = $this->sendOTPByEmail($this->request->getPost('email'), $kodeotp);
            $user_created = $this->userModel->createUser([
                'nama_user' => $nama,
                'email' => $email,
                'password' => $password,
                'level' => 'user',
                'foto_profil' => 'avatar.svg',
                'verify_key' => $kodeotp,
                'time_verified' => time(),
            ]);
            $penduduk_created = $pendudukModel->createPenduduk([
                'nik' => $nik,
                'nama' => $nama,
                'status' => 'aktif',
                'created_by' => $email
            ]);
            if ($user_created && $penduduk_created && $is_email_sended) {
                return redirect('login')->with('msg', '<div class="alert alert-primary" role="alert">
                Kode OTP untuk verifikasi email berhasil dikirim
                </div>');
            } else {
                return redirect('register')->with('msg', '<div class="alert alert-danger" role="alert">
                Register gagal!
                </div>');
            }
        }
        $data['validation'] = $this->validator;
        $data['admin'] = [];
        return view('register', $data);
    }

    public function verifikasi_akun()
    {
        $data['title'] = 'Verifikasi Akun';
        if ($this->request->getMethod() == 'post' and $this->validate([
            'verify' => 'trim|required|exact_length[6]',
        ])) {
            $otp = $this->request->getPost('verify');
            $user = $this->userModel->getSpesifikUser(['verify_key' => $otp])['id_user'];
            if ($user) {
                $this->userModel->updateUser($user, [
                    'active' => 1
                ]);
                return redirect('login')->with('msg', '<div class="alert alert-primary" role="alert">
                Kode OTP anda sudah terverifikasi, silahkan login
                </div>');
            } else {
                return redirect('verifikasi')->with('msg', '<div class="alert alert-danger" role="alert">
                Kode OTP tidak valid
                </div>');
            }
        }
        return view('verifikasi_akun', $data);
    }

    public function verify_otp($otp)
    {
        // $otp = $this->request->getPost('verify');
        $penduduk = $this->userModel->getSpesifikUser(['verify_key' => $otp]);
        if ($penduduk) {
            return $this->response->setJSON([
                'verified' => true,
                'message' => 'You are verified',
            ]);
        } else {
            return $this->response->setJSON([
                'verified' => false,
                'message' => 'OTP Code is not valid',
            ]);
        }
    }

    private function sendOTPByEmail(string $receiverEmail, $otpCode)
    {
        $email = new Email();
        $config = new \Config\Email();
        $email = \Config\Services::email($config);
        $email->setTo($receiverEmail);
        $email->setSubject('Kode OTP Verifikasi Akun');
        $email->setMessage("Kode OTP verifikasi anda adalah $otpCode \r\n Silahkan Masukkan Kode OTP pada halaman verifikasi akun berikut : " . site_url('verifikasi'));
        $email->setNewline("\r\n");
        try {
            return $email->send();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function generateOTP()
    {
        return bin2hex(random_bytes(3));
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
}
