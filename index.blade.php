@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>
        <i class="bi bi-book"></i>
        Daftar Buku
    </h1>
    <link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <div class="d-flex gap-2">

        {{-- EXPORT CSV --}}
        <a href="{{ route('buku.export') }}" class="btn btn-success">
            <i class="bi bi-download"></i> Export CSV
        </a>

        {{-- TAMBAH BUKU --}}
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Buku
        </a>

    </div>
</div>

{{-- Statistik Cards --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Total Buku</h6>
                        <h2 class="mb-0">{{ $totalBuku }}</h2>
                    </div>
                    <div class="text-primary">
                        <i class="bi bi-book-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Tersedia</h6>
                        <h2 class="mb-0">{{ $bukuTersedia }}</h2>
                    </div>
                    <div class="text-success">
                        <i class="bi bi-check-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-danger">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-1">Buku Habis</h6>
                        <h2 class="mb-0">{{ $bukuHabis }}</h2>
                    </div>
                    <div class="text-danger">
                        <i class="bi bi-x-circle-fill" style="font-size: 3rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filter Kategori --}}
<div class="card mb-4">
    <div class="card-body">
        <h6 class="card-title">
            <i class="bi bi-funnel"></i> Filter Kategori:
        </h6>

        <div class="btn-group" role="group">
            <a href="{{ route('buku.index') }}" class="btn btn-sm {{ !isset($kategori) ? 'btn-primary' : 'btn-outline-primary' }}">
                Semua
            </a>
            <a href="{{ route('buku.kategori', 'Programming') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Programming' ? 'btn-primary' : 'btn-outline-primary' }}">
                Programming
            </a>
            <a href="{{ route('buku.kategori', 'Database') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Database' ? 'btn-primary' : 'btn-outline-primary' }}">
                Database
            </a>
            <a href="{{ route('buku.kategori', 'Web Design') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Web Design' ? 'btn-primary' : 'btn-outline-primary' }}">
                Web Design
            </a>
            <a href="{{ route('buku.kategori', 'Networking') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Networking' ? 'btn-primary' : 'btn-outline-primary' }}">
                Networking
            </a>
            <a href="{{ route('buku.kategori', 'Data Science') }}" class="btn btn-sm {{ isset($kategori) && $kategori == 'Data Science' ? 'btn-primary' : 'btn-outline-primary' }}">
                Data Science
            </a>
        </div>
    </div>
</div>

{{-- Search --}}
<div class="card mb-4">
    <div class="card-header">
        <h5>
            <i class="bi bi-search"></i>
            Search & Filter Buku
        </h5>
    </div>

    <div class="card-body">

        <form action="{{ route('buku.search') }}" method="GET">
            <div class="row">

                <div class="col-md-3">
                    <input type="text" name="keyword" class="form-control"
                           placeholder="Cari buku..."
                           value="{{ request('keyword') }}">
                </div>

                <div class="col-md-2">
                    <select name="kategori" class="form-select">
                        <option value="">Semua Kategori</option>
                        <option value="Programming">Programming</option>
                        <option value="Database">Database</option>
                        <option value="Web Design">Web Design</option>
                        option value="Networking">Networking</option>
                        <option value="Data Science">Data Science</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="tahun" class="form-select">
                        <option value="">Semua Tahun</option>
                        @for($i = date('Y'); $i >= 2000; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div class="col-md-2">
                    <select name="ketersediaan" class="form-select">
                        <option value="">Semua</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>

                    <a href="{{ route('buku.index') }}" class="btn btn-secondary">
                        Reset
                    </a>
                </div>

            </div>
        </form>

    </div>
</div>

{{-- ================= BULK DELETE FORM ================= --}}
<form action="{{ route('buku.bulk-delete') }}" method="POST">
@csrf

<div class="mb-3">
    <input type="checkbox" id="select-all">
    <label for="select-all">Select All</label>

    <button type="submit" class="btn btn-danger btn-sm"
            onclick="return confirm('Yakin ingin menghapus buku terpilih?')">
        Delete Selected
    </button>
</div>

{{-- Daftar Buku --}}
<div class="row">

@forelse ($bukus as $buku)

    <div class="col-md-4 mb-4">

        <div class="card h-100 shadow-sm">

            <div class="card-body">

                {{-- CHECKBOX BULK DELETE --}}
                <input type="checkbox" name="buku_ids[]" value="{{ $buku->id }}" class="mb-2">

                <div class="text-center mb-3">
                    <i class="bi bi-book display-1"></i>
                </div>

                <h5 class="card-title">{{ $buku->judul }}</h5>

                <p><strong>Pengarang:</strong> {{ $buku->pengarang }}</p>

                <p><strong>Harga:</strong> Rp {{ number_format($buku->harga,0,',','.') }}</p>

                <p><strong>Stok:</strong> {{ $buku->stok }}</p>

                <span class="badge bg-primary">{{ $buku->kategori }}</span>

                @if($buku->stok > 0)
                    <span class="badge bg-success">Tersedia</span>
                @else
                    <span class="badge bg-danger">Habis</span>
                @endif

            </div>

            <div class="card-footer">

                <div class="btn-group-hertical d-grid gap-2">

                    <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-sm btn-info text-white">
                        <i class="bi bi-eye"></i> Detail
                    </a>

                    <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>

                    {{-- DELETE SINGLE (SweetAlert) --}}
                    <form action="{{ route('buku.destroy', $buku->id) }}"
                          method="POST"
                          class="d-inline delete-form">

                        @csrf
                        @method('DELETE')

                        <button type="button"
                                class="btn btn-sm btn-danger w-100 btn-delete"
                                data-judul="{{ $buku->judul }}">
                            <i class="bi bi-trash"></i> Hapus
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@empty

    <div class="col-12">
        <div class="alert alert-info">
            <i class="bi bi-info-circle"></i>
            Tidak ada data buku

            @isset($kategori)
                dengan kategori <strong>{{ $kategori }}</strong>
            @endisset
        </div>
    </div>

@endforelse

</div>

</form>
{{-- ================= END BULK DELETE FORM ================= --}}

@if ($bukus->count() > 0)
<div class="text-center mt-4">
    <p class="text-muted">
        Menampilkan {{ $bukus->count() }} buku
    </p>
</div>
@endif

@endsection


@push('scripts')

<script>
// SELECT ALL
document.getElementById('select-all').addEventListener('change', function() {
    document.querySelectorAll('input[name="buku_ids[]"]').forEach(cb => {
        cb.checked = this.checked;
    });
});

// SWEET ALERT DELETE SINGLE
document.querySelectorAll('.btn-delete').forEach(button => {

    button.addEventListener('click', function(e) {

        e.preventDefault();

        const form = this.closest('form');
        const judul = this.dataset.judul;

        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: `Apakah Anda yakin ingin menghapus buku "${judul}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }

        });

    });

});
</script>

@endpush