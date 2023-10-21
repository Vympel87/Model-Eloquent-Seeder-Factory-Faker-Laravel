@extends('layout.main')

@section('container')
    @php
        use Carbon\Carbon;
    @endphp

    <h1 class="display-4 ms-5 mt-2 center">Daftar Pencarian</h1>

    <div class="d-flex flex-row justify-content-between mb-3 mt-3 m-5">
        @if (count($data_buku))
            <div>Ditemukan <strong>{{ count($data_buku) }}</strong> buah data, dengan kata kunci <strong>{{ $cari }}</strong></div>
        @else
            <div class="alert alert-warning">Data dengan kata kunci <strong>{{ $cari }}</strong> tak ditemukan</div>
        @endif
        <a class="btn btn btn-outline-danger" href="/buku" role="button">Kembali</a>
    </div>

    <div class="d-flex align-items-center mb-3 mt-3 m-5">
        <form class="d-flex" action="{{ route('buku.search') }}" method="GET">
            @csrf
            <input type="text" name="kata" class="form-control search-input" placeholder="Cari ...">
            <button class="btn btn-outline-primary search-button" type="submit">Cari</button>
        </form>
    </div>

    @if (Session::has('pesan'))
        <div class="alert alert-success">{{ Session::get('pesan') }}</div>
    @endif

    <div class="mt-3 m-5">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Penulis</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Tanggal terbit</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_buku as $buku)
                    <tr>
                        <td>{{ ++$no }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp " . number_format($buku->harga, 2, ',', '.') }}</td>
                        <td>{{ Carbon::parse($buku->terbit)->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin untuk dihapus?')">Hapus</button>
                            </form>
                            <form action="{{ route('buku.update', $buku->id) }}" method="post">
                                @csrf
                                <a class="btn btn-primary mt-2" href="{{ route('buku.update', $buku->id) }}" role="button">Update</a>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
