<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absen extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function nama()
    {
        return $this->belongsTo(Nama::class, 'nama_id');
    }
}
