<?php

namespace App\Models\User;

use App\Models\Calender1;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Satker;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\ModelAuthenticate;
use Calender as GlobalCalender;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Lpj extends ModelAuthenticate
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_pegawai',
        'id_user',
        'id_satker',
        'tanggal_pengajuan',
        'jam_pengajuan',
        'jam_selesai',
        'status_ad',
        'status',
        'balasan_wa',

    ];

    protected $attributes = [
        'status_ad' => 'Pending',
    ];
    public function setTanggalPengajuanAttribute($value)
    {
        $this->attributes['tanggal_pengajuan'] = Carbon::parse($value)->format('d F Y');
    }

    protected $table = 'lpj';

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
        return $this->hasMany(Calender1::class, 'id_lpj');
    }
}
