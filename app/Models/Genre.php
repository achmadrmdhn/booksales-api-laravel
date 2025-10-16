<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;

    public static function getGenres()
    {
        return [
            [
                'id' => 1,
                'name' => 'Fiksi',
                'description' => 'Genre yang berisi cerita-cerita rekaan atau khayalan.'
            ],
            [
                'id' => 2,
                'name' => 'Non-Fiksi',
                'description' => 'Genre yang menyajikan informasi berdasarkan fakta dan kenyataan.'
            ],
            [
                'id' => 3,
                'name' => 'Fantasi',
                'description' => 'Genre yang melibatkan sihir dan dunia-dunia imajinatif.'
            ],
            [
                'id' => 4,
                'name' => 'Horor',
                'description' => 'Genre yang bertujuan untuk menimbulkan rasa takut pada pembaca.'
            ],
            [
                'id' => 5,
                'name' => 'Romance',
                'description' => 'Genre yang berfokus pada hubungan dan kisah cinta.'
            ]
        ];
    }
}