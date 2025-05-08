<?php

namespace Database\Seeders;

use App\Models\Barcode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarcodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Barcode::factory()->count(5)->create();
    }
}
