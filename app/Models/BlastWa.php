<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModelAuthenticate;
use App\Models\Satker;
use App\Models\User;
use App\Models\Arsip;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BlastWa extends ModelAuthenticate
{
    protected $table = 'blastwa';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = ['pesan', 'ids', 'id', 'id_satker'];

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
        return $this->belongsTo(User::class, 'idu');
    }

    public function arsips()
    {
        return $this->hasMany(Arsip::class, 'id_blastwa');
    }


    // public function handleUpload()
    // {
    //     if (request()->hasFile('file')) {
    //         $file = request()->file('file');
    //         $destination = "app/pdf";
    //         $randomStr = Str::random(5);
    //         $filename = $this->id . "-" . time() . "-" . $randomStr . "." . $file->extension();
    //         $url = $file->storeAs($destination, $filename, 'public');
    //         $this->file = "storage/" . $url; // Sesuaikan path untuk disimpan di database
    //         $this->save();
    //     }
    // }
}
