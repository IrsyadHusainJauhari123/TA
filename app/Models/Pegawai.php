<?php

namespace App\Models;

use App\Models\User\Lpj;
use App\Models\User\Spd;
use App\Models\User\Sp2d;
use App\Models\User\Spm;
use App\Models\User\Addk;
use App\Models\User\Calender;
use App\Models\ModelAuthenticate;
use App\Models\Calender1;
use App\Models\Calender2;
use App\Models\User\Khusus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends ModelAuthenticate
{
    protected $table = 'pegawai';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    public function lpjs()
    {
        return $this->hasMany(Lpj::class, 'id_pegawai');
    }

    public function addks()
    {
        return $this->hasMany(Addk::class, 'id_pegawai');
    }

    public function spms()
    {
        return $this->hasMany(Spm::class, 'id_pegawai');
    }

    public function spds()
    {
        return $this->hasMany(Spd::class, 'id_pegawai');
    }

    public function sp2ds()
    {
        return $this->hasMany(Sp2d::class, 'id_pegawai');
    }

    public function calenders()
    {
        return $this->hasMany(Calender1::class, 'id_calender');
    }

    public function khusus()
    {
        return $this->hasMany(Khusus::class, 'id_khusus');
    }

    public function calenders2()
    {
        return $this->hasMany(Calender2::class, 'id_calender');
    }
}
