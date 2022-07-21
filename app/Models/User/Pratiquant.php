<?php

namespace App\Models\User;

use App\Models\Params\CotePratiquant;
use App\Models\Params\FonctionPratiquant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pratiquant extends Model
{
    use HasFactory;

    protected $table = 'pratiquants';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'personne_id',
        'fonction_pratiquant_id',
        'cote_pratiquant_id',
        'ins',
        'active'
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

}
