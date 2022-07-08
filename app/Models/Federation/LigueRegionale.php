<?php

namespace App\Models\Federation;

use App\Models\Localisation\Region;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigueRegionale extends Model
{
    use HasFactory;

    protected $table = 'ligue_regionales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
        'sigle',
        'federation_id',
        'region_id',
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

    public function federation(){
        return $this->belongsTo(Federation::class);
    }

    public function region(){
        return $this->belongsTo(Region::class);
    }
}
