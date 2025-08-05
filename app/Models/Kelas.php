<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'nama_kelas';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'nama_kelas',
        'tingkat',
        'jurusan'
    ];

    // Relasi dengan Siswa
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'nama_kelas', 'nama_kelas');
    }
}
