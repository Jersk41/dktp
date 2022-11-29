<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Approval;
use App\Models\DetailPenduduk;
use App\Models\Penduduk as ModelsPenduduk;
use App\Models\Setting;

class Penduduk extends BaseController
{
    public function __construct() {
        $this->pendudukModel = model(ModelsPenduduk::class);
        $this->approvalModel = model(Approval::class);
        $this->settingModel = model(Setting::class);
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $approval = ($this->approvalModel->getFullApproval([
            'penduduk.nik','foto','sidik_jari','status_approval', 'tanggapan_approval', 'tgl_tanggapan'
        ], ['created_by' => session()->get('email')])[0]) ?? ['status_approval' => ''];
        $data['biodata'] = ($approval['nik']) ?? '';
        $data['foto'] = ($approval['foto']) ?? '';
        $data['sidikjari'] = ($approval['sidik_jari']) ?? '';
        $data['pesan'] = ($approval['tanggapan_approval']) ?? '';
        switch ($approval['status_approval']) {
            case 'verifikasi':
                $data['badge'] = '<span class="badge bg-warning text-dark">Verifikasi</span>';
                break;
            case 'proses':
                $data['badge'] = '<span class="badge bg-info text-dark">Proses</span>';
                break;
            case 'selesai':
                $data['badge'] = '<span class="badge bg-success text-dark">Selesai</span>';
                break;
            case 'ditolak':
                $data['badge'] = '<span class="badge bg-dark text-white">Ditolak</span>';
                break;
            default:
                $data['badge'] = '<span class="badge bg-danger text-dark">Data Belum Lengkap</span>';
                break;
        }
        $data['validation'] = $this->validator;
        return view('dashboard', $data);
    }

    public function buatktp()
    {
        $data['title'] = 'Buat KTP';
        $data['wilayah'] = $this->settingModel->query(
            'SELECT id_setting,kode_wilayah,nama_wilayah,jenis_wilayah,kecamatan,kab_kota,provinsi FROM setting'
        )->getResultArray();
        $data['penduduk'] = $this->pendudukModel->getSpesifikPenduduk(['created_by'=>session()->get('email')]);
        return view('penduduk/buat_ktp', $data);
    }

    public function submitdata()
    {
        if ($this->request->getMethod() == 'post' and $this->validate([
            // 'nik' => 'trim|required|is_natural|exact_length[15,16,17]|is_unique[penduduk.nik]',
            'no_kk' => 'trim|required|is_natural|exact_length[15,16,17]|is_unique[penduduk.no_kk]',
            'nama' => 'trim|required|alpha_space',
            'tempat_lahir' => 'trim|required|alpha_space',
            'tgl_lahir' => 'trim|required|valid_date[Y-m-d]',
            'jenis_kelamin' => 'trim|required|in_list[L,P]',
            'alamat' => 'trim|required|alpha_numeric_punct',
            'wilayah' => 'trim|required',
            'agama' => 'trim|required|in_list[islam,kristen,hindu,buddha,lainnya]',
            'golongan_darah' => 'trim|required|in_list[A,B,AB,O]',
            'status_perkawinan' => 'trim|required|in_list[belum kawin,kawin]',
            'pekerjaan' => 'trim|required|string',
            'kewarganegaraan' => 'trim|required|in_list[wni,wna]',
            'foto' => 'uploaded[foto]|max_size[foto,2048]|ext_in[foto,jpg,png,jpeg]|is_image[foto]',
            'ttd' => 'uploaded[ttd]|max_size[ttd,512]|ext_in[ttd,png]|is_image[ttd]',
        ])) {
            $detailPendudukModel = model(DetailPenduduk::class);
            $nik = $this->request->getPost('nik');
            
            $data = [
                // 'nik' => $nik,
                'no_kk' => $this->request->getPost('no_kk'),
                'nama' => $this->request->getPost('nama'),
                'tempat_lahir' => $this->request->getPost('tempat_lahir'),
                'tgl_lahir' => $this->request->getPost('tgl_lahir'),
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
                'alamat' => $this->request->getPost('alamat'),
                'rt_rw' => sprintf("%'.03d/%'.03d", $this->request->getPost('rt'), $this->request->getPost('rw')),
                'agama' => $this->request->getPost('agama'),
                'golongan_darah' => $this->request->getPost('golongan_darah'),
                'status_perkawinan' => $this->request->getPost('status_perkawinan'),
                'pekerjaan' => $this->request->getPost('pekerjaan'),
                // 'pendidikan' => $this->request->getPost('pendidikan'),
                'kewarganegaraan' => $this->request->getPost('kewarganegaraan'),
                'tgl_pembuatan' => date('Y-m-d'),
                'status' => 'aktif',
                'kode_wilayah' => $this->request->getPost('wilayah'),
                'created_by' => session()->get('email'),
            ];
            $detail = [
                'nik' => $nik,
            ];
            $filefoto = $this->request->getFile('foto');
            if ($filefoto->isValid() && !$filefoto->hasMoved()) {
                $newName = $filefoto->getRandomName();
                $filefoto->move(FCPATH . 'uploads', $newName);
                $detail['foto'] = $newName;
            }
            $filettd = $this->request->getFile('ttd');
            if ($filettd->isValid() && !$filettd->hasMoved()) {
                $newName = $filettd->getRandomName();
                $filettd->move(FCPATH . 'uploads', $newName);
                $detail['ttd'] = $newName;
            }
            $penduduk = $this->pendudukModel->updatePenduduk($nik,$data);
            $detpenduduk = $detailPendudukModel->createDetailPenduduk($detail);
            $approval = $this->approvalModel->createApproval([
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
        } else {
            return redirect('dktp/buatktp')->with('msg', '<div class="alert alert-danger" role="alert">
                Data Gagal Dikirim!
                </div>');
        }
    }

    public function detail()
    {
        $data['title'] = 'Detail Pembuatan KTP';
        $approval = $this->approvalModel->getFullApproval([], ['created_by' => session()->get('email')])[0];
        $data['approval'] = $approval;
        $data['pesan'] = ($approval['tanggapan_approval']) ?? '';
        switch ($approval['status_approval']) {
            case 'verifikasi':
                $data['badge'] = '<span class="badge bg-warning text-dark">Verifikasi</span>';
                break;
            case 'proses':
                $data['badge'] = '<span class="badge bg-info text-dark">Proses</span>';
                break;
            case 'selesai':
                $data['badge'] = '<span class="badge bg-success text-dark">Selesai</span>';
                break;
            case 'ditolak':
                $data['badge'] = '<span class="badge bg-dark text-white">Ditolak</span>';
                break;
            default:
                $data['badge'] = '<span class="badge bg-danger text-dark">Data Belum Lengkap</span>';
                break;
        }
        return view('penduduk/detail',$data);
    }
}
