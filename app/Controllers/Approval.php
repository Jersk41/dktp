<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Approval as ApprovalModel;

class Approval extends BaseController
{
    public function __construct() {
        $this->approvalModel = model(ApprovalModel::class);
    }
    public function index($id = false)
    {
        $data['title'] = 'Approval';
        if($id){
            $data['title'] = 'Detail Approval';
            $data['approval'] = $this->approvalModel->getFullApproval([],['id_approval'=>$id])[0];
            return view('admin/approval_detail',$data);
        }
        $data['approval'] = $this->approvalModel->getFullApproval();
        return view('admin/approval',$data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit Approval';
        $data['approval'] = $this->approvalModel->getFullApproval([],['id_approval'=>$id])[0];//$this->approvalModel->getApproval($id);
        $data['validation'] = $this->validator;
        return view('admin/edit_approval', $data);
    }

    public function update(int $id, string $status = '')
    {
        if ($this->request->getMethod() == 'post' and $this->validate([
            // 'status_approval' => 'trim|required|in_list[proses,selesai,ditolak,verifikasi]',
            'tanggapan_approval' => 'trim|required|string',
            // 'tgl_tanggapan' => 'trim|required|valid_date[Y-m-d]',
        ])) {
            $approval = [
                'status_approval' => ($this->request->getPost('status_approval')) ?? $status,
                'tanggapan_approval' => $this->request->getPost('tanggapan_approval'),
                // 'tgl_tanggapan' => $sets['tgl_tanggapan'],
                'tgl_tanggapan' => date('Y-m-d'),
            ];  
            if ($this->approvalModel->updateApproval($id,$approval)) {
                return redirect('main/approval')->with('msg', '<div class="alert alert-primary" role="alert">
                        Data Approval Berhasil Dirubah!
                        </div>');
            } else {
                return redirect('main/approval')->with('msg', '<div class="alert alert-danger" role="alert">
                        Data Approval Gagal Dirubah!
                        </div>');
            }
        }
    }

    public function delete($id)
    {
        if ($this->approvalModel->deleteApproval($id)) {
            return redirect('main/approval')->with('msg', '<div class="alert alert-primary" role="alert">
                    Approval Dihapus!
                    </div>');
        } else {
            return redirect('main/approval')->with('msg', '<div class="alert alert-danger" role="alert">
                    Approval Gagal Dihapus!
                    </div>');
        }
    }
}
