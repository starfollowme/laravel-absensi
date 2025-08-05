<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';
    protected $primaryKey = 'kode_absensi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_absensi',
        'tanggal',
        'jam_datang',
        'status_absensi',
        'keterangan',
        'nip',
        'nis'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_datang' => 'datetime:H:i:s'
    ];

    // Relasi dengan User (pencatat absensi)
    public function user()
    {
        return $this->belongsTo(User::class, 'nip', 'nip');
    }

    // Relasi dengan Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    // Scope untuk filter berdasarkan tanggal
    public function scopeByDate($query, $date)
    {
        return $query->whereDate('tanggal', $date);
    }

    // Scope untuk filter berdasarkan kelas
    public function scopeByKelas($query, $namaKelas)
    {
        return $query->whereHas('siswa', function ($q) use ($namaKelas) {
            $q->where('nama_kelas', $namaKelas);
        });
    }

    // Scope untuk filter berdasarkan status
    public function scopeByStatus($query, $status)
    {
        return $query->where('status_absensi', $status);
    }

    // Static method untuk generate kode absensi
    public static function generateKodeAbsensi()
    {
        $prefix = 'ABS';
        $date = now()->format('Ymd');
        $lastAbsensi = static::where('kode_absensi', 'like', $prefix . $date . '%')
                            ->orderBy('kode_absensi', 'desc')
                            ->first();

        if ($lastAbsensi) {
            $lastNumber = (int) substr($lastAbsensi->kode_absensi, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $prefix . $date . $newNumber;
    }
}