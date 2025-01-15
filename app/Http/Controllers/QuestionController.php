<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function getAnswer()
    {
        // Ambil input pertanyaan dari pengguna
        $questionText = Request('question');



        // Cari pertanyaan yang sesuai dengan input pengguna
        $question = Question::where('question_text', 'like', '%' . $questionText . '%')->first();

        // Jika pertanyaan tidak ditemukan
        if (!$question) {
            return response()->json(['error' => 'Pertanyaan tidak ditemukan.'], 404);
        }

        // Ambil jawaban yang terkait dengan pertanyaan tersebut
        $answers = $question->answers;

        // Jika jawaban tidak ditemukan
        if ($answers->isEmpty()) {
            return response()->json(['error' => 'Jawaban tidak ditemukan.'], 404);
        }

        // Kembalikan jawaban
        return response()->json($answers);
    }
}
