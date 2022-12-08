<?php

namespace App\Models;

use CodeIgniter\Model;

class Setting extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'setting';
    protected $primaryKey       = 'id_setting';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_wilayah',
        'nama_wilayah',
        'jenis_wilayah',
        'kecamatan',
        'kab_kota',
        'provinsi',
        'nip_pimpinan',
        'nama_pimpinan',
        'ttd_pimpinan',
        'nip_sekretaris',
        'nama_sekretaris',
        'ttd_sekretaris',
        'id_user'
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

    public function getSetting($data = false)
    {
        if (!$data) {
            return $this->findAll();
        }
        return $this->where([$this->primaryKey => $data])->first();
    }

    public function getSpesifikSetting($param)
    {
        return $this->where($param)->first();
    }

    public function createSetting($data)
    {
        return $this->insert($data);
    }

    public function updateSetting($key, $data)
    {
        return $this->update($key, $data);
    }

    public function deletePenduduk($key)
    {
        return $this->delete($key);
    }

    public function getNumbers($param = false)
    {
        if (!$param) {
            return $this->selectCount($param);
        }
        return $this->selectCount();
    }
}
