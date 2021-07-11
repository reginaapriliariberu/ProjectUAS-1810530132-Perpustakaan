<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    //

    protected $fillable = [
        'judul_buku', 'penulis_buku', 'penerbit_buku', 'tahun_terbit', 'stok',
    ];
}
