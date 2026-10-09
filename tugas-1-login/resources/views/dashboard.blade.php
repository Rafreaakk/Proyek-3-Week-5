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

        <h3>Selamat datang {{ Auth::user()->nama_lengkap }}</h3>
        <p>Halaman ini hanya bisa dibuka setelah login. </p>
        <p>Username: {{ Auth::user()->username }}</p>
    </div>
</body>
</html>