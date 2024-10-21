<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKejahatan extends Model
{
    use HasFactory;

    protected $table = 'jenis_kejahatan';

    protected $fillable = ['nama_jenis'];

    public function konten()
    {
        return $this->hasMany(Konten::class);
    }
}
