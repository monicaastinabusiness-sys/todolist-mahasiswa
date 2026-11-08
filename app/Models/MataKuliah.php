<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'nama_matkul',
        'dosen',
        'semester',
    ];

    public function tugas(): HasMany
    {
        return $this->hasMany(Tugas::class);
    }
}
