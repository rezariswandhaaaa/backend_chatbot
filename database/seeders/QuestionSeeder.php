<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::insert([
            ['question_text' => 'Apa itu Repository??'],
            ['question_text' => 'Apa itu OPAC (Oniline Public Access Catalog)?'],
            ['question_text' => 'Berapa Jumlah buku yang dapat dipinjam?'],
            ['question_text' => 'Berapa lama masa pinjam buku di perpustakaan UMY?'],
            ['question_text' => 'Berapa denda yang diberikan jika terlambat mengembalikan buku?'],
            ['question_text' => 'Bagaimana prosedur untuk mendapatkan surat bebas pustaka?'],
            ['question_text' => 'Bagaimana cara meminjam buku secara online?'],
            ['question_text' => 'Jam layanan Perpustakaan UMY?'],
            ['question_text' => 'Ruang sidang Perpustakaan?'],
            ['question_text' => 'Ruang komputer?'],
            ['question_text' => 'Cek Turnitin?'],
        ]);
    }
}
