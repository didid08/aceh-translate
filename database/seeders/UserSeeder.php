<?php

/* FILE INI BERFUNGSI UNTUK MEMASUKKAN DATA AWAL KEDALAM TABLE "user" */

namespace Database\Seeders;

use Illuminate\Database\Seeder; // Memanggil package buat menangani seeder (wajib)
use Illuminate\Support\Facades\DB; // Memanggil package DB agar kita dapat memanggil fungsi yang dapat dipakai untuk mengatur database, seperti insert,update,delete,dll. Dalam kasus ini, package ini hanya digunakan buat insert data
use Illuminate\Support\Facades\Hash; // Memanggil package hash, agar kita dapat mengencrypt password yang dimasukkan kedalam table

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@localhost',
            'password' => Hash::make('admin') // Mengencrypt password: "admin"
        ]);
    }
}
