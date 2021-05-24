<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Home|halaman utama'
		];
		echo view('template/header', $data);
		echo view('index');
		echo view('template/footer');
	}
}
