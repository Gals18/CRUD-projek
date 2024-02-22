<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table ='barang'; //sesuaikan dengan nama tabel di database
    // ok primary keynya id_produk
    protected $primaryKey ='id_produk'; //sesuikan dengan nama kolom primarykey
    protected $fillable =[
        'id_produk',
        'nama_produk',
        'harga_produk',
        'gambar',
        'stok',
    ];
}
