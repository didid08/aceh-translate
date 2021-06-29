<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VocabularySuggestion extends Model
{
    use HasFactory;

    protected $fillable = ['aceh', 'indonesia', 'deskripsi'];
}
