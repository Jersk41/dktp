<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Approval;
use App\Models\DetailPenduduk;
use App\Models\Penduduk as ModelsPenduduk;

class Penduduk extends BaseController
{
    public function index()
    {
        $data['title'] = 'Dashboard';
        return view('dashboard', $data);
    }

    public function buatktp()
    {
        $data['title'] = 'Buat KTP';
        $data['validation'] = $this->validator;
        return view('penduduk/buat_ktp', $data);

    }

    public function submitdata()
    {
        if ($this->request->getMethod() == 'post' and $this->validate([
            'nik' => 'trim|required|is_natural|exact_length[15,16,17]|is_unique[penduduk.nik]',
            'no_kk' => 'trim|required|is_natural|exact_length[15,16,17]|is_unique[penduduk.no_kk]',
            'nama' => 'trim|required|alpha_space',
            'tempat_lahir' => 'trim|required|alpha_space',
            'tgl_lahir' => 'trim|required|valid_date[Y-m-d]',
            'jenis_kelamin' => 'trim|required|in_list[L,P]',
            'alamat' => 'trim|required|alpha_numeric_space',
            // 'rt_rw' => 'trim|required|is_natural',
            'agama' => 'trim|required|in_list[islam,kristen,hindu,buddha,lainnya]',
            'golongan_darah' => 'trim|required|in_list[A,B,AB,O]',
            'status_perkawinan' => 'trim|required|in_list[belum_kawin,kawin]',
            'pekerjaan' => 'trim|required|alpha_numeric_space',
            'pendidikan' => 'trim|required|alpha_numeric_space',
            'kewarganegaraan' => 'trim|required|in_list[wni,wna]',
            'foto' => 'uploaded[foto]|max_size[foto,2048]|ext_in[foto,jpg,png,jpeg]|is_image[foto]',
            'ttd' => 'required',
        ])) {
        }
        $pendudukModel = model(ModelsPenduduk::class);
        $detailPendudukModel = model(DetailPenduduk::class);
        $approvalModel = model(Approval::class);
        $nik = $this->request->getPost('nik');
        $data = [
            'nik' => $nik,
            'no_kk' => $this->request->getPost('no_kk'),
            'nama' => $this->request->getPost('nama'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tgl_lahir' => $this->request->getPost('tgl_lahir'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'rt_rw' => sprintf("%'.03d/%'.03d",$this->request->getPost('rt'),$this->request->getPost('rw')),
            'agama' => $this->request->getPost('agama'),
            'golongan_darah' => $this->request->getPost('golongan_darah'),
            'status_perkawinan' => $this->request->getPost('status_perkawinan'),
            'pekerjaan' => $this->request->getPost('pekerjaan'),
            'pendidikan' => $this->request->getPost('pendidikan'),
            'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
            'tgl_pembuatan' => date('Y-m-d'),
            'status' => 'aktif',
        ];
        $detail = [
            'nik' => $nik,
            'ttd' => $this->request->getPost('ttd'),
        ];
        $filefoto = $this->request->getFile('foto');
        if ($filefoto->isValid() &&!$filefoto->hasMoved()) {
            $newName = $filefoto->getRandomName();
            $filefoto->move(FCPATH . 'uploads', $newName);
            $detail['foto'] = $newName;
        }
        $penduduk = $pendudukModel->createPenduduk($data);
        $detpenduduk = $detailPendudukModel->createDetailPenduduk($detail);
        $approval = $approvalModel->createApproval([
            'status_approval' => 'verifikasi',
            'tanggapan_approval' => '',
            'nik' => $nik,
        ]);
        if ($penduduk && $detpenduduk && $approval) {
            return redirect('dktp/buatktp')->with('msg', '<div class="alert alert-primary" role="alert">
                    Data Berhasil Dikirim!
                    </div>');
        } else {
            return redirect('dktp/buatktp')->with('msg', '<div class="alert alert-danger" role="alert">
                    Data Gagal Dikirim!
                    </div>');
        }
    }
}
