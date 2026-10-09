<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tugas 1</title>
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
            max-width: 380px; 
            box-sizing: border-box;
        }
        .error { 
            color: red; 
            margin-bottom: 15px; 
        }
        .form-group { 
            margin-bottom: 15px; 
        }
        label { 
            display: block; 
            margin-bottom: 5px; 
        }
        input[type="text"], input[type="password"] { 
            width: 100%; 
            padding: 8px; 
            box-sizing: border-box;
        }
        button { 
            margin-top: 10px; /* Jarak antara input password dan tombol submit */
            padding: 8px 20px; 
            cursor: pointer; 
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="box">
        <h3>localhost:8000/login</h3>
        <hr>
        <h2>Login</h2>
        <p>Masuk untuk membuka dashboard</p>

        <!-- Menampilkan pesan error jika login gagal -->
        @error('username')
            <div style="color: red; margin-bottom: 15px;">
                [ {{ $message }} ]
            </div>
        @enderror

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="{{ old('username') }}" required autofocus>
            </div>

            <div clas="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>