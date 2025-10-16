<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        Author::create([
            'name' => 'Andrea Hirata',
            'photo' => 'andrea_hirata.jpg',
            'bio' => 'Penulis novel "Laskar Pelangi" yang terkenal.'
        ]);
        Author::create([
            'name' => 'Tere Liye',
            'photo' => 'tere_liye.jpg',
            'bio' => 'Penulis produktif dengan karya-karya populer seperti "Hafalan Shalat Delisa".'
        ]);
        Author::create([
            'name' => 'J.K. Rowling',
            'photo' => 'jk_rowling.jpg',
            'bio' => 'Penulis seri novel fantasi "Harry Potter".'
        ]);
        Author::create([
            'name' => 'Stephen King',
            'photo' => 'stephen_king.jpg',
            'bio' => 'Dikenal sebagai "Raja Horor" dengan banyak karya laris.'
        ]);
        Author::create([
            'name' => 'Dewi Lestari',
            'photo' => 'dewi_lestari.jpg',
            'bio' => 'Penulis dan musisi, terkenal dengan seri "Supernova".'
        ]);
    }
}