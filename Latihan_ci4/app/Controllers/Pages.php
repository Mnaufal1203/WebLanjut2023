<?php

		namespace App\Controllers;
		use App\Models\ProdukModel;

		class Page extends BaseController
		{
			public function keranjang()
			{
				return view('Pages/keranjang_view');
			} 

			public function produk()
			{
				$produkModel = new ProdukModel(); 
				$produk = $produkModel->findAll();
				$data['produks'] = $produk;

				return view('Pages/produk_view', $data);
			} 
		}