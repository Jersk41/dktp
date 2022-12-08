<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Setting;
use CodeIgniter\Files\FileCollection;
class Petugas extends Admin
{
    public function __construct()
    {
        parent::__construct();
        $this->settingModel = model(Setting::class);
    }

    public function index()
    {
        $data['title'] = 'Petugas';
        $data['users'] = $this->userModel->filterUser(['level !=' => 'user']);
        $data['validation'] = $this->validator;
        return view('admin/petugas', $data);
    }

    public function tambah()
    {
        if ($this->validate([
            'nama' => 'trim|required|alpha_numeric_space',
            'email' => 'trim|required|valid_email|is_unique[user.email]',
            'password' => 'trim|required|alpha_numeric_punct|min_length[6]|max_length[15]',
            'confirm_pass' => 'trim|required|alpha_numeric_punct|min_length[6]|max_length[15]|matches[password]',
        ])) {
            $input = $this->request->getPost();
            $input['level'] = 'superadmin';
            if ($this->add(false, $input)) {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-primary" role="alert">
                    Data User Berhasil Ditambah!
                    </div>');
            } else {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-danger" role="alert">
                    Data User Gagal Ditambah!
                    </div>');
            }
        } else {
            $data['validation'] = $this->validator;
            return redirect('main/petugas')->with('msg', '<div class="alert alert-danger" role="alert">
                    Data User Gagal Ditambah!
                    </div>');
        }
    }

    public function tambah_admin()
    {
        if ($this->validate([
            'nama' => 'trim|required|alpha_numeric_punct',
            'email' => 'trim|required|valid_email|is_unique[user.email]',
            'password' => 'trim|required|alpha_numeric_punct|min_length[6]|max_length[15]',
            'confirm_pass' => 'trim|required|alpha_numeric_punct|min_length[6]|max_length[15]|matches[password]',
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
            $input['level'] = 'admin';
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
            if ($this->add(true, $input)) {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-primary" role="alert">
                    Data User Berhasil Ditambah!
                    </div>');
            } else {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-danger" role="alert">
                    Data User Gagal Ditambah!
                    </div>');
            }
        }
    }

    private function add($isadmin = false, $data)
    {
        $kodeotp = bin2hex(random_bytes(3));
        $user = $this->userModel->createUser([
            'nama_user' => $data['nama'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'no_telp' => $data['no_telp'],
            'level' => $data['level'],
            'active' => 1,
            'foto_profil' => 'avatar.svg',
            'verify_key' => $kodeotp,
            'time_verified' => time(),
        ]);
        if ($isadmin) {
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
        return $user;
    }

    public function edit($id_user)
    {
        $data['title'] = 'Edit Petugas';
        $data['user'] = $this->userModel->getUser($id_user);
        $level = ($this->request->getGet('l')) ?? 'superadmin';
        $data['level'] = $level;
        $isadmin = false;
        $rules = [];
        if ($level == 'superadmin') {
            $rules = [
                'nama' => 'trim|required|alpha_numeric_space',
                'email' => 'trim|required|valid_email',
                // 'level' => 'trim|required|in_list[superadmin,admin]',
            ];
            
        }else{
            if(!$id_user) $rules['kode_wilayah'] = 'trim|required|is_unique[setting.kode_wilayah]';
            $rules = [
                'nama' => 'trim|required|alpha_numeric_space',
                'email' => 'trim|required|valid_email',
                /* Setting Rule */
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
            ];
            $isadmin = true;
            $data['setting'] = $this->settingModel->getSpesifikSetting(['id_user'=>$this->userModel->getSpesifikUser(['id_user'=>$id_user])['id_user']]);
        }
        if ($this->request->getMethod() == 'post' and $this->validate($rules)) {
            $input = $this->request->getPost();
            if ($this->update($id_user, $isadmin, $input)) {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-primary" role="alert">
                        Data User Berhasil Dirubah!
                        </div>');
            } else {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-danger" role="alert">
                        Data User Gagal Dirubah!
                        </div>');
            }
        }
        $data['validation'] = $this->validator;
        return view('admin/edit_petugas', $data);
    }

    public function edit_admin($id_user)
    {
        $data['title'] = 'Edit Petugas';
        $data['level'] = 'admin';
        $data['user'] = $this->userModel->getUser($id_user);
        if ($this->request->getMethod() == 'post' and $this->validate([
            'nama' => 'trim|required|alpha_numeric_space',
            'email' => 'trim|required|valid_email',
            'level' => 'trim|required|in_list[superadmin,admin]',
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
            if ($this->update($id_user, true, $input)) {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-primary" role="alert">
                        Data User Berhasil Dirubah!
                        </div>');
            } else {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-danger" role="alert">
                        Data User Gagal Dirubah!
                        </div>');
            }
        }
        $data['validation'] = $this->validator;
        return view('admin/edit_petugas', $data);
    }

    private function update($id, $isadmin = false, $data)
    {
        $user = $this->userModel->updateUser($id,[
            'nama_user' => $data['nama'],
            'email' => $data['email'],
            'no_telp' => $data['no_telp'],
            'foto_profil' => ($data['foto_profil']) ?? 'avatar.svg',
        ]);
        if($isadmin){
            $oldSetting = $this->settingModel->getSpesifikSetting(['id_user'=>$this->userModel->getSpesifikUser(['id_user'=>$id])['id_user']]);
            if($oldSetting['ttd_pimpinan'] != '' or $oldSetting['ttd_sekretaris'] != ''){
                $filelist = [
                    FCPATH . 'uploads/'.$oldSetting['ttd_pimpinan'],
                    FCPATH . 'uploads/'.$oldSetting['ttd_sekretaris'],
                ];
                $files = new FileCollection($filelist);
                $files->removeFiles($filelist);
            }

            $file_pimpinan = $this->request->getFile('ttd_pimpinan');
            if ($file_pimpinan->isValid() && !$file_pimpinan->hasMoved()) {
                $newName = $file_pimpinan->getRandomName();
                $file_pimpinan->move(FCPATH . 'uploads', $newName);
                $data['ttd_pimpinan'] = $newName;
            }
            $file_sekretaris = $this->request->getFile('ttd_sekretaris');
            if ($file_sekretaris->isValid() && !$file_sekretaris->hasMoved()) {
                $newName = $file_sekretaris->getRandomName();
                $file_sekretaris->move(FCPATH . 'uploads', $newName);
                $data['ttd_sekretaris'] = $newName;
            }
            $wilayah = $this->settingModel->updateSetting($oldSetting['id_setting'],[
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
            ]);
            return ($user && $wilayah);
        }
        return $user;
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
