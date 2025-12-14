<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrderNotification;
use App\Models\User;
use Carbon\Carbon;

class OrderNotificationSeeder extends Seeder
{
    public function run()
    {
        // Ambil user pertama (atau sesuaikan dengan user_id yang ada)
        $user = User::first();

        if (!$user) {
            $this->command->error('User tidak ditemukan. Buat user terlebih dahulu.');
            return;
        }

        $notifications = [
            [
                'user_id' => $user->id,
                'title' => 'Pesanan Selesai',
                'menu_name' => 'Nasi Goreng',
                'menu_image' => 'image/nasi_goreng_umi.jpeg',
                'quantity' => 3,
                'total_price' => 30000,
                'order_date' => Carbon::parse('2023-10-11'),
                'delivery_date' => Carbon::parse('2023-10-12'),
                'address' => 'Jl. Perintah',
                'phone' => '08123xxxxx',
                'status' => 'completed',
                'description' => 'Pesanan telah selesai. Klik untuk beri nilai penilaian, paling lambat',
                'rating_deadline' => Carbon::parse('2025-10-18'),
                'is_read' => false,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Pesanan Selesai',
                'menu_name' => 'Nasi Ayam Sambal',
                'menu_image' => 'image/nasi_ayam_sambal.jpeg',
                'quantity' => 2,
                'total_price' => 34000,
                'order_date' => Carbon::parse('2023-10-10'),
                'delivery_date' => Carbon::parse('2023-10-11'),
                'address' => 'Jl. Contoh',
                'phone' => '08123xxxxx',
                'status' => 'completed',
                'description' => 'Pesanan telah selesai. Klik untuk beri nilai penilaian, paling lambat',
                'rating_deadline' => Carbon::parse('2025-10-17'),
                'is_read' => false,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Pesanan Selesai',
                'menu_name' => 'Tumis Buncis',
                'menu_image' => 'image/tumis_buncis.jpeg',
                'quantity' => 1,
                'total_price' => 10000,
                'order_date' => Carbon::parse('2023-10-10'),
                'delivery_date' => Carbon::parse('2023-10-11'),
                'address' => 'Jl. Contoh',
                'phone' => '08123xxxxx',
                'status' => 'completed',
                'description' => 'Pesanan telah selesai. Klik untuk beri nilai penilaian, paling lambat',
                'rating_deadline' => Carbon::parse('2025-10-17'),
                'is_read' => false,
            ],
            [
                'user_id' => $user->id,
                'title' => 'Pesanan Selesai',
                'menu_name' => 'Ayam Geprek',
                'menu_image' => 'image/nasi_ayam_geprek.jpeg',
                'quantity' => 4,
                'total_price' => 64000,
                'order_date' => Carbon::parse('2023-10-12'),
                'delivery_date' => Carbon::parse('2023-10-13'),
                'address' => 'Jl. Contoh',
                'phone' => '08123xxxxx',
                'status' => 'completed',
                'description' => 'Pesanan telah selesai. Klik untuk beri nilai penilaian, paling lambat',
                'rating_deadline' => Carbon::parse('2025-10-19'),
                'is_read' => false,
            ],
        ];

        foreach ($notifications as $notification) {
            OrderNotification::create($notification);
        }

        $this->command->info('Order notifications seeded successfully!');
    }
}
