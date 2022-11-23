<?php

namespace App\Models;

use CodeIgniter\Model;

class Penduduk extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'penduduk';
    protected $primaryKey       = 'nik';
    protected $useAutoIncrement = false;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nik',
        'no_kk',
        'nama',
        'tempat_lahir',
        'tgl_lahir',
        'jenis_kelamin',
        'alamat',
        'rt_rw',
        'agama',
        'golongan_darah',
        'status_perkawinan',
        'pekerjaan',
        'pendidikan',
        'kewarganegaraan',
        'tgl_pembuatan',
        'status',
        'kode_wilayah',
        'created_by',
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

    public function getPenduduk($data = false)
    {
        if(!$data){
            return $this->findAll();
        }
        return $this->where([$this->primaryKey => $data])->first();
    }

    public function getSpesifikPenduduk($param)
    {
        return $this->where($param)->first();
    }

    public function getPendudukFull($params = [],$cond = [])
    {
        if ($params) {
            $this->select($params);
        }else {
            $this->select('*');
        }
        $this->join('penduduk',"penduduk.nik = detail_penduduk.nik");
        if($cond){
            $this->where($cond);
        }
        return $this->findAll();
    }

    public function createPenduduk($data)
    {
        return $this->insert($data);
    }

    public function updatePenduduk($key,$data)
    {
        return $this->update($key,$data);
    }

    public function deletePenduduk($key)
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
}
