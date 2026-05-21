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
        $user = auth()->user();

        // Jika super admin lihat semua hadiah
        if ($user->role === 'super_admin') {

            $prizes = Prize::select(
                'id',
                'nama_hadiah',
                'peluang',
                'warna'
            )->get();

        } else {

            // User biasa hanya area sendiri
            $prizes = Prize::where('area_id', $user->area_id)
                ->select(
                    'id',
                    'nama_hadiah',
                    'peluang',
                    'warna'
                )
                ->get();
        }

        return response()->json($prizes);
    }

    public function spin()
    {
        $user = auth()->user();

        // Ambil hadiah berdasarkan area
        if ($user->role === 'super_admin') {

            $prizes = Prize::all(); 

        } else {

            $prizes = Prize::where(
                'area_id',
                $user->area_id
            )->get();
        }

        // Jika hadiah kosong
        if ($prizes->isEmpty()) {

            return response()->json([
                'success' => false,
                'message' => 'Tidak ada hadiah tersedia'
            ]);
        }

        // Hitung total peluang
        $totalWeight = $prizes->sum('peluang');

        // Random angka
        $randomValue = rand(1, $totalWeight);

        $currentWeight = 0;

        $winner = null;

        // Weighted random
        foreach ($prizes as $prize) {

            $currentWeight += $prize->peluang;

            if ($randomValue <= $currentWeight) {

                $winner = $prize;

                break;
            }
        }

        // Simpan history spin
        DB::table('history_spin')->insert([
    'user_id' => $user->id,
    'hadiah' => $winner->nama_hadiah,
    'area_id' => $user->area_id,
    'waktu' => now(),
]);

        // Response hasil spin
        return response()->json([
            'success' => true,
            'winner_id' => $winner->id,
            'winner_name' => $winner->nama_hadiah,
            'winner_color' => $winner->warna,
        ]);
    }
}