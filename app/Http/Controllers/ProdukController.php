<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Produk;
use App\Http\Requests\Edit\ProdukRequest;

class ProdukController extends Controller
{
    public function index()
    {
        $user = Auth::user()->load(['penjual']);
        $daftarProduk = Produk::where('penjual_id', $user->penjual->id)->get();
        return view('users.penjual.dashboard', ['daftarProduk' => $daftarProduk]);
    }

    public function edit(Produk $produk)
    {
        return view('users.penjual.lihat-produk', compact('produk'));
    }

    public function update(ProdukRequest $request, Produk $produk)
    {
        $produk->update($request->all());
        return redirect()->back()->with('success', 'Produk ' . $produk->nama_produk . ' berhasil diperbaharui !');
    }
}
