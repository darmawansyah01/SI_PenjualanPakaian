<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(20)->create();
        \App\Models\Pegawai::factory(20)->create();
        \App\Models\Barang::factory(20)->create();
        \App\Models\Supplier::factory(20)->create();
        \App\Models\Transaksi::factory(20)->create();

        \App\Models\User::factory()->create([
            'name' => 'User',
            'alamat' => 'Jakarata',
            'gender' => 'Laki-laki',
            'email' => 'user@user.com',
            'password' => Hash::make('123')
        ]);
    }
}
