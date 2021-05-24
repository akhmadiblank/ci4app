<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Home | Halaman utama'
        ];

        //jika menggunakan cara biasa
        // echo view('template/header', $data);
        // echo view('Pages/index');
        // echo view('template/footer');

        //jika menggunakan teknik templating engine
        return  view('Pages/index', $data);
    }
    public function about()
    {
        $data = [
            'title' => 'About'
        ];
        echo view('template/header', $data);
        echo view('Pages/about');
        echo view('template/footer');
    }

    public function contact()
    {
        $data = [

            'title'   => 'contact us',
            'alamat'  => [
                [
                    'type' => 'rumah',
                    'alamat' => 'sukorejo',
                    'kota' => 'lumajang'
                ],
                [
                    'type' => 'kantor',
                    'alamat' => 'lowokwaru',
                    'kota' => 'malang'
                ]
            ]
        ];
        return  view('pages/contact', $data);
    }
}
