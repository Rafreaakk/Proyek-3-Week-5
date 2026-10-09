<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Celana Denim</title>
    <style>
        body { font-family: monospace; display: flex; justify-content: center; padding: 40px 10px; margin: 0; background-color: #f4f4f9; }
        .box { border: 1px dashed #333; padding: 20px; width: 100%; max-width: 500px; background: white; }
        .header { display: flex; justify-content: space-between; font-weight: bold; margin-bottom: 10px; font-size: 16px; }
        .item { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px dotted #ccc; }
        .item-info { flex: 1; }
        button { padding: 4px 8px; cursor: pointer; font-family: monospace; }
        a { color: blue; text-decoration: none; }
        .product-img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 15px;
        }
        .item-content {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="header">
            <span>Toko Celana Denim</span>
            <a href="{{ url('/keranjang') }}">[ Keranjang ({{ $totalItem }}) ]</a>
        </div>
        <hr>
        <p>Daftar barang :</p>
        
        @php 
            $gambar_produk = [
                1 => 'https://wingmandenim.com/wp-content/uploads/2026/05/Zero-Zeke-Scovill-1-1-scaled-1-1229x1536.webp',
                2 => 'https://wingmandenim.com/wp-content/uploads/2026/05/Katalog-BrownFire-2026-1-scaled-1.webp',
                3 => 'https://wingmandenim.com/wp-content/uploads/2026/05/Kogane-1-no-label.webp',
                4 => 'https://wingmandenim.com/wp-content/uploads/2026/05/Katalog-Mirage-1-1-scaled-1-1229x1536.webp',
                5 => 'https://wingmandenim.com/wp-content/uploads/2026/05/Katalog-Seafire-1-scaled-1-1229x1536.webp',
            ];
        @endphp

        @foreach($barangs as $barang)
        <div class="item">
         <div class="item-content">
            <img src="{{ $gambar_produk[$barang->id] ?? 'https://via.placeholder.com/70' }}" alt="{{ $barang->nama }}" class="product-img">
            
            <div class="item-info">
                [img] <strong>{{ $barang->nama }}</strong><br>
                Rp {{ number_format($barang->harga, 0, ',', '.') }}
            </div>
         </div>  
            
            <!-- Form untuk tambah ke keranjang -->
            <form action="{{ url('/keranjang/tambah/'.$barang->id) }}" method="POST" style="margin: 0;">
                @csrf
                <button type="submit">[Masukkan ke keranjang]</button>
            </form>
        </div>
        @endforeach
    </div>
</body>
</html>