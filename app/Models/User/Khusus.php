<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Satker;
use App\Models\User;
use App\Models\Calender2;
use App\Models\ModelAuthenticate;
use App\Models\Pegawai;
use Illuminate\Support\Carbon;




class Khusus extends ModelAuthenticate
{
    protected $primaryKey = 'id';
    protected $table = 'khusus';
    protected $fillable = [
        'id_pegawai',
        'id_user',
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

    public function calenders2()
    {
        return $this->hasMany(Calender2::class, 'id_khusus');
    }
}
