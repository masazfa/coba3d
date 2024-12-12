<?php

namespace App\Controllers;
use App\Models\m_aset;

class Home extends BaseController
{
    protected $db;
    protected $m_aset;

    public function __construct()
    {
        $this->m_aset = new m_aset();
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        $data = array(
            'title' => 'WebGIS',
            'data3d' => $this->m_aset->get_all_data(),
            'isi' => 'v_home'
        );
        // $data['idtanah'] = null;

        echo view('template/v_wrapper', $data);
    }
}
