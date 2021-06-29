<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VocabularyRequest extends Model
{
    use HasFactory;

    protected $fillable = ['kosakata', 'bahasa_tujuan'];
}
