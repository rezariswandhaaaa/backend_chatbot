<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function storeQuestionAndAnswer(Request $request){
    // Validasi input
        $validatedData = $request->validate([
            'question_text' => 'required|string',
            'answer' => 'required|string',
        ]);

    // Simpan pertanyaan
        $question = Question::create([
            'question_text' => $validatedData['question_text'],
        ]);

    // Simpan jawaban
        Answer::create([
            'answer_text' => $validatedData['answer'],
            'question_id' => $question->id,
        ]);

        return response()->json([
            'message' => 'Pertanyaan dan jawaban berhasil disimpan',
            'data' => [
                'question' => $question,
                'answer' => $validatedData['answer'],
            ]
        ], 201);
    }

    public function getQuestionsWithAnswers()
    {
        try {
            $questions = Question::with('answers')->orderBy('created_at', 'desc')->get();

            return response()->json([
                'message' => 'Data pertanyaan dan jawaban berhasil diambil',
                'data' => $questions,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateQuestionAndAnswer(Request $request, $id)
    {
        $validatedData = $request->validate([
            'question_text' => 'required|string',
            'answer_text' => 'required|string',
        ]);

        try {
            $question = Question::findOrFail($id);
            $question->update([
                'question_text' => $validatedData['question_text'],
            ]);

            $answer = $question->answers()->first();
            $answer->update([
                'answer_text' => $validatedData['answer_text'],
            ]);

            return response()->json([
                'message' => 'Pertanyaan dan jawaban berhasil diperbarui',
                'data' => [
                    'question' => $question,
                    'answer' => $answer,
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function deleteQuestionAndAnswer($id)
    {
        try {
            $question = Question::findOrFail($id);

            // Delete related answers
            $question->answers()->delete();

            // Delete the question
            $question->delete();

            return response()->json([
                'message' => 'Pertanyaan dan jawaban berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }

}
