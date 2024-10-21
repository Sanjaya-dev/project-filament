<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Konten extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $table = 'konten';
    
    protected $casts = [
        'nama' => 'json',
        'peneliti' => 'json',
    ];

    protected $fillable = [
        'nama', 'jenis_kejahatan_id', 'peneliti', 'tanggal_SPDP', 'tanggal_P17', 'tanggal_tahap_I',
        'tanggal_P18', 'tanggal_P19', 'tanggal_P20', 'tanggal_P21', 'tanggal_P21A',
    ];

    public function jenisKejahatan()
    {
        return $this->belongsTo(JenisKejahatan::class, 'jenis_kejahatan_id');
    }

    protected function formattedNama(): Attribute
    {
        return Attribute::make(
             get: function ($value, $attributes) {
               $namesArray = $this->getAttribute('nama'); // Mengambil data hanya dari kolom 'nama'
                
                 // Memastikan bahwa $namesArray adalah array
                if (!is_array($namesArray) || empty($namesArray)) {
                    return 'Tidak ada data';
                }

                // Ambil 'value' dari setiap objek dalam array
                $names = array_map(function($item) {
                    return $item['value'] ?? '';
                }, $namesArray);

                // Gabungkan nilai menjadi string dan hapus nilai kosong
                return implode(', ', array_filter($names)) ?: 'Tidak ada data'; // Menghapus nilai kosong dan memberikan teks default jika kosong
            }
        );
    }
    protected function formattedPeneliti(): Attribute
    {
        return Attribute::make(
             get: function ($value, $attributes) {
               $namesArray = $this->getAttribute('peneliti'); // Mengambil data hanya dari kolom 'nama'
                
                 // Memastikan bahwa $namesArray adalah array
                if (!is_array($namesArray) || empty($namesArray)) {
                    return 'Tidak ada data';
                }

                // Ambil 'value' dari setiap objek dalam array
                $names = array_map(function($item) {
                    return $item['value'] ?? '';
                }, $namesArray);

                // Gabungkan nilai menjadi string dan hapus nilai kosong
                return implode(', ', array_filter($names)) ?: 'Tidak ada data'; // Menghapus nilai kosong dan memberikan teks default jika kosong
            }
        );
    }
}
