<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pengaduan';

    protected $fillable = [
        'user_id',
        'judul_pengaduan',
        'tanggal_kejadian',
        'lokasi',
        'latitude',
        'longitude',
        'status',
        'keterangan_kejadian'
    ];

    // Model Pengaduan.php
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


    public function foto()
    {
        return $this->hasMany(PengaduanFoto::class, 'id_pengaduan', 'id_pengaduan');
    }
}
