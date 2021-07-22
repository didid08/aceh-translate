<?php

use Illuminate\Database\Migrations\Migration; // Memanggil package migration buat menangani migrasi tabel
use Illuminate\Database\Schema\Blueprint; // Memanggil package blueprint buat menangani blueprint dari tabel
use Illuminate\Support\Facades\Schema; // Memanggil package schema agar kita dapat membuat scheme dari tabel

class CreateUsersTable extends Migration // Class untuk membuat Tabel "users"
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() // fungsi yg dijalankan ketika kita melakukan migrasi
    {
        Schema::create('users', function (Blueprint $table) { // Untuk membuat schema atau struktur dari tabel user
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() // Buat membatalkan migrasi
    {
        Schema::dropIfExists('users');
    }
}


// Informasi-informasi singkat diatas juga berlaku untuk file migration yg lain
