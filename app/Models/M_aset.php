<?php

namespace App\Models;

use CodeIgniter\Model;

class m_aset extends Model
{
    protected $table = 'data3d';
    public function get_all_data()
    {
        $builder = $this->db->table('data3d');
        return $builder->get()->getResultArray();
    }

    // public function caritanah()
    // {
    //     $request = service('request');
    //     $keywordtanah = $request->getPost('keywordtanah');
    
    //     return $this->table('tanah')
    //                 ->like('pemilik', $keywordtanah);
    // }
}
