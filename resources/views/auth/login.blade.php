<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Catering</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow: hidden;
            color: #333;
            /* Latar belakang hijau dari gambar */
            background: #879b55; 
        }
        .container {
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex-direction: column;
            padding: 20px;
            box-sizing: border-box;
        }
        .logo {
            width: 180px;
            margin-bottom: 20px;
        }
        .auth-box {
            background: rgba(230, 230, 210, 0.7); /* Latar belakang kotak transparan */
            padding: 30px 40px;
            border-radius: 20px;
            width: 100%;
            max-width: 400px;
            text-align: left;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
        .input-field {
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 10px;
            box-sizing: border-box;
            background: #e6e6d1; /* Warna input dari gambar */
        }
        .login-button {
            width: 100%;
            padding: 12px;
            background-color: #4A572A;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 10px;
        }
        .auth-links {
            text-align: center;
            margin-top: 15px;
            font-size: 0.9rem;
        }
        .auth-links a {
            color: #4A572A;
            font-weight: bold;
            text-decoration: none;
        }
        .forgot-password {
            text-align: right;
            font-size: 0.8rem;
            margin-top: -5px;
            margin-bottom: 15px;
        }
        .forgot-password a {
            color: #4A572A;
            text-decoration: none;
        }
        /* Ini untuk pesan error (Gambar image_34fda0.png) */
        .error-message {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border-radius: 5px;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <img src="{{ asset('image/LOGO1.png') }}" alt="Logo Catering" class="logo">

        <div class="auth-box">

            {{-- Menampilkan pesan sukses setelah registrasi --}}
            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif
            @if($errors->any())
                <div class="error-message">
                    Email atau password salah, silahkan masukkan email dan password yg benar
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" class="input-field" 
                           placeholder="masukkan email anda" 
                           value="{{ old('email') }}" required autofocus>
                </div>

                <div class="input-group">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" 
                           class="input-field" placeholder="masukkan password anda" required>
                </div>

                <div class="forgot-password">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">
                            lupa password?
                        </a>
                    @endif
                </div>

                <button type="submit" class="login-button">
                    login
                </button>

                <div class="auth-links">
                    belum punya akun? <a href="{{ route('register') }}">register</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>