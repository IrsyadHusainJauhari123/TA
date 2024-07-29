<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;
use App\Models\Calender1;
use App\Models\Satker;
use Carbon\Carbon;
use App\Models\User;
use App\Models\ModelAuthenticate;

class Addk extends ModelAuthenticate
{

    protected $table = 'addk';
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function setTanggalPengajuanAttribute($value)
    {
        $this->attributes['tanggal_pengajuan'] = Carbon::parse($value)->format('d F Y');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'id_satker');
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function calenders()
    {
        return $this->hasMany(Calender1::class, 'id_calender');
    }
}
