<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengaduanFoto extends Model
{
    use HasFactory;

    protected $table = 'pengaduan_foto';

    protected $fillable = [
        'id_pengaduan',
        'foto_kejadian',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }
}