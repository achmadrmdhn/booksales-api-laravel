<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    // Relasi ke tabel authors
    public function author()
    {
        // Buku dimiliki oleh satu Penulis
        return $this->belongsTo(Author::class);
    }

    // Relasi ke tabel genres
    public function genre()
    {
        // Buku dimiliki oleh satu Genre
        return $this->belongsTo(Genre::class);
    }
}