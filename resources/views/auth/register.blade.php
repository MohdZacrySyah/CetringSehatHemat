<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Catering</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow-y: auto; /* Boleh scroll jika konten panjang */
            color: #333;
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
            min-height: 100vh;
        }
        .logo {
            width: 180px;
            margin-bottom: 20px;
        }
        .auth-box {
            background: rgba(230, 230, 210, 0.7);
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
            background: #ffffff; /* Input di register putih */
        }
        .register-button {
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
        .password-note {
            font-size: 0.8rem;
            color: #555;
            margin-top: -10px;
            margin-bottom: 10px;
        }
        .error-message {
            font-size: 0.8rem;
            color: #721c24;
            margin-top: 3px;
            list-style: none;
            padding-left: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <img src="{{ asset('image/LOGO1.png') }}" alt="Logo Catering" class="logo">

        <div class="auth-box">

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="input-group">
                    <label for="name">Username*</label>
                    <input id="name" type="text" name="name" class="input-field" 
                           placeholder="masukkan nama anda" 
                           value="{{ old('name') }}" required autofocus>
                    @if ($errors->has('name'))
                        <ul class="error-message">
                            @foreach ($errors->get('name') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="input-group">
                    <label for="email">Email*</label>
                    <input id="email" type="email" name="email" class="input-field" 
                           placeholder="aaaa@gmail.com" 
                           value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <ul class="error-message">
                            @foreach ($errors->get('email') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="input-group">
                    <label for="password">Password*</label>
                    <input id="password" type="password" name="password" 
                           class="input-field" placeholder="masukkan 8 karakter" required>
                    <p class="password-note">
                        
                    </p>
                    @if ($errors->has('password'))
                        <ul class="error-message">
                            @foreach ($errors->get('password') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <div class="input-group">
                    <label for="password_confirmation">Konfirmasi Password*</label>
                    <input id="password_confirmation" type="password" 
                           name="password_confirmation" class="input-field" 
                           placeholder="masukkan ulang password anda" required>
                </div>

                <button type="submit" class="register-button">
                    register
                </button>

                <div class="auth-links">
                    sudah punya akun? <a href="{{ route('login') }}">login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>