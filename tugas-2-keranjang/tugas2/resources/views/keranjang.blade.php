<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <style>
        body { font-family: monospace; display: flex; justify-content: center; padding: 40px 10px; margin: 0; background-color: #f4f4f9; }
        .box { border: 1px dashed #333; padding: 20px; width: 100%; max-width: 500px; background: white; }
        .header { font-weight: bold; font-size: 16px; margin-bottom: 5px; }
        .item { margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px dotted #ccc; }
        .actions { display: flex; gap: 5px; margin-top: 8px; align-items: center; }
        .total { font-weight: bold; font-size: 16px; margin-top: 15px; }
        button { padding: 4px 8px; cursor: pointer; font-family: monospace; }
        form { margin: 0; }
        a { color: blue; text-decoration: none; }
    </style>
</head>
<body>
    <div class="box">
        <div class="header">Keranjang belanja Tanpa login</div>
        <a href="{{ url('/') }}">&laquo; Kembali ke Katalog</a>
        <hr>
        
        @if(count($cartItems) > 0)
            @foreach($cartItems as $item)
            <div class="item">
                <strong>{{ $item['nama'] }}</strong><br>
                Rp {{ number_format($item['harga'], 0, ',', '.') }} x {{ $item['jumlah'] }} = 
                <strong>Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</strong>
                
                <div class="actions">
                    <form action="{{ url('/keranjang/update/'.$item['id']) }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="minus">
                        <button type="submit">[-]</button>
                    </form>
                    
                    <span style="font-weight:bold; margin: 0 5px;">{{ $item['jumlah'] }}</span>
                    
                    <form action="{{ url('/keranjang/update/'.$item['id']) }}" method="POST">
                        @csrf
                        <input type="hidden" name="action" value="plus">
                        <button type="submit">[+]</button>
                    </form>

                    <form action="{{ url('/keranjang/hapus/'.$item['id']) }}" method="POST" style="margin-left: 15px;">
                        @csrf
                        <button type="submit">[hapus]</button>
                    </form>
                </div>
            </div>
            @endforeach
            
            <div class="total">Total Rp {{ number_format($totalHarga, 0, ',', '.') }}</div>
            <hr>
            
            <form action="{{ url('/keranjang/kosongkan') }}" method="POST" style="text-align: center; margin-top: 20px;">
                @csrf
                <button type="submit">[ Kosongkan keranjang ]</button>
            </form>
        @else
            <p>Keranjang masih kosong.</p>
        @endif
    </div>
</body>
</html>