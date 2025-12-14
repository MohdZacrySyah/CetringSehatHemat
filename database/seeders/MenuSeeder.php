<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Matikan foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Kosongkan tabel menu
        Menu::truncate();
        
        // Nyalakan lagi foreign key check
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Menu::insert([
            // MENU BIASA
            [
                'name' => 'Nasi Goreng Umi',
                'description' => 'Nasi goreng enak umi',
                'image' => 'image/nasi_goreng_umi.jpeg',
                'price' => 10000,
                'is_paket_hemat' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nasi dan Sambal ayam',
                'description' => 'Nasi dan ayam dengan sambal',
                'image' => 'image/nasi_ayam_sambal.jpeg',
                'price' => 17000,
                'is_paket_hemat' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tumis Buncis dan Terong',
                'description' => 'Tumis buncis segar dan terong',
                'image' => 'image/tumis_buncis.jpeg',
                'price' => 10000,
                'is_paket_hemat' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Ayam Geprek',
                'description' => 'Ayam geprek pedas',
                'image' => 'image/nasi_ayam_geprek.jpeg',
                'price' => 16000,
                'is_paket_hemat' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sambal Terong',
                'description' => 'Terong goreng sambal',
                'image' => 'image/sambal_terong.jpeg',
                'price' => 10000,
                'is_paket_hemat' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nasi dan Sambal Ikan',
                'description' => 'Nasi putih dan ikan bakar sambal',
                'image' => 'image/nasi_ikan_bakar.jpeg',
                'price' => 15000,
                'is_paket_hemat' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // ===== MENU PAKET HEMAT SEHAT =====
            [
                'name' => 'Nasi Merah + Sosis Tahu',
                'description' => 'Paket nasi merah dengan sosis tahu dan sayur',
                'image' => 'image/paket_nasimerah_sosis_tahu.jpeg',
                'price' => 25000,
                'is_paket_hemat' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nasi Merah + Udang Brokoli',
                'description' => 'Paket nasi merah, udang dan brokoli',
                'image' => 'image/paket_nasimerah_udang_brokoli.jpeg',
                'price' => 35000,
                'is_paket_hemat' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jagung + Labu Timun',
                'description' => 'Paket jagung manis, labu dan timun',
                'image' => 'image/paket_jagung_labu_timun.jpeg',
                'price' => 25000,
                'is_paket_hemat' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nasi Merah + Sosis Tuna',
                'description' => 'Paket nasi merah dengan sosis tuna',
                'image' => 'image/paket_nasimerah_sosis_tuna.jpeg',
                'price' => 25000,
                'is_paket_hemat' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nasi Merah + Udang Brokoli (L)',
                'description' => 'Porsi besar nasi merah udang brokoli',
                'image' => 'image/paket_nasimerah_udang_brokoli_L.jpeg',
                'price' => 55000,
                'is_paket_hemat' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jagung + Labu Timun (L)',
                'description' => 'Porsi besar paket jagung labu timun',
                'image' => 'image/paket_jagung_labu_timun_L.jpeg',
                'price' => 35000,
                'is_paket_hemat' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $this->command->info('Menu seeded successfully!');
    }
}
