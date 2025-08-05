<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'nis';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nis',
        'nama_siswa',
        'tanggal_lahir',
        'nama_kelas',
        'qr_code_data',
        'gambar'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    // Relasi dengan Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'nama_kelas', 'nama_kelas');
    }

    // Relasi dengan Absensi
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'nis', 'nis');
    }

    // Accessor untuk gambar
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/siswa/' . $this->gambar);
        }
        return asset('images/default-avatar.png');
    }
}
