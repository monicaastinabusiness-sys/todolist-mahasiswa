<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengguna extends Authenticatable
{
    protected $table = 'pengguna';

    protected $fillable = [
        'nama_pengguna',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function tugas(): HasMany
    {
        return $this->hasMany(Tugas::class, 'pengguna_id');
    }
}
