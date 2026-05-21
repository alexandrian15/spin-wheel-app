<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prize;
use App\Models\Area;

class AdminController extends Controller
{
    public function index(Request $request)
{
    $user = auth()->user();

    // =========================
    // DATA HADIAH
    // =========================

   if ($user->role === 'super_admin') {

    $hadiah = Prize::with('area');

    // Filter area khusus super admin
    if (
        $request->filled('filter_area')
        && $request->filter_area != ''
    ) {

        $hadiah->where(
            'area_id',
            $request->filter_area
        );

    }

} else {

    // Admin biasa hanya area sendiri
    $hadiah = Prize::with('area')
        ->where(
            'area_id',
            $user->area_id
        );

}

    // Search
    if ($request->search) {

        $hadiah->where(function ($q) use ($request) {

            $q->where(
                'nama_hadiah',
                'like',
                '%' . $request->search . '%'
            )
            ->orWhere(
                'peluang',
                'like',
                '%' . $request->search . '%'
            );

        });

    }

    $limit = $request->limit ?? 10;

    $hadiah = $hadiah
        ->orderBy('id', 'asc')
        ->limit($limit)
        ->get();

    // =========================
    // HISTORY
    // =========================
$historyLimit = $request->history_limit ?? 10;


    $history = DB::table('history_spin')
    ->leftJoin('areas', 'history_spin.area_id', '=', 'areas.id');
    
    if (
    $user->role === 'super_admin'
    && $request->history_area
) {

    $history->where(
        'history_spin.area_id',
        $request->history_area
    );

}

$history = $history
    ->select(
        'history_spin.id',
        'history_spin.hadiah',
        'history_spin.waktu',
        'history_spin.area_id',
        'areas.name'
    )

    ->orderByDesc('history_spin.id')
    ->limit($historyLimit)
    ->get();
    // =========================
    // AREAS
    // =========================

    $areas = Area::all();

    return view('admin', compact(
        'hadiah',
        'history',
        'areas',
        'limit',
        'historyLimit'
    ));
    
    

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
    $historyQuery->where('area_id', $user->area_id);
}

$history = $historyQuery
    ->select(
        'id',
        'area_id',
        'hadiah',
        'waktu' // <-- GANTI dengan nama kolom asli di tabel history_spin Anda (misal: 'username' atau 'name')
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
    $user = auth()->user();

    $validated = $request->validate([
        'nama_hadiah' => 'required|string|max:255',
        'peluang' => 'required|numeric|min:1|max:100',
        'warna' => 'nullable|string',
    ]);

    // Admin area otomatis area sendiri
    if ($user->role !== 'super_admin') {

        $validated['area_id'] = $user->area_id;

    } else {

        // Super admin pilih area manual
        $validated['area_id'] = $request->area_id;

    }

    Prize::create($validated);

    return redirect('/admin')
        ->with('success', 'Hadiah berhasil ditambahkan');
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
$areas = Area::all();
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