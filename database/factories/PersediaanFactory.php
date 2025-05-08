<?php

namespace Database\Factories;

use App\Models\Barcode;
use App\Models\Persediaan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Persediaan>
 */
class PersediaanFactory extends Factory
{
    protected $model = Persediaan::class;

    public function definition()
    {
        $tipe = $this->faker->randomElement(['masuk', 'keluar']);
        $qty = $this->faker->numberBetween(10, 100);
        $tanggal = $this->faker->dateTimeBetween('-2 months', 'now')->format('Y-m-d');

        return [
            'id_barcode' => Barcode::inRandomOrder()->first()->id ?? Barcode::factory(),
            'tipe' => $tipe,
            'qty_produk' => $qty,
            'tanggal' => $tanggal,
            'qty_sisa' => $tipe === 'masuk' ? $qty : 0,
        ];
    }
}
