<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = ['tanggal_sp2dk', 'tanggal_kirim_suki', 'tanggal_kirim_pos', 'tanggal_kempos', 'tanggal_telpon_wp',	'tanggal_ba_tidak_hadir', 'tanggal_konseling', 'tanggal_visit', 'tanggal_lhp2dk', 'tanggal_setor', 'tanggal_usul_pemeriksaan', 'tanggal_dspp'];

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function letterTaxpayer()
    {
        return $this->hasManyThrough(Letter::class,
         Taxpayer::class, 
         'user_id', //foreign_key taxpayers
         'taxpayer_id', //foreign_key letters
         'id', //primary_key letters
         'id'); //primary_key 
    }

    public function letterTaxpayerKasi()
    {
        return $this->hasManyThrough(Letter::class,
         Taxpayer::class, 
         'kasi_id', 
         'taxpayer_id',
         'id', 
         'id');
    }

    // public function letterTaxpayers()
    // {
    //     return $this->hasMany(Letter::class, Taxpayer::class);
    //     // return $this->hasManyThrough(Letter::class,
    //     //  Taxpayer::class, 
    //     //  'user_id', 
    //     //  'taxpayer_id', 
    //     //  'id', 
    //     //  'id');
    // }
}
