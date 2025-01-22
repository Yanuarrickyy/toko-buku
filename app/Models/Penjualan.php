<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan'; 
    protected $primaryKey = 'id_penjualan';
    protected $fillable = [
        'user_id',
        'buku_id',
        'tanggal_transaksi',
        'jumlah',
        'harga',
        'total_harga',
        'pembayaran',
        'kembalian',
        'status',
    ];
    
    
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }
    
    public function buku(): BelongsTo
    {
        return $this->belongsTo(Buku::class, 'buku_id', 'id_buku'); 
    }
}
