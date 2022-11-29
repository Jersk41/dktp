<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Setting;

class Petugas extends Admin
{
    public function __construct() {
        parent::__construct();
        $this->settingModel = model(Setting::class);
    }
    public function index()
    {
        $data['title'] = 'Petugas';
        $data['users'] = $this->userModel->filterUser(['level !=' => 'user']);
        if ($this->request->getMethod() == 'post' and $this->validate([
            'nama' => 'trim|required|alpha_numeric_space',
            'email' => 'trim|required|valid_email|is_unique[user.email]',
            'password' => 'trim|required|alpha_numeric_space|min_length[6]|max_length[15]',
            'confirm_pass' => 'trim|required|alpha_numeric_space|min_length[6]|max_length[15]|matches[password]',
            'level' => 'trim|required|in_list[superadmin,admin,user]',
            /* Setting Rule */
            'kode_wilayah' => 'trim|required|is_unique[setting.kode_wilayah]',
            'nama_wilayah' => 'trim|required|alpha_numeric_space',
            'jenis_wilayah' => 'trim|required|in_list[desa,kelurahan]',
            'kecamatan' => 'trim|required|alpha_numeric_space',
            'provinsi' => 'trim|required|alpha_numeric_space',
            'nip_pimpinan' => 'trim|required|is_natural',
            'nama_pimpinan' => 'trim|required|alpha_numeric_punct',
            'ttd_pimpinan' => 'uploaded[ttd_pimpinan]|max_size[ttd_pimpinan,512]|ext_in[ttd_pimpinan,png]|is_image[ttd_pimpinan]',
            'nip_sekretaris' => 'trim|required|is_natural',
            'nama_sekretaris' => 'trim|required|alpha_numeric_punct',
            'ttd_sekretaris' => 'uploaded[ttd_sekretaris]|max_size[ttd_sekretaris,512]|ext_in[ttd_sekretaris,png]|is_image[ttd_sekretaris]',
        ])) {
            $input = $this->request->getPost();
            $file_pimpinan = $this->request->getFile('ttd_pimpinan');
            if ($file_pimpinan->isValid() && !$file_pimpinan->hasMoved()) {
                $newName = $file_pimpinan->getRandomName();
                $file_pimpinan->move(FCPATH . 'uploads', $newName);
                $input['ttd_pimpinan'] = $newName;
            }
            $file_sekretaris = $this->request->getFile('ttd_sekretaris');
            if ($file_sekretaris->isValid() && !$file_sekretaris->hasMoved()) {
                $newName = $file_sekretaris->getRandomName();
                $file_sekretaris->move(FCPATH . 'uploads', $newName);
                $input['ttd_sekretaris'] = $newName;
            }
            if ($this->add($input)) {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-primary" role="alert">
                    Data User Berhasil Ditambah!
                    </div>');
            } else {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-danger" role="alert">
                    Data User Gagal Ditambah!
                    </div>');
            }
        }
        $data['setting'] = [];
        $data['validation'] = $this->validator;
        return view('admin/petugas', $data);
    }

    private function add($data)
    {
        $kodeotp = bin2hex(random_bytes(3));
        $user = $this->userModel->createUser([
            'nama_user' => $data['nama'],
            'email' => $data['email'],
            'password' => password_hash($data['password'],PASSWORD_DEFAULT),
            'no_telp' => $data['no_telp'],
            'level' => $data['level'],
            'active' => 1,
            'foto_profil' => 'avatar.svg',
            'verify_key' => $kodeotp,
            'time_verified' => time(),
            'created_by' => $data['email']
        ]);
        $wilayah = $this->settingModel->createSetting([
            'kode_wilayah' => $data['kode_wilayah'],
            'nama_wilayah' => $data['nama_wilayah'],
            'jenis_wilayah' => $data['jenis_wilayah'],
            'kecamatan' => $data['kecamatan'],
            'kab_kota' => $data['kab_kota'],
            'provinsi' => $data['provinsi'],
            'nip_pimpinan' => $data['nip_pimpinan'],
            'nama_pimpinan' => $data['nama_pimpinan'],
            'ttd_pimpinan' => $data['ttd_pimpinan'],
            'nip_sekretaris' => $data['nip_sekretaris'],
            'nama_sekretaris' => $data['nama_sekretaris'],
            'ttd_sekretaris' => $data['ttd_sekretaris'],
            'id_user' => $user,
        ]);
        return ($user && $wilayah);
    }

    public function edit($id_user)
    {
        $data['title'] = 'Edit Petugas';
        $data['user'] = $this->userModel->getUser($id_user);
        if ($this->request->getMethod() == 'post' and $this->validate([
            'nama' => 'trim|required|alpha_numeric_space',
            'email' => 'trim|required|valid_email',
            'level' => 'trim|required|in_list[superadmin,admin]',
        ])) {
            $this->update($id_user, $this->request->getPost('nama'), $this->request->getPost('email'), $this->request->getPost('level'));
        }
        $data['validation'] = $this->validator;
        return view('admin/edit_petugas', $data);
    }

    private function update($id, $nama, $email, $level)
    {
        $user = [
            'nama_user' => $nama,
            'email' => $email,
            'level' => $level,
        ];
        if ($this->userModel->updateUser($id, $user)) {
            return redirect('main/petugas')->with('msg', '<div class="alert alert-primary" role="alert">
                    Data User Berhasil Dirubah!
                    </div>');
        } else {
            return redirect('main/petugas')->with('msg', '<div class="alert alert-danger" role="alert">
                    Data User Gagal Dirubah!
                    </div>');
        }
    }

    public function delete($id_user)
    {
        if ($this->userModel->deleteUser($id_user)) {
            return redirect('main/petugas')->with('msg', '<div class="alert alert-primary" role="alert">
                    User Berhasil Dihapus!
                    </div>');
        } else {
            return redirect('main/petugas')->with('msg', '<div class="alert alert-danger" role="alert">
                    User Gagal Dihapus!
                    </div>');
        }
    }
}
