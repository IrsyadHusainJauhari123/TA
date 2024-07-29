<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ModelAuthenticate;
use App\Models\BlastWa;
use App\Models\Broadcast;
use App\Models\Satker;

class Arsip extends ModelAuthenticate
{
    protected $table = 'arsip';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    protected $fillable = ['id_blastwa', 'ids', 'id', 'created_at', 'updated_at'];


    public function blastwas()
    {
        return $this->belongsTo(BlastWa::class, 'id_blastwa');
    }

    public function broadcastwas()
    {
        return $this->belongsTo(Broadcast::class, 'id_blastwa');
    }

    public function satker()
    {
        return $this->belongsTo(Satker::class, 'ids');
    }
}
