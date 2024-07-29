<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User, Pegawai, Satker};
use Illuminate\Support\Carbon;
use App\Models\ModelAuthenticate;
use App\Models\User\Khusus;

class Calender2 extends ModelAuthenticate
{
    protected $table = 'calender2';
    protected $fillable = ['id_khusus', 'id_satker', 'id_user', 'id', 'color', 'id_pegawai'];

    public function setTanggalPengajuanAttribute($value)
    {
        $this->attributes['tanggal_pengajuan'] = Carbon::parse($value)->format('d F Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'id_satker');
    }

    public function khusus()
    {
        return $this->belongsTo(Khusus::class, 'id_khusus');
    }
}
