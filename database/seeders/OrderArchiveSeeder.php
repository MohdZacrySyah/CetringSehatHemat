<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderArchive;
use App\Models\User;
use Carbon\Carbon;

class OrderArchiveSeeder extends Seeder
{
    public function run()
    {
        // Ambil user pertama (atau sesuaikan dengan user_id yang ada)
        $user = User::first();

        if (!$user) {
            $this->command->error('User tidak ditemukan. Buat user terlebih dahulu.');
            return;
        }

        $archives = [
            [
                'user_id' => $user->id,
                'menu_name' => 'Sambal Terong',
                'menu_image' => 'image/sambal_terong.jpeg',
                'quantity' => 3,
                'price' => 10000,
                'total_price' => 30000,
                'status' => 'cancelled',
                'cancel_reason' => 'Pesanan Cancel dengan kriteria tertentu!',
                'ordered_by' => 'Pembeli',
                'ordered_at' => Carbon::parse('2024-01-28 11:48:00'),
                'address' => 'Mengubah alamat pengiriman',
                'payment_method' => 'Belum Bayar',
            ],
            [
                'user_id' => $user->id,
                'menu_name' => 'Nasi Sambal Tempe',
                'menu_image' => 'image/nasi_ayam_sambal.jpeg',
                'quantity' => 2,
                'price' => 15000,
                'total_price' => 30000,
                'status' => 'cancelled',
                'cancel_reason' => 'Pesanan Cancel dengan kriteria tertentu!',
                'ordered_by' => 'Pembeli',
                'ordered_at' => Carbon::parse('2024-01-27 10:30:00'),
                'address' => 'Mengubah alamat pengiriman',
                'payment_method' => 'Belum Bayar',
            ],
            [
                'user_id' => $user->id,
                'menu_name' => 'Ayam Geprek',
                'menu_image' => 'image/nasi_ayam_geprek.jpeg',
                'quantity' => 4,
                'price' => 16000,
                'total_price' => 64000,
                'status' => 'cancelled',
                'cancel_reason' => 'Pesanan Cancel dengan kriteria tertentu!',
                'ordered_by' => 'Pembeli',
                'ordered_at' => Carbon::parse('2024-01-26 14:15:00'),
                'address' => 'Mengubah alamat pengiriman',
                'payment_method' => 'Belum Bayar',
            ],
            [
                'user_id' => $user->id,
                'menu_name' => 'Nasi Ikan Bakar',
                'menu_image' => 'image/nasi_ikan_bakar.jpeg',
                'quantity' => 1,
                'price' => 15000,
                'total_price' => 15000,
                'status' => 'cancelled',
                'cancel_reason' => 'Pesanan Cancel dengan kriteria tertentu!',
                'ordered_by' => 'Pembeli',
                'ordered_at' => Carbon::parse('2024-01-25 09:20:00'),
                'address' => 'Mengubah alamat pengiriman',
                'payment_method' => 'Belum Bayar',
            ],
            [
                'user_id' => $user->id,
                'menu_name' => 'Nasi Goreng',
                'menu_image' => 'image/nasi_goreng_umi.jpeg',
                'quantity' => 2,
                'price' => 12000,
                'total_price' => 24000,
                'status' => 'cancelled',
                'cancel_reason' => 'Pesanan Cancel dengan kriteria tertentu!',
                'ordered_by' => 'Pembeli',
                'ordered_at' => Carbon::parse('2024-01-24 16:45:00'),
                'address' => 'Mengubah alamat pengiriman',
                'payment_method' => 'Belum Bayar',
            ],
        ];

        foreach ($archives as $archive) {
            OrderArchive::create($archive);
        }

        $this->command->info('Order archives seeded successfully!');
    }
}
