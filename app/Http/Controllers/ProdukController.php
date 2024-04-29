<?php

namespace App\Http\Controllers;

use App\Events\NewContentNotification;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produk = Produk::all();
        
        return view('produk.index', compact('produk'));

    }

    public function tesnotif()
    {
        event(new NewContentNotification('latihan pusher'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
       
         $request->validate([
            'nama' => 'required|max:255',
            'deskripsi' => 'required',
            'harga' => 'required|numeric',
            
        ]);
        
        
        $data = Produk::create([
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'harga' => $request->input('harga'),
        ]);

        $datasend = [

            'nama' => $data->nama,
            'deskripsi' => $data->deskripsi, 
            'harga' => $data->harga,
            'message' =>'data produk Berhasil di tambahkan' 
        ]; 

        event(new NewContentNotification($datasend));

        // $produk = new Produk(); 
        // $produk->nama = $validatedData['nama'];
        // $produk->deskripsi = $validatedData['deskripsi'];
        // $produk->harga = $validatedData['harga'];
       
        // $produk->save();

        return back()->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
