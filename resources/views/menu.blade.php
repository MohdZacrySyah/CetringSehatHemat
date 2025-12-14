<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Catering</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            /* Background hijau muda sama seperti welcome */
            background-color: #a8b87c; 
        }

        .page-container {
            width: 100%;
            min-height: 100vh;
            /* Gradien dari welcome screen */
            background: linear-gradient(135deg, #a8b87c 0%, #879b55 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .menu-container {
            width: 100%;
            max-width: 1200px; /* Batas lebar maksimum */
            margin: auto;
            /* Background konten area seperti di gambar */
            background-color: #9aaa6f; 
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
            box-sizing: border-box;
        }

        .menu-grid {
            display: grid;
            /* Buat 4 kolom di layar besar.
              Buat 3 kolom di layar sedang.
              Buat 2 kolom di layar kecil/ponsel.
            */
            grid-template-columns: repeat(4, 1fr);
            gap: 20px; /* Jarak antar item */
        }

        .menu-item {
            text-align: center;
            background: #f4f4f4; /* Latar belakang item */
            border-radius: 10px;
            overflow: hidden; /* Agar gambar tidak keluar dari radius */
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .menu-item img {
            width: 100%;
            height: 150px; /* Tinggi gambar dibuat seragam */
            object-fit: cover; /* Agar gambar terpotong rapi (tidak gepeng) */
            display: block;
        }

        .menu-item p {
            margin: 10px 0;
            font-weight: bold;
            color: #333;
        }

        /* --- Pengaturan Responsive Grid --- */
        @media (max-width: 992px) {
            .menu-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .menu-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .menu-item img {
                height: 120px; /* Tinggi gambar di ponsel */
            }
        }

    </style>
</head>
<body>

    <div class="page-container">
        <div class="menu-container">
            
            <div class="menu-grid">

                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/nasi_ayam_sambal.jpeg') }}" alt="Nasi Sambal ayam">
                        <p>Nasi Sambal ayam</p>
                    </div>
                </a>

                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/nasi_ikan_sambal.jpeg') }}" alt="Nasi sambal ikan">
                        <p>Nasi sambal ikan</p>
                    </div>
                </a>

                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/nasi_ayam_geprek.jpeg') }}" alt="Ayam geprek">
                        <p>Ayam geprek</p>
                    </div>
                </a>

                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/nasi_ikan_bakar.jpeg') }}" alt="Nasi Ikan Bakar">
                        <p>Nasi Ikan Bakar</p>
                    </div>
                </a>

                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/nasi_goreng_umi.jpeg') }}" alt="Nasi Goreng Umi">
                        <p>Nasi Goreng Umi</p>
                    </div>
                </a>

                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/nasi_ayam_bakar.jpeg') }}" alt="Nasi Ayam Bakar">
                        <p>Nasi Ayam Bakar</p>
                    </div>
                </a>

                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/nasi_gulai_ayam.jpeg') }}" alt="Nasi Gulai Ayam">
                        <p>Nasi Gulai Ayam</p>
                    </div>
                </a>

                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/nasi_sambal_tempe.jpeg') }}" alt="Nasi Sambal Tempe">
                        <p>Nasi Sambal Tempe</p>
                    </div>
                </a>

                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/sambal_terong.jpeg') }}" alt="Sambal Terong">
                        <p>Sambal Terong</p>
                    </div>
                </a>

                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/tumis_buncis.jpeg') }}" alt="Tumis Buncis Terong">
                        <p>Tumis Buncis Terong</p>
                    </div>
                </a>

                <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/nasi_ayam_geprek.jpeg') }}" alt="Nasi Ayam Geprek">
                        <p>Nasi Ayam Geprek</p>
                    </div>
                </a>

                 <a href="{{ route('login') }}" style="text-decoration: none; color: inherit;">
                    <div class="menu-item">
                        <img src="{{ asset('image/mie_goreng_umi.jpeg') }}" alt="Nasi Ayam Geprek">
                        <p>mi goreng umi</p>
                    </div>
                </a>

                

                

            </div>
            </div>
        </div>
    </body>
</html>