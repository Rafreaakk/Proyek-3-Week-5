<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller
{
    // Menampilkan halaman utama (Katalog)
    public function index()
    {
        $products = Product::all();
        return view('katalog', compact('products'));
    }

    // Menampilkan halaman keranjang
    public function cart()
    {
        $cart = session()->get('cart', []);
        $totalHarga = 0;
        $cartItems = [];

        foreach ($cart as $id => $qty) {
            $product = \App\Models\Product::find($id);
            if ($product) {
                $subtotal = $product->harga * $qty;
                $totalHarga += $subtotal;
                $cartItems[$id] = [
                    'nama_barang' => $product->nama_barang,
                    'harga' => $product->harga,
                    'jumlah' => $qty,
                    'subtotal' => $subtotal,
                    'stok' => $product->stok
                ];
            }
        }

        return view('keranjang', compact('cartItems', 'totalHarga'));
    }

    // Menambah barang ke keranjang
    public function addToCart($id)
    {
        $product = \App\Models\Product::find($id);
        if (!$product || $product->stok < 1) {
            return back()->with('error', 'Barang tidak ditemukan atau stok habis.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Cek apakah jumlah melebihi stok
            if ($cart[$id] + 1 > $product->stok) {
                return back()->with('error', 'Jumlah melebihi stok yang tersedia!');
            }
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Barang berhasil ditambahkan ke keranjang!');
    }

    // Mengubah jumlah barang (+ / -)
    public function updateCart(Request $request, $id)
    {
        $action = $request->input('action');
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $product = \App\Models\Product::find($id);
            
            if ($action == 'plus') {
                if ($cart[$id] + 1 > $product->stok) {
                    return back()->with('error', 'Jumlah pesanan melebihi stok!');
                }
                $cart[$id]++;
            } elseif ($action == 'minus') {
                $cart[$id]--;
                if ($cart[$id] <= 0) {
                    unset($cart[$id]); // Hapus jika jumlah 0
                }
            }
            session()->put('cart', $cart);
        }
        return back();
    }

    // Menghapus barang dari keranjang
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return back();
    }

    // Proses Checkout
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/')->with('error', 'Keranjang kosong, tidak bisa checkout!');
        }

        $totalHarga = 0;
        foreach ($cart as $id => $qty) {
            $product = Product::find($id);
            if ($product) $totalHarga += ($product->harga * $qty);
        }

        $id_order = 'ORD-' . time();
        $user = Auth::user();

        DB::beginTransaction();
        try {
            // 1. Simpan ke tabel orders
            Order::create([
                'id_order' => $id_order,
                'id_user' => $user->id_user,
                'tanggal_order' => now(),
                'total_harga' => $totalHarga,
                'alamat_pengiriman' => $user->alamat // Menggunakan alamat default user
            ]);

            // 2. Simpan ke order_details dan kurangi stok
            foreach ($cart as $id => $qty) {
                $product = Product::find($id);
                if ($product) {
                    OrderDetail::create([
                        'id_order' => $id_order,
                        'id_barang' => $id,
                        'harga_satuan' => $product->harga,
                        'jumlah_beli' => $qty
                    ]);

                    // Kurangi stok di database
                    $product->stok -= $qty;
                    $product->save();
                }
            }

            // 3. Kosongkan keranjang setelah berhasil
            session()->forget('cart');
            DB::commit();

            return redirect('/riwayat')->with('success', 'Checkout berhasil! Pesanan sedang diproses.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan sistem saat checkout.');
        }
    }

    // Menampilkan Riwayat Pesanan
    public function riwayat()
    {
        $user = Auth::user();
        // Ambil data pesanan beserta detail barangnya khusus untuk user yang sedang login
        $orders = Order::with('details.product')
                    ->where('id_user', $user->id_user)
                    ->orderBy('tanggal_order', 'desc')
                    ->get();

        return view('riwayat', compact('orders'));
    }

}
