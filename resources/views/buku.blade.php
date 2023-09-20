<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    @php
        use Carbon\Carbon;
    @endphp
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
                    <td>{{ "Rp ".number_format($buku->harga, 2, ',', ',') }}</td>
                    <td>{{ Carbon::parse($buku->terbit)->format('d/m/Y') }}</td>
                    <td><a href="#" id="edit">Edit</a> | <a href="#" id="delete">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
      </table>

    <h3>
        Tugas Praktikum
    </h3>
    <p>
        Ada {{ $total_data }} data dalam tabel Buku <br>
        Harga total dari {{ $total_data }} buah buku di atas adalah Rp {{ $jumlah_harga }}
    </p>
  </body>
</html>