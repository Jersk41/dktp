<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Petugas extends Admin
{
    public function index()
    {
        $data['title'] = 'Petugas';
        $data['users'] = $this->userModel->filterUser(['level !='=>'user']);
        if ($this->request->getMethod() == 'post' and $this->validate([
            'nama' => 'trim|required|alpha_numeric_space',
            'email' => 'trim|required|valid_email|is_unique[user.email]',
            'password' => 'trim|required|alpha_numeric_space|min_length[6]|max_length[15]',
            'confirm_pass' => 'trim|required|alpha_numeric_space|min_length[6]|max_length[15]|matches[password]',
            'level' => 'trim|required|in_list[superadmin,admin,user]',
        ])) {
            if ($this->add($this->request->getPost('nama'), $this->request->getPost('email'), $this->request->getPost('confirm_pass'), $this->request->getPost('level'))) {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-primary" role="alert">
                    Data User Berhasil Ditambah!
                    </div>');
            } else {
                return redirect('main/petugas')->with('msg', '<div class="alert alert-danger" role="alert">
                    Data User Gagal Ditambah!
                    </div>');
            }
        }
        $data['validation'] = $this->validator;
        return view('admin/petugas', $data);
    }

    private function add($nama, $email, $password, $level)
    {
        $user = [
            'nama_user' => $nama,
            'email' => $email,
            'password' => $password,
            'level' => $level,
        ];
        return $this->userModel->createUser($user);
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
            $this->update($id_user,$this->request->getPost('nama'),$this->request->getPost('email'),$this->request->getPost('level'));
        }
        $data['validation'] = $this->validator;
        return view('admin/edit_petugas', $data);    
    }

    private function update($id,$nama, $email, $level)
    {
        $user = [
            'nama_user' => $nama,
            'email' => $email,
            'level' => $level,
        ];
        if ($this->userModel->updateUser($id,$user)) {
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
