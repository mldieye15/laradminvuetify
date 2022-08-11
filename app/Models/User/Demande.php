<?php

namespace App\Models\User;

use App\Models\Params\CotePratiquant;
use App\Models\Params\FonctionPratiquant;
use App\Models\Structures\Association;
use App\Models\Structures\CentreFormation;
use App\Models\Structures\Club;
use App\Models\Structures\TypeStructure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;

    protected $table = 'demandes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'personne_id',
        'type_demande_id',
        'fonction_pratiquant_id',
        'cote_pratiquant_id',
        'type_structure_id',
        'structure'
    ];

    /**
     * Return the personne.
     */
    public function personne(){
        return $this->belongsTo(Personne::class);
    }

    /**
     * Return the fonction pratiquant.
     */
    public function fonction_pratiquant(){
        return $this->belongsTo(FonctionPratiquant::class);
    }

    /**
     * Return the cote pratiquant.
     */
    public function cote_pratiquant(){
        return $this->belongsTo(CotePratiquant::class);
    }

    /**
     * Return the cote type structure.
     */
    public function type_structure(){
        return $this->belongsTo(TypeStructure::class);
    }

    /**
     * Return the cote type structure.
     */
    public function club(){
        return $this->belongsTo(Club::class);
    }

    /**
     * Rettourne le cnetre de formation.
     */
    public function centre_formation(){
        return $this->belongsTo(CentreFormation::class);
    }

    /**
     * Return the association.
     */
    public function association(){
        return $this->belongsTo(Association::class);
    }

}
