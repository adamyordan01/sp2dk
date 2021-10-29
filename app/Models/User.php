<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'nip',
        'email',
        'password',
        'section_id',
        'position_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gravatar($size = 100)
    {
        $grav_url = "https://ui-avatars.com/api/?background=random&name=$this->name";

        return $grav_url;
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function taxpayer()
    {
        return $this->hasMany(Taxpayer::class);
    }

    public function letterTaxpayerKasi()
    {
        return $this->hasManyThrough(Letter::class,
         Taxpayer::class,
         'kasi_id', 
         'taxpayer_id',
         'id', 
         'id'
        );
    }

    public function letterTaxpayer()
    {
        return $this->hasManyThrough(Letter::class,
         Taxpayer::class, 
         'user_id', //foreign_key taxpayers
         'taxpayer_id', //foreign_key letters
         'id', //primary_key users
         'id'); //primary_key taxpayers
    }


    public function letterTaxpayerPelaksana()
    {
        return $this->hasManyThrough(Letter::class,
         Taxpayer::class, 
         'pelaksana_id', 
         'taxpayer_id', 
         'id', 
         'id');
    }
}
