<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BiodataController extends Controller
{
    public function index()
    {
        $biodata = [
            'nama' => 'Aprilia Ica Faradila',
            'role' => 'Mahasiswa Universitas Nurul Jadid',
            'bio' => 'Saya lahir di Situbondo tetapi sekarang saya tinggal di Desa Taman, Paiton, Probolinggo. 
            Saya kuliah di jurusan Informatika, yang mengajarkan saya tentang teknologi. 
            Selain itu, Saya suka memasak karena dengan memasak saya dapat mengekspresikan kreativitas saya.',
            'social_media' => [
                ['name' => 'Facebook', 'url' => 'https://www.facebook.com/apriliaica.faradila', 'icon' => 'fab fa-facebook'],
                ['name' => 'TikTok', 'url' => 'https://www.tiktok.com/@qqoanpagd?_t=8nd6nVXHfMe&_r=1', 'icon' => 'fab fa-tiktok'],
                ['name' => 'Instagram', 'url' => 'https://www.instagram.com/apriliafadilaa?igsh=ZDlyeG5vN3RnZ2k5', 'icon' => 'fab fa-instagram'],
            ]            
        ];

        return view('trial.biodata')->with('biodata', $biodata);
    }
}
