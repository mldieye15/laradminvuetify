<?php

namespace App\Models\Structures;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeStructure extends Model
{
    use HasFactory;

    protected $table = 'type_structures';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'libelle',
        'sigle',
        'visible'
    ];

    public function ligue_regionale(){
        return $this->belongsTo(LigueRegionale::class);
    }
}
