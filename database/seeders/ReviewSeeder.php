<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use Carbon\Carbon;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        $reviews = [
            [
                'customer_name' => 'Rositah Maimunah',
                'menu_name' => 'Nasi dan Ayam Sambal Merah',
                'rating' => 4,
                'review' => 'Alhamduliah, pesana saya sudah sampai. terimakasih aplikasi catering, pesanan sesuai apa yang saya pesan. rasa nya juga sangat nikmat',
                'reviewed_at' => Carbon::now()->subDays(2),
            ],
            [
                'customer_name' => 'Bunda Minah',
                'menu_name' => 'Nasi dan Ayam Sambal Merah',
                'rating' => 4,
                'review' => 'Alhamduliah, pesana saya sudah sampai. terimakasih aplikasi catering, pesanan sesuai apa yang saya pesan. rasa nya juga sangat nikmat',
                'reviewed_at' => Carbon::now()->subDays(3),
            ],
            [
                'customer_name' => 'Laila Canggung',
                'menu_name' => 'Nasi dan Ayam Sambal Merah',
                'rating' => 4,
                'review' => 'Alhamduliah, pesana saya sudah sampai. terimakasih aplikasi catering, pesanan sesuai apa yang saya pesan. rasa nya juga sangat nikmat',
                'reviewed_at' => Carbon::now()->subDays(5),
            ],
            [
                'customer_name' => 'Ahmad Rizki',
                'menu_name' => 'Nasi Goreng Spesial',
                'rating' => 5,
                'review' => 'Makanannya enak banget! Pengiriman cepat dan porsinya banyak. Recommended!',
                'reviewed_at' => Carbon::now()->subDays(1),
            ],
            [
                'customer_name' => 'Siti Nurhaliza',
                'menu_name' => 'Ayam Geprek Pedas',
                'rating' => 5,
                'review' => 'Pedasnya pas, ayamnya crispy. Puas banget deh pokoknya!',
                'reviewed_at' => Carbon::now()->subDays(4),
            ],
            [
                'customer_name' => 'Budi Santoso',
                'menu_name' => 'Soto Ayam Lamongan',
                'rating' => 3,
                'review' => 'Rasanya lumayan, tapi kurangnya porsi kuahnya sedikit. Overall oke lah',
                'reviewed_at' => Carbon::now()->subDays(6),
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }

        $this->command->info('Reviews seeded successfully!');
    }
}
