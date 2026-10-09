<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog - Toko Denim</title>
</head>
<body style="font-family: monospace; max-width: 800px; margin: 20px auto; padding: 20px; border: 1px dashed #000;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
        <h2>Toko Celana Denim</h2>
        <div>
            @auth
                <span>Halo, {{ Auth::user()->nama_lengkap }}!</span> |
                <a href="{{ url('/keranjang') }}">[ Keranjang ]</a> |
                <a href="{{ url('/riwayat') }}">[ Riwayat ]</a>
                <form action="{{ url('/logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" style="background:none; border:none; color:blue; text-decoration:underline; cursor:pointer; font-family:inherit; padding:0;">[ Logout ]</button>
                </form>
            @else
                <!-- Jika belum login -->
                <a href="{{ url('/login') }}">[ Login untuk Berbelanja ]</a>
            @endauth
        </div>
    </div>

    @if(session('error'))
        <div style="color: red; margin-bottom: 15px; padding: 10px; border: 1px dashed red;">
            [ ! ] {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div style="color: green; margin-bottom: 15px; padding: 10px; border: 1px dashed green;">
            [ v ] {{ session('success') }}
        </div>
    @endif

    <p>Daftar Barang :</p>
    @foreach($products as $p)
    <div style="border-bottom: 1px dotted #ccc; padding: 15px 0; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center;">
            <!-- Menggunakan API gambar acak sementara -->
            <img src="https://picsum.photos/seed/{{ $p->id_barang }}/70/70" alt="{{ $p->nama_barang }}" style="width: 70px; height: 70px; object-fit: cover; border: 1px solid #ccc; margin-right: 15px;">
            <div>
                <strong>{{ $p->nama_barang }}</strong><br>
                Rp {{ number_format($p->harga, 0, ',', '.') }}<br>
                Stok: {{ $p->stok }}
            </div>
        </div>
        
        <div>
            @if($p->stok > 0)
                <form action="{{ url('/keranjang/tambah/'.$p->id_barang) }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit">[ Masukkan ke keranjang ]</button>
                </form>
            @else
                <button disabled style="color: grey; cursor: not-allowed;">[ Stok Habis ]</button>
            @endif
        </div>
    </div>
    @endforeach

</body>
</html>