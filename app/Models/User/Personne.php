<?php

namespace App\Models\User;

use App\Models\Localisation\Pays;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personne extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prenoms',
        'nom',
        'sexe',
        'surnom',
        'taille',
        'poids',
        'fonction',
        'ne_vers',
        'date_naiss',
        'lieu_naiss',
        'pays_naiss',
        'pays_natio',
        'adresse',
        'telephone',
        'civilite',
        'photo',
        'email',
        'type_piece_ident',
        'piece_ident',
        'annee_naiss',
        'ne_vers_naiss',
        'cin',
        'passport',
        'page_web',
        'facebook',
        'whatsapp',
        'telegram',
        'instagram',
        'tiktok',
        'active',
    ];

    /**
     * Return the user's country.
     */
    public function pays_naiss(){
        return $this->belongsTo(Pays::class);
    }

    /**
     * Return the user's nationality.
     */
    public function pays_natio(){
        return $this->belongsTo(Pays::class);
    }


    /**
     * Return the user's national identification.
     */
    public function ins(){
        return $this->belongsTo(UserNatioSportIdentity::class);
    }
}
