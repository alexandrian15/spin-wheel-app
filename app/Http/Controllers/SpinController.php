<?php

namespace App\Http\Controllers;

use App\Models\Prize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpinController extends Controller
{
    public function index()
    {
        return view('wheel');
    }

    public function getPrizes()
    {
        // Ambil data dari database
        $prizes = Prize::select(['id', 'nama_hadiah', 'peluang','warna'])->get();

        return response()->json($prizes);
    }

    public function spin()
    {
        $prizes = Prize::all();

        if ($prizes->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Tidak ada hadiah']);
        }

        // Logika Weighted Random
        $totalWeight = $prizes->sum('peluang');
        $randomValue = rand(1, $totalWeight);
        
        $currentWeight = 0;
        $winner = null;

        foreach ($prizes as $prize) {
            $currentWeight += $prize->peluang;
            if ($randomValue <= $currentWeight) {
                $winner = $prize;
                break;
            }
        }

        // Simpan hasil ke history_spin
        DB::table('history_spin')->insert([
            'hadiah' => $winner->nama_hadiah,
            'waktu' => now(),
        ]);

        return response()->json([
            'success' => true,
            'winner_id' => $winner->id,
            'winner_name' => $winner->nama_hadiah,
            'winner_color' => $winner->warna,
        ]);
    }
}