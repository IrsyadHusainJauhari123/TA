<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Satker;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Arsip;
use App\Models\ModelAuthenticate;

class Broadcast extends ModelAuthenticate
{
    protected $table = 'broadcast';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primarykey = 'id';

    protected $fillable = ['id_satker', 'id_user', 'pesan', 'ids'];

    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = Carbon::parse($value)->format('d F Y');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'ids');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function arsips()
    {
        return $this->hasMany(Arsip::class, 'id_blastwa');
    }
}
