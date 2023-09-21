@extends('layout.main')

@section('container')

    <div class="card border-dark mb-3 position-absolute top-50 start-50 translate-middle" style="max-width: 36rem;">
        <div class="card-header">Tambah Buku</div>
        <div class="card-body">
            <form class="row g-3" method="post" action="{{ route('buku.store') }}">
            @csrf
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Judul</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="title" name = "judul">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Penulis</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="writer" name = "penulis">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Harga</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="price" name = "harga">
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Tangal terbit</label>
                    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="YY/MM/DD" name = "terbit">
                </div>

                <div class="vstack gap-2 col-md-5 mx-auto">
                    <button class="btn btn-outline-primary" type="submit">Simpan</button>
                </div>
                <a class="btn btn btn-outline-danger" href="/buku" role="button">Batal</a>
            </form>
        </div>
    </div>

@endsection