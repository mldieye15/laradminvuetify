<?php

namespace App\Models\Federation;

use App\Models\Localisation\Pays;
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
        'pays_id',
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

    public function pays(){
        return $this->belongsTo(Pays::class);
    }
}
