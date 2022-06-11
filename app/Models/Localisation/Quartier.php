<?php

namespace App\Models\Localisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quartier extends Model
{
    use HasFactory;

    protected $table = 'quartiers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
        'sigle',
        'codification',
        'indicatif',
        'visible',
        'commune_id',
        'map'
    ];

    public function commune(){
        return $this->belongsTo(Commune::class);
    }
}
