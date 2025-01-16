<?php

namespace App\Imports;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class QuestionsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Log untuk debugging baris yang sedang diproses
        Log::info('Baris yang diproses:', $row);

        // Pastikan kolom 'question_text' ada dan tidak kosong
        if (isset($row['question_text']) && !empty($row['question_text'])) {
            // Buat data pertanyaan baru
            $question = Question::create([
                'question_text' => $row['question_text'],
            ]);

            // Jika kolom 'answer_text' ada dan tidak kosong, tambahkan jawaban
            if (isset($row['answer_text']) && !empty($row['answer_text'])) {
                $question->answers()->create([
                    'answer_text' => $row['answer_text'],
                ]);
            }

            // Kembalikan objek pertanyaan
            return $question;
        }

        // Jika tidak ada data yang valid, kembalikan null
        return null;
    }

}
