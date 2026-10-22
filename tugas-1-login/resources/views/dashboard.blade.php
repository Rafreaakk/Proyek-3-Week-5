<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Tugas 1</title>
    <style>
        body { 
            font-family: monospace; 
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #ffffff;
        }
        .box { 
            border: 1px dashed #333; 
            padding: 25px; 
            width: 100%;
            max-width: 400px; 
            box-sizing: border-box;
        }
        .header { 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
        }
        button { 
            padding: 5px 12px; 
            cursor: pointer; 
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="header">
            <h3>Dashboard</h3>
            <!-- Logout memakai metode POST dan @csrf -->
            <form action="{{ url('/logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
        <hr>

        @if (session('status'))
            <div style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; margin-bottom: 15px;">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3>Selamat datang {{ Auth::user()->nama_lengkap }}</h3>
        <p>Halaman ini hanya bisa dibuka setelah login. </p>
        <p>Username: {{ Auth::user()->username }}</p>
        
        <!-- Form Simulasi Ubah Role -->
        <form action="/admin/users/2/role" method="POST" style="margin-bottom: 20px; border: 1px solid black; padding: 10px;">
            @csrf
            @method('PATCH')
            <label>ID Target (Ganti tulisan TARGET_ID di URL action form ini pada kodingan)</label><br>
            <input type="text" name="role" placeholder="Ketik role (staff/customer/admin)">
            <button type="submit">Ubah Role</button>
        </form>

        <!-- Form Simulasi Cart W06 -->
        <form action="/cart/add" method="POST" style="border: 1px solid black; padding: 10px;">
            @csrf
            <button type="submit">Test Add to Cart</button>
        </form>

        
    </div>
</body>
</html>