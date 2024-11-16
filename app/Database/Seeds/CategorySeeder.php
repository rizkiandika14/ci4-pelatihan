<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'HSE',
            'description' => 'HSE (Health, Safety, Environtment) untuk Industri Umum, Migas, Pertambangan dan Konstruksi',
            'image' => 'hse.png'],
            ['name' => 'Kesehatan',
            'description' => 'Pelatihan untuk Tenaga Kesehatan ber-SKP Kemenkes RI yang didukung
                        oleh tenaga ahli yang kompeten di bidangnya Masing-masing',
            'image' => 'kesehatan.png'],
            ['name' => 'Agrobisnis',
            'description' => 'Training dan konsultasi bidang Agrobisnis dan Lingkungan serta
                        penyediaan peralatan dan material bidang tersebut',
            'image' => 'agrobisnis.png']
        ];

        // Using Query Builder
        $this->db->table('categories')->insertBatch($data);
    }
}
