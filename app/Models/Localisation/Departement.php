<?php

namespace App\Models\Localisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table = 'departements';

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
        'region_id',
        'map'
    ];

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function communes(){
        return $this->hasMany(Commune::class);
    }
}
