<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create([
            'title' => 'Laskar Pelangi',
            'description' => 'Kisah inspiratif sekelompok anak Belitung yang memiliki semangat belajar tinggi.',
            'price' => 75000.00,
            'stock' => 15,
            'cover_photo' => 'laskar_pelangi.jpg',
            'genre_id' => 1, // Fiksi
            'author_id' => 1 // Andrea Hirata
        ]);
        Book::create([
            'title' => 'Pulang',
            'description' => 'Novel tentang kehidupan perantauan dan pencarian jati diri.',
            'price' => 85500.00,
            'stock' => 20,
            'cover_photo' => 'pulang.jpg',
            'genre_id' => 1, // Fiksi
            'author_id' => 2 // Tere Liye
        ]);
        Book::create([
            'title' => 'Harry Potter and the Sorcerer\'s Stone',
            'description' => 'Buku pertama dari seri Harry Potter yang memperkenalkan dunia sihir.',
            'price' => 125000.00,
            'stock' => 5,
            'cover_photo' => 'harry_potter.jpg',
            'genre_id' => 3, // Fantasi
            'author_id' => 3 // J.K. Rowling
        ]);
        Book::create([
            'title' => 'It',
            'description' => 'Kisah horor ikonik tentang badut Pennywise yang meneror sekelompok anak.',
            'price' => 99900.00,
            'stock' => 10,
            'cover_photo' => 'it.jpg',
            'genre_id' => 4, // Horor
            'author_id' => 4 // Stephen King
        ]);
        Book::create([
            'title' => 'Supernova: Ksatria, Puteri, dan Bintang Jatuh',
            'description' => 'Seri fiksi ilmiah yang menggabungkan sains, spiritualitas, dan kisah cinta.',
            'price' => 90000.00,
            'stock' => 25,
            'cover_photo' => 'supernova.jpg',
            'genre_id' => 1, // Fiksi
            'author_id' => 5 // Dewi Lestari
        ]);
    }
}