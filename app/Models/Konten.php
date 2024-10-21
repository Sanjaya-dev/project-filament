<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Konten extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = 'konten';
    
    protected $casts = [
        'nama' => 'array',
        'peneliti' => 'array',
    ];

    protected $fillable = [
        'nama', 'jenis_kejahatan_id', 'peneliti', 'tanggal_SPDP', 'tanggal_P17', 'tanggal_tahap_I',
        'tanggal_P18', 'tanggal_P19', 'tanggal_P20', 'tanggal_P21', 'tanggal_P21A',
    ];

    public function jenisKejahatan()
    {
        return $this->belongsTo(JenisKejahatan::class, 'jenis_kejahatan_id');
    }
}
