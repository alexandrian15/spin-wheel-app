<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prize;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $search = $request->input('search', '');

        $limit = (int) $request->input('limit', 10);

        $historyLimit = (int) $request->input('history_limit', 10);

    
    

        /*
        |--------------------------------------------------------------------------
        | QUERY HADIAH
        |--------------------------------------------------------------------------
        */

        $hadiahQuery = Prize::query();

        // Jika bukan super admin
        if ($user->role !== 'super_admin') {

            $hadiahQuery->where(
                'area_id',
                $user->area_id
            );
        }

        // Search
        if (!empty($search)) {

            $hadiahQuery->where(function ($query) use ($search) {

                $query->where(
                    'nama_hadiah',
                    'like',
                    "%{$search}%"
                )
                ->orWhere(
                    'peluang',
                    'like',
                    "%{$search}%"
                );

            });
        }

        $hadiah = $hadiahQuery
            ->orderBy('id', 'ASC')
            ->limit($limit)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | QUERY HISTORY
        |--------------------------------------------------------------------------
        */

        $historyQuery = DB::table('history_spin');

        // Jika bukan super admin
        if ($user->role !== 'super_admin') {

            $historyQuery->where(
                'area_id',
                $user->area_id
            );
        }

        $history = $historyQuery
            ->select(
                'id',
                'hadiah',
                'waktu'
            )
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

    /*
    |--------------------------------------------------------------------------
    | TAMBAH HADIAH
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_hadiah' => 'required|string|max:255',
            'peluang' => 'required|numeric|min:1|max:100',
            'warna' => 'nullable|string'
        ]);

        // otomatis area user login
        $validated['area_id'] = auth()->user()->area_id;

        Prize::create($validated);

        return redirect('/admin')
            ->with(
                'success',
                'Hadiah berhasil ditambahkan'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE HADIAH
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama_hadiah' => 'required|string|max:255',
            'peluang' => 'required|numeric|min:1|max:100',
            'warna' => 'nullable|string'
        ]);

        $prize = Prize::findOrFail($id);

        // Cegah edit area lain
        if (
            auth()->user()->role !== 'super_admin'
            &&
            $prize->area_id != auth()->user()->area_id
        ) {
            abort(403);
        }

        $prize->update($validated);

        return redirect('/admin')
            ->with(
                'success',
                'Hadiah berhasil diperbarui'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS HADIAH
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $prize = Prize::findOrFail($id);

        // Cegah hapus area lain
        if (
            auth()->user()->role !== 'super_admin'
            &&
            $prize->area_id != auth()->user()->area_id
        ) {
            abort(403);
        }

        $prize->delete();

        return redirect('/admin')
            ->with(
                'success',
                'Hadiah berhasil dihapus'
            );
    }
        /*
    |--------------------------------------------------------------------------
    | LIST USER
    |--------------------------------------------------------------------------
    */

    public function users()
    {
        // hanya super admin
        if (auth()->user()->role !== 'super_admin') {
            abort(403);
        }

        $users = DB::table('users')
            ->leftJoin('areas', 'users.area_id', '=', 'areas.id')
            ->select(
                'users.id',
                'users.name',
                'users.email',
                'users.role',
                'users.area_id',
                'areas.name as area_name'
            )
            ->orderBy('users.id', 'ASC')
            ->get();

        $areas = DB::table('areas')->get();

        return view(
            'admin-users',
            compact(
                'users',
                'areas'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE AREA USER
    |--------------------------------------------------------------------------
    */

    public function updateUserArea(Request $request, $id)
    {
        // hanya super admin
        if (auth()->user()->role !== 'super_admin') {
            abort(403);
        }

        $request->validate([
            'area_id' => 'required|exists:areas,id',
            'role' => 'required'
        ]);

        DB::table('users')
            ->where('id', $id)
            ->update([
                'area_id' => $request->area_id,
                'role' => $request->role,
            ]);

        return redirect('/admin/users')
            ->with(
                'success',
                'User berhasil diupdate'
            );
    }
}