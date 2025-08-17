<?php

namespace App\Controllers;

use App\Models\LayananModel;
use App\Models\ArtikelModel;

class SitemapController extends BaseController
{
    public function index()
    {
        $layananModel = new LayananModel();
        $artikelModel = new ArtikelModel();

        $data['static_urls'] = [
            ['loc' => base_url('/')],
            ['loc' => base_url('/layanan')],
            ['loc' => base_url('/galeri')],
            ['loc' => base_url('/artikel')],
            ['loc' => base_url('/lokasi')],
        ];

        $data['layanan_urls'] = $layananModel->findAll();
        $data['artikel_urls'] = $artikelModel->findAll();

        // Mengatur header agar browser membacanya sebagai file XML
        $this->response->setHeader('Content-Type', 'text/xml;charset=UTF-8');

        return view('sitemap', $data);
    }
}
