<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan - Toko Denim</title>
</head>
<body style="font-family: monospace; max-width: 800px; margin: 20px auto; padding: 20px; border: 1px dashed #000;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #000; padding-bottom: 10px; margin-bottom: 20px;">
        <h2>Riwayat Pesanan</h2>
        <a href="{{ url('/') }}">[ Kembali ke Katalog ]</a>
    </div>

    @if(session('success'))
        <div style="color: green; margin-bottom: 15px; padding: 10px; border: 1px dashed green;">
            [ v ] {{ session('success') }}
        </div>
    @endif

    @if($orders->count() > 0)
        @foreach($orders as $order)
            <div style="border: 1px solid #ccc; margin-bottom: 20px; padding: 15px;">
                <strong>ID Pesanan: {{ $order->id_order }}</strong> | Waktu: {{ $order->tanggal_order }}<br>
                Alamat Tujuan: {{ $order->alamat_pengiriman }}<br>
                <hr style="border-top: 1px dotted #ccc;">
                <ul style="list-style-type: square; margin: 10px 0; padding-left: 20px;">
                    @foreach($order->details as $detail)
                        <li>
                            {{ $detail->product->nama_barang }} 
                            ({{ $detail->jumlah_beli }} x Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }})
                        </li>
                    @endforeach
                </ul>
                <hr style="border-top: 1px dotted #ccc;">
                <strong>Total Belanja: Rp {{ number_format($order->total_harga, 0, ',', '.') }}</strong>
            </div>
        @endforeach
    @else
        <p>Belum ada riwayat pesanan.</p>
    @endif

</body>
</html>