<?php

/* FILE INI BERFUNGSI UNTUK MEMANGGIL SEEDERS YANG TELAH KITA BUAT */
/* SEEDER BERFUNGSI UNTUK MEMASUKKAN DATA AWAL KEDALAM DATABASE */

namespace Database\Seeders;

use Illuminate\Database\Seeder; // Package wajib

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([ // Nah, manggilnya pake method ini
            UserSeeder::class, // memanggil seeder buat table user
            DictionarySeeder::class // memanggil seeder buat table dictionary
        ]);
    }
}
