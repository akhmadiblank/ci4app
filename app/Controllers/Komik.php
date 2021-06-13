<?php

namespace App\Controllers;

use App\Controllers\Komik as ControllersKomik;
use App\Models\KomikModel;
use CodeIgniter\CodeIgniter;

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
        //$komik = $this->KomikModel->findAll();
        //dd($komik);
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $this->KomikModel->getKomik()
        ];

        return  view('komik/index', $data);
    }
    public function detail($slug)
    {
        //bisa pakai cara seperti di atas
        $komik = $this->KomikModel->getKomik($slug);
        $data = [
            'title' => 'Detail komik',
            'komik' => $komik
        ];
        if (empty($data['komik'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('error because ' . $slug . ' not found');
        }
        return  view('komik/detail', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'tambah data komik',
            'validation' => \config\Services::validation()
        ];


        return  view('komik/create', $data);
    }
    public function save()
    {
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
        }


        //$data = $this->request->getVar();
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->KomikModel->save(
            [
                'judul' => $this->request->getVar('judul'),
                'slug' => $slug,
                'penulis' => $this->request->getVar('penulis'),
                'penerbit' => $this->request->getVar('penerbit'),
                'sampul' => $this->request->getVar('sampul')

            ]
        );
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to('/komik');
    }
}
