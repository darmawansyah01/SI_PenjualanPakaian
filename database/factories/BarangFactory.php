<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'warna' => 'Merah',
            'gambar' => 'testImg',
            'ukuran' => 'M',
            'bahan' => 'Katun',
            'harga' => rand(1000, 9999)
        ];
    }
}