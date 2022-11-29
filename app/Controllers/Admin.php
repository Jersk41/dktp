<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Approval;
use App\Models\Setting;
use App\Models\User;

class Admin extends BaseController
{
    public $userModel;

    public function __construct()
    {
        $this->userModel = model(User::class);
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $approvalModel = model(Approval::class);
        $SettingModel = model(Setting::class);
        $data['penduduk'] = count($this->userModel->filterUser(['level'=>'user']));
        /* Untuk Superadmin */
        if(session()->get('level') == 'superadmin'){
            $data['petugas'] = count($this->userModel->filterUser(['level'=>'admin']));
            $data['approval'] = count($approvalModel->getApproval());
            $data['approval_proses'] = count($approvalModel->filterApproval(['status_approval'=>'proses']));
            $data['approval_selesai'] = count($approvalModel->filterApproval(['status_approval'=>'selesai']));
        }else{
            /* Untuk Admin */
            $data['setting'] = $SettingModel->getSpesifikSetting(['id_user'=>session()->get('id')]);
            $data['approval'] = count($approvalModel->getFullApproval([],['penduduk.kode_wilayah'=> $SettingModel->getSpesifikSetting(['id_user'=>session()->get('id')])['kode_wilayah']]));
            $data['approval_proses'] = count($approvalModel->getFullApproval([],['status_approval'=>'proses']));
            $data['approval_selesai'] = count($approvalModel->getFullApproval([],['status_approval'=>'selesai']));
        }
        return view('dashboard',$data);
    }

    public function profile()
    {
        $data['title'] = 'Profile';
        $data['user'] = $this->userModel->getSpesifikUser(['email'=>session()->get('email')]);
        return view('profil',$data);
    }
}
