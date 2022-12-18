<?php

namespace App\Models\User;

use App\Models\Params\CotePratiquant;
use App\Models\Params\FonctionPratiquant;
use App\Models\Structures\TypeStructure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autorisation extends Model
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
        'structure',
        'traite'
    ];

    /**
     * Return the personne.
     */
    public function personne(){
        return $this->belongsTo(Personne::class);
    }

    /**
     * Return the type demande.
     */
    public function type_demande(){
        return $this->belongsTo(TypeDemande::class);
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

}
