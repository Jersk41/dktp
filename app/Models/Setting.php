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
    protected $validationRules      = [
        'kode_wilayah' => 'trim|required|is_unique[setting.kode_wilayah]',
        'nama_wilayah' => 'trim|required|alpha_numeric_space',
        'jenis_wilayah' => 'trim|required|in_list[desa,kelurahan]',
        'kecamatan' => 'trim|required|alpha_numeric_space',
        'kab_kota' => 'trim|required|alpha_numeric_space',
        'provinsi' => 'trim|required|alpha_numeric_space',
        'nip_pimpinan' => 'trim|required|is_natural',
        'nama_pimpinan' => 'trim|required|alpha_numeric_punct',
        'ttd_pimpinan' => 'uploaded[ttd_pimpinan]|max_size[ttd_pimpinan,512]|ext_in[ttd_pimpinan,png]|is_image[ttd_pimpinan]',
        'nip_sekretaris' => 'trim|required|is_natural',
        'nama_sekretaris' => 'trim|required|alpha_numeric_punct',
        'ttd_sekretaris' => 'uploaded[ttd_sekretaris]|max_size[ttd_sekretaris,512]|ext_in[ttd_sekretaris,png]|is_image[ttd_sekretaris]',
        'id_user' => 'trim|required|is_natural',
    ];
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
