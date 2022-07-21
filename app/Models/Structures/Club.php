<?php

namespace App\Models\Structures;

use App\Models\Federation\LigueRegionale;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $table = 'clubs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
        'sigle',
        'ligue_regionale_id',
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
        'visible',
        'type_structure_id'
    ];

    public function ligue_regionale(){
        return $this->belongsTo(LigueRegionale::class);
    }
}
