<?php

namespace App\Models;

use App\Models\User\{Addk, Lpj, Spm, Sp2d, Spd};
use App\Models\{User, Pegawai, Satker};
use Illuminate\Support\Carbon;

use App\Models\ModelAuthenticate;

class Calender1 extends ModelAuthenticate
{
    protected $table = 'calender1';
    protected $fillable = ['id_lpj', 'id', 'color', 'id_spd', 'id_spm', 'id_addk', 'id_sp2d'];
    public function setTanggalPengajuanAttribute($value)
    {
        $this->attributes['tanggal_pengajuan'] = Carbon::parse($value)->format('d F Y');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function lpj()
    {
        return $this->belongsTo(Lpj::class, 'id_lpj');
    }

    public function spm()
    {
        return $this->belongsTo(Spm::class, 'id_spm');
    }

    public function spd()
    {
        return $this->belongsTo(Spd::class, 'id_spd');
    }

    public function sp2d()
    {
        return $this->belongsTo(Sp2d::class, 'id_sp2d');
    }

    public function addk()
    {
        return $this->belongsTo(Addk::class, 'id_addk');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'id_satker');
    }
}
