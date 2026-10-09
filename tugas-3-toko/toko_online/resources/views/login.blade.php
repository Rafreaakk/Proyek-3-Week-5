<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toko Denim</title>
</head>
<body style="font-family: monospace; max-width: 400px; margin: 50px auto; padding: 20px; border: 1px dashed #000;">
    <h2>Login Toko</h2>
    
    @error('username')
        <div style="color: red; margin-bottom: 15px;">
            [ {{ $message }} ]
        </div>
    @enderror

    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div style="margin-bottom: 10px;">
            <label style="display:inline-block; width: 80px;">Username</label>
            <input type="text" name="username" value="{{ old('username') }}" required>
        </div>
        <div style="margin-bottom: 15px;">
            <label style="display:inline-block; width: 80px;">Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">[ Masuk ]</button>
    </form>
</body>
</html>