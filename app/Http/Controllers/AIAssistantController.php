<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class AIAssistantController extends Controller
{
    /**
     * Tampilkan halaman chat AI Assistant.
     */
    public function index()
    {
        return view('ai.index');
    }

    /**
     * Kirim chat ke Gemini API dengan konteks database real-time.
     */
    public function chat(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:1000',
        ]);

        $question = $request->input('question');
        $apiKey = env('GEMINI_API_KEY');

        // Check if API Key exists
        if (!$apiKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kunci API Gemini (GEMINI_API_KEY) belum dikonfigurasi di file .env Anda. Silakan tambahkan kunci API terlebih dahulu untuk mengaktifkan AI.'
            ], 400);
        }

        // 1. Ambil data stok suku cadang dari database
        $spareparts = Sparepart::all();
        $sparepartsContext = "Daftar Stok Suku Cadang (Spareparts):\n";
        if ($spareparts->isEmpty()) {
            $sparepartsContext .= "Tidak ada data suku cadang di database.\n";
        } else {
            foreach ($spareparts as $part) {
                $sparepartsContext .= "- [Kode: {$part->code}] {$part->name} ({$part->brand}) | Stok: {$part->stock} {$part->unit} | Harga Jual: Rp " . number_format($part->selling_price, 0, ',', '.') . "\n";
            }
        }

        // 2. Ambil data antrean service hari ini
        $today = Carbon::today()->toDateString();
        $services = Service::with(['vehicle.customer'])
            ->whereDate('service_date', $today)
            ->orderBy('id')
            ->get();

        $queueContext = "Daftar Antrean Service Hari Ini ({$today}):\n";
        if ($services->isEmpty()) {
            $queueContext .= "Tidak ada antrean service hari ini.\n";
        } else {
            $no = 1;
            foreach ($services as $service) {
                $plate = $service->vehicle->plate_number ?? '-';
                $customerName = $service->vehicle->customer->name ?? 'Tanpa Nama';
                $complaint = $service->complaint ?? 'Tidak ada keluhan';
                $status = $service->status ?? 'Menunggu';
                $queueContext .= "{$no}. Antrean #{$no} | Plat: {$plate} | Pelanggan: {$customerName} | Keluhan: {$complaint} | Status: {$status}\n";
                $no++;
            }
        }

        // 3. Bangun System Prompt / Instruction
        $systemPrompt = "Anda adalah Asisten AI pintar bernama 'Jasolu AI' yang ditugaskan khusus untuk kasir/staff bengkel motor 'Jasolu Service'. Tugas utama Anda adalah membantu kasir menjawab pertanyaan pelanggan mengenai stok suku cadang, harga suku cadang, dan status antrean service pelanggan secara cepat, tepat, dan ramah.

Berikut adalah DATA REAL-TIME dari database bengkel hari ini:

=== DATA SUKU CADANG ===
{$sparepartsContext}

=== DATA ANTREAN SERVICE HARI INI ===
{$queueContext}

=== PETUNJUK MENJAWAB ===
1. Jawablah menggunakan Bahasa Indonesia yang ramah, ringkas, sopan, dan langsung ke intinya.
2. Jika ditanyakan tentang stok suku cadang, sebutkan nama suku cadang, kode barang, ketersediaan stok, dan harganya secara detail.
3. Jika ditanyakan tentang antrean service (misalnya dengan menyebutkan plat nomor atau nama pelanggan):
   - Cari data pelanggan tersebut dari data antrean di atas.
   - Informasikan nomor antrean ke-berapa mereka hari ini.
   - Sebutkan status service saat ini (Menunggu / Diproses / Selesai) dan keluhannya.
4. Jika data suku cadang atau plat nomor/nama pelanggan yang ditanyakan tidak tercantum dalam data di atas, katakan dengan sopan bahwa data tersebut tidak ditemukan dalam sistem bengkel saat ini.
5. Jangan berasumsi atau membuat informasi/data palsu di luar data database yang diberikan di atas.";

        try {
            // Panggil Gemini API
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $question]
                        ]
                    ]
                ],
                'systemInstruction' => [
                    'parts' => [
                        ['text' => $systemPrompt]
                    ]
                ]
            ]);

            if ($response->successful()) {
                $result = $response->json();
                $reply = $result['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya tidak menerima respon dari AI. Silakan coba lagi.';
                
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply
                ]);
            } else {
                $errorMsg = $response->json('error.message') ?? 'Terjadi kesalahan pada server AI.';
                return response()->json([
                    'status' => 'error',
                    'message' => 'Gemini API Error: ' . $errorMsg
                ], $response->status());
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Kesalahan koneksi: ' . $e->getMessage()
            ], 500);
        }
    }
}
