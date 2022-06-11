<?php

namespace App\Models\Localisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;

    protected $table = 'communes';

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
        'departement_id',
        'map'
    ];

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function quartiers(){
        return $this->hasMany(Quartier::class);
    }
}
