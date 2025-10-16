<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        Genre::create([
            'name' => 'Fiksi',
            'description' => 'Genre yang berisi cerita-cerita rekaan atau khayalan.'
        ]);
        Genre::create([
            'name' => 'Non-Fiksi',
            'description' => 'Genre yang menyajikan informasi berdasarkan fakta dan kenyataan.'
        ]);
        Genre::create([
            'name' => 'Fantasi',
            'description' => 'Genre yang melibatkan sihir dan dunia-dunia imajinatif.'
        ]);
        Genre::create([
            'name' => 'Horor',
            'description' => 'Genre yang bertujuan untuk menimbulkan rasa takut pada pembaca.'
        ]);
        Genre::create([
            'name' => 'Romance',
            'description' => 'Genre yang berfokus pada hubungan dan kisah cinta.'
        ]);
    }
}