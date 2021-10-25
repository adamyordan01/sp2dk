<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxpayer extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kasi()
    {
        return $this->belongsTo(User::class, 'kasi_id');
    }

    public function pelaksana()
    {
        return $this->belongsTo(User::class, 'pelaksana_id');
    }
}
