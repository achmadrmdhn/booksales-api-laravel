<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    public static function getAuthors()
    {
        return [
            [
                'id' => 1,
                'name' => 'Andrea Hirata',
                'photo' => 'andrea_hirata.jpg',
                'bio' => 'Penulis novel "Laskar Pelangi" yang terkenal.'
            ],
            [
                'id' => 2,
                'name' => 'Tere Liye',
                'photo' => 'tere_liye.jpg',
                'bio' => 'Penulis produktif dengan karya-karya populer seperti "Hafalan Shalat Delisa".'
            ],
            [
                'id' => 3,
                'name' => 'J.K. Rowling',
                'photo' => 'jk_rowling.jpg',
                'bio' => 'Penulis seri novel fantasi "Harry Potter".'
            ],
            [
                'id' => 4,
                'name' => 'Stephen King',
                'photo' => 'stephen_king.jpg',
                'bio' => 'Dikenal sebagai "Raja Horor" dengan banyak karya laris.'
            ],
            [
                'id' => 5,
                'name' => 'Dewi Lestari',
                'photo' => 'dewi_lestari.jpg',
                'bio' => 'Penulis dan musisi, terkenal dengan seri "Supernova".'
            ]
        ];
    }
}