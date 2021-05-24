<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{
    protected $KomikModel;
    public function __construct()
    {
        //guna bisa diakses semua method
        //tapi bisa juga di akses disemua kelas jika kita tarus Di BaseController
        $this->KomikModel = new KomikModel();
    }
    public function index()
    {
        //cara buka db tanpa model walaupun itu tidak di rekomendasikan
        // $db = db_connect();
        // $Komik = $db->query('SELECT*FROM komik');
        // //dd($Komik);
        // foreach ($Komik->getResultArray() as $row) {
        //     d($row);
        // }

        //menghubungkan menggunakan model
        //1.pertama di instansiasi
        //$KomikModel = new \App\Models\KomikModel();
        //2.menggunakan 'Use' untuk menyingkat namespace
        //$KomikModel = new KomikModel();
        $komik = $this->KomikModel->findAll();
        //dd($komik);
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $komik
        ];
        return  view('komik/index', $data);
    }
}
