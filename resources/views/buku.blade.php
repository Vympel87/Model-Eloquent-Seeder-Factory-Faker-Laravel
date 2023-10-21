@extends('layout.main')

@section('container')
    @php
        use Carbon\Carbon;
    @endphp

    <h1 class="display-4 ms-5 mt-2 center">Daftar Buku</h1>

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
                    <td>{{ "Rp ".number_format($buku->harga, 2, ',', '.') }}</td>
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

    <h3 class="ms-5 mt-3">
        INFO DATA
    </h3>

    <p class="ms-5">
        Ada {{ $total_data }} data dalam tabel Buku <br>
        Harga total dari {{ $total_data }} buah buku di atas adalah Rp {{ $jumlah_harga }}
    </p>

    <p align = "left"><a class="btn btn-primary ms-5 mt-2 mb-5" href="{{ route('buku.create') }}" role="button">Tambah Buku</a></p>

    <div class="d-flex justify-content-center mt-3">
      <nav aria-label="Page navigation">
          <ul class="pagination">
              <li class="page-item {{ !$data_buku->previousPageUrl() ? 'disabled' : '' }}">
                  @if ($data_buku->previousPageUrl())
                      <a class="btn btn-outline-primary" href="{{ $data_buku->previousPageUrl() }}" style="margin-right: 10px;">Sebelumnya</a>
                  @else
                      <span class="btn btn-outline-primary" style="margin-right: 10px; pointer-events: none;">Sebelumnya</span>
                  @endif
              </li>
              <li class="page-item {{ !$data_buku->nextPageUrl() ? 'disabled' : '' }}">
                  @if ($data_buku->nextPageUrl())
                      <a class="btn btn-outline-primary" href="{{ $data_buku->nextPageUrl() }}">Selanjutnya</a>
                  @else
                      <span class="btn btn-outline-primary" style="pointer-events: none;">Selanjutnya</span>
                  @endif
              </li>
          </ul>
      </nav>
  </div>
  
  <div class="pagination-info bg-secondary text-light text-center">
      Menampilkan halaman {{ $data_buku->currentPage() }} dari {{ $data_buku->lastPage() }}, total {{ $data_buku->total() }} data.
  </div>
  

@endsection
