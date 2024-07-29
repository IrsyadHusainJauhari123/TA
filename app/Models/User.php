<?php

namespace App\Models;

use App\Models\Satker;
use App\Models\User\Addk;
use App\Models\User\Lpj;
use App\Models\User\Spd;
use App\Models\User\Sp2d;
use App\Models\User\Spm;
use App\Models\Blastwa;
use App\Models\Broadcast;
use App\Models\Calender1;
use App\Models\Calender2;
use Calender as GlobalCalender;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\ModelAuthenticate;
use App\Models\User\Khusus;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends ModelAuthenticate
{
    protected $table = 'user';
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'username',
        'level',
        'email',
        'jabatan',
        'jenis_kelamin',
        'alamat_satker',
        'agama',
        'password',
        'kode_satker',

    ];



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role === 'admin'; // Anda harus mengganti 'admin' dengan nilai yang mewakili peran admin dalam aplikasi Anda
    }

    public function isSatker()
    {
        return $this->role === 'satker'; // Anda harus mengganti 'satker' dengan nilai yang mewakili peran satker dalam aplikasi Anda
    }


    public function satker()
    {
        return $this->belongsTo(Satker::class, 'id_satker');
    }

    public function lpjs()
    {
        return $this->hasMany(Lpj::class, 'id_user');
    }

    public function addks()
    {
        return $this->hasMany(Addk::class, 'id_user');
    }


    public function spds()
    {
        return $this->hasMany(Spd::class, 'id_user');
    }

    public function spms()
    {
        return $this->hasMany(Spm::class, 'id_user');
    }

    public function sp2ds()
    {
        return $this->hasMany(Sp2d::class, 'id_user');
    }

    public function calenders()
    {
        return $this->hasMany(Calender1::class, 'id_calender');
    }

    public function blasts()
    {
        return $this->hasMany(Blastwa::class, 'idu');
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
}
