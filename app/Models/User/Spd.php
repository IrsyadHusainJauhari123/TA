<?php

namespace App\Models\User;

use App\Models\ModelAuthenticate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;
use App\Models\User;
use App\Models\Satker;
use App\Models\Calender1;
use Carbon\Carbon;

class Spd extends ModelAuthenticate
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pegawai',
        'id_user',
        'tanggal_pengajuan',
        'jam_pengajuan',
        'jam_selesai',
        'status_ad',
        'status',

    ];


    protected $attributes = [
        'status_ad' => 'Pending',
    ];

    protected $table = 'spd';

    public function setTanggalPengajuanAttribute($value)
    {
        $this->attributes['tanggal_pengajuan'] = Carbon::parse($value)->format('d F Y');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
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
