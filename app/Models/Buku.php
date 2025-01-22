<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table ='buku';

    protected $primaryKey ='id_buku';

    protected $fillable = [
        'kategori_id',
        'judul',
        'deskripsi',
        'penulis',
        'cover',
        'status',
        'harga', // Kolom harga ditambahkan
    ];
    
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id_kategori');
    }
    public function scopeAktif($query)
{
    return $query->where('status', 'aktif');
}
// Di Buku.php
public function peminjaman()
{
    return $this->hasMany(Peminjaman::class, 'buku_id', 'id_buku');
}

}