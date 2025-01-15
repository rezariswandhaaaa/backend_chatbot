<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Answer::insert([
            // Jawaban untuk pertanyaan ID 1
            ['answer_text' => 'Jam Layanan Perpustakaan UMY dibagi menjadi beberapa macam :.', 'question_id' => 11],

            // Jawaban untuk pertanyaan ID 2
            

            // Jawaban untuk pertanyaan ID 3
            ['answer_text' => 'Perpustakaan Pusat UMY menyediakan 40 unit komputer yang dapat diakses oleh civitas akademika UMY. Ruang komputer tersebut berada di Gedung D. lantai 3.', 'question_id' => 13],




        ]);
    }
}
