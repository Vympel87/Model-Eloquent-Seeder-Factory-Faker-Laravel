<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batas = 10;
        $data_buku = Buku::orderBy('id')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);
        $total_data = Buku::count();
        $jumlah_harga = Buku::sum('harga');


        return view('buku', compact('data_buku', 'no', 'total_data', 'jumlah_harga'));
    }

    public function search(Request $request){
        $batas = 10;
        $cari = $request->kata;
        $data_buku = Buku::where('judul', 'like', '%'.$cari.'%')->orwhere('penulis','like', '%'.$cari.'%')->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas * ($data_buku->currentPage() - 1);
        return view('search', compact('jumlah_buku', 'no', 'data_buku', 'no', 'cari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'terbit' => 'required|date',
        ]); 
        $buku = new Buku;
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->terbit = $request->terbit;
        $buku->save();
        return redirect('/buku')->with(`pesan`,`Buku berhasil disimpan`);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);
        return view('update', compact('buku'));
    }

    public function updateData(Request $request, $id)
    {
        $buku = Buku::find($id);
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->terbit = $request->terbit;
        $buku->save();
        return redirect('/buku');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Buku::find($id);
        $book->delete();

        return redirect('/buku');

    }
}
