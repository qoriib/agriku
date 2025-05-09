<?php

namespace Database\Seeders;

use App\Models\FormulirPemesananMako;
use App\Models\Konsumen;
use App\Models\PesananMako;
use Illuminate\Database\Seeder;

class PesananMakoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $konsumenList = Konsumen::all();

        foreach ($konsumenList as $konsumen) {
            FormulirPemesananMako::factory(10)->create([
                'id_konsumen' => $konsumen->id
            ])->each(function ($formulir) {
                PesananMako::factory()->create([
                    'id_formulir_pemesanan_mako' => $formulir->id,
                    'id_konsumen' => $formulir->id_konsumen,
                ]);
            });
        }
    }
}
