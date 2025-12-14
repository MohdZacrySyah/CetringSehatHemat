<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catering</title>
    <style>
        /* Pengaturan Dasar */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            overflow: hidden; /* Mencegah scroll di body utama (penting) */
            color: #333;
        }

        /* --- status-bar-mock CSS DIHAPUS --- */


        /* Latar belakang gradien */
        .container {
            height: 100%;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            /* Perkiraan gradien dari gambar Anda */
            background: linear-gradient(135deg, #a8b87c 0%, #879b55 100%);
        }

        /* Penampung untuk setiap layar */
        .screen {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100%; /* Penting: Layar mengisi penuh */
            position: absolute;
            top: 0;
            left: 0;
            transition: opacity 0.5s ease-out;
            box-sizing: border-box; /* Agar padding tidak merusak ukuran */
            
            /* CATATAN: Padding-top dikurangi karena status bar sudah dihapus */
            padding-top: 0; 
        }

        /* Layar 1: Splash (Gambar 1 & 2) */
        #splash-screen {
            cursor: pointer; /* Membuatnya bisa diklik */
        }

        #splash-screen .logo {
            width: 180px; /* Sesuaikan ukuran logo */
        }

        #splash-screen .welcome-text {
            font-size: 1.1rem;
            font-weight: bold;
            color: #4A572A;
            margin-top: 10px;
            opacity: 0; /* Awalnya transparan */
            transition: opacity 1s ease-in; /* Efek fade-in */
        }

        /* Layar 2: Onboarding (Gambar 3) */
        #onboarding-screen {
            opacity: 0; /* Awalnya transparan */
            visibility: hidden; /* Awalnya tersembunyi */
            justify-content: flex-start; /* Mulai dari atas */
            /* Padding-top disesuaikan (dikurangi) karena status bar sudah dihapus */
            padding-top: 50px; 
            overflow-y: auto; /* Tambahkan scroll vertikal JIKA konten meluap */
            padding-bottom: 50px; /* Beri jarak di bawah saat di-scroll */
        }
        
        /* ... CSS lainnya tetap sama ... */
        #onboarding-screen .logo {
            width: 150px; /* Logo lebih kecil di atas */
        }

        #onboarding-screen h1 {
            font-size: 1.8rem;
            color: #4A572A;
            margin-top: 20px;
        }

        #onboarding-screen .content-box {
            background: rgba(230, 230, 210, 0.7); /* Latar belakang kotak transparan */
            padding: 25px;
            margin-top: 20px;
            border-radius: 20px;
            width: 80%;
            max-width: 500px;
            text-align: left;
            color: #333;
        }
        
        #onboarding-screen .content-box h2 {
            text-align: center;
            margin-top: 0;
        }

        /* --- CSS UNTUK TOMBOL "MULAI" --- */
        .start-button {
            margin-top: 30px;
            padding: 12px 30px;
            background-color: #4A572A;
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            flex-shrink: 0; 
            
            /* Tambahan untuk tag <a> */
            text-decoration: none; 
            display: inline-block;
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="screen" id="splash-screen">
            <img src="{{ asset('image/LOGO1.png') }}" alt="Logo Catering" class="logo">
            <p class="welcome-text" id="welcome-text">
                Selamat datang di Cetering Sehat Hemat
            </p>
        </div>

        <div class="screen" id="onboarding-screen">
            <img src="{{ asset('image/LOGO1.png') }}" alt="Logo Catering" class="logo">
            <h1>CETERING FREAST</h1>
            
            <div class="content-box">
                <h2>HALO PELANGGAN..!!</h2>
                <p>Aplikasi CATERING FREAST adalah aplikasi yang membantu memesan makanan dalam jumlah besar. Dalam aplikasi ini juga memudahkan pelanggan dalam memilih dan request makanan. Pelanggan juga akan bisa berhubungan langsung owner dan tim dapur</p>
                <p>Aplikasi ini juga meringkaskan waktu dalam pembayaran dalam mode digital / online</p>
            </div>

            <a href="{{ url('/menu') }}" class="start-button">MULAI</a>
        </div>

    </div>

    <script>
        // Ambil elemen-elemen yang kita butuhkan
        const splashScreen = document.getElementById('splash-screen');
        const welcomeText = document.getElementById('welcome-text');
        const onboardingScreen = document.getElementById('onboarding-screen');

        // FUNGSI 1: (Gambar 1 -> Gambar 2)
        // Setelah 1.5 detik, tampilkan teks "Selamat datang"
        setTimeout(() => {
            welcomeText.style.opacity = '1';
        }, 1500); // 1.5 detik

        // FUNGSI 2: (Gambar 2 -> Gambar 3)
        // Ketika layar splash (Gambar 1 atau 2) diklik...
        splashScreen.addEventListener('click', () => {
            // 1. Sembunyikan layar splash
            splashScreen.style.opacity = '0';
            // Biarkan 'visibility' tetap pada 'hidden' setelah transisi
            setTimeout(() => {
                splashScreen.style.visibility = 'hidden';
            }, 500); // Waktu yang sama dengan transisi opacity

            // 2. Tampilkan layar onboarding
            onboardingScreen.style.visibility = 'visible';
            onboardingScreen.style.opacity = '1';
        });

    </script>
</body>
</html>