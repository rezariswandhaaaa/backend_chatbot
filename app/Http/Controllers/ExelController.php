<?php

namespace App\Http\Controllers;

use App\Imports\QuestionsImport;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ExelController extends Controller
{
    public function getImportedData()
    {
        try {
            // Ambil semua data pertanyaan dengan jawaban terkait
            $questions = Question::with('answers')->get();

            // Kirim response sukses
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diambil.',
                'data' => $questions,
            ], 200);
        } catch (\Exception $e) {
            // Log error jika terjadi kesalahan
            Log::error('Kesalahan saat mengambil data: ' . $e->getMessage());

            // Kirim response error
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengambil data.',
                'error' => $e->getMessage(),
            ], 400);
        }
    }

    public function importExcel(Request $request)
{
    try {
        // Validasi file
        $request->validate([
            'file' => 'required|file|mimes:xlsx|max:2048',
        ]);

        // Ambil file yang diunggah
        $uploadedFile = $request->file('file');

        // Log informasi file
        Log::info('File diterima: ' . $uploadedFile->getClientOriginalName());
        Log::info('Path sementara: ' . $uploadedFile->getRealPath());

        // Validasi ekstensi file
        if (!in_array($uploadedFile->getClientOriginalExtension(), ['xlsx'])) {
            return response()->json([
                'success' => false,
                'message' => 'Ekstensi file tidak didukung. Gunakan file dengan format xlsx',
            ], 400);
        }

        // Proses impor file menggunakan Maatwebsite Excel
        Excel::import(new QuestionsImport, $uploadedFile);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diimpor.',
        ], 200);
    } catch (\Exception $e) {
        // Tangani kesalahan jika ada
        Log::error('Kesalahan: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan saat memproses file.',
            'error' => $e->getMessage(),
        ], 500);
    }
}









}
