<?php

namespace App\Models;

use CodeIgniter\Model;

class Approval extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'approval';
    protected $primaryKey       = 'id_approval';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'status_approval',
        'tanggapan_approval',
        'tgl_tanggapan',
        'nik'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getApproval($approval = false)
    {
        if (!$approval) {
            return $this->findAll();
        }
        return $this->where([$this->primaryKey => $approval])->first();
    }

    public function getSpesifikApproval($param)
    {
        return $this->where($param)->first();
    }

    public function filterApproval($param)
    {
        return $this->where($param)->findAll();
    }

    public function createApproval($data)
    {
        return $this->insert($data);
    }

    public function updateApproval($key, $data)
    {
        return $this->update($key, $data);
    }

    public function deleteApproval($key)
    {
        return $this->delete($key);
    }

    public function getNumbers($param = false)
    {
        if(!$param){
            return $this->selectCount($param);
        }
        return $this->selectCount();
    }

    public function getFullApproval($params = [],$cond = [])
    {
        if ($params) {
            $this->select($params);
        }else {
            $this->select('*');
        }
        $this->join('penduduk',"penduduk.nik = approval.nik");
        $this->join('detail_penduduk',"penduduk.nik = detail_penduduk.nik");
        $this->join('setting',"setting.kode_wilayah = penduduk.kode_wilayah",'left');
        if($cond){
            $this->where($cond);
        }
        return $this->findAll();
    }

    public function report()
	{
		$this->select('approval.*, penduduk.nama,penduduk.tgl_pembuatan,nama_wilayah,jenis_wilayah,kecamatan,kab_kota,provinsi');
		$this->join('penduduk','penduduk.nik = approval.nik');
        $this->join('setting',"setting.kode_wilayah = penduduk.kode_wilayah");
		// $this->join('user','user.id_user = tanggapan.id_user','left');
		return $this->findAll();
	}
}
