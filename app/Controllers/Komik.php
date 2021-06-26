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
        if (!$this->validate(
            [
                'judul' => [
                    'rules' => 'required|is_unique[komik.judul]',
                    'errors' => [
                        'required' => '{field} komik harus diisi',
                        'is_unique' => '{field} komik sudah terdaftar'
                    ]
                ],
                'penulis' => [
                    'rules' => 'required|is_unique[komik.judul]',
                    'errors' => [
                        'required' => '{field} komik harus diisi',
                        'is_unique' => '{field} komik sudah terdaftar'
                    ]
                ],
                'penerbit' => [
                    'rules' => 'required|is_unique[komik.judul]',
                    'errors' => [
                        'required' => '{field} komik harus diisi',
                        'is_unique' => '{field} komik sudah terdaftar'
                    ]
                ],
                'sampul'   => [
                    'rules' => 'is_image[sampul]|mime_in[sampul,image/png,image/jpg,image/jpeg]|max_size[sampul,1024]',
                    'errors' => [
                        'max_size' => 'ukuran gambar harus kurang 1 Mb',
                        'is_image' => 'yang anda upload bukan gambar',
                        'mime_is' => 'yang anda upload bukan gambar'
                    ]

                ]

            ]
        )) {
            //$validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/komik/create')->withInput();
        }
        //ambil gambarnya
        $fileSampul = $this->request->getFile('sampul');
        if ($fileSampul->getError() == 4) {
            $namaSampul = 'sampul.png';
        } else {
            //pindahkan ke file img di public
            // cara pertama
            // $fileSampul->move('img');
            // $namaSampul = $fileSampul->getName();

            //cara kedua
            //mengganti nama filenya dengan random untuk keamanan
            $namaSampul = $fileSampul->getRandomName();
            //pindahkan ke folder img
            $fileSampul->move('img', $namaSampul);
        }



        //$data = $this->request->getVar();
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->KomikModel->save(
            [
                'judul' => $this->request->getVar('judul'),
                'slug' => $slug,
                'penulis' => $this->request->getVar('penulis'),
                'penerbit' => $this->request->getVar('penerbit'),
                'sampul' => $namaSampul

            ]
        );
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to('/komik');
    }
    public function delete($id)
    {
        //cari gambar sampul dulu berdasarkan identify
        $komik = $this->KomikModel->find($id);
        //unlink di file img
        if ($komik['sampul'] != "sampul.png") {
            unlink('img/' . $komik['sampul']);
        }
        $this->KomikModel->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/komik');
    }
    public function edit($slug)
    {
        $data = [
            'title' => 'tambah data komik',
            'validation' => \config\Services::validation(),
            'komik' => $this->KomikModel->getKomik($slug)
        ];


        return  view('komik/edit', $data);
    }
    public function update($id)
    {
        $komiklama = $this->KomikModel->getKomik($this->request->getVar('slug'));
        if ($komiklama['judul'] == $this->request->getVar('judul')) {
            $rule_field = 'required';
        } else {
            $rule_field = 'required|is_unique[komik.judul]';
        }
        if (!$this->validate([
            'judul' => [
                'rules' => $rule_field,
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} komik sudah terdaftar'
                ]
            ],
            'sampul'   => [
                'rules' => 'is_image[sampul]|mime_in[sampul,image/png,image/jpg,image/jpeg]|max_size[sampul,1024]',
                'errors' => [
                    'max_size' => 'ukuran gambar harus kurang 1 Mb',
                    'is_image' => 'yang anda upload bukan gambar',
                    'mime_is' => 'yang anda upload bukan gambar'
                ]

            ]
        ])) {
            //$validation = \Config\Services::validation();
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();
        }

        $filesampul = $this->request->getFile('sampul');

        //cek apakah gambarnya tetap atau baru
        if ($filesampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            //generate nama background
            $namaSampul = $filesampul->getRandomName();
            //pindahkan ke file image
            $filesampul->move('img', $namaSampul);
            //hapus file sampulLama
            unlink('img/' . $this->request->getVar('sampulLama'));
        }
        $slug = url_title($this->request->getVar('judul'), '-', true);
        $this->KomikModel->save(
            [
                'id'    => $id,
                'judul' => $this->request->getVar('judul'),
                'slug' => $slug,
                'penulis' => $this->request->getVar('penulis'),
                'penerbit' => $this->request->getVar('penerbit'),
                'sampul' => $namaSampul

            ]
        );
        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->to('/komik');
    }
}
