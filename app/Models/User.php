<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_user',
        'email',
        'password',
        'no_telp',
        'level',
        'foto_profil',
        'active',
        'verify_key',
        'time_verified'
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

    public function getUser($user = false)
    {
        if(!$user){
            return $this->findAll();
        }
        return $this->where([$this->primaryKey => $user])->first();
    }

    public function getSpesifikUser($param)
    {
        return $this->where($param)->first();
    }

    public function filterUser($param)
    {
        return $this->where($param)->findAll();
    }

    public function createUser($data)
    {
        return $this->insert($data);
    }
    
    public function updateUser($key,$data)
    {
        return $this->update($key,$data);
    }

    public function deleteUser($key)
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
