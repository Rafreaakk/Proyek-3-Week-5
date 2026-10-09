<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang - Toko Denim</title>
</head>
<body style="font-family: monospace; max-width: 800px; margin: 20px auto; padding: 20px; border: 1px dashed #000;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
        <h2>Keranjang Belanja</h2>
        <a href="{{ url('/') }}">[ Kembali ke Katalog ]</a>
    </div>

    <!-- Alert Notifikasi -->
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

    @if(count($cartItems) > 0)
        <table style="width: 100%; text-align: left; border-collapse: collapse;">
            <tr style="border-bottom: 1px solid #000;">
                <th style="padding: 10px 0;">Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
            
            @foreach($cartItems as $id => $item)
            <tr style="border-bottom: 1px dotted #ccc;">
                <td style="padding: 10px 0;">{{ $item['nama_barang'] }}</td>
                <td>Rp {{ number_format($item['harga'], 0, ',', '.') }}</td>
                <td>
                    <form action="{{ url('/keranjang/update/'.$id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="action" value="minus">
                        <button type="submit">[-]</button>
                    </form>
                    <span style="margin: 0 10px;">{{ $item['jumlah'] }}</span>
                    <form action="{{ url('/keranjang/update/'.$id) }}" method="POST" style="display:inline;">
                        @csrf
                        <input type="hidden" name="action" value="plus">
                        <button type="submit">[+]</button>
                    </form>
                </td>
                <td>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                <td>
                    <form action="{{ url('/keranjang/hapus/'.$id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" style="color: red;">[ Hapus ]</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>

        <div style="text-align: right; margin-top: 20px; font-size: 1.2em;">
            <strong>Total Bayar: Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong>
        </div>

        <div style="text-align: right; margin-top: 20px;">
            <form action="{{ url('/checkout') }}" method="POST">
                @csrf
                <button type="submit" style="padding: 10px 20px; font-weight: bold; cursor: pointer;">[ Lanjutkan Checkout ]</button>
            </form>
        </div>
    @else
        <p>Keranjang masih kosong nih. Yuk belanja dulu!</p>
    @endif

</body>
</html>