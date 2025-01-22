<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bukus = Buku::get();

       $bukus = Buku::with('kategori')->where('status', 'aktif')->get();
        
       // $bukus = Buku::with('kategori')->where('status', 'aktif')->orderBy('created_at', 'DESC')->get();
         
        // $bukus = Buku::with('kategori')
        // ->where('status','aktif')
        // ->orderBy('created_at', 'DESC')
        // ->get()
        // ->take(2);

        
     return view('dashboard.index', compact('bukus'));

     // $query = Buku::get()
    //-> map(function ($q){
      // return[
          //  'id_buku'=> $q -> id_buku,
          // 'judul' => $q -> judul,
          //  'penulis'=> $q -> penulis,
           // 'status' => $q -> status,
          //  'tanggal' => Carbon::parse($q->created_at)->translatedFormat('d F  Y'),
          //  'nama_kategori'=> $q->kategori->nama

       
    }
}