<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width,
initial-scale=1.0">

<title>Admin Spin Wheel</title>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<style>

.history-filter{
    margin-bottom:20px;
}

.filter-btn{
    padding:10px 18px;
    border:none;
    border-radius:12px;
    cursor:pointer;
    margin-right:10px;
    background:#374151;
    color:white;
    font-weight:600;
    transition:0.3s;
    box-shadow:0 4px 10px rgba(0,0,0,0.2);
}

.filter-btn:hover{
    background:#4b5563;
    transform:translateY(-2px);
}

.filter-btn.active{
    background:linear-gradient(90deg,#22c55e,#16a34a);
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:linear-gradient(135deg,#111827,#0f172a);
    color:white;
    min-height:100vh;
    padding:40px;
}

.container{
    width:100%;
    max-width:1400px;
    margin:auto;
}

.title{
    font-size:34px;
    font-weight:700;
    margin-bottom:30px;
    letter-spacing:0.5px;
}

.card{
    background:#1f2937;
    padding:25px;
    border-radius:24px;
    margin-bottom:30px;
    box-shadow:0 10px 30px rgba(0,0,0,0.35);
    border:1px solid rgba(255,255,255,0.05);
}

.card-title{
    font-size:22px;
    margin-bottom:20px;
    font-weight:600;
}

.table-wrapper{
    overflow-x:auto;
}

.table{
    width:100%;
    border-collapse:collapse;
    background:#fff;
    color:#111827;
    border-radius:18px;
    overflow:hidden;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

.table th{
    background:linear-gradient(90deg,#374151,#1f2937);
    color:white;
    padding:16px;
    text-align:left;
    font-size:14px;
    font-weight:600;
    letter-spacing:0.5px;
}

.table td{
    padding:15px 16px;
    border-bottom:1px solid #e5e7eb;
    font-size:14px;
    transition:0.2s;
}

.table tr:nth-child(even){
    background:#f9fafb;
}

.table tr:hover{
    background:#f3f4f6;
}

.badge{
    display:inline-block;
    padding:6px 12px;
    border-radius:999px;
    font-size:12px;
    font-weight:600;
    background:linear-gradient(90deg,#22c55e,#16a34a);
    color:white;
}

.empty{
    text-align:center;
    padding:20px;
    color:#6b7280;
}

.grid{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:25px;
}

@media(max-width:900px){
    .grid{
        grid-template-columns:1fr;
    }
}

.form-group{
    margin-bottom:20px;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:500;
    color:white;
}

.form-group input,
.form-group select{
    width:100%;
    padding:12px 14px;
    border:1px solid #d1d5db;
    border-radius:10px;
    font-size:14px;
    background:white;
    color:black;
    transition:0.2s;
}

.form-group input:focus,
.form-group select:focus{
    outline:none;
    border-color:#3b82f6;
    box-shadow:0 0 0 4px rgba(59,130,246,0.15);
}

.btn{
    padding:10px 16px;
    border:none;
    border-radius:10px;
    font-weight:600;
    cursor:pointer;
    font-size:14px;
    transition:0.25s;
    box-shadow:0 4px 10px rgba(0,0,0,0.15);
}

.btn:hover{
    transform:translateY(-2px);
}

.btn-primary{
    background:linear-gradient(90deg,#3b82f6,#2563eb);
    color:white;
}

.btn-success{
    background:linear-gradient(90deg,#22c55e,#16a34a);
    color:white;
}

.btn-warning{
    background:linear-gradient(90deg,#f59e0b,#d97706);
    color:white;
    font-size:12px;
    padding:6px 12px;
}

.btn-danger{
    background:linear-gradient(90deg,#ef4444,#dc2626);
    color:white;
    font-size:12px;
    padding:6px 12px;
}

.btn-secondary{
    background:linear-gradient(90deg,#6b7280,#4b5563);
    color:white;
}

.actions{
    display:flex;
    gap:8px;
}

.modal{
    display:none;
    position:fixed;
    z-index:1000;
    left:0;
    top:0;
    width:100%;
    height:100%;
    background-color:rgba(0,0,0,0.6);
    backdrop-filter:blur(4px);
}

.modal.active{
    display:flex;
    align-items:center;
    justify-content:center;
}

.modal-content{
    background:#1f2937;
    padding:30px;
    border-radius:24px;
    width:90%;
    max-width:500px;
    box-shadow:0 20px 60px rgba(0,0,0,0.5);
}

.modal-header{
    font-size:24px;
    font-weight:700;
    margin-bottom:20px;
    color:white;
}

.modal-footer{
    display:flex;
    gap:10px;
    margin-top:30px;
    justify-content:flex-end;
}

.close-modal{
    background:none;
    border:none;
    color:white;
    font-size:28px;
    cursor:pointer;
    float:right;
}

.alert{
    padding:15px 20px;
    border-radius:10px;
    margin-bottom:20px;
    font-size:14px;
}

.alert-success{
    background:#d1fae5;
    color:#065f46;
}

.alert-danger{
    background:#fee2e2;
    color:#991b1b;
}

.input-row{
    display:flex;
    gap:15px;
}

.input-row .form-group{
    flex:1;
}



</style>
</head>
<body>

<div style="
    position:fixed;
    top:25px;
    right:25px;
    z-index:9999;
">

    <form method="POST" action="{{ route('logout') }}">

        @csrf

        <button
            type="submit"
            style="
                background:transparent;
                border:none;
                cursor:pointer;
                display:flex;
                align-items:center;
                justify-content:center;
            "
        >

            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="52"
                height="52"
                fill="none"
                viewBox="0 0 24 24"
                stroke="#d5c1c1"
                stroke-width="2.2"
                style="
                    transition:0.25s;
                "
                onmouseover="
                    this.style.transform='scale(1.12)';
                    this.style.stroke='#ff444a';
                "
                onmouseout="
                    this.style.transform='scale(1)';
                    this.style.stroke='#fcfcfc';
                "
            >

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1
                    a2 2 0 01-2 2H6a2 2 0 01-2-2V7
                    a2 2 0 012-2h5a2 2 0 012 2v1"
                />

            </svg>

        </button>

    </form>

</div>

<div class="container">

    <h1 class="title">
        Dashboard Admin Spin Wheel
    </h1>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <div class="grid">

        <!-- ===================================== -->
        <!-- FORM TAMBAH HADIAH -->
        <!-- ===================================== -->

        <div class="card">

            <h2 class="card-title">
                Tambah Hadiah Baru
            </h2>

            <form action="/admin/hadiah" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama_hadiah">Nama Hadiah</label>
                    <p class="note">
                    ⚡ tolong pakai huruf besar ⚡
                    </p>
                    <input 
                        type="text" 
                        id="nama_hadiah"
                        name="nama_hadiah" 
                        placeholder="Contoh: ORTUSEIGHT"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="peluang">Peluang (%)</label>
                    <input 
                        type="number" 
                        id="peluang"
                        name="peluang" 
                        placeholder="Contoh: 10"
                        min="1"
                        max="100"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="warna">Warna (Optional)</label>
                    <input 
                        type="color" 
                        id="warna"
                        name="warna" 
                        value="#3b82f6"
                    >
                </div>

                <button type="submit" class="btn btn-success" style="width:100%;">
                    Tambah Hadiah
                </button>

            </form>

        </div>

        <!-- ===================================== -->
        <!-- TABEL HADIAH -->
        <!-- ===================================== -->

        <div class="card">

            <h2 class="card-title">
                DATA HADIAH 
            </h2>

            <div class="history-filter" style="margin-bottom:20px;">
                <form method="GET" class="input-row" style="align-items:flex-end; gap:12px; flex-wrap:wrap;">
                    <input type="hidden" name="history_limit" value="{{ $historyLimit ?? 10 }}">

                    <div class="form-group" style="flex:2; min-width:300px;">
                        <div style="display:flex; gap:10px; align-items:center;">
                            <input
                                type="text"
                                id="hadiah_search"
                                name="search"
                                value="{{ old('search', $search ?? '') }}"
                                placeholder="Cari nama atau peluang"
                                style="flex:1;"
                            >
                            <button type="submit" class="btn btn-primary" style="white-space:nowrap;">
                                Search
                            </button>
                        </div>
                    </div>

                    <div class="form-group" style="flex:0 0 150px; min-width:150px;">
                        <label for="limit">Fillter</label>
                        <select id="limit" name="limit" onchange="this.form.submit()" style="width: 50%; padding:8px 10px; font-size:13px;">
                            <option value="5" {{ isset($limit) && $limit == 5 ? 'selected' : '' }}>5 Data</option>
                            <option value="10" {{ isset($limit) && $limit == 10 ? 'selected' : '' }}>10 Data</option>
                            <option value="20" {{ isset($limit) && $limit == 20 ? 'selected' : '' }}>20 Data</option>
                            <option value="50" {{ isset($limit) && $limit == 50 ? 'selected' : '' }}>50 Data</option>
                        </select>
                    </div>
                </form>
            </div>

            <div class="table-wrapper">

                <table class="table">

                    <thead>

                        <tr>
                            <th>ID</th>
                            <th>Nama Hadiah</th>
                            <th>Peluang</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>

                    <tbody>

                    @forelse($hadiah as $item)

                        <tr>

                            <td>
                                {{ $item->id }}
                            </td>

                            <td>
                                {{ $item->nama_hadiah }}
                            </td>

                            <td>
                                {{ $item->peluang }}%
                            </td>

                            <td>
                                <div class="actions">
                                    <button 
                                        class="btn btn-warning"
                                        onclick="openEditModal({{ $item->id }}, '{{ $item->nama_hadiah }}', {{ $item->peluang }}, '{{ $item->warna ?? '#3b82f6' }}')">
                                        Edit
                                    </button>
                                    <form 
                                        action="/admin/hadiah/{{ $item->id }}" 
                                        method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button 
                                            type="submit" 
                                            class="btn btn-danger"
                                            onclick="return confirm('Yakin ingin menghapus?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="4" class="empty">
                                Tidak ada data hadiah
                            </td>
                        </tr>

                    @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    <!-- ===================================== -->
    <!-- TABEL HISTORY -->
    <!-- ===================================== -->

    <div class="card">

        <h2 class="card-title">
            History Spin Database
        </h2>

        <div class="history-filter" style="margin-bottom:20px;">
            <form method="GET" style="display:flex; gap:12px; align-items:flex-end; flex-wrap:wrap;">
                <div class="form-group" style="flex:0 0 150px; min-width:150px;">
                    <label for="history_limit">Tampilkan</label>
                    <select id="history_limit" name="history_limit" onchange="this.form.submit()" style="width:100%; padding:8px 10px; font-size:13px;">
                        <option value="5" {{ isset($historyLimit) && $historyLimit == 5 ? 'selected' : '' }}>5 Data</option>
                        <option value="10" {{ isset($historyLimit) && $historyLimit == 10 ? 'selected' : '' }}>10 Data</option>
                        <option value="20" {{ isset($historyLimit) && $historyLimit == 20 ? 'selected' : '' }}>20 Data</option>
                        <option value="50" {{ isset($historyLimit) && $historyLimit == 50 ? 'selected' : '' }}>50 Data</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="table-wrapper">

            <table class="table">

                <thead>

                    <tr>
                        <th>ID</th>
                        <th>Hadiah</th>
                        <th>Waktu</th>
                    </tr>

                </thead>

                <tbody>

                @forelse($history as $item)

                    <tr>

                        <td>
                            {{ $item->id }}
                        </td>

                        <td>
                            {{ $item->hadiah }}
                        </td>

                        <td>
                            {{ $item->waktu }}
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="3" class="empty">
                            Tidak ada history spin
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- ===================================== -->
<!-- MODAL EDIT HADIAH -->
<!-- ===================================== -->

<div id="editModal" class="modal">

    <div class="modal-content">

        <button class="close-modal" onclick="closeEditModal()">&times;</button>

        <h2 class="modal-header">Edit Hadiah</h2>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="edit_nama_hadiah">Nama Hadiah</label>
                <input 
                    type="text" 
                    id="edit_nama_hadiah"
                    name="nama_hadiah" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="edit_peluang">Peluang (%)</label>
                <input 
                    type="number" 
                    id="edit_peluang"
                    name="peluang" 
                    min="1"
                    max="100"
                    required
                >
            </div>

            <div class="form-group">
                <label for="edit_warna">Warna</label>
                <input 
                    type="color" 
                    id="edit_warna"
                    name="warna"
                >
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeEditModal()">
                    Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>
            </div>

        </form>

    </div>

</div>

<script>

function openEditModal(id, nama, peluang, warna) {
    document.getElementById('edit_nama_hadiah').value = nama;
    document.getElementById('edit_peluang').value = peluang;
    document.getElementById('edit_warna').value = warna;
    
    const form = document.getElementById('editForm');
    form.action = `/admin/hadiah/${id}`;
    
    document.getElementById('editModal').classList.add('active');
}

function closeEditModal() {
    document.getElementById('editModal').classList.remove('active');
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('editModal');
    if (event.target === modal) {
        modal.classList.remove('active');
    }
}

</script>

</body>
</html>