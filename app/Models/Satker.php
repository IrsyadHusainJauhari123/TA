<?php

namespace App\Models;

use App\Models\User;

use App\Models\User\Lpj;
use App\Models\User\Sp2d;
use App\Models\User\Spm;
use App\Models\ModelAuthenticate;
use App\Models\Calender1;
use App\Models\Calender2;
use App\Models\Blastwa;
use App\Models\User\Spd;
use App\Models\Broadcast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\Addk;
use App\Models\User\Khusus;
use App\Models\Arsip;
use PhpParser\Node\Expr\FuncCall;

class Satker extends ModelAuthenticate
{
    protected $table = 'satker';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    public function users()
    {
        return $this->hasMany(User::class, 'id_satker');
    }

    public function lpjs()
    {
        return $this->hasMany(Lpj::class, 'id_satker');
    }

    public function addks()
    {
        return $this->hasMany(Addk::class, 'id_satker');
    }

    public function spds()
    {
        return $this->hasMany(Spd::class, 'id_satker');
    }

    public function sp2ds()
    {
        return $this->hasMany(Sp2d::class, 'id_satker');
    }

    public function spms()
    {
        return $this->hasMany(Spm::class, 'id_satker');
    }

    public function calenders()
    {
        return $this->hasMany(Calender1::class, 'id_calender');
    }

    public function blasts()
    {
        return $this->hasMany(Blastwa::class,  'ids');
    }

    public function broadcasts()
    {
        return $this->hasMany(Broadcast::class, 'ids');
    }

    public function khusus()
    {
        return $this->hasMany(Khusus::class, 'id_khusus');
    }


    public function calenders2()
    {
        return $this->hasMany(Calender2::class, 'id_calender');
    }

    public function arsips()
    {
        return $this->hasMany(Arsip::class, 'ids');
    }
}
