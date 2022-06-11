<?php

namespace App\Models\Localisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

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
        'pays_id',
        'map'
    ];

    public function pays(){
        return $this->belongsTo(Pays::class);
    }

    public function departments(){
        return $this->hasMany(Department::class);
    }
}
