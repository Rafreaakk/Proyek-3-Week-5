<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampillkan daftar barang (Katalog)
    public function index()
    {
        $barangs = Barang::all();
        $cart = session()->get('cart', []);
        $totalItem = array_sum($cart); // Menghitung total qty di keranjang

        return view('katalog', compact('barangs','totalItem'));
    }

    // Menampilkan isi keranjang
    public function cart()
    {
        $cart = session()->get('cart', []);

        $cartItems = [];
        $totalHarga = 0;

        foreach ($cart as $id => $jumlah) {
            $barang = Barang::find($id);
            if ($barang) {
                $subtotal = $barang->harga * $jumlah;
                $totalHarga += $subtotal;

                $cartItems[] = [
                    'id' => $id,
                    'nama' => $barang->nama,
                    'harga' => $barang->harga,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return view('keranjang', compact('cartItems', 'totalHarga'));
    }

    // Tambah produk ke keranjang
    public function add($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]++; // Tambah jumlah jika produk sudah ada
        } else {
            $cart[$id] = 1;
        }

        session()->put('cart', $cart);
        return redirect('/');
    }

    // Ubah jumlah item di keranjang
    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        $action = $request->input('action'); 

        if (isset($cart[$id])) {
            if ($action == 'plus') {
                $cart[$id]++;
            } elseif ($action == 'minus') {
                $cart[$id]--;
                if ($cart[$id] <= 0) {
                    unset($cart[$id]); 
                }
            }
            session()->put('cart', $cart);
        }
        return redirect('/keranjang');
    }

    // Hapus satu jenis produk dari keranjang
    public function remove($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect('/keranjang');
    }

    // Kosongkan semua isi keranjang
    public function clear() 
    {
        session()->forget('cart');
        return redirect('/keranjang');
    }

}
