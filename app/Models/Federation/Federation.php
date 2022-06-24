<?php

namespace App\Models\Federation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Federation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
        'sigle',
        'sport_id',
        'logo',
        'sologan',
        'adresse',
        'telephone',
        'fax',
        'email',
        'date_creation',
        'recipisse_numero',
        'recipisse_date',
        'recipisse_url',
        'reglement_int_url',
        'page_web',
        'facebook',
        'whatsapp',
        'telegram',
        'instagram',
        'tiktok',
        'visible'
    ];

    public function sport(){
        return $this->belongsTo(Sport::class);
    }
}
