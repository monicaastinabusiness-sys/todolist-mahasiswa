<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengguna extends Model
{
    protected $table = 'pengguna';

    protected $fillable = [
        'nama_pengguna',
        'email',
        'password',
    ];

    public function tugas(): HasMany
    {
        return $this->hasMany(Tugas::class);
    }
}
