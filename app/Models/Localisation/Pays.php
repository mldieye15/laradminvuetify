<?php

namespace App\Models\Localisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;

    protected $table = 'pays';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
        'sigle',
        'code_alpha2',
        'code_alpha3',
        'indicatif',
        'continent_id',
        'visible',
        'flag',
        'map',
        'current'
    ];

    public function continent(){
        return $this->belongsTo(Continent::class);
        //  return $this->belongsTo(Article::class, 'foreign_key_name');
    }

    public function regions(){
        return $this->hasMany(Region::class);
    }
}
