<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Approval as ApprovalModel;

class Approval extends BaseController
{
    public function index($id = false)
    {
        $approvalModel = model(ApprovalModel::class);
        $data['title'] = 'Approval';
        if($id){
            $data['approval'] = $approvalModel->getFullApproval([],['id_approval'=>$id])[0];
            $data['title'] = 'Detail Approval';
            return view('admin/approval_detail',$data);
        }
        $data['approval'] = $approvalModel->getFullApproval();
        return view('admin/approval',$data);
    }
}
