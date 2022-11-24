<?php

namespace App\Controllers;

use App\Models\Setting as ModelsSetting;

class Setting extends Admin
{
    protected $settingModel;

    public function __construct()
    {
        parent::__construct();
        $this->settingModel = model(ModelsSetting::class);
    }

    public function index()
    {
        $data['title'] = 'Setting Wilayah';
        $data['user'] = $this->userModel->getSpesifikUser(['email' => session()->get('email')]);
        $data['setting'] = $this->settingModel->getSpesifikSetting([
            'id_user' => session()->get('id')
        ]);
        return view('admin/setting', $data);
    }

    public function form($id = false)
    {
        $data['title'] = 'Setting Wilayah';
        $data['user'] = $this->userModel->getSpesifikUser(['email' => session()->get('email')]);
        $data['setting'] = $this->settingModel->getSpesifikSetting([
            'id_user' => session()->get('id')
        ]);
        return view('admin/form_setting', $data);
    }

    public function create()
    {
        if ($this->request->getMethod() == 'post' and $this->validate([
            'kode_wilayah' => 'trim|required|is_unique[setting.kode_wilayah]',
            'nama_wilayah' => 'trim|required|alpha_numeric_space',
            'jenis_wilayah' => 'trim|required|in_list[desa,kelurahan]',
            'kecamatan' => 'trim|required|alpha_numeric_space',
            'provinsi' => 'trim|required|alpha_numeric_space',
            'nip_pimpinan' => 'trim|required|is_natural',
            'nama_pimpinan' => 'trim|required|alpha_numeric_punct',
            // 'ttd_pimpinan' => 'trim|required',
            'nip_sekretaris' => 'trim|required|is_natural',
            'nama_sekretaris' => 'trim|required|alpha_numeric_punct',
            // 'ttd_sekretaris' => 'trim|required',
            'id_user' => 'trim|required|is_natural',
        ])) {
            $data = [
                // 'kode_wilayah' => $this->request->getPost('kode_wilayah'),
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'jenis_wilayah' => $this->request->getPost('jenis_wilayah'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'provinsi' => $this->request->getPost('provinsi'),
                'nip_pimpinan' => $this->request->getPost('nip_pimpinan'),
                'nama_pimpinan' => $this->request->getPost('nama_pimpinan'),
                // 'ttd_pimpinan' => $this->request->getPost('/'),
                'nip_sekretaris' => $this->request->getPost('nip_sekretaris'),
                'nama_sekretaris' => $this->request->getPost('nama_sekretaris'),
                // 'ttd_sekretaris' => $this->request->getPost('/'),
                'id_user' => $this->request->getPost('id_user'),
            ];
            var_dump($this->settingModel->save($data));
        }
        var_dump($this->validator->getErrors());
    }

    public function update($id = false)
    {
        $rules = [
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
            'id_user' => 'trim|required|is_natural',
        ];
        if(!$id) $rules['kode_wilayah'] = 'trim|required|is_unique[setting.kode_wilayah]';
        if ($this->request->getMethod() == 'post' and $this->validate($rules)) {
            $data = [
                'nama_wilayah' => $this->request->getPost('nama_wilayah'),
                'jenis_wilayah' => $this->request->getPost('jenis_wilayah'),
                'kecamatan' => $this->request->getPost('kecamatan'),
                'provinsi' => $this->request->getPost('provinsi'),
                'nip_pimpinan' => $this->request->getPost('nip_pimpinan'),
                'nama_pimpinan' => $this->request->getPost('nama_pimpinan'),
                // 'ttd_pimpinan' => $this->request->getPost('/'),
                'nip_sekretaris' => $this->request->getPost('nip_sekretaris'),
                'nama_sekretaris' => $this->request->getPost('nama_sekretaris'),
                // 'ttd_sekretaris' => $this->request->getPost('/'),
                'id_user' => $this->request->getPost('id_user'),
            ];
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
            if ($this->settingModel->updateSetting($id,$data)) {
                return redirect('main/setting')->with('msg', '<div class="alert alert-primary" role="alert">
                        Peraturan Berhasil Dirubah!
                        </div>');
            } else {
                return redirect('main/setting')->with('msg', '<div class="alert alert-danger" role="alert">
                        Peraturan Gagal Dirubah!
                        </div>');
            }
        }
        var_dump($this->validator->getErrors());
    }
}
