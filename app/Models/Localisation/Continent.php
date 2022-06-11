<?php

namespace App\Models\Localisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    use HasFactory;

    protected $table = 'continents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
        'sigle',
        'visible',
        'map',
        'flag'
    ];

    public function pays(){
        return $this->hasMany(Pays::class);
    }
}
