<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prize;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search', '');
        $limit = (int) $request->input('limit', 10);
        $historyLimit = (int) $request->input('history_limit', 10);

        $hadiahQuery = DB::table('hadiah');

        if (!empty($search)) {
            $hadiahQuery->where('nama_hadiah', 'like', "%{$search}%")
                        ->orWhere('peluang', 'like', "%{$search}%");
        }

        $hadiah = $hadiahQuery->orderBy('id', 'ASC')
                              ->limit($limit)
                              ->get();

        $history = DB::table('history_spin')
                    ->orderBy('id', 'DESC')
                    ->limit($historyLimit)
                    ->get();

        return view(
            'admin',
            compact(
                'hadiah',
                'history',
                'search',
                'limit',
                'historyLimit'
            )
        );

    }

    // Tambah hadiah baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_hadiah' => 'required|string|max:255',
            'peluang' => 'required|numeric|min:1|max:100',
            'warna' => 'nullable|string'
        ]);

        Prize::create($validated);

        return redirect('/admin')->with('success', 'Hadiah berhasil ditambahkan');
    }

    // Update hadiah
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_hadiah' => 'required|string|max:255',
            'peluang' => 'required|numeric|min:1|max:100',
            'warna' => 'nullable|string'
        ]);

        Prize::findOrFail($id)->update($validated);

        return redirect('/admin')->with('success', 'Hadiah berhasil diperbarui');
    }

    // Hapus hadiah
    public function destroy($id)
    {
        Prize::findOrFail($id)->delete();

        return redirect('/admin')->with('success', 'Hadiah berhasil dihapus');
    }

}