<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h1>Daftar Buku</h1>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Pesan error --}}
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Informasi --}}
    <div class="alert alert-info">
        <strong>Total Buku :</strong> {{ $totalBuku }} <br>
        <strong>Buku Tersedia :</strong> {{ $bukuTersedia }} <br>
        <strong>Buku Habis :</strong> {{ $bukuHabis }}
    </div>

    <div class="mb-3">
        <a href="{{ route('buku.create') }}" class="btn btn-primary">
            Tambah Buku
        </a>
    </div>

    <h3>Daftar Buku</h3>

    <form action="{{ route('buku.bulk-delete') }}" method="POST">
        @csrf

        <button type="submit"
                class="btn btn-danger mb-3"
                onclick="return confirm('Yakin ingin menghapus buku yang dipilih?')">
            Hapus Terpilih
        </button>

        <table class="table table-bordered table-striped">

            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>

                    <th>
                        <input type="checkbox" id="select-all">
                    </th>
                </tr>
            </thead>

            <tbody>

                @forelse($bukus as $index => $buku)

                    <tr>

                        <td>{{ $index + 1 }}</td>

                        <td>{{ $buku->kode_buku }}</td>

                        <td>{{ $buku->judul }}</td>

                        <td>{{ $buku->pengarang }}</td>

                        <td>{{ $buku->kategori }}</td>

                        <td>
                            Rp {{ number_format($buku->harga, 0, ',', '.') }}
                        </td>

                        <td>

                            @if($buku->stok > 0)

                                <span class="badge bg-success">
                                    {{ $buku->stok }}
                                </span>

                            @else

                                <span class="badge bg-danger">
                                    Habis
                                </span>

                            @endif

                        </td>

                        <td>

                            <a href="{{ route('buku.show', $buku->id) }}"
                               class="btn btn-info btn-sm">
                                Detail
                            </a>

                            <a href="{{ route('buku.edit', $buku->id) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                        </td>

                        <td>

                            <input type="checkbox"
                                   name="buku_ids[]"
                                   value="{{ $buku->id }}">

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="9" class="text-center">
                            Data buku tidak tersedia.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </form>

</div>

<script>

    document.getElementById('select-all').addEventListener('change', function () {

        document.querySelectorAll('input[name="buku_ids[]"]')
            .forEach(function (checkbox) {

                checkbox.checked = document.getElementById('select-all').checked;

            });

    });

</script>

</body>
</html>